const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.setPublicPath('dist')

mix
  .sass('assets/scss/main.scss', 'css/main.css')
  .options({
    postCss: [tailwindcss('./tailwind.config.js')]
  })
  .version()
