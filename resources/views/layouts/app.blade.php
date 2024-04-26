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
    @cookieconsentscripts
    <!-- Feed rss & atom  -->
    <x-feed-links />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        @unless(request()->routeIs('home'))
        @include('layouts.footer')
        @endunless
    </div>
    @cookieconsentview
</body>
    <script>
        function submitForm() {
            console.log("Form submitted");
            document.getElementById('filterForm').submit();
        }
        function updateTotal(form) {
            let total = 0;
            let totalPlaces = 0;

            // Calculer le total des places
            form.querySelectorAll('[name^=places]').forEach(input => {
                const price = input.getAttribute('data-price');
                const quantity = parseInt(input.value);

                if (price && quantity > 0) {
                    total += quantity * parseFloat(price);
                    totalPlaces += quantity;
                }
            });

            // Calculer le total des sièges
            form.querySelectorAll('[name^=selected_seats]').forEach(input => {
                const price = input.getAttribute('data-price');

                if (price && input.checked) {
                    total += parseFloat(price);
                }
            });

            // Mettre à jour le total
            const totalElement = form.querySelector('#total');
            if (totalElement) {
                totalElement.innerText = '€ ' + parseFloat(total).toFixed(2);
            }

            // Valider le nombre de sièges sélectionnés
            const seatsInputs = form.querySelectorAll('[name^=selected_seats]');
            const selectedSeatsCount = Array.from(seatsInputs).filter(input => input.checked && !input.disabled).length;

            seatsInputs.forEach(input => {
                input.disabled = (selectedSeatsCount >= totalPlaces && !input.checked);
            });
        }
    </script>
</html>
