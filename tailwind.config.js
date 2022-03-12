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
                },
                'niagara': {
                    'base': '#21A086'
                }
            },
            borderWidth: {
                '6': '6px'
            },
            borderRadius: {
                '5xl': '2.5rem',
                '10': '0.625rem',
                'sidebar': '0 129px 129px 0',
                'active-icon': '10px 10px 0 10px'
            },
            height: {
                '60vh': '60vh'
            },
            gridTemplateRows: {
                'auto-1fr': 'auto 1fr',
                'auto-1fr-1fr': 'auto 1fr 1fr'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
