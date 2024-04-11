import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // changer le theme en blanc
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'primary': '#FFD700',
                'secondary': '#FFA500',
                'danger': '#FF0000',
                'success': '#008000',
                'info': '#00FFFF',
                'warning': '#FFA500',
                'dark': '#000000',
                'brezee' : '#5a67d8',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],


};
