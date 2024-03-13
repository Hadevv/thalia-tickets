import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Pagination from './components/Pagination.vue';
import { createApp } from 'vue'
const app = createApp()

app.component('Pagination', Pagination );

app.mount('#app')


