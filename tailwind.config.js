const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ['./theme/**/*.php'],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '30px'
      }
    },
    extend: {
      colors: {
        accent: '#cfc493'
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans]
      }
    }
  }
}
