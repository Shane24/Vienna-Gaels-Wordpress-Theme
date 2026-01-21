/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './assets/js/**/*.js'
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        'primary': '#008040',
        'background-light': '#fcfcfc',
        'background-dark': '#1a1a1a',
        'vienna-gold': '#DDBB5C',
      },
      fontFamily: {
        'display': ['Lexend', 'sans-serif']
      },
      borderRadius: {
        'DEFAULT': '0.25rem',
        'lg': '0.5rem',
        'xl': '0.75rem',
        'full': '9999px'
      },
    },
  },
  plugins: [],
}