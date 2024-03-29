const mix  = require('laravel-mix');
const glob = require('glob');

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

// jsファイルにはglobを使う
glob.sync('resources/js/*.js').map(function(file) {
    mix.js(file, 'public/js').version()
});
glob.sync('resources/js/user/*.js').map(function(file) {
    mix.js(file, 'public/js/user').version()
});
glob.sync('resources/js/owner/*.js').map(function(file) {
    mix.js(file, 'public/js/owner').version()
});
glob.sync('resources/js/storedetail/*.js').map(function(file) {
    mix.js(file, 'public/js/storedetail').version()
});
// components以下のファイル
glob.sync('resources/js/components/atoms/buttons/*.js').map(function(file) {
    mix.js(file, 'public/js/components/atoms/buttons').version()
});
glob.sync('resources/js/components/molecules/*.js').map(function(file) {
    mix.js(file, 'public/js/components/molecules').version()
});
glob.sync('resources/js/components/organisms/*.js').map(function(file) {
    mix.js(file, 'public/js/components/organisms').version()
});
glob.sync('resources/js/components/organisms/owner/*.js').map(function(file) {
    mix.js(file, 'public/js/components/organisms/owner').version()
});
glob.sync('resources/js/components/organisms/user/*.js').map(function(file) {
    mix.js(file, 'public/js/components/organisms/user').version()
});

mix
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
