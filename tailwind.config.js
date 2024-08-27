/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  content: [],
  theme: {
    extend: {
      height: {
        'fit': 'fit-content',
      },
      textAlign: {
        'justify': 'justify',
      }
    },
  },
  plugins: [],
}

