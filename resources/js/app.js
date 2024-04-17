import './bootstrap';

import Alpine from 'alpinejs';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faUser, faClock } from '@fortawesome/free-solid-svg-icons';
import { createApp } from 'vue';
import Pagination from './components/Pagination.vue';
import Dropdown from './components/Dropdown.vue';
import Navigation from './components/Navigation.vue';

library.add(faUser, faClock);

const app = createApp({
    components: {
        Pagination,
        Dropdown,
        Navigation
    }
});

app.component('font-awesome-icon', FontAwesomeIcon);

window.Alpine = Alpine;
Alpine.start();

app.mount('#app');



