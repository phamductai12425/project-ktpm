const defaultTheme = require('tailwindcss/defaultTheme')
const forms = require('@tailwindcss/forms')
const typography = require('@tailwindcss/typography')
const aspectRatio = require('@tailwindcss/aspect-ratio')
const lineClamp = require('@tailwindcss/line-clamp')

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/**/*.html",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: '#06b6d4',
        secondary: '#a21caf',
        accent: '#ec4899',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.8s ease-out',
        'blob': 'blob 7s infinite',
        'glow': 'glow 3s infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(50px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        blob: {
          '0%': { transform: 'translate(0px, 0px) scale(1)' },
          '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
          '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
          '100%': { transform: 'translate(0px, 0px) scale(1)' },
        },
        glow: {
          '0%': { textShadow: '0 0 5px rgba(255,255,255,0.5)' },
          '50%': { textShadow: '0 0 20px rgba(255,255,255,0.8), 0 0 30px rgba(236,72,153,0.5)' },
          '100%': { textShadow: '0 0 5px rgba(255,255,255,0.5)' },
        },
      },
    },
  },
  plugins: [forms, typography, aspectRatio, lineClamp],
}
