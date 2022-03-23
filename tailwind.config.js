const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'xs': '0px',
            },
            boxShadow: {
                '3xl': '0 -11px 40px -20px rgba(0, 0, 0, 0.3)',
            },
            colors: {
                'grenteel': {
                    100: '#e3e6ed',
                    200: '#c5ccda',
                    300: '#a8b1c7',
                    400: '#8a96b3',
                    500: '#6c7ca0',
                    600: '#566486',
                    700: '#434e68',
                    800: '#2f374a',
                    900: '#1c212c',
                    1000: '#090b0e',
                },
                'lilac': {
                    100: '#e5e3ed',
                    200: '#c9c6d9',
                    300: '#aca8c6',
                    400: '#908bb2',
                    500: '#746d9f',
                    600: '#5d5784',
                    700: '#484467',
                    800: '#333049',
                    900: '#1f1d2c',
                    1000: '#e5e3ed',
                },
                'neutral': {
                    100: '#f3f6fe',
                    200: '#e9edf9',
                    300: '#e6eaf7',
                    400: '#e4e9f9',
                    500: '#dde5fc',
                    600: '#d5dffb',
                    700: '#cedafa',
                    800: '#cedafa',
                    900: '#becef9',
                    1000: '#b7c9f9',
                    1100: '#b7c9f8',
                    1200: '#a8bef7',
                    1300: '#a8bef7',
                },
                'midnight': {
                    40: '#334063',
                    90: '#2a3960',
                    100: '#20315a',
                    200: '#1e2e54',
                    300: '#1b2a4e',
                    400: '#192748',
                    500: '#172442',
                    600: '#131d36',
                    700: '#131d36',
                    800: '#0c1324',
                    900: '#0f172a',
                    1000: '#0c1324',
                },
                'tahiti': {
                    100: '#cffafe',
                    200: '#a5f3fc',
                    300: '#67e8f9',
                    400: '#22d3ee',
                    500: '#06b6d4',
                    600: '#0891b2',
                    700: '#0e7490',
                    800: '#155e75',
                    900: '#164e63',
                },
                "flopy": {
                  50: "#F0F4F9",
                  100: "#E1E9F4",
                  200: "#BCCEE6",
                  300: "#93B1D7",
                  400: "#5483BF",
                  500: "#1C304B",
                  600: "#16263B",
                  700: "#16263B",
                  800: "#0F1A29",
                  900: "#0F1A29"
                }
            },
            keyframes: {
                pinger: {
                    '75%, 100%': {
                        transform: 'scale(0.5)',
                        opacity: 0
                    },
                },
                'pop': {
                    '0': {
                        transform: 'scale(0)'
                    },
                	'50%': {
                		transform: 'scale(1.2)'
                	} 
                }
            },
            animation: {
                pinger: 'pinger 0.9s ease-in-out',
                pop: 'pop 0.3s linear 1',
            }
        },
            
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar'),
        require("tailwindcss-animation-delay"),
    ],
};
