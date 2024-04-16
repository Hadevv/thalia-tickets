<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session()->has('notification'))
            <div class="alert alert-success">
                {{ session()->get('notification') }}
            </div>
        @endif
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-2 z-100">
                        <dropdown></dropdown>
                        <x-admin-nav>
                            
                        </x-admin-nav>
                        {{-- <a href="{{ route('artist.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Ajouter un artiste</a> --}}
                    </div>
                </div>
            </div>
            @if($artists->isNotEmpty())
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Prénom</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nom</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($artists as $artist)
                                <tr>
                                    <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm">
                                        <div class="text-gray-500">{{ $artist->firstname }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">{{ $artist->lastname }}</td>
                                    <td class="flex items-center space-x-5 relative whitespace-nowrap py-5 pl-3 pr-4 text-left text-sm font-medium sm:pr-0">
                                        <a href="{{ route('artist.edit', $artist->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 hover:cursor-pointer hover:text-gray-400 transition ease-in-out duration-300">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>

                                        {{-- @include('artist.partials.delete-artist-form', [
                                            'artistId' => $artist->id
                                        ]) --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="sm:flex sm:items-center mt-5">
                <div class="sm:flex-auto">
                    <p class="mt-2 text-sm text-gray-700">Aucun artiste pour le moment.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
