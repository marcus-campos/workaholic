let mix = require('laravel-mix');

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

/**
 * App
 */

//CSS
mix.styles([
    'resources/assets/css/app.css'
], 'public/css/app.css').version();

//Scripts JS
/*mix.scripts([
    'resources/assets/js/vue/filters.js',
    'resources/assets/js/vue/cities/cities.js',
    'resources/assets/js/vue/job/proposal/show.js',
    'resources/assets/js/vue/job/index.js',
    'resources/assets/js/vue/job/show.js',
    'resources/assets/js/vue/filters.js'
], 'public/js/app.js').version();*/

/**
 * Auth
 */

//CSS
mix.styles(['resources/assets/css/auth.css'], 'public/css/auth.css').version();