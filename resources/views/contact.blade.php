<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex justify-center items-center w-full" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-4">
                            <x-input-label for="name" value="Name" />
                            <input type="text" name="name" value="{{ old('name') }}" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                            <x-input-label for="email" value="Email" />
                            <input type="text" name="email" value="{{ old('email') }}" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            <x-input-label for="message" value="Message" />
                            <textarea name="message" rows="4" class="w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />

                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
