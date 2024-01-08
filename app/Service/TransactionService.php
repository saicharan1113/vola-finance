<?php

namespace App\Service;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    private $latest_transaction;

    /**
     * @return array
     */
    public function calculateUserClosingBalance()
    {
        $this->latest_transaction = Transaction::orderBy('trans_plaid_date', 'desc')->first();

        $daily_90_days_closing_balance = $this->daily90DaysClosingBalance();

        $avg_90_days_balance = $this->avg90DaysClosingBalance();

        $first_30days_and_last30_days_avg = $this->first30DaysAndLast30AvgClosingBalance();


        return [
            'daily_90_days_closing_balance' => $daily_90_days_closing_balance,
            'avg_90_days_balance' => $avg_90_days_balance,
            'first_30days_and_last30_days_avg' => $first_30days_and_last30_days_avg
        ];
    }

    /**
     * @return mixed
     */
    private function daily90DaysClosingBalance()
    {
        return Transaction::select([
            'trans_user_id as user_id',
            'trans_plaid_date as trans_date',
            DB::raw(
                'ROUND(SUM(trans_plaid_amount + ?), 2) as rounded_sum'
            )
        ])->whereDate('trans_plaid_date', '<=', $this->latest_transaction->trans_plaid_date)
            ->whereDate('trans_plaid_date', '>=', $this->latest_transaction->trans_plaid_date->subDays(90))
            ->groupBy('trans_plaid_date', 'trans_user_id')
            ->addBinding('5', 'select')  //intial value as $5
            ->get();
    }

    /**
     * @return mixed
     */
    private function avg90DaysClosingBalance()
    {
        return Transaction::select([
            'trans_user_id as user_id',
            'trans_plaid_date as trans_date',
            DB::raw(
                'ROUND(AVG(trans_plaid_amount + ?), 2) as rounded_avg'
            )
        ])->whereDate('trans_plaid_date', '<=', $this->latest_transaction->trans_plaid_date)
            ->whereDate('trans_plaid_date', '>=', $this->latest_transaction->trans_plaid_date->subDays(90))
            ->groupBy('trans_plaid_date', 'trans_user_id')
            ->addBinding('5', 'select')  //intial value as $s5
            ->get();
    }

    /**
     * @return mixed
     */
    private function first30DaysAndLast30AvgClosingBalance()
    {
        return Transaction::select(
            'trans_user_id',
            DB::raw('ROUND(AVG(CASE WHEN day_number <= 30 THEN closing_balance END), 2) AS avg_first_30_days'),
            DB::raw('ROUND(AVG(CASE WHEN day_number > 60 THEN closing_balance END), 2) AS avg_last_30_days')
        )
            ->fromSub(function ($query) {
                $query->select(
                    'trans_user_id',
                    DB::raw('SUM(trans_plaid_amount) OVER (PARTITION BY trans_user_id ORDER BY trans_plaid_date) AS closing_balance'),
                    DB::raw('ROW_NUMBER() OVER (PARTITION BY trans_user_id ORDER BY trans_plaid_date) AS day_number')
                )
                    ->from('transactions');
            }, 'subquery')
            ->groupBy('trans_user_id')
            ->get();
    }

    /**
     * @return array
     */
    public function getCreditDebitTransactions()
    {
        $last30_days_income = $this->last30DaysIncome();
        $last30_days_debit_transaction = $this->last30DaysDebitTransaction();
        $sum_debit_transaction_on_days = $this->debitTransactionsOnDays();
        $sum_income_transaction_amount_greater_than_15 = $this->sumTransactionGreaterThan15();

        return [
            'last30_days_income' => $last30_days_income,
            'last30_days_debit_transaction' => $last30_days_debit_transaction,
            'sum_debit_trans_on_fri_sat_sun_day' => $sum_debit_transaction_on_days,
            'sum_income_with_transaction_amount_greater_than_15' => $sum_income_transaction_amount_greater_than_15
        ];
    }

    /**
     * @return mixed
     */
    private function last30DaysIncome()
    {
        return Transaction::select(DB::raw('ROUND(SUM(trans_plaid_amount),2) as total_income'))
            ->where('trans_plaid_category_id', '!=', 18020004)
            ->where('trans_plaid_amount', '>', 0)
            ->whereDate('trans_plaid_date', '<=', today())
            ->whereDate('trans_plaid_date', '>=', today()->subDays(30))
            ->groupBy('trans_user_id')
            ->get();
    }

    /**
     * @return mixed
     */
    private function last30DaysDebitTransaction()
    {
        return Transaction::where('trans_plaid_category_id', '!=', 18020004)
            ->where('trans_plaid_amount', '<', 0)
            ->whereDate('trans_plaid_date', '<=', today())
            ->whereDate('trans_plaid_date', '>=', today()->subDays(30))
            ->groupBy('trans_user_id')
            ->count();
    }

    /**
     * @return mixed
     */
    private function debitTransactionsOnDays()
    {
        return Transaction::select(DB::raw('ROUND(SUM(ABS(trans_plaid_amount)), 2) as total_income'))
            ->where(function ($query) {
                $query->whereRaw('DAYOFWEEK(trans_plaid_date) = 6') // Friday
                ->orWhereRaw('DAYOFWEEK(trans_plaid_date) = 7') // Saturday
                ->orWhereRaw('DAYOFWEEK(trans_plaid_date) = 1'); // Sunday
            })
            ->where('trans_plaid_amount', '<', 0)
            ->groupBy('trans_user_id')
            ->get();
    }

    /**
     * @return mixed
     */
    private function sumTransactionGreaterThan15()
    {
        return Transaction::select(DB::raw('ROUND(SUM(ABS(trans_plaid_amount)), 2) as total_income'))
            ->where('trans_plaid_amount', '>', 15)
            ->groupBy('trans_user_id')
            ->get();
    }
}
