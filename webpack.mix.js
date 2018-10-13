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

mix.sass('resources/assets/scss/style.scss', 'public/assets/css/style.css').version();


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
    'resources/assets/js/vue/user/job/proposal/show.js'
], 'public/js/proposalShow.js').version();

//Job
mix.babel([
    'resources/assets/js/vue/user/job/index.js'
], 'public/js/jobIndex.js').version();//Job

mix.babel([
    'resources/assets/js/vue/user/job/show.js'
], 'public/js/jobShow.js').version();

mix.babel([
    'resources/assets/js/vue/user/job/form.js'
], 'public/js/jobForm.js').version();

//Cities
mix.babel([
    'resources/assets/js/vue/cities/cities.js'
], 'public/js/cities.js').version();

//User My-Account
mix.babel([
    'resources/assets/js/vue/user/my-account/address.js',
    'resources/assets/js/vue/user/my-account/data.js'
], 'public/js/user-my-account.js').version();



/**
 * Auth
 */

//CSS
mix.styles(['resources/assets/css/auth.css'], 'public/css/auth.css').version();