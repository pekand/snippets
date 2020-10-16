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

if (mix.inProduction()) {
    mix
    .version() // add hash to names
    .sourceMaps();
}

mix
.webpackConfig({devtool: 'source-map'}) // custom webpack config
//.browserSync()
//.disableNotifications()
//.copy('node_modules/source', 'public/destination'); // manuali copy files
//.copyDirectory('resources/source/img', 'public/destination/img');
.styles([
    'resources/css/main.css', // merge native css files
], 'public/css/styles.css')
.scripts([
    'resources/js/script.js', // merge vanila files
], 'public/js/script.js')
.babel([
    'resources/js/babel.js', // merge ES2015 
], 'public/js/babel.js')
.js('resources/js/app-bootstrap.js', 'public/js')
.js('resources/js/app-vue.js', 'public/js')
.react('resources/js/app-react.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.extract(['axios', 'jquery', 'bootstrap', 'vue', 'react'])
.sourceMaps(); // extract to separate file


