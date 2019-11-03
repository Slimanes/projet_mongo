var Encore = require('@symfony/webpack-encore');
var CopyWebpackPlugin = require('copy-webpack-plugin'); // this line tell to webpack to use the plugin

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addStyleEntry('css/app', './assets/css/app.css')
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    // .enableVersioning()
    // .enableSassLoader()

    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/images', to: 'images' }
    ]))
;

// export the final configuration
module.exports = Encore.getWebpackConfig();