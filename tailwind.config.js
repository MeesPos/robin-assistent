const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
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
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'slate': {
                    'background': '#F7F8FC'
                },
                'blue': {
                    'base': '#00465A'
                },
                'green': {
                    'dark': '#315120'
                },
                'gray': {
                    'dots': '#CCCCCC'
                },
                'red': {
                    'dots': '#6F1C18'
                }
            },
            borderWidth: {
                '6': '6px'
            },
            borderRadius: {
                '5xl': '2.5rem'
            },
            height: {
                '60vh': '60vh'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
