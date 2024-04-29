import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import Pagination from './components/Pagination.vue';
import Dropdown from './components/Dropdown.vue';
import Navigation from './components/Navigation.vue';


const app = createApp({
    components: {
        Pagination,
        Dropdown,
        Navigation
    }
});

window.Alpine = Alpine;
Alpine.start();

app.mount('#app');



