<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" bg-red-700 bg-opacity-80 p-6">
                        <h2 class="text-2xl font-semibold text-white dark:text-gray-100">Repertoire</h2>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Liste des représentations</div>
                                <div class="card-body">
                                    @foreach ($paginatedRepresentationsByDay as $day => $representations)
                                        <h2>{{ $day }}</h2>
                                        <ul>
                                            @foreach ($representations as $representation)
                                                @dd($representation)
                                                <li>
                                                    <strong>{{ $representation->show->title }}</strong> -
                                                    {{ $representation->schedule->format('H:i') }} -
                                                    {{ $representation->show->location }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach

                                    {{ $paginatedRepresentationsByDay->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
