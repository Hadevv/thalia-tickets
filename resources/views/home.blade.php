<x-app-layout>
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
                                    <div class="m-2">
                                        <div class="flex justify-center">
                                            <p class ="text-white dark:text-gray-300">30.07.21</p>
                                            <p class="text-white dark:text-gray-300 m-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                        <p class="text-white dark:text-gray-300">comedia Theater</p>
                                    </div>
                                    <div class="m-2">
                                        <div class="border border-white-600 mt-3 mb-3"></div>
                                        <div class="flex justify-center">
                                            <p class ="text-white dark:text-white-300">30.07.21</p>
                                            <p class="text-white dark:text-white-300 m-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                        <p class="text-white dark:text-gray-300">comedia Theater</p>
                                    </div>
                                    <div class="m-2">
                                        <div class="border border-white-600 mt-3 mb-3"></div>
                                        <div class="flex justify-center">
                                            <p class ="text-white dark:text-gray-300">30.07.21</p>
                                            <p class="text-white dark:text-gray-300 m-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                        <p class="text-white dark:text-gray-300">comedia Theater</p>
                                    </div>
                                    <div class="m-2">
                                        <div class="border border-white-600 mt-3 mb-3"></div>
                                        <div class="flex justify-center">
                                            <p class ="text-white dark:text-gray-300">30.07.21</p>
                                            <p class="text-white dark:text-gray-300 m-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                        <p class="text-white dark:text-gray-300">comedia Theater</p>
                                    </div>
                                    <div class="m-2">
                                        <div class="border border-white-600 mt-3 mb-3"></div>
                                        <div class="flex justify-center">
                                            <p class ="text-white dark:text-gray-300">30.07.21</p>
                                            <p class="text-white dark:text-gray-300 m-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                        <p class="text-white dark:text-gray-300">comedia Theater</p>
                                    </div>
                                    <!--@foreach ($representations as $representation)
                                        <div class="m-2">
                                            @if ($loop->first)
                                                <div class="flex justify-center">
                                                    <p class="text-white dark:text-gray-300">{{ $representation->schedule }}</p>
                                                    <p class="text-white dark:text-gray-300 m-2">{{ Str::limit($representation->show->title, 30) }}</p>
                                                </div>
                                            @else
                                                <div class="border border-white-600 mt-3 mb-3"></div>
                                                <div class="flex justify-center">
                                                    <p class="text-white dark:text-white-300">{{ $representation->schedule }}</p>
                                                    <p class="text-white dark:text-white-300 m-2">{{ Str::limit($representation->show->title, 30) }}</p>
                                                </div>
                                            @endif
                                            <p class="text-white dark:text-gray-300">comedia Theater</p>
                                        </div>
                                    @endforeach-->
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
                                            <a class="flex justify-center items-center font-semibold text-base text-white" href="#">Voir plus
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
                                    bg-top">
                                <div class="flex justify-center items-center">
                                    <h2 class="text-9xl ml-20 font-semibold font-macamore text-withe dark:text-withe-100">Credit Alejandro</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
