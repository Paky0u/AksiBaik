import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                blue: {
                    50: '#eafffa',
                    100: '#c6fce5',
                    200: '#a2fbeb',
                    300: '#6ef3d6',
                    400: '#3eedd9',
                    500: '#0ecedb',
                    600: '#0ecedb',
                    700: '#00a2b4',
                    800: '#008291',
                    900: '#005963',
                },
                emerald: {
                    50: '#eafffa',
                    100: '#c6fce5',
                    200: '#99fbe2',
                    300: '#6ef3d6',
                    400: '#41eed0',
                    500: '#12dac0',
                    600: '#0ea793',
                    700: '#0b8071',
                    800: '#085d52',
                    900: '#053f38',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
