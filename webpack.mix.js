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

// App
mix.js('resources/js/app.js', 'public/mix/js')
    .postCss('resources/css/app.css', 'public/mix/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

// Admin
mix.js('resources/js/admin.js', 'public/mix-admin/js')
    .postCss('resources/css/admin.css', 'public/mix-admin/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}

