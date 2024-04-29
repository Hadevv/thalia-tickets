<x-app-layout>
    <div class="py-6">
        <div class=" mx-auto sm:px-6 lg:px-6">
            <div class="bg-white dark:bg-gray-800 md:mr-20 md:ml-20 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 relative">
                    <!--banner vertical THEATRE 2024-->
                    <div class="absolute z-10 w-4 h-full bg-withe flex items-center justify-center">
                        <span class="text-2xl  font-semibold text-gray-900 dark:text-gray-100 bg-white transform -rotate-90">THEATRE_2024_THEATRE_2024_THEATRE_2024_THEATRE_2024_THEATRE_2024_THEATRE_2024_THEATRE_2024_THEATRE_2024</span>
                    </div>
                        <div class="grid gap-3 grid-cols-12">
                            <div class="col-span-full sm:col-span-6 lg:col-span-3 overflow-hidden relative bg-white border border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                                <!-- Card -->
                                <div class="p-6">

                                </div>
                            </div>
                            <div class="col-span-full sm:col-span-6 grid-row-8 lg:col-span-3 overflow-hidden relative bg-white border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                                <!-- Card Repertoire -->
                                <div class="
                                    p-6
                                    text-white-900
                                    dark:text-white-100
                                    bg-[url('/public/images/repertoire.jpeg')]
                                    h-full
                                    bg-center
                                    bg-cover
                                    bg-no-repeat
                                    bg-opacity-30
                                    ">
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

                                    <div class="m-2 flex justify-between items-center z-100">
                                        <a href="{{ route('show.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-2 rounded focus:outline-none focus:shadow-outline">Acheter un ticket</a>
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
                            <div class="col-span-full sm:col-span-6 lg:col-span-6 overflow-hidden relative bg-white border border-gray-200 dark:border-gray-800 dark:bg-gray-900">
                                <!-- Card -->
                                <div class="w-full h-96">
                                    <img src="{{ asset('images/ayiti.jpg') }}" alt="Ayiti" class="object-cover w-full h-full">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
