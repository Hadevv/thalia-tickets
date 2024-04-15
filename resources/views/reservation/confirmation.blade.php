<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Reservation confirmation</h1>
                    <p>Your reservation has been confirmed.</p>
                    <p>Reservation number: {{ $reservation->id }}</p>
                    <p>Show: {{ $reservation->show->title }}</p>
                    <p>Date: {{ $reservation->show->date }}</p>
                    <p>Number of seats: {{ $reservation->seats }}</p>
                    <p>Price: {{ $reservation->price }} €</p>
                    <p>Reservation date: {{ $reservation->created_at }}</p>
                    <a href="{{ route('reservation.cancel', $reservation->id) }}" class="
                        bg-red-500
                        hover:bg-red-700
                        text-white
                        font-bold
                        py-2
                        px-4
                        rounded
                        mt-4
                        inline-block
                    ">Cancel reservation</a>
            </div>
        </div>
    </div>
</x-app-layout>
