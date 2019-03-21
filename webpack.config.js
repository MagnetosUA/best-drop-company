var Encore = require('@symfony/webpack-encore');
Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('web/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .enableBuildNotifications()
    .copyFiles({from: './assets/project-images', pattern: /\.(png|jpg|jpeg)$/, to: 'images/project-images/[name].[ext]'})
;
// export the final configuration
module.exports = Encore.getWebpackConfig();
