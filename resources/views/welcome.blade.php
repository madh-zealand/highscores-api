<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="text-black/50 dark:text-white/50 bg-gradient-to-t from-violet-400 to-fuchsia-300">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <x-application-logo class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]"></x-application-logo>
                        </div>
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ route('dashboard') }}"
                                        class="rounded-md px-3 py-2 text-sky-600 ring-1 ring-transparent transition hover:bg-sky-50/20 hover:text-sky-900 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-sky-600 ring-1 ring-transparent transition hover:bg-sky-50/20 hover:text-sky-900 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-sky-600 ring-1 ring-transparent transition hover:bg-sky-50/20 hover:text-sky-900 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6 flex flex-col items-center gap-8">
                        <h1 class="text-6xl font-extrabold text-sky-900 drop-shadow-md">
                            Highscores API
                        </h1>
                        <div class="text-lg text-center px-6">
                            Welcome to Highscore API — the simplest way to manage game leaderboards online.
                            Whether you’re developing a retro arcade shooter or the next big mobile hit,
                            our straightforward API lets you create, track, and display highscores for all
                            your games in real time.
                            <br>
                            Level up your gaming experience with secure, fast, and reliable leaderboard services!
                        </div>
                        <div class="text-lg font-bold text-center px-6">
                            Register now to manage your game highscores effortlessly
                        </div>
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center px-4 py-2 bg-sky-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            Register your account now
                        </a>
                        <x-welcome-splash-image
                            class="max-w-md drop-shadow-md"
                        ></x-welcome-splash-image>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Created by Martin Dilling-Hansen
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
