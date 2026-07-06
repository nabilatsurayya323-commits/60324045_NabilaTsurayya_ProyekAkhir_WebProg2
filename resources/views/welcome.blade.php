<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#FDFDFC] text-[#1b1b18]">
        
        <div class="min-h-screen flex flex-col items-center justify-center p-6">
            <main class="w-full max-w-xl text-center">
                <h1 class="text-3xl font-semibold tracking-tight mb-4">
                    Selamat Datang di Laravel
                </h1>
                <p class="text-gray-600 mb-6">
                    Aplikasi Anda siap dikembangkan menggunakan Tailwind CSS v4.
                </p>
            </main>
        </div>

    </body>
</html>