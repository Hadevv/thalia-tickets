<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="
                        w-full
                        flex
                        justify-between
                        items-center
                        mb-5
                    ">
                        <a href="{{ route('show.index') }}" class="
                            text-indigo-600
                            font-semibold
                            text-sm
                            dark:text-indigo-400
                            hover:text-indigo-800
                            dark:hover:text-indigo-200">⟵ Retour</a>
                    </div>
                    <div class="w-full flex">
                        <div class="w-56 mr-10 flex-shrink-0">
                        @if ($show->poster_url)
                            <img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}" class="object-cover w-full h-auto">
                        @endif
                        
                        </div>
                        <div class="flex flex-col w-full">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $show->title }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $show->description }}</p>
                            <div class="flex flex-wrap">
                                <p class="text-gray-600 dark:text-gray-400 mr-4">{{ $show->locality }}</p>
                                <p class="text-gray-600 dark:text-gray-400 mr-4">{{ $show->type }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $show->date }}</p>
                            </div>
                            <div class="flex flex-row">
                                <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2">Auteurs :</h3>
                                <ul class="flex flex-row">
                                    @foreach ($show->authors() as $key => $author)
                                        <a href="#" class="text-indigo-600 dark:text-gray-400 text-sm font-semibold mt-2">{{ $author->firstname }} {{ $author->lastname }}</a>
                                        @if ($key < count($show->authors()) - 1)
                                            <span class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2"> - </span>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="flex flex-row">
                                <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2">Comédiens :</h3>
                                <ul class="flex flex-row">
                                    @foreach ($show->actors() as $key => $actor)
                                        <a href="#" class="text-indigo-600 dark:text-gray-400 text-sm font-semibold mt-2">
                                            {{ $actor->firstname }} {{ $actor->lastname }}
                                        </a>
                                        @if ($key < count($show->actors()) - 1)
                                            <span class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2"> - </span>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="pt-2 dark:border-gray-700 mt-2">
                                <div class="flex justify-between">
                                    en travaux
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="
                        w-full
                        mt-5
                        dark:border-gray-700
                        border-t
                        dark:border-gray-500">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-4">Représentations</h3>
                        <table class="w-full mt-2">
                            <thead>
                                <tr>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Heure</th>
                                    <th class="text-left">Lieu</th>
                                    <th class="text-left">Réservation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($show->representations as $representation)
                                    <tr>
                                        <td>
                                            @if ($representation->schedule instanceof \Carbon\Carbon)
                                                {{ $representation->schedule->format('l d F Y') }}
                                            @else
                                                {{ $representation->schedule }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($representation->schedule instanceof \Carbon\Carbon)
                                                {{ $representation->schedule->format('H:i') }}
                                            @else
                                                {{ $representation->schedule }} <!-- Supposons que c'est une heure déjà formatée -->
                                            @endif
                                        </td>

                                            @isset($representation->location->designation)
                                                {{ $representation->location->designation }}
                                            @else
                                                à définir
                                            @endisset
                                        </td>
                                        <td>
                                            @if ($show->bookable && $show->representations->count() > 0)
                                                <a href="{{ route('representation.booking', $representation->id) }}" class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">Réserver</a>
                                            @else
                                                <span class="text-red-500 text-sm font-semibold">Non réservable</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
