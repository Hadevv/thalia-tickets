<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-red-700 bg-opacity-80 p-6">
                        <h2 class="text-2xl font-semibold text-white dark:text-gray-100">Repertoire</h2>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Liste des représentations</div>
                                <div class="card-header">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <a href="{{ route('schedule.index', ['date' => $previousDay]) }}">&lt;</a>
                                            <span class="mx-2">{{ $currentDayFormatted['formattedDate'] }}</span>
                                            <a href="{{ route('schedule.index', ['date' => $nextDay]) }}">&gt;</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('schedule.index', ['date' => Carbon\Carbon::parse($currentDay)->addDay()->toDateString()]) }}">Représentations du lendemain</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if(isset($paginatedRepresentationsByDay[$currentDay]))
                                        @foreach ($paginatedRepresentationsByDay[$currentDay] as $representation)
                                            <p>{{ $representation['schedule'] }}</p>
                                        @endforeach
                                        {{ $paginatedRepresentationsByDay[$currentDay]->links() }}
                                    @else
                                        <p>Aucune représentation pour ce jour.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>











