<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Mon panier</h2>
                    @if ($reservations && $reservations->count() > 0)
                        <ul>
                            @foreach($reservations as $reservation)
                                <li>
                                    @if ($reservation->representation_reservations && $reservation->representation_reservations->count() > 0)
                                    <h3>
                                        {{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('l d F Y') : $reservation->representation_reservations->first()->representation->schedule }}
                                        à
                                        {{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('H:i') : '' }}
                                    </h3>

                                        <ul>
                                            @foreach($reservation->representation_reservations as $representation_reservation)
                                                <li>{{ $representation_reservation->quantity }}x {{ $representation_reservation->price->type }} - {{ $representation_reservation->price->price }}€</li>
                                            @endforeach
                                        </ul>
                                        <p>Total: {{ $reservation->total() }}€</p>
                                    @endif
                                    <form action="{{ route('reservation.cart.remove', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <form action="{{ route('create-payment-checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Procéder au paiement</button>
                        </form>
                    @else
                        <p>Votre panier est vide</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
