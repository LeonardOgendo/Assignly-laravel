import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
    'bg-[#1c1c1c]',
    'bg-[#2a2a2a]',
    'bg-[#777777]',
    'text-black',
    'bg-[#333333]',
    'bg-[#444444]',
    'bg-[#555555]',
    'bg-[#666666]',
    'h-[85vh]',
    'min-h-[130px]',
    'hover:bg-[#2e2e2e]',
    'border-[#777]'
  ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
