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
                    <div>
                        @if ($show->bookable && $show->representations->count() > 0)

                            <span class="text-green-500 text-sm font-semibold">Réservable</span>
                            @foreach($show->representations->sortBy('schedule') as $representation)
                                <div>
                                    <a href="{{ route('show.show', ['id' => $show->id, 'slug' => $show->slug]) }}" class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                                        {{ \App\Helpers\DateHelper::formatScheduleDate($representation->schedule)['formattedDate'] }} - {{ \Carbon\Carbon::parse($representation->schedule)->format('H:i') }}
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <span class="text-red-500 text-sm font-semibold">Non réservable</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center gap-4 items-center">
                <a href="#" target="_blank" class="focus:outline-none cursor-pointer m-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray-300" stroke-width="1.5" stroke="currentColor" class="size-3 text-gray-500 color-indigo-200 transition ease-in-out duration-150 hover:text-indigo focus:outline-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M307 34.8c-11.5 5.1-19 16.6-19 29.2v64H176C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96h96v64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

