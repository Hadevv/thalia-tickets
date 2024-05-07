<x-app-layout>
    <div class="flex justify-center flex-col py-6 px-4 md:flex-row md:px-0 md:mr-24 md:ml-24 md:py-6">
        <div
            class="w-full md:w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-1 mb-4">
            <div class="sm:min-w-36 p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-center">
                    <!-- Calendar -->
                    <div class="space-y-0.5">
                        <!-- Months -->
                        <div class="grid grid-cols-5 items-center gap-x-3 mx-1.5 pb-3">
                            <!-- Prev Button -->
                            <div class="col-span-1">
                                <button type="button"
                                        class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- End Prev Button -->

                            <!-- Month / Year -->
                            <div class="col-span-3 flex justify-center items-center gap-x-1">
                                <div class="relative">
                                    <select data-hs-select='{
                                                "placeholder": "Select month",
                                                "viewport": "#single-datepicker-tab-preview-datepicker",
                                                "toggleTag": "<button type=\"button\"></button>",
                                                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative flex text-nowrap w-full cursor-pointer text-start font-medium text-gray-800 hover:text-gray-600 focus:outline-none focus:text-gray-600 before:absolute before:inset-0 before:z-[1] dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300",
                                                "dropdownClasses": "mt-2 z-50 w-32 max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                "optionClasses": "p-2 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-3.5 text-gray-800 dark:text-neutral-200\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                                              }' class="hidden">
                                        <option value="0">January</option>
                                        <option value="1">February</option>
                                        <option value="2">March</option>
                                        <option value="3">April</option>
                                        <option value="4">May</option>
                                        <option value="5">June</option>
                                        <option value="6" selected="">July</option>
                                        <option value="7">August</option>
                                        <option value="8">September</option>
                                        <option value="9">October</option>
                                        <option value="10">November</option>
                                        <option value="11">December</option>
                                    </select>
                                </div>

                                <span class="text-gray-800 dark:text-neutral-200">/</span>

                                <div class="relative">
                                    <select data-hs-select='{
                                            "placeholder": "Select year",
                                            "viewport": "#single-datepicker-tab-preview-datepicker",
                                            "toggleTag": "<button type=\"button\"></button>",
                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative flex text-nowrap w-full cursor-pointer text-start font-medium text-gray-800 hover:text-gray-600 focus:outline-none focus:text-gray-600 before:absolute before:inset-0 before:z-[1] dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300",
                                            "dropdownClasses": "mt-2 z-50 w-20 max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                            "optionClasses": "p-2 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 size-3.5 text-gray-800 dark:text-neutral-200\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                                          }' class="hidden">
                                        <option selected="">2023</option>
                                        <option>2024</option>
                                        <option>2025</option>
                                        <option>2026</option>
                                        <option>2027</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Month / Year -->

                            <!-- Next Button -->
                            <div class="col-span-1 flex justify-end">
                                <button type="button"
                                        class="size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    <svg class="flex-shrink-0 size-4" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- End Next Button -->
                        </div>
                        <!-- Months -->

                        <!-- Weeks -->
                        <div class="flex pb-1.5">
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              Mo
                            </span>
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              Tu
                            </span>
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              We
                            </span>
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              Th
                            </span>
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              Fr
                            </span>
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              Sa
                            </span>
                            <span class="m-px w-10 block text-center text-sm text-gray-500 dark:text-neutral-500">
                              Su
                            </span>
                        </div>
                        <!-- Weeks -->

                        <!-- Days -->
                        <div class="flex">
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    26
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    27
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    28
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    29
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    30
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    1
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    2
                                </button>
                            </div>
                        </div>
                        <!-- Days -->

                        <!-- Days -->
                        <div class="flex">
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    3
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    4
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    5
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    6
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    7
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    8
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    9
                                </button>
                            </div>
                        </div>
                        <!-- Days -->

                        <!-- Days -->
                        <div class="flex">
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    10
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    11
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    12
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    13
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    14
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    15
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    16
                                </button>
                            </div>
                        </div>
                        <!-- Days -->

                        <!-- Days -->
                        <div class="flex">
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    17
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    18
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    19
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center bg-blue-600 border border-transparent text-sm font-medium text-white hover:border-blue-600 rounded-full dark:bg-blue-500 disabled:text-gray-300 disabled:pointer-events-none dark:hover:border-blue-500">
                                    20
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    21
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    22
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    23
                                </button>
                            </div>
                        </div>
                        <!-- Days -->

                        <!-- Days -->
                        <div class="flex">
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    24
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    25
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    26
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    27
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    28
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    29
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    30
                                </button>
                            </div>
                        </div>
                        <!-- Days -->

                        <!-- Days -->
                        <div class="flex">
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600">
                                    31
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    1
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    2
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    3
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    4
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    5
                                </button>
                            </div>
                            <div>
                                <button type="button"
                                        class="m-px size-10 flex justify-center items-center border border-transparent text-sm text-gray-800 hover:border-blue-600 hover:text-blue-600 rounded-full disabled:text-gray-300 disabled:pointer-events-none dark:text-neutral-200 dark:hover:border-neutral-500 dark:disabled:text-neutral-600"
                                        disabled="">
                                    6
                                </button>
                            </div>
                        </div>
                        <!-- Days -->
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-full md:w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx-2 md:mx-1 mb-4">
            <div class="sm:min-w-36 p-6 text-gray-900 dark:text-gray-100">
                <div class="bg-opacity-80 p-6">
                    <h2 class="text-2xl font-semibold text-indigo-600 dark:text-gray-100">Horaire</h2>
                    <div class="col-md-8 mt-6">
                        <div class="flex justify-between items-center w-full">
                            <a class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 font-medium text-gray-700 hover:bg-gray-50"
                               rel="prev" href="{{ route('schedule.index', ['date' => $previousDay]) }}">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512"
                                     height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z">
                                    </path>
                                </svg> &nbsp; Hier
                            </a>

                            <span
                                class="mx-2 text-gray-600 font-medium border border-gray-300 rounded-md px-4 py-2">{{ $currentDayFormatted['formattedDate'] }}</span>

                            <a class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 font-medium text-gray-700 hover:bg-gray-50"
                               rel="next" href="{{ route('schedule.index', ['date' => $nextDay]) }}">Demain &nbsp;
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                     viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        @if(isset($paginatedRepresentationsByDay[$currentDay]))
                            @foreach ($paginatedRepresentationsByDay[$currentDay] as $representation)
                                <div class="bg-white px-5 mt-10 rounded-lg border border-gray-300 overflow-hidden mb-6">
                                    <div class="p-4">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $representation['show']['title'] }}</h3>
                                        <p class="text-gray-600">{{ $representation['show']['description'] }}</p>
                                        <div class="flex justify-between items-center mt-4">
                                            <p class="text-gray-600">
                                                Lieu: {{ $representation['location']['designation'] }}</p>
                                            <p class="text-gray-600">{{ $representation['schedule'] }}</p>
                                            <p class="text-gray-600">{{ $representation['show']['duration'] }} min</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{ $paginatedRepresentationsByDay[$currentDay]->links() }}
                        @else
                            <div class="bg-white px-5 mt-10 rounded-lg border border-gray-300 overflow-hidden mb-6">
                                <div class="p-4">
                                    <p class="text-gray-600">Aucune représentation pour cette date.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>












