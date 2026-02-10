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


 mix.styles([
    'resources/assets/libs/font-awesome-4.7.0/css/font-awesome.min.css',
    'resources/css/general.css'
], 'public/css/app.css');




mix.scripts([
    'resources/assets/libs/jquery-validate-1.19.5/jquery.validate.min.js',
    'resources/js/general.js',
], 'public/js/general.app.min.js');

