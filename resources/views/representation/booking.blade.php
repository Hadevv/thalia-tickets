<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <article>
                        <h3 class="text font-semibold mt-4"><strong>Representation du {{$representation->schedule->format('l d F Y')}} à {{ $representation->schedule->format('H:i') }}</strong></h3>
                        <p class="mt-4"><strong>Spectacle</strong> : {{ $representation->show->title }}</p>

                        <p class="mt-4"><strong>Lieu :</strong>
                            @if ($representation->location)
                            {{ $representation->location->designation }}
                            @elseif ($representation->show->location)
                            {{ $representation->show->location->designation }}
                            @else
                            à déterminer
                            @endif
                        </p>

                        <form x-data="{ total: 0, hasSelectedPlaces: false }" action="{{ route('create-payment-checkout') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="representation_id" value="{{ $representation->id }}">
                            <input type="hidden" name="checkout_session_id" value="{{ session('checkout_session_id') }}">

                        @foreach ($currentPrices as $price)
                            <div class="flex items-center space-x-4">
                                <label for="places_{{ $price->type }}" class=" text font-semibold text-gray-600 dark:text-gray-400">{{ ucfirst($price->type) }}(s) - {{ $price->price }}€</label>
                                <input class="w-[6ch] max-w-[8ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" x-on:input="total = total + (parseInt($event.target.value) * {{ $price->price }}); hasSelectedPlaces = true;" type="number" name="places[{{ $price->type }}]" id="places_{{ $price->type }}" class="border border-gray-300 dark:border-gray-600 p-2 w-16" data-price="{{ $price->price }}" min="0" value="0" required>
                            </div>
                            @endforeach

                            <div class="flex items-center space-x-4">
                                <strong class="text-gray-600 dark:text-gray-400">Total :</strong>
                                <span x-text="total + '€'" id="total" class="text-gray-900 dark:text-gray-100">0€</span>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <button type="submit" x-bind:disabled="!hasSelectedPlaces" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Continuer vers le paiement</button>

                                <div class="flex items-center justify-center flex-row bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded focus:outline-none focus:shadow-outline">
                                    <button type="submit" x-bind:disabled="!hasSelectedPlaces" name="action" value="addToCart" class="flex items-center bg-transparent hover:bg-gray-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-4 h-4 mr-2 fill-current text-white">
                                            <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                        </svg>
                                        Ajouter au panier
                                    </button>
                                </div>

                            </div>
                        </form>
                    </article>

                    <div class="mt-4">
                        <a href="{{ route('show.show', ['id' => $representation->show->id, 'slug' => $representation->show->slug]) }}"
                           class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                            Voir le spectacle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

