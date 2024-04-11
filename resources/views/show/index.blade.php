<x-app-layout>
    <div class="flex justify-center py-12 ml-40 mr-40">
        <div class="flex justify-center w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 ">
            <div class="min-w-20 p-6 text-gray-900 dark:text-gray-100">
                <!-- Contenu de la première zone blanche -->
                <x-search-bar :shows="$shows" :search="$search ?? '' "/>
                <h3 class="
                    text
                    font-semibold
                    text-lg
                    text-gray
                    dark:text-gray-200
                ">Filtrer les spectacles</h3>
                <x-input-label for="date" value="De" />
                <input type="date" name="" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                <x-input-label for="date" value="à" />
                <input type="date" name="" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                <x-input-label for="location" value="Lieux" />
                <x-select name="location" :options="$lieux ?? []" class="w-[35ch] max-w-[40ch]" />

            </div>
        </div>
        <div class="w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2">
            <div class="p-6 text-gray-900 dark:text-gray-100 overflow-y-auto max-h-[700px]">
                <!-- Contenu de la deuxième zone blanche -->
                <!-- les spectacles -->
                @foreach ($shows as $show)
                    <x-show-card :show="$show" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
