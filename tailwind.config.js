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
    'text-[0.9rem]',
    'bg-[#e65100]',
    'bg-[#333333]',
    'bg-[#444444]',
    'bg-[#555555]',
    'bg-[#666666]',
    'text-[#e65100]',
    'text-[#777]',
    'py-[2px]',
    'h-[85vh]',
    'min-h-[130px]',
    'hover:bg-[#2e2e2e]',
    'border-[#777]',
    'min-w-[45%]',
    'flex-wrap',
    'border-[#3f3f3f]',
    'text-[#8b8b8b]',
    'focus:ring-[#e65100]',
    'hover:bg-[#e65100]',
    'md:min-w-[45%]',
    'border-[#e65100]',
    'hover:border-white',
    'text-[#fd4236]',
    'bg-[#1f1f1f]/90',
    'ml-[6.8rem]',
    'space-y-[1rem]',
    'mt-12',
    'mt-5',
    'min-h-[150px]',
    'md:text-[1.3rem]'
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
