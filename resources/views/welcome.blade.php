<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <style>
        body {
            margin: 0;
            line-height: inherit;
        }
    </style>
</head>

<body
    class=
    "antialiased
    bg-gray-200
    bg-no-repeat"
    style="background-image: url('storage/VolaFinance/HeroCover.jpg');
    background-size: 100% 80vh"
>
<div class="h-full">
    <div class="w-full container mt-2">
        <div class="grid grid-cols-8 gap-4">
            <div class="col-span-2 justify-self-end gap-2 font-bold text-xl p-3">
                BrandName
            </div>

            <div class="col-span-2 ml-6 p-3">
                <div class="grid grid-cols-4 gap-1">
                    <div class="col-span-1 font-medium">Home</div>
                    <div class="col-span-1 font-medium">Product</div>
                    <div class="col-span-1 font-medium">Pricing</div>
                    <div class="col-span-1 font-medium">Contact</div>
                </div>
            </div>

            <div class="col-span-4">
                <div class="grid grid-cols-2 gap-5 ">
                    <div class="col-span-1 justify-self-end font-medium p-3">
                        <a href="#">Login</a>
                    </div>
                    <div class="col-span-1 font-medium">
                        <button class="col-span-1 font-medium bg-blue-500 text-white rounded-md px-3 py-3">
                            Become a Member
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="pt-28 w-96 mx-auto grid grid-cols-1 gap-4 place-items-center place-content-center">
            <div class="text-white font-bold text-4xl text-center">
                Creating Beautifull & Usefull Solutions
            </div>

            <div class="text-white font-semibold text-center">
                <p>We know how large projects will act, but things on a small scale do not act that way </p>
            </div>

            <div class="flex flex-wrap justify-between space-x-7">
                <button class="rounded-full border px-6 py-3 bg-blue-500 text-white">
                    Get Quote Now
                </button>

                <button class="rounded-full px-6 py-3 border text-white hover:bg-blue-500">
                    Learn More
                </button>
            </div>
        </div>

        <div class="my-10 w-2/3 mx-auto grid grid-cols-12 gap-5 place-items-center place-content-center">
            <div class="h-40 col-span-4 space-y-1 flex flex-col px-10 py-5 bg-white overflow-hidden shadow hover:shadow-md">
                <div>
                    <img alt="people" src="{{url('storage/VolaFinance/IcnPeopleColorIcon.png')}}">
                </div>
                <div>
                    <p class="font-bold text-xl">Investment Trading</p>
                </div>
                <p class="text-wrap text-sm text-gray-600">the quick fox jumps over the lazy dog</p>
            </div>

            <div class="h-40 col-span-4 space-y-1 flex flex-col px-10 py-5 bg-white overflow-hidden shadow hover:shadow-md">
                <div>
                    <img alt="people" src="{{url('storage/VolaFinance/IcnPeopleColorIcon.png')}}">
                </div>
                <div>
                    <p class="font-bold text-xl">Raising Funds</p>
                </div>
                <p class="text-wrap text-sm text-gray-600">the quick fox jumps over the lazy dog</p>
            </div>

            <div class="bg-sky-500 h-40 col-span-4 space-y-1 flex flex-col px-10 py-5 bg-white overflow-hidden shadow hover:shadow-md">
                <div>
                    <img alt="people" src="{{url('storage/VolaFinance/IcnPeopleIcon.png')}}">
                </div>
                <div>
                    <p class="font-bold text-xl text-white">Financial Analysis</p>
                </div>
                <p class="text-wrap text-sm text-gray-600 text-slate-50">the quick fox jumps over the lazy dog</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
