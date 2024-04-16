import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Pagination from './components/Pagination.vue';
import Dropdown from './components/Dropdown.vue';
import { createApp } from 'vue';

const app = createApp({
    components: {
        Pagination,
        Dropdown

    }
});

app.mount('#app');


