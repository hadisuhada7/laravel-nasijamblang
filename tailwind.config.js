/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans:  ['"Manrope"', 'system-ui', 'sans-serif'],
                serif: ['"Cormorant Garamond"', 'serif'],
            },
        },
    },
    plugins: [],
};
