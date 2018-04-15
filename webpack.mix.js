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

//Filters
mix.babel([
    'resources/assets/js/vue/filters.js'
], 'public/js/filters.js').version();

//Proposal
mix.babel([
    'resources/assets/js/vue/job/proposal/show.js'
], 'public/js/proposalShow.js').version();

//Job
mix.babel([
    'resources/assets/js/vue/job/index.js'
], 'public/js/jobIndex.js').version();//Job

mix.babel([
    'resources/assets/js/vue/job/show.js'
], 'public/js/jobShow.js').version();

//Cities
mix.babel([
    'resources/assets/js/vue/cities/cities.js'
], 'public/js/cities.js').version();

/**
 * Auth
 */

//CSS
mix.styles(['resources/assets/css/auth.css'], 'public/css/auth.css').version();