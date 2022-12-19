const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        borderRadius: {
            'none': '0',
            'sm': '0.125rem',
            DEFAULT: '0.125rem',
            'md': '0.2rem',
            'lg': '0.125rem',
            'xl': '0.25rem',
            '2xl': '0.375rem',
            '3xl': '0.5rem',
            '4xl': '0.75rem',
            'full': '9999px',
            'large': '12px',
        },
        extend: {
            screens: {
                '3xl': '1921px',
            },
            fontFamily: {
                sans: ['Almarai', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '1/8': '12.5%',
                '3/8': '37.5%',
                '5/8': '62.5%',
                '7/8': '87.5%',
                '1/10': '10%',
                '3/10': '30%',
                '7/10': '70%',
                '9/10': '90%',
                '19/40': '47.5%',
                '21/40': '52.5%',
                '112': '28rem',
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '192': '48rem',
                '300': '75rem',
            },
            minHeight: {
                '192': '48rem',
            },
            minWidth: {
                '300': '75rem',
                '1/2': '50%',
                '7/12': '58.33333%',
                '3/4': '75%',
            },
            colors: {
                brand: {
                    dark: '#001C6F',
                    mid: '#0D46FF',
                    light: '#00ecff',
                    yellow: '#ffcf00',
                    hilite: '#ffff00',
                    g1: '#1125FF',
                    g2: '#00D9FF',
                },
                danger: colors.rose,
                gray: colors.stone,
                primary: {
                    DEFAULT: '#00ecff',
                     '50': '#BFFBFF',
                    '100': '#79F5FF',
                    '200': '#0DEFFB',
                    '300': '#00CDF9',
                    '400': '#0092FF',
                    '500': '#0D46FF',
                    '600': '#003CC6',
                    '700': '#002D9C',
                    '800': '#001C6F',
                    '900': '#001141'
                },
                success: colors.green,
                warning: colors.amber,
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
