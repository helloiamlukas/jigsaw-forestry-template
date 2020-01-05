let mix = require('laravel-mix');
let build = require('./tasks/build.js');

mix.setPublicPath('source/assets/build');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        // build.browserSync(),
        build.watch([
            'config.php',
            'source/**/*.md',
            'source/**/*.php',
            'source/**/*.yml',
            'source/**/*.scss',
        ]),
    ]
});

mix.js('source/_assets/js/app.js', 'js')
    .sourceMaps()
    .sass('source/_assets/sass/app.scss', 'css')
    .options({
        processCssUrls: false,
    })
    .version();
