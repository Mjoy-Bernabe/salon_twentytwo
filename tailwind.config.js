/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Outfit"', 'sans-serif'],
      },
      colors: {
        gold: '#f0a22c',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}