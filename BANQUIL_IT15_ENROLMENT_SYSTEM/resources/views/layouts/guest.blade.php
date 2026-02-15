<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-red-950">
            <a href="{{ url('/') }}" class="flex items-center justify-center w-20 h-20 rounded-xl bg-white border-2 border-red-400 shadow-lg shrink-0">
                <x-application-logo class="w-12 h-12 fill-current text-red-600" />
            </a>
            <p class="mt-3 text-sm font-semibold text-white">Mini Academic Portal</p>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white border-2 border-red-800 shadow-xl overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
