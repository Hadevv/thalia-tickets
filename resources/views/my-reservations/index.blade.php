<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($reservations->count() > 0)
                        @foreach ($reservations as $reservation)
                            <div class="flex flex-col space-y-4">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-2xl font-semibold">
                                        @if (
                                            $reservation->representation_reservations->isNotEmpty() &&
                                                $reservation->representation_reservations->first()->representationSeat->representation)
                                            {{ $reservation->representation_reservations->first()->representationSeat->representation->show->title }}
                                        @else
                                            Information non disponible
                                        @endif
                                    </h2>
                                    <span class="text-lg font-semibold">{{ $reservation->total() }}€</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p>Quantité : {{ $reservation->representation_reservations->sum('quantity') }}</p>
                                    <p
                                        @if (
                                            $reservation->representation_reservations->isNotEmpty() &&
                                                $reservation->representation_reservations->first()->representation &&
                                                $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon)
                                            {{ $reservation->representation_reservations->first()->representation->schedule->format('d/m/Y H:i') }}
                                        @else
                                            Date et heure non disponible
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Lieu :
                                        @if (
                                            $reservation->representation_reservations->isNotEmpty() &&
                                                $reservation->representation_reservations->first()->representationSeat->representation &&
                                                $reservation->representation_reservations->first()->representationSeat->representation->location)
                                            {{ $reservation->representation_reservations->first()->representationSeat->representation->location->designation }}
                                        @else
                                            Information non disponible
                                        @endif
                                    </p>
                                    <p>
                                        Adresse :
                                        @if (
                                            $reservation->representation_reservations->isNotEmpty() &&
                                                $reservation->representation_reservations->first()->representationSeat->representation &&
                                                $reservation->representation_reservations->first()->representationSeat->representation->location)
                                            {{ $reservation->representation_reservations->first()->representationSeat->representation->location->address }}
                                        @else
                                            Information non disponible
                                        @endif
                                    </p>
                                    <p>
                                        Ville :
                                        @if (
                                            $reservation->representation_reservations->isNotEmpty() &&
                                                $reservation->representation_reservations->first()->representationSeat->representation &&
                                                $reservation->representation_reservations->first()->representationSeat->representation->location &&
                                                $reservation->representation_reservations->first()->representationSeat->representation->location->locality)
                                            {{ $reservation->representation_reservations->first()->representationSeat->representation->location->locality->locality }},
                                            {{ $reservation->representation_reservations->first()->representationSeat->representation->location->locality->postal_code }}
                                        @else
                                            Information non disponible
                                        @endif
                                    </p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p>Date et heure :
                                        @if (
                                            $reservation->representation_reservations->isNotEmpty() &&
                                                $reservation->representation_reservations->first()->representationSeat->representation &&
                                                $reservation->representation_reservations->first()->representationSeat->representation->schedule)
                                            {{ \Carbon\Carbon::parse($reservation->representation_reservations->first()->representationSeat->representation->schedule)->format('d/m/Y H:i') }}
                                        @else
                                            Aucune date et heure disponible
                                        @endif
                                    </p>
                                    <p>Réservation : @if ($reservation->status === 'confirmed')
                                            Payée
                                        @else
                                            Non payée
                                        @endif
                                    </p>
                                    <p>
                                        Sièges :
                                        @if ($reservation->representation_reservations)
                                            {{ $reservation->representation_reservations->filter(function ($representationReservation) {
                                                    return $representationReservation->representationSeat->seat !== null;
                                                })->map(function ($representationReservation) {
                                                    return $representationReservation->representationSeat->seat->seat_number;
                                                })->flatten()->implode(', ') }}
                                        @else
                                            Aucun siège réservé
                                        @endif
                                    </p>
                                </div>
                                <div class="flex space-x-4">
                                    <form action="{{ route('my-reservations.download-invoice', $reservation->id) }}"
                                        method="GET">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Télécharger
                                            la facture</button>
                                    </form>
                                    <form action="{{ route('my-reservations.cancel', $reservation->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Annuler
                                            la réservation</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        {{ $reservations->links() }}
                    @else
                        <p class="mt-4">Aucune réservation trouvée</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
