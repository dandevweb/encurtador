const mix = require('laravel-mix');

mix

    .styles([
        'resources/views/assets/css/bootstrap.css',
        'resources/views/assets/css/style.css',
    ], 'public/assets/css/main.css')

    .scripts([
        'resources/views/assets/js/jquery.js',
        'resources/views/assets/js/popper.js',
        'resources/views/assets/js/bootstrap.js',
        'resources/views/assets/js/main.js',
        'resources/views/assets/js/forms.js',
    ], 'public/assets/js/main.js')

    .copyDirectory('resources/views/assets/img', 'public/assets/img');

