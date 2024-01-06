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
    bg-no-repeat"
    style="background-image: url('storage/VolaFinance/HeroCover.jpg');
    background-size: 100% 80vh"
>
<div class="flex">
    <div class="flex-none w-1/4">
        <div class="grid justify-items-end">
            <span class="font-semibold capitalize">brandName</span>
        </div>
    </div>
    <div class="flex-1 w-1/4">
        <div class="grid grid-cols-4 gap-1 justify-items-end">
            <div>Home</div>
            <div>Product</div>
            <div>Pricing</div>
            <div>Content</div>
        </div>
    </div>
    <div class="flex-1 w-1/2">
        <div class="grid grid-cols-2 justify-items-center">
            <div class="col-span-1/4">
                Login
            </div>
            <div class="col-span-3/4">
                Sign
            </div>
        </div>
    </div>
</div>
<div>

</div>
</body>
</html>
