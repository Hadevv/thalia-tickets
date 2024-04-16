<template id="dropdown-template">
    <div class="relative group">
        <button @click="isOpen = !isOpen" class=" h-8 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline flex items-center px-3 py-1.5 border border-indigo-600 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:border-indigo-600 transition text-sm">
            Import
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        <div v-if="isOpen" @click="isOpen = false" class="absolute mt-1 w-48 rounded-md shadow-lg bg-white z-50 overflow-visible border border-indigo-600">
            <a href="#" class="block px-4 py-1 text-gray-700 hover:bg-gray-100 text-sm">Excel</a>
            <a href="#" class="block px-4 py-1 text-gray-700 hover:bg-gray-100 text-sm">Pdf</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false
        };
    }
};
</script>

