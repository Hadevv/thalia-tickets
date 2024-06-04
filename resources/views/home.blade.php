<x-app-layout>
    @if (session('representation_ended') && Auth::check() && !$representations->isEmpty())
        @foreach ($representations as $representation)
            @if ($representation->hasAttended() && $representation->isPaymentConfirmed())
                <!-- Modal pour la revue -->
                <x-modal name="reviewModal_{{ $representation->id }}" :show="true" maxWidth="2xl">

                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <!-- Inputs pour la revue et la note -->
                        <h3>Laisser un commentaire pour le spectacle {{ $representation->show->title }}</h3>
                        <label for="review">Votre revue :</label>
                        <textarea name="review" id="review" rows="4" cols="50" required></textarea>
                        <label for="stars">Votre note :</label>
                        <select name="stars" id="stars" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <!-- Input caché pour l'ID du spectacle -->
                        <input type="hidden" name="show_id" value="{{ $representation->show->id }}">
                        <!-- Vérification de l'authentification de l'utilisateur avant d'inclure l'input pour l'ID de l'utilisateur -->
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <!-- Input caché pour l'ID de la représentation -->
                        <input type="hidden" name="representation_id" value="{{ $representation->id }}">
                        <!-- Bouton de soumission -->
                        <button type="submit">Envoyer</button>
                    </form>
                </x-modal>
            @endif
        @endforeach
    @endif
    <!-- Banner -->
    <div class="py-6">
        <div class=" mx-auto sm:px-6 lg:px-6">
            <div class="bg-white dark:bg-gray-800 md:mr-20 md:ml-20 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 relative">
                    <!--banner vertical THEATRE 2024-->
                    <div class="absolute z-10 w-4 ms:h-auto md:h-auto md:w-full bg-withe flex items-center justify-center"
                        style="white-space: nowrap;">
                        <span
                            class="text-2xl font-semibold text-withe dark:text-withe bg-white transform -rotate-90">THEATRE
                            2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE
                            2024 THEATRE 2024 THEATRE 2024 THEATRE 2024</span>
                    </div>
                    <div class="grid gap-3 grid-cols-12 grid-rows-1">
                        <div
                            class="col-span-full grid-row-2 sm:col-span-6 lg:col-span-3 overflow-hidden relative bg-white dark:bg-gray-900">
                            <!-- Card -->
                            <div
                                class="p-6 bg-[url('/public/images/directeur.jpeg')]
                                h-96
                                bg-cover
                                bg-no-repeat">
                            </div>
                            <div
                                class="mt-3 p-6 bg-[url('/public/images/theatre-du-parc.jpg')]
                                h-96
                                bg-cover
                                bg-no-repeat">
                            </div>
                        </div>
                        <div class="flex justify-between col-span-full sm:col-span-6 lg:col-span-3 overflow-hidden relative dark:bg-gray-900 rounded-lg shadow-lg">
                            <!-- Card Repertoire -->
                            <div class="
                                relative
                                text-white
                                bg-[url('/public/images/hero-repertoire.jpeg')]
                                h-full
                                w-full
                                bg-center
                                bg-cover
                                bg-no-repeat
                                bg-opacity-30
                                transition
                                duration-300
                                ease-in-out
                                transform
                                hover:scale-105
                                rounded-lg
                                ">
                                <div class="bg-red-700 bg-opacity-80 p-6 h-full flex flex-col justify-between rounded-lg">
                                    <div>
                                        <h2 class="text-2xl font-semibold text-white dark:text-gray-100">Repertoire</h2>
                                        @foreach ($representations as $representation)
                                            <a href="{{ route('show.show', ['id' => $representation->show->id, 'slug' => $representation->show->slug]) }}">
                                                <div class="m-3">
                                                    @if ($loop->first)
                                                        <div class="flex justify-center">
                                                            <p class="text-white dark:text-gray-300">
                                                                {{ \App\Helpers\DateHelper::formatScheduleDate($representation->schedule)['formattedDate'] }}
                                                            </p>
                                                            <p class="text-white dark:text-gray-300 m-2">
                                                                {{ Str::limit($representation->show->title, 20) }}
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div class="border-t border-white-600 mt-3 mb-3"></div>
                                                        <div class="flex justify-center">
                                                            <p class="text-white dark:text-white-300">
                                                                {{ \App\Helpers\DateHelper::formatScheduleDate($representation->schedule, 'd/m H:i')['formattedDate'] }}
                                                            </p>
                                                            <p class="text-white dark:text-white-300 m-2">
                                                                {{ Str::limit($representation->show->title, 20) }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                    <p class="text-white dark:text-gray-300">
                                                        {{ $representation->show->artists->first()->firstname }}
                                                        {{ $representation->show->artists->first()->lastname }}
                                                    </p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="mt-4 flex justify-between items-center z-10">
                                        <a href="{{ route('show.index') }}" class="bg-red-600 hover:bg-white text-white hover:text-red-600 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">Acheter un ticket</a>
                                        <a class="flex items-center font-semibold text-base text-white bg-red-600 hover:bg-white hover:text-red-600 py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out" href="{{ route('show.index') }}">
                                            Voir plus
                                            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="col-span-full text-withe sm:col-span-6 lg:col-span-6 overflow-hidden relative bg-white dark:bg-gray-900">
                            <!-- Card -->
                            <div
                                class="
                                    p-6
                                    text-white dark:text-white-300
                                    bg-[url('/public/images/credit-alejandro.jpg')]
                                    h-full
                                    bg-cover
                                    bg-no-repeat
                                    bg-opacity-30
                                    bg-top
                                    ">
                                <div class="flex justify-center items-center">
                                    <h2
                                        class="text-7xl ml-20 font-semibold font-macamore text-withe dark:text-withe-100 md:text-9xl">
                                        Credit Alejandro</h2>
                                </div>
                                <div class="flex justify-end items-center h-full">
                                    <x-award-winner title="Award Winner" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
