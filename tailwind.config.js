import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    color: '#387C2B',
                    gray: '#f4f5fa',
                    dark: '#222831',
                    text: '#111827',
                },
                secondary: {
                    text: '#4B5563',
                },
                button: {
                    red: '#EF4A00',
                    green : '#45B369',
                    blue: '#487FFF',
                }
            },
        },

    },

    plugins: [forms, typography, require("tailwindcss-animate")],
};
