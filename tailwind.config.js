/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            container: {
                center: true,
            },

            animation: {
                spin: "spin 3s linear infinite",
                fadeIn: "fadeIn 250ms ease-out",
            },

            keyframes: {
                fadeIn: {
                    "0%": { opacity: "0.0" },
                    "100%": { opacity: "1.0" },
                },
            },
        },
    },
    plugins: [],
};
