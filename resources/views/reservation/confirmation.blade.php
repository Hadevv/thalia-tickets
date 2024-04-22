<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">Confirmation de réservation</div>
                                    <div class="card-body">
                                        <p>Merci pour votre réservation !</p>
                                        <p>Détails de la réservation :</p>
                                        <ul>
                                            <li>ID de la réservation : {{ $reservation->id }}</li>
                                            <li>Date de réservation : {{ $reservation->booking_date }}</li>
                                            <li>Status : {{ $reservation->status }}</li>
                                        </ul>
                                        <p>vous allez resevoir un mail de confirmation avec les détails de la réservation.</p>
                                    </div>
                                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Retour</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
