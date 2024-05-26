@props(['show'])
<div x-data="{
    tags: [],
    newTag: '',
    showInput: false,
    addTag(tag) {
        if (tag.trim() !== '') {
            fetch('{{ route('show.addTag', $show->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ tag: tag.trim() })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.tags.push(tag.trim());
                        this.newTag = '';
                        this.showInput = false;
                    }
                });
        }
    },
    removeTag(index) {
        this.tags.splice(index, 1);
    }
}">
    <div class="flex justify-between items-center w-full">
        <!-- Existing Tags from Database -->
        <div
            class="flex flex-col max-h-m w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 mb-2">
            @foreach ($show->tags as $tag)
                <div class="flex items-center">
                    <div
                        class="w-22 m-2 ml-4 text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-green-200 text-green-700 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-arrow-right mr-2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                        {{ $tag->tag }}
                        @can('addTag', App\Models\Tag::class)
                            <form method="POST" action="{{ route('show.removeTag', $show->id) }}" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="tag" value="{{ $tag->tag }}">
                                <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none">
                                    &times;
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Tag Input -->
        @can('addTag', App\Models\Tag::class)
            <div class="w-24 mb-4 flex flex-col justify-end">
                <!-- Button to show the input field -->
                <button @click="showInput = !showInput"
                    class="px-2 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none">
                    Ajouter
                </button>

                <!-- Input Field (hidden by default) -->
                <div x-show="showInput" class="mt-4 flex items-center -translate-x-40">
                    <input x-model="newTag" @keydown.enter.prevent="addTag(newTag)" type="text"
                        placeholder="Ajouter un tag"
                        class="flex-grow p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <button @click="addTag(newTag)"
                        class="px-2 py-2 bg-indigo-500 text-white rounded-r-md hover:bg-indigo-600 focus:outline-none">
                        Ajouter
                    </button>
                </div>
            </div>
            <!-- Tags added via the form -->
            <div class="mt-4 flex flex-wrap">
                <template x-for="(tag, index) in tags" :key="index">
                    <div class="flex items-center bg-green-200 text-green-700 rounded-full px-3 py-1 m-1">
                        <span x-text="tag"></span>
                        <button @click="removeTag(index)" class="ml-2 text-red-500 hover:text-red-700 focus:outline-none">
                            &times;
                        </button>
                    </div>
                </template>
            </div>
        @endcan
    </div>
    <div class="flex w-full mt-4">
        <div class="w-32 mr-10 flex-shrink-0">
            @if ($show->poster_url)
                @if (Str::startsWith($show->poster_url, ['http://', 'https://']))
                    <img src="{{ $show->poster_url }}" alt="{{ $show->title }}" class="object-cover w-full h-auto">
                @else
                    <img src="{{ asset('images/' . $show->poster_url) }}" alt="{{ $show->title }}"
                        class="object-cover w-full h-auto">
                @endif
            @endif
        </div>
        <div class="flex flex-col w-full">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $show->title }}</h2>
            <p class="text-gray-600 dark:text-gray-400">{{ $show->description }}</p>
            <div class="flex flex-wrap">
                <p class="text-gray-600 dark:text-gray-400 mr-4">{{ $show->locality }}</p>
                <p class="text-gray-600 dark:text-gray-400 mr-4">{{ $show->type }}</p>
                <p class="text-gray-600 dark:text-gray-400">{{ $show->date }}</p>
            </div>
            <div class="flex flex-row mt-2">
                <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Auteurs :</h3>
                <ul>
                    @foreach ($show->authors() as $key => $author)
                        <li>
                            <a href="#"
                                class="text-indigo-600 dark:text-gray-400 text-sm font-semibold mt-2">{{ $author->firstname }}
                                {{ $author->lastname }}</a>
                            @if ($key < count($show->authors()) - 1)
                                <span class="text-gray-600 dark:text-gray-400 text-sm font-semibold mt-2"> - </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="pt-2 dark:border-gray-700 mt-2">
                <div class="flex justify-between">
                    <a href="{{ route('show.show', ['id' => $show->id, 'slug' => $show->slug]) }}"
                        class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                        En savoir plus
                    </a>
                    <div>
                        @if ($show->bookable && $show->representations->count() > 0 && $show->representations->sortBy('schedule')->first()->schedule > now())
                            <span class="text-green-500 text-sm font-semibold">Réservable</span>
                            @foreach ($show->representations->sortBy('schedule') as $representation)
                                @if (\Carbon\Carbon::parse($representation->schedule)->isFuture())
                                    <div>
                                        <a href="{{ route('show.show', ['id' => $show->id, 'slug' => $show->slug]) }}"
                                            class="text-indigo-600 font-semibold text-sm dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200">
                                            {{ \App\Helpers\DateHelper::formatScheduleDate($representation->schedule)['formattedDate'] }}
                                            - {{ \Carbon\Carbon::parse($representation->schedule)->format('H:i') }}
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <span class="text-red-500 text-sm font-semibold">Non réservable</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-center gap-4 items-center mt-4">
                @include('show.partials.share-modal' , ['show' => $show])
            </div>
        </div>
    </div>
</div>

