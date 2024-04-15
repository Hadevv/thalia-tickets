<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Reservation</h1>
                    <form action="{{ route('reservation.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="show_id" value="{{ $show->id }}">
                        <div class="mb-4">
                            <label for="seats" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">Number of seats:</label>
                            <input type="number" name="seats" id="seats" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-400 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <button type="submit" class="
                            text-indigo-600
                            hover:bg-indigo-600
                            text-white
                            font-bold
                            py-2
                            px-4
                            rounded
                            mt-4
                            inline-block
                        ">Reserve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
