@props(['show'])

<div class="flex flex-col max-h-m bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 mb-2">
    <div class="flex w-full">


        <div class="w-32 mr-10 flex-shrink-0">
            @if ($show->poster_url)
            @if (Str::startsWith($show->poster_url, ['http://', 'https://']))
                <img src="{{ $show->poster_url }}" alt="{{ $show->title }}" class="object-cover w-full h-auto">
            @else
                <img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}" class="object-cover w-full h-auto">
            @endif
        @endif

        </div>
        <div class="flex flex-col w-full">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $show->title }}</h2>
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
            <div class="pt-2 dark:border-gray-700 mt-2">
                <div class="flex justify-between">
                    <a href="{{ route('show.show', ['id' => $show->id, 'slug' => $show->slug]) }}" class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">En savoir plus</a>
                    @if ($show->bookable && $show->representations->count() > 0)
                        <span class="text-green-500 text-sm font-semibold">Réservable</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Non réservable</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

