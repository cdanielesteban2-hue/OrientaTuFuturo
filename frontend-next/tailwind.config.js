/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/**/*.{js,ts,jsx,tsx,mdx}',
    './pages/**/*.{js,ts,jsx,tsx,mdx}',
    './components/**/*.{js,ts,jsx,tsx,mdx}',
  ],
  darkMode: 'media',
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
        heading: ['Outfit', 'sans-serif'],
      },
      colors: {
        brand: {
          blue: '#2563eb',
          emerald: '#059669',
          pink: '#db2777',
          orange: '#ea580c',
          purple: '#7c3aed',
          slate: '#475569',
          gold: '#facc15'
        }
      }
    },
  },
  plugins: [],
}
