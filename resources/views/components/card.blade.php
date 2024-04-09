<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm sm:rounded-lg']) }}>
    @if (isset($image))
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full">
    @endif
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">{{ $title }}</h2>
        <p class="mt-2 text-gray-600 text-sm">{{ $slot }}</p>
    </div>
</div>
