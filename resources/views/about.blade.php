<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About') }}
        </h2>
    </x-slot>

    <div class="py-2 bg-white shadow-sm sm:rounded-lg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="p-4">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                        {{ __('It is all about eservation!') }}
                    </h2>
                    <div class="mt-8">
                        <p>Discover a modern theatre ticket booking experience in Belgium</p>
                        <p>That's why I created <a href="{{ config('app.url') }}" class="underline">reservation.com</a>,It aims to be simple and minimalist.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
