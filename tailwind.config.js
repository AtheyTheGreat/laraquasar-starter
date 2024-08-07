/** @type {import('tailwindcss').Config} */
import forms from '@tailwindcss/forms';
export default {
    content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    'node_modules/preline/dist/*.js',
  ],
  darkMode: "class",
  theme: {
    extend: {
      fontFamily: {
        dosis: ['Dosis', 'sans-serif'],
        roboto: ['Roboto', 'sans-serif'],
      },
      animation: {
        'infinite-scroll': 'infinite-scroll 100s linear infinite',
        'infinite-scroll-cleint': 'infinite-scroll 15s linear infinite',
      },
    },
  },
  plugins: [forms, require("preline/plugin"), require("flowbite/plugin"), require('@tailwindcss/forms'),],
}

