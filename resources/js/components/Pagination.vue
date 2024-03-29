<template>
    <div class="flex items-center justify-center mt-4">
        <button
            @click="counter--"
            class="px-4 py-2 text-black bg-blue-500 rounded-l hover:bg-blue-600"
        >
            Previous
        </button>
        <span class="px-4 py-2 text-blue-500">
            Page {{ counter }}
        </span>
        <button
            @click="counter++"
            class="px-4 py-2 text-black bg-blue-500 rounded-r hover:bg-blue-600"
        >
            Next
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const counter = ref(0);
</script>
