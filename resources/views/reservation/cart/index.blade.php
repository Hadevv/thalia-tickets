<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold">Mon panier</h2>
                    @if ($reservations && $reservations->count() > 0)
                        <ul class="mt-4">
                            @foreach($reservations as $reservation)
                                <li class="mb-4">
                                    @if ($reservation->representation_reservations && $reservation->representation_reservations->count() > 0)
                                    <h3 class="text-lg font-semibold">
                                        {{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('l d F Y') : $reservation->representation_reservations->first()->representation->schedule }}
                                        à
                                        {{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('H:i') : '' }}
                                    </h3>
                                        <ul class="mt-2">
                                            @foreach($reservation->representation_reservations as $representation_reservation)
                                                <li>{{ $representation_reservation->quantity }}x {{ $representation_reservation->price->type }} - {{ $representation_reservation->price->price }}€</li>
                                            @endforeach
                                        </ul>
                                        <p class="mt-2">Total: {{ $reservation->total() }}€</p>
                                    @endif
                                    <form action="{{ route('reservation.cart.remove', $reservation->id) }}" method="POST" class="mt-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">Supprimer</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <form action="{{ route('create-payment-checkout') }}" method="POST" class="mt-6">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Procéder au paiement</button>
                        </form>
                    @else
                        <p class="mt-4">Votre panier est vide</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

