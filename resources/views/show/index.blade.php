<x-app-layout>
    <h1 class="text-3xl font-bold text-gray-800 my-6 text-center">Liste de nos spectacles</h1>

    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($shows as $show)
            <div class="border border-gray-300 rounded-lg shadow-lg p-4 flex flex-col items-center">
                <div class="w-25 h-25 overflow-hidden ">
                    <img src="{{ asset($show->poster_url) }}" alt="{{ $show->title }}" >
                </div>
                <h2 class="text-xl font-bold mt-4">
                    <a href="{{ route('show.show', $show->id) }}" class="hover:underline">{{ $show->title }}</a>
                </h2>
                <p class="text-gray-600 my-2 text-center">{{ $show->description }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
