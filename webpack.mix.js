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
mix.setPublicPath('/')

mix.babelConfig({
  plugins: [
    '@babel/plugin-syntax-dynamic-import'
  ]
});

if (mix.inProduction()) {
    mix.disableNotifications();
    mix.version();
}

mix.js('resources/js/app.js', 'admin/public/js')
   .sass('resources/sass/app.scss', 'admin/public/css');

mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ],
    output: {
        chunkFilename: mix.inProduction() ? 'admin/public/dist/[name].[chunkhash].js' : 'admin/public/chunks/[name].js?id=[chunkhash]',
    }
});