const mix = require('laravel-mix');
const webpack = require('webpack');

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

mix
    .setPublicPath('public')
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.sass', 'public/css')
    .copy('resources/assets/images', 'public/images')
    .sourceMaps()
    //.copy('public', '../../laravelhorizon/public/vendor/horizon')
    .copy('public/css', '../../public/vendor/tasking/css')
    .copy('public/fonts', '../../public/fonts')
    .copy('public/js', '../../public/vendor/tasking/js')
    .copy('public/images', '../../public/vendor/tasking/images')
    .version();


mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ],
    resolve: {
        alias: {
          'icons': path.resolve(__dirname, "./node_modules/vue-material-design-icons")
          // 'vue$': 'vue/dist/vue.runtime.esm.js'
        },
        extensions: [
          ".vue"
        ]
    }
});
