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
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Feed rss & atom  -->
    @cookieconsentscripts
    <x-feed-links />

    <!-- Scripts -->
    @vite(['resources/css/all.min.css','resources/css/app.css','resources/js/app.js'])

</head>
<body class="font-sans antialiased flex flex-col min-h-screen">
    <div class="flex-grow bg-gray-100 dark:bg-gray-900 flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main class="flex-grow">
            <div id="app">
                {{ $slot }}
            </div>
        </main>

        <!-- Page Footer -->
        @include('layouts.footer')
    </div>
    @cookieconsentview

    <!-- Scripts -->
    @stack('scripts')

    </body>
</html>
