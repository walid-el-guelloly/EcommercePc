export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        brand: { // bleu type joutech
          50:  '#e3f2ff',
          100: '#bbdeff',
          500: '#0073cf',
          600: '#005fa8',
          700: '#004885',
        },
        accent: { // rouge bouton
          500: '#f4425f',
          600: '#e0244e',
        },
      },
      fontFamily: {
        sans: [
          'Inter',
          'system-ui',
          '-apple-system',
          'BlinkMacSystemFont',
          '"Segoe UI"',
          'sans-serif',
        ],
      },
    },
  },
  plugins: [],
};