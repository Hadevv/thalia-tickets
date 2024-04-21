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
                            <button type="submit" x-bind:disabled="!hasSelectedPlaces" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Continuer vers le paiement</button>
                        </form>
                    </article>

                    

                    <div class="mt-4">
                        <a href="{{ route('show.show', $representation->show->id) }}" class="
                            text-indigo-600
                            font-semibold
                            text-sm
                            dark:text-indigo-400
                            hover:text-indigo-800
                            dark:hover:text-indigo-200">Voir le spectacle</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

