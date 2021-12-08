const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')
const plugin = require('tailwindcss/plugin')

module.exports = {
    mode: 'jit',
    purge: {
        content: [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './vendor/laravel/jetstream/**/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
            './vendor/filament/forms/resources/views/**/*.blade.php',
        ],
        safelist: [
            'bg-color-1',
        ]
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ["'Inter'", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'color': {
                    DEFAULT: '#7a6cff', // Blue text color
                    '1': '#06b67d', // Green
                    '2': '#f6f7fb', // Light Background color
                    '3': '#1a1f33', // Dark Blue
                    green: '#33c15f',
                    danger: colors.rose,
                    primary: colors.blue,
                },
            },
            boxShadow: {
                '1': '0 0 21px 5px rgba(254, 218, 17, 0.58)',
                '2': '0 5px 10px 5px rgba(254, 218, 17, 0.67)',
                '3': '0 4px 8px 3px rgba(254, 218, 17, 0.67)'
            },

            spacing: {
                '18': '4.5rem',
                '22': '5.5rem',
                '26': '6.5rem',
                '30': '7.5rem',
                '34': '8.5rem',
                '38': '9.5rem',
                '42': '10.5rem',
                '46': '11.5rem',
                '50': '12.5rem',
                '54': '13.5rem',
                '58': '14.5rem',
                '62': '15.5rem',
                '66': '16.5rem',
                '70': '17.5rem',
                '74': '18.5rem',
                '78': '19.5rem',
                '82': '20.5rem',
                '86': '21.5rem',
                '90': '22.5rem',
                '94': '23.5rem',
                '98': '24.5rem',
                '102': '25.5rem',
                '106': '26.5rem',
                '110': '27.5rem',
                'xs': '28rem',
                'sm': '32rem',
                'md': '36rem',
                'ml': '40rem',
                'mxg': '44rem',
                'mlg': '48rem',
                'lg': '52rem',
                'xl': '60rem',
                '2xl': '72rem',
                '3xl': '80rem',
                '4xl': '96rem',
            },

            borderWidth: {
                '3': '3px',
                '5': '5px',
                '6': '6px',
                '7': '7px',
                '8': '8px',
            },
            fontSize: {
                '2xs': '0.75rem',
                md: '.9375rem',
                '2.5xl': '1.75rem',
                '3.5xl': '2rem',
                '4.5xl': '2.5rem',
                '5.5xl': '3.5rem',
                '6.5xl': ['4rem', '1.10'],
                '7.5xl': '5rem',
            },
            minWidth: {
                clg: '800px',
                cmd: '400px'
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        plugin(function({ addBase, components, theme }) {
            addBase({
                'body': {
                    backgroundColor: theme('colors.color.2'),
                },
                '.trnstsn, a, button, input, textarea, select': {
                    transition: 'all 0.35s ease-in-out',

                },
                '.mobile-menu': {
                    '@screen md': {
                        display: 'flex !important'
                    }
                }
            })
        })
    ],
}
