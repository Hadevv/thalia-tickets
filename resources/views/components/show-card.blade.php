@props(['show'])

<div class="flex flex-col max-h-m bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
    <div class="flex w-full">
        <div class="w-36 mr-10 flex-shrink-0">
        @if ($show->poster_url)
            <img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}" class="object-cover w-full h-auto">
        @endif
        </div>
        <div class="flex flex-col">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $show->title }}</h2>
            <p class="text-gray-600 dark:text-gray-400">{{ $show->description }}</p>
            <div class="flex flex-wrap">
                <p class="text-gray-600 dark:text-gray-400 mr-4">{{ $show->locality }}</p>
                <p class="text-gray-600 dark:text-gray-400 mr-4">{{ $show->type }}</p>
                <p class="text-gray-600 dark:text-gray-400">{{ $show->date }}</p>
            </div>
        </div>
    </div>
</div>

