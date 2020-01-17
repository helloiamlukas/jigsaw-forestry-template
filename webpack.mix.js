const {exec} = require('child_process');
let argv = require('yargs').argv;

if (argv.serve) {
    exec('mkdir -p build_staging && ./vendor/bin/jigsaw serve staging --port=8080 --host=0.0.0.0')
}

let mix = require('laravel-mix');
let build = require('./tasks/build.js');

mix.setPublicPath('source/assets/build');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.watch([
            'config.php',
            'source/**/*.md',
            'source/**/*.php',
            'source/**/*.yml',
            'source/**/*.scss',
        ]),
    ]
});

mix.js('source/_assets/js/main.js', 'js')
    .sass('source/_assets/sass/main.scss', 'css')
    .options({
        processCssUrls: false,
    })
    .sourceMaps(false, 'source-map')
    .version();
