<x-app-layout>
    @if (session('representation_ended') && Auth::check() && !$representations->isEmpty())
        @foreach($representations as $representation)
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
                    <div class="absolute z-10 w-4 ms:h-auto md:h-auto md:w-full bg-withe flex items-center justify-center" style="white-space: nowrap;">
                        <span class="text-2xl font-semibold text-withe dark:text-withe bg-white transform -rotate-90">THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024 THEATRE 2024</span>
                    </div>
                    <div class="grid gap-3 grid-cols-12 grid-rows-1">
                        <div class="col-span-full grid-row-2 sm:col-span-6 lg:col-span-3 overflow-hidden relative bg-white dark:bg-gray-900">
                                <!-- Card -->
                            <div class="p-6 bg-[url('/public/images/directeur.jpeg')]
                                h-96
                                bg-cover
                                bg-no-repeat">
                            </div>
                            <div class="mt-3 p-6 bg-[url('/public/images/theatre-du-parc.jpg')]
                                h-96
                                bg-cover
                                bg-no-repeat">
                            </div>
                        </div>
                        <div class="flex justify-between col-span-full sm:col-span-6 lg:col-span-3 overflow-hidden relative dark:bg-gray-900">
                                <!-- Card Repertoire -->
                            <div class="
                                    text-white-900
                                    dark:text-white-100
                                    bg-[url('/public/images/hero-repertoire.jpeg')]
                                    h-full
                                    w-full
                                    bg-center
                                    bg-cover
                                    bg-no-repeat
                                    bg-opacity-30
                                    filter-grayscale
                                    hover:brightness-125
                                    transition
                                    duration-300
                                    ease-in-out
                                    transform
                                    hover:scale-105
                                    bg-top">
                                <div class=" bg-red-700
                                    bg-opacity-80 p-6">
                                    <h2 class="text-2xl font-semibold text-white dark:text-gray-100">Repertoire</h2>
                                    @foreach ($representations as $representation)
                                        <a href="{{ route('show.show', ['id' => $representation->show->id, 'slug' => $representation->show->slug]) }}">
                                            <div class="m-3">
                                                <!-- $loop->first permet d'appliquer sur le premier une classe particulière, par exemple "en-tête d'affiche" -->
                                                @if ($loop->first)
                                                    <div class="flex justify-center">
                                                        <p class="text-white dark:text-gray-300">{{ \App\Helpers\DateHelper::formatScheduleDate($representation->schedule)['formattedDate'] }}</p>
                                                        <p class="text-white dark:text-gray-300 m-2">{{ Str::limit($representation->show->title, 20) }}</p>
                                                        <p class="text-white dark:text-gray-300 m-2">{{ Str::limit($representation->show->description, 20) }}</p>
                                                    </div>
                                                @else
                                                    <div class="border border-white-600 mt-3 mb-3"></div>
                                                    <div class="flex justify-center">
                                                        <p class="text-white dark:text-white-300">{{ \App\Helpers\DateHelper::formatScheduleDate($representation->schedule, 'd/m H:i')['formattedDate'] }}</p>
                                                        <p class="text-white dark:text-white-300 m-2">{{ Str::limit($representation->show->title, 20) }}</p>
                                                        <p class="text-white dark:text-gray-300 m-2">{{ Str::limit($representation->show->description, 20) }}</p>
                                                    </div>
                                                @endif
                                                <p class="text-white dark:text-gray-300">{{ $representation->show->artists->first()->firstname }} {{ $representation->show->artists->first()->lastname }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="m-2 mt:4 md:mt-8 flex justify-between items-center z-100 h-auto">
                                    <div class="
                                            flex
                                            justify-between
                                            items-center
                                            opacity-70
                                            w-full
                                            font-semibold
                                            text-base
                                            text-white
                                            dark:text-white-300
                                            bg-red-700
                                            hover:bg-red-800
                                            py-2
                                            px-2
                                            rounded
                                            focus:outline-none
                                            focus:shadow-outline
                                            transition
                                            duration-300
                                            ease-in-out
                                            transform
                                            hover:scale-105
                                            hover:shadow-lg
                                            hover:translate-y-1
                                            hover:translate-x-1
                                            hover:rotate-1
                                            hover:skew-y-1
                                            hover:skew-x
                                    ">
                                        <a href="{{ route('show.index') }}" class="bg-withe-200 hover:bg-withe text-white font-semibold py-2 px-2 rounded focus:outline-none focus:shadow-outline">Acheter un ticket</a>
                                            <!-- repertoire -->
                                        <div >
                                            <a class="flex justify-center items-center font-semibold text-base text-white" href="{{route('show.index')}}">Voir plus
                                                <svg
                                                        class="m-1 size-6"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        stroke="#ffffff"
                                                >
                                                    <path stroke="#ffffff" stroke-width="1.2" fill-rule="evenodd" clip-rule="evenodd" d="M13.4697 5.46967C13.7626 5.17678 14.2374 5.17678 14.5303 5.46967L20.5303 11.4697C20.8232 11.7626 20.8232 12.2374 20.5303 12.5303L14.5303 18.5303C14.2374 18.8232 13.7626 18.8232 13.4697 18.5303C13.1768 18.2374 13.1768 17.7626 13.4697 17.4697L18.1893 12.75H4C3.58579 12.75 3.25 12.4142 3.25 12C3.25 11.5858 3.58579 11.25 4 11.25H18.1893L13.4697 6.53033C13.1768 6.23744 13.1768 5.76256 13.4697 5.46967Z" fill="#FFFFFF"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-full text-withe sm:col-span-6 lg:col-span-6 overflow-hidden relative bg-white dark:bg-gray-900">
                                <!-- Card -->
                            <div class="
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
                                    <h2 class="text-7xl ml-20 font-semibold font-macamore text-withe dark:text-withe-100 md:text-9xl">Credit Alejandro</h2>
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
