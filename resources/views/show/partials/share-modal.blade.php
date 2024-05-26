@props(['show'])
<div x-data="{ isOpen: false }">
    <div class="flex w-full justify-center gap-4 items-center mt-4">
        <a href="#" @click.prevent="isOpen = true" class="focus:outline-none cursor-pointer m-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="gray-300" stroke-width="1.5"
                stroke="currentColor"
                class="size-3 text-gray-500 color-indigo-200 transition ease-in-out duration-150 hover:text-indigo focus:outline-none">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M307 34.8c-11.5 5.1-19 16.6-19 29.2v64H176C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96h96v64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z" />
            </svg>
        </a>
    </div>

    <div x-show="isOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold mb-4">Share this link</h2>
            <input id="shareLink" type="text" value="{{ url('/show/' . $show->id . '-' . $show->slug) }}"
                class="w-full p-2 border border-gray-300 rounded-lg mb-4">
            <div class="flex justify-end">
                <button @click="copyToClipboard()" class="bg-indigo-500 text-white px-4 py-2 rounded-lg mr-2">Copy
                    Link</button>
                <button @click="isOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Close</button>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("shareLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
        }
    </script>
</div>

