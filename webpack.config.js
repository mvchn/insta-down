var Encore = require('@symfony/webpack-encore');
var webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin') ;
const PurgecssPlugin = require('purgecss-webpack-plugin');
const path = require('path');
const glob = require('glob');
const PATHS = {
    src: path.join(__dirname, 'assets')
};

Encore
// directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app0', './assets/js/app.js')
    .addEntry('app', './assets/js/vue/index.js')
    //.addEntry('page1', './assets/js/page1.js')
    //.addEntry('page2', './assets/js/page2.js')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

    .enableSassLoader(function(options) {
        // https://github.com/sass/node-sass#options
        // options.includePaths = [...]
    })

    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })

    .enableVueLoader()
        
// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()

    .addPlugin(new MiniCssExtractPlugin({
        filename: "[name].css",
    }))
    .addPlugin(new PurgecssPlugin({
        paths: glob.sync(`${PATHS.src}/**/*`,  { nodir: true }),
    }))
;

module.exports = Encore.getWebpackConfig();
