var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/web/build')
    .cleanupOutputBeforeBuild()
    .addEntry('app', './web/assets/js/main.js')
    .addStyleEntry('global', './web/assets/css/global.scss')
    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())

;

module.exports = Encore.getWebpackConfig();