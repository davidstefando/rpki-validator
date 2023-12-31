/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'idnic-blue': '#243c5a',
                'light-blue': '#E8F0FF',
                'light-gray': '#f9fafb',
                'valid': '#66BB6A',
                'invalid': '#E63434',
                gray: colors.gray,
                orange: colors.orange,
            }
        },
    },
    plugins: [],
}

