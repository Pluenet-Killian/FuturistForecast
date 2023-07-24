<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased w-full h-[100vh]">
        <div class="backgroundLogin w-full h-full bg-cover flex items-center justify-center" style="background-image: url('{{ asset('images/bg-login.png') }}')">
            <div class="w-full sm:max-w-xl  px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg ">
            <p class="text-center font-semibold text-5xl">FuturistForecast</p>
            <p class="text-center font-semibold text-gray-700 text-xl mt-4">Faites vos prédictions, qui sera le plus clairvoyant ?</p>

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
    </div>

    </body>
</html>
