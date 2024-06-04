<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="w-full flex justify-between items-center mb-5">
                        <a href="{{ route('show.index') }}"
                           class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 flex items-center">

                            <svg class="-rotate-180 mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-arrow-right">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                            Retour
                        </a>
                    </div>


                    <div class="w-full flex">
                        <div class="w-56 mr-10 flex-shrink-0">
                            @if ($show->poster_url)
                                <img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}"
                                    class="object-cover w-full h-auto">
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
                                        <a href="#"
                                            class="text-indigo-600 dark:text-gray-400 text-sm font-semibold mt-2">{{ $author->firstname }}
                                            {{ $author->lastname }}</a>
                                        @if ($key < count($show->authors()) - 1)
                                            <span class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2"> -
                                            </span>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="flex flex-row">
                                <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2">Artistes :</h3>
                                <ul class="flex flex-row">
                                    @foreach ($show->artists as $key => $artist)
                                        <a href="#"
                                            class="text-indigo-600 dark:text-gray-400 text-sm font-semibold mt-2">
                                            {{ $artist->firstname }} {{ $artist->lastname }}
                                        </a>
                                        @if ($key < count($show->artists) - 1)
                                            <span class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2"> -
                                            </span>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="flex flex-row">
                                <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2">Durée :</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2">
                                    {{ $show->duration }} minutes</p>
                            </div>

                            <div class="pt-2 dark:border-gray-700 mt-2">
                                <div class="flex justify-between">
                                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2">
                                        Saison : {{ $show->created_in }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="w-full mt-5 dark:border-gray-700 border-t dark:border-gray-500">
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
                                @php
                                    $futureRepresentations = $show->representations->filter(function ($representation) {
                                        return \Carbon\Carbon::parse($representation->schedule)->isFuture();
                                    });
                                    $hasFutureRepresentations = $futureRepresentations->count() > 0;
                                @endphp

                                @if ($hasFutureRepresentations)
                                    @foreach ($futureRepresentations as $representation)
                                        @php
                                            $availableSeats = \App\Models\RepresentationSeat::where(
                                                'representation_id',
                                                $representation->id,
                                            )
                                                ->where('status', 'available')
                                                ->count();
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ \Carbon\Carbon::parse($representation->schedule)->format('l d F Y') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($representation->schedule)->format('H:i') }}
                                            </td>
                                            <td>
                                                {{ $representation->location ? $representation->location->designation : 'Non défini' }}
                                            </td>
                                            <td>
                                                @if ($show->bookable && \Carbon\Carbon::parse($representation->schedule)->isFuture())
                                                    <a href="{{ route('representation.booking', $representation->id) }}"
                                                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold h-8 py-1 px-2 rounded">
                                                        Réserver
                                                    </a>
                                                    @if ($availableSeats == 0)
                                                        <span
                                                            class="text-red-500 text-sm font-semibold ml-12">Complet</span>
                                                    @else
                                                        <span class="text-green-500 text-sm font-semibold ml-12">Il reste
                                                            {{ $availableSeats }} places</span>
                                                    @endif
                                                @else
                                                    <span class="text-red-500 text-sm font-semibold">Non
                                                        réservable</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if (!$hasFutureRepresentations)
                            <div class="text-center text-red-500 text-sm font-semibold mt-4">
                                Actuellement, aucune représentation n'est disponible pour réservation.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

