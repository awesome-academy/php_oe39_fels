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

mix.js([
    'resources/js/app.js',
    'resources/js/ajaxLogout.js',
], 'public/js')
.sass('resources/sass/app.scss', 'public/css');

mix.js('resources/assets/admin/js/app.js', 'public/js/admin.js')
.styles('resources/assets/admin/css/style.css', 'public/css/admin.css');

mix.js([
    'resources/assets/admin/js/bootstrap.min.js',
    'resources/assets/admin/js/jquery-3.5.1.min.js',
    'resources/assets/admin/js/popper.min.js',
], 'public/js/library.js')
.styles([
    'resources/assets/admin/css/all.min.css',
    'resources/assets/admin/css/bootstrap.min.css',
    'resources/assets/admin/css/solid.min.css',
], 'public/css/library.css');
