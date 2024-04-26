<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex justify-center items-center w-full" action="{{ route('admin.representation.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-4">

                            <x-input-label for="schedule" value="Horaire" />
                            <input type="datetime-local" name="schedule" value="{{ old('schedule') }}" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('schedule')" class="mt-2" />

                            <x-input-label for="location_id" value="Lieu" />
                            <x-select name="location_id" :options="$locations->pluck('designation', 'id')->toArray()" class="w-[35ch] max-w-[35ch]" />
                            <x-input-error :messages="$errors->get('location_id')" class="mt-2" />

                            <x-input-label for="show_id" value="Spectacle" />
                            <x-select name="show_id" :options="$shows->pluck('title', 'id')->toArray()" class="w-[35ch] max-w-[35ch]" />
                            <x-input-error :messages="$errors->get('show_id')" class="mt-2" />

                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
