<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex justify-center items-center w-full" action="{{ route('artist.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-1">

                            <x-input-label for="firstname" value="Prénom" />
                            <input type="text" name="firstname" value="{{ old('firstname') }}" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />

                            <x-input-label for="lastname" value="Nom" />
                            <input type="text" name="lastname" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('lastname') }}</textarea>
                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />

                            <x-input-label for="roles" value="Roles" />
                            <x-select name="roles[]" :options="$roles->pluck('type', 'id')->toArray()" class="w-[35ch] max-w-[35ch]" multiple />
                            <x-input-error :messages="$errors->get('roles.*')" class="mt-2" />

                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
