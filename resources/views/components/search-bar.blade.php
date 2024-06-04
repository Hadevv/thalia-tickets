@props(['search'])

<form action="{{ route('show.index') }}" method="GET" id="searchForm" class="flex">
    <div class="relative w-full w-[35ch] max-w-[40ch]">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search..." class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm pr-8" id="searchInput">
            <a href="{{ route('show.clear') }}" class="absolute inset-y-0 right-0 mr-3 flex items-center justify-center text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
    </div>
</form>





