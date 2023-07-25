import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'xxs': '480px',
                '3xl': '1600px',
                'max_2xl': {'max': '1535px'},
                // => @media (max-width: 1535px) { ... }

                'max_xl': {'max': '1279px'},
                // => @media (max-width: 1279px) { ... }

                'max_lg': {'max': '1023px'},
                // => @media (max-width: 1023px) { ... }

                'max_md': {'max': '767px'},
                // => @media (max-width: 767px) { ... }

                'max_sm': {'max': '639px'},
                // => @media (max-width: 639px) { ... }

                'max_xs': {'max': '450px'},
            },
            keyframes: {
                fadein: {
                    '0%': {
                        opacity: '0'
                    },
                    '100%': {
                        opacity: '1'
                    }
                }
            },
            boxShadow: {
                'insetShadow': 'inset 0 2px 4px 0 rgb(0 0 0 / 0.02)'
            }
        },
    },
    darkMode: 'class',

    plugins: [forms],
};
