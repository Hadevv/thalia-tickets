<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Locality') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>{{ $locality->postal_code }} - {{ $locality->locality }}</h1>
                    <ul class="mt-4">
                        @foreach ($locality->locations as $location)
                        <li class="list-disc ml-8">
                            {{$location->designation}}
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('locality.index') }}">Retour à l'index</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
