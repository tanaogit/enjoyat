const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
.js('resources/js/app.js', 'public/js')
.js('resources/js/index.js', 'public/js')
.js('resources/js/user/login.js', 'public/js/user')
.js('resources/js/user/index.js', 'public/js/user')
.js('resources/js/owner/login.js', 'public/js/owner')
.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.sass('resources/sass/app.scss', 'public/css')
.autoload({
    "jquery": ['$', 'window.jQuery'],
  })
.version();
