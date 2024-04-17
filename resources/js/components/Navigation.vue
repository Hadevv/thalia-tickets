<template>
    <div class="flex justify-center items-center space-x-4 mb-4">
        <a :href="route('admin.index')" class="text-2xl hover:text-indigo-600 transition duration-300 ease-in-out">
            <font-awesome-icon :icon="['fas', 'theater-masks']" />
        </a>
        <a :href="route('admin.artist.index')" class="text-2xl hover:text-indigo-600 transition duration-300 ease-in-out">
            <font-awesome-icon :icon="['fas', 'user']" />
        </a>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute;

</script>

<style>
.icon {
    color: #222;
    margin-left: 12px;
    font-size: 36px;
}
</style>



