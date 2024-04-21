<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($reservations && $reservations->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                                <li class="py-4">
                                    @if ($reservation->representation_reservations && $reservation->representation_reservations->count() > 0)
                                        <div class="flex items-start justify-between">
                                            <div class="flex items-center space-x-10">
                                                <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 relative">
                                                    <div class="absolute inset-0 flex items-center justify-center opacity-95">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-8 h-8 fill-current text-white">
                                                            <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                                        </svg>
                                                    </div>
                                                    <img src="{{ asset('images/' . $reservation->representation_reservations->first()->representation->show->poster_url) }}" alt="{{ $reservation->representation_reservations->first()->representation->show->title }}" class="w-full h-full object-cover object-center">
                                                </div>

                                                <div class="flex flex-col">
                                                    <h3 class="text-lg font-semibold">{{ $reservation->representation_reservations->first()->representation->show->title }}</h3>
                                                    <p class="text-sm text-gray-500">Qté {{ $reservation->representation_reservations->sum('quantity') }}</p>
                                                    <p class="text-sm text-gray-500">{{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('d/m/Y H:i') : '' }}</p>
                                                </div>
                                                <h3 class="mt-2">
                                                    {{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('l d F Y') : $reservation->representation_reservations->first()->representation->schedule }}
                                                    {{-- faire une fonction pour rajouter à l'heure de debut le temps de la pieces --}}
                                                    {{ $reservation->representation_reservations->first()->representation->schedule instanceof \Carbon\Carbon ? $reservation->representation_reservations->first()->representation->schedule->format('H:i') : '' }}
                                                </h3>
                                                <ul class="mt-2">
                                                    @foreach($reservation->representation_reservations as $representation_reservation)
                                                        <li>{{ $representation_reservation->quantity }}x {{ $representation_reservation->price->type }} - {{ $representation_reservation->price->price }}€</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="flex items-center">
                                                <span class="text-base ">Total: {{ $reservation->total() }}€</span>
                                                <form action="{{ route('reservation.cart.remove', $reservation->id) }}" method="POST" class="ml-4">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="flex justify-end mt-6">
                            <div>
                                <p class="text-lg font-semibold">Total</p>
                                <p class="text-sm text-gray-500">Frais de port et taxes calculés lors du paiement.</p>
                            </div>
                            <div class="ml-4">
                                <p class="text-lg font-semibold">{{ number_format($total, 2, ',', ' ') }}€</p>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <div class="mt-6 flex justify-end">
                                <form action="{{ route('reservation.payall') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-4 h-4 mr-2 fill-current">
                                            <path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z"/>
                                        </svg>
                                        Procéder au paiement
                                    </button>
                                </form>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <form action="{{ route('reservation.cart.removeall') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Supprimer tout le panier</button>
                                </form>
                            </div>
                            <div class="mt-6 flex justify-start items-center">
                                <a href="{{ route('reservation.cart') }}" class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Retour au panier</a>
                            </div>
                        </div>
                        @else
                        <p class="mt-4">Votre panier est vide</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
