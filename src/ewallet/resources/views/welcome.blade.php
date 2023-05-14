<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Collective Bank</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    ])
</head>

<body class="antialiased">
    <div
        class="relative min-h-screen bg-center bg-gray-50 sm:flex sm:justify-center sm:items-center bg-dots-darker selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
        <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
            <a href="{{ route('login') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <section>
            <div class="max-w-screen-xl px-4 py-32 mx-auto lg:flex lg:h-screen lg:items-center">
                <div class="max-w-xl mx-auto text-center">
                    <h1 class="text-3xl font-extrabold sm:text-5xl">
                        CollectiveBank
                        <div class="font-extrabold text-red-700 sm:block">
                            Simplify Your Finances
                        </div>
                    </h1>

                    <p class="mt-4 sm:text-xl/relaxed">
                        Effortlessly manage your money with CCbank, the user-friendly platform designed to make deposits
                        and withdrawals a breeze. Say goodbye to complex processes and hello to simplicity!
                    </p>

                    <div class="flex flex-wrap justify-center gap-4 mt-8">
                        <a class="block w-full px-12 py-3 text-sm font-medium text-white bg-red-600 rounded shadow hover:bg-red-700 focus:outline-none focus:ring active:bg-red-500 sm:w-auto"
                            href="/login">
                            Login
                        </a>

                        <a class="block w-full px-12 py-3 text-sm font-medium text-red-600 bg-white rounded shadow hover:text-red-700 focus:outline-none focus:ring active:text-red-500 sm:w-auto"
                            href="/register">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </section>
        {{-- Copyright info --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 text-center text-gray-500">
            <p class="text-sm">
                &copy; {{ date('Y') }} CollectiveBank. All rights reserved.<br>
                Made by Frenki Herlambang Prasetyo
            </p>
        </div>
    </div>
</body>

</html>
