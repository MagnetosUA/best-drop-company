var Encore = require('@symfony/webpack-encore');
Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('web/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .addEntry('new-order', './assets/js/new-order.js')
    .addEntry('one-product-page', './assets/js/one-product-page/modal-image.js')
    .addEntry('security', './assets/js/security/security.js')
    .addEntry('user-page', './assets/js/user-page/user-page.js')
    .enableBuildNotifications()
    .copyFiles({from: './assets/project-images', pattern: /\.(png|jpg|jpeg)$/, to: 'images/project-images/[name].[ext]'})
    .autoProvidejQuery()
;
// export the final configuration
module.exports = Encore.getWebpackConfig();
