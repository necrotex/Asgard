let mix = require('laravel-mix');
let webpack = require('webpack');

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

mix.webpackConfig({
    resolve: {
        alias: {
            'jquery-ui': 'jquery-ui-dist/jquery-ui.js'
        }
    },

    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
            clipboard: "clipboard",
        }),

        new webpack.LoaderOptionsPlugin({
            options: {
                loaders: [{
                    test: /datatables\.net.*/,
                    loader: 'imports?define=>false'
                }]
            }
        })
    ]

})
    .autoload({
        jquery: ['$', 'window.jQuery']
    })

    .extract(['jquery'])

    .js('resources/assets/js/app.js', 'public/js')

    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/login.scss', 'public/css');
