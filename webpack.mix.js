const mix = require('laravel-mix');

// Main CSS
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

// *********Start *********

//admin JS 
mix.js('resources/js/admin/js/app.js', 'public/js/admin/app.js')
    .vue().version();
    
//admin CSS 
mix.styles([
        'resources/css/common/preloader.css',
        'resources/css/common/button-color.css',
        'resources/css/common/admin-style.css',
    ], 'public/css/admin/app.css').version();
    

//website JS 
mix.js('resources/js/website/js/app.js', 'public/js/website/app.js')
    .vue().version();
    
//website CSS 
mix.styles([
        'resources/css/common/preloader.css',
        'resources/css/common/button-color.css',
        'resources/css/website/main.css',
    ], 'public/css/website/app.css').version();

// *********End *********