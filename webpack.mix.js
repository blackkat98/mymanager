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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/custom/logout.js', 'public/js')
    .js('resources/js/custom/avatar.js', 'public/js')
    .js('resources/js/custom/toasts.js', 'public/js')
    .js('resources/js/custom/datatable.js', 'public/js')
    .js('resources/js/custom/summernote.js', 'public/js')
    .js('resources/js/custom/colorpicker.js', 'public/js')
    .js('resources/js/custom/user_datatable.js', 'public/js')
    .js('resources/js/custom/note_list.js', 'public/js')
    .postCss('resources/css/img.css', 'public/css');
