<?php

namespace App\Http\Controllers;

use App\Service\TransactionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getUserClosingBalance()
    {
        $response = (new TransactionService())->calculateUserClosingBalance();

        return new JsonResponse(['response' => $response], Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function getIncomeData()
    {
        $response = (new TransactionService())->getCreditDebitTransactions();

        return new JsonResponse(['response' => $response], Response::HTTP_OK);
    }
}
