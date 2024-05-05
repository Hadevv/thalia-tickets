<x-app-layout>
    <div class="flex justify-center flex-col py-6 px-4 md:flex-row md:px-0 md:mr-24 md:ml-24 md:py-6">
        <div class="w-full md:w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-1 mb-4">
            <div class="sm:min-w-36 p-6 text-gray-900 dark:text-gray-100">
                <!-- Contenu de la première zone blanche -->
                <x-search-bar :shows="$shows" :search="$search ?? '' "/>
                <h3 class="
                    text
                    font-semibold
                    text-lg
                    text-gray
                    dark:text-gray-200
                ">Filtrer les spectacles</h3>
                <form action="{{ route('show.index') }}" method="get" id="filterForm">
                    <x-input-label for="date_from" value="De" />
                    <input type="date" name="date_from" id="date_from" value="{{ $date_from ?? '' }}" onchange="submitForm()" class="w-full w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                    <x-input-label for="date_to" value="à" />
                    <input type="date" name="date_to" id="date_to" value="{{ $date_to ?? '' }}" onchange="submitForm()" class="w-full w-[35ch] max-w-[40ch] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                    <x-input-label for="location" value="Lieux" />
                    <x-select name="location" :options="$lieux ?? []" :selected="$location ?? null" onchange="submitForm()" class="w-[35ch] max-w-[40ch]" />
                </form>
            </div>
        </div>
        <div class="w-full md:w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-1 md:sm">
            <div class="p-6 text-gray-900 dark:text-gray-100 overflow-y-auto max-h-[700px] md:sm w-full">
                <!-- Contenu de la deuxième zone blanche -->
                <!-- les spectacles -->
                @foreach ($shows as $show)
                    <x-show-card :show="$show" />
                @endforeach
            </div>
            <div class="p-6">
                {{ $shows->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function submitForm() {
                const dateFrom = document.getElementById('date_from').value;
                const dateTo = document.getElementById('date_to').value;

                // Vérifier si les deux dates sont définies
                if (dateFrom && dateTo) {
                    // Si les deux dates sont définies, soumettre le formulaire
                    console.log("Form submitted");
                    document.getElementById('filterForm').submit();
                } else {
                    alert("Veuillez sélectionner à la fois une date de début et une date de fin.");
                }
            }
        </script>
    @endpush
</x-app-layout>




