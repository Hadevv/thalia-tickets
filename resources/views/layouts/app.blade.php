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
</body>
    <script>
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            document.getElementById('location').value = '';

            document.getElementById('searchInput').addEventListener('input', function() {
                document.getElementById('searchForm').submit();
            });

            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Empêche le formulaire de se soumettre normalement

                // Réinitialisez l'URL en supprimant les paramètres de requête
                const baseUrl = window.location.href.split('?')[0];
                window.history.replaceState(null, null, baseUrl);

                // Soumet le formulaire
                document.getElementById('searchForm').submit();
            });
        }
        function submitForm() {
            const dateFrom = document.getElementById('date_from').value;
            const dateTo = document.getElementById('date_to').value;

            // Vérifier si les deux dates sont définies
            if (dateFrom && dateTo) {
                // Si les deux dates sont définies, soumettre le formulaire
                console.log("Form submitted");
                document.getElementById('filterForm').submit();
            } else {
                // Si seulement une des dates est définie, afficher un message d'erreur
                alert("Veuillez sélectionner à la fois une date de début et une date de fin.");
            }
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
