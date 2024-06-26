const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const tailwindcss = require('tailwindcss')

mix.sass('resources/sass/app.scss', 'public/css')
  .options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
  })

mix.js('resources/js/app.js', 'public/js')

/*
  Tabler Icons FTW!
*/

mix.copy('node_modules/@tabler/icons/iconfont/fonts/tabler-icons.svg', 'public/icons')
mix.copy('node_modules/@tabler/icons/iconfont/tabler-icons.min.css', 'public/icons')

if (mix.inProduction()) {
    mix.version();
}
