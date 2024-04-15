<x-app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    {{ session()->get('notification') }}
                </div>
            @endif
            <div class="py-8 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center mb-5">
                                    <x-admin-card
                                    name="Shehab Najib"
                                    role="Creator"
                                    description="Account owner"
                                    email="howpossible17@example.com"
                                    phone="+1-202-555-0170"
                                    />
                                <a href="{{ route('show.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Ajouter un spectacle</a>
                        </div>
                    </div>
                </div>

                @if($shows->isNotEmpty())
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Title</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Author</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($shows as $show)
                                    <tr>
                                        <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm">
                                            <div class="text-gray-500">{{ Str::limit($show->title, 70) }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            <span>
                                                @foreach($show->authors() as $author)
                                                <a href="#" class="text-sm">{{ $author->firstname }} {{ $author->lastname }}</a>
                                                @if(!$loop->last)
                                                <span class="text-gray-500"> - </span>
                                                @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            <span class="inline-flex items-center rounded-md bg-{{ $show->bookable }}-50 px-2 py-1 text-xs font-medium text-{{ $show->bookable }}-700 ring-1 ring-inset ring-{{ $show->bookable }}-600/20">{{ $show->bookable }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">{{ $show->created_in->format('m/d/Y') }}</td>
                                        <td class="flex items-center space-x-5 relative whitespace-nowrap py-5 pl-3 pr-4 text-left text-sm font-medium sm:pr-0">
                                            <a href="{{ route('show.create') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:cursor-pointer hover:text-gray-400 transition ease-in-out duration-300">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('show.edit', $show) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 hover:cursor-pointer hover:text-gray-400 transition ease-in-out duration-300">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>

                                            @include('show.partials.delete-show-form', [
                                                'showId' => $show->id
                                            ])
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
                        <p class="mt-2 text-sm text-gray-700">No show at the moment.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
</x-app-layout>
