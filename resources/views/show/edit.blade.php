<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex justify-center items-center w-full" action="{{ route('show.update', $show->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col space-y-2">

                            <x-input-label for="title" value="Titre" />
                            <input type="text" name="title" value="{{ $show->title }}" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />

                            <x-input-label for="description" value="Description" />
                            <textarea name="description" class="w-full max-w-full h-48 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $show->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />

                            <x-input-label for="poster_url" value="Poster URL" />
                            <input type="text" name="poster_url" value="{{ $show->poster_url }}" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('poster_url')" class="mt-2" />

                            <x-input-label for="artists" value="Artistes" />
                            <select name="artists[]" multiple class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-[35ch] max-w-[35ch]">
                                @foreach($artists as $artist)
                                    <option value="{{ $artist->id }}" {{ $show->artists->contains($artist->id) ? 'selected' : '' }}>
                                        {{ $artist->firstname }} {{ $artist->lastname }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('artists')" class="mt-2" />

                            <x-input-label for="duration" value="Durée (minutes)" />
                            <input type="number" name="duration"value="{{ $show->duration }}" step="10" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />

                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

