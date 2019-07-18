
const fs = require('fs-extra');
const path = require('path');
const Bundler = require('parcel-bundler');
const argv = require('minimist')(process.argv.slice(2));
const watch = require('glob-watcher');
const browserSync = require("browser-sync").create();
const dotenv = require('dotenv').config()
const chalk = require('chalk')

/**
 * Set the env variable
 */
process.env.NODE_ENV = argv.env || 'development';

/**
 * Options for our parcel bundler
 */
const srcDir = 'src';
const options = {
    outDir: process.env.OUTDIR !== undefined ? process.env.OUTDIR : './dist',
    sourceMaps: process.env.NODE_ENV !== 'production'
}

const moveFile = (from, to) => {
    from = `./${from}`
    to = `${to}/${from.replace('src', '')}`
    const file = from.substring(from.lastIndexOf('/') + 1)

    fs.copy(from, to)
        .then(() => {
            console.log(chalk.bgGreenBright.black(`✔ ${file} successfully moved.`));
        })
        .catch(err => console.error(err))
}


/**
 * Run parcel-bundler and glob-watcher
 */
async function runBundle( files ) {
    const bundler = new Bundler(files, options);
    const bundle = await bundler.bundle();

    if( process.env.NODE_ENV === 'development' ) {
        console.clear();
        browserSync.init({
            proxy: process.env.DEV_URL,
        });
        runWatcher( bundler );
    }
}

/**
 * Watch out for php file changes 
 */
const runWatcher = bundler => {
    const watcher = watch([
        './src/**/*.php',
        './src/**/*.twig',
        './src/style.css'
    ]);

    watcher.on('change', (path, stat) => {
        moveFile(path, bundler.options.outDir)
        reloadBrowsers(bundler);
    })

    watcher.on('add', (path, stat) => {
        moveFile(path, bundler.options.outDir)
        reloadBrowsers(bundler);
    })
}

/**
 * Tell parcel to reload our browser
 */
const reloadBrowsers = (bundler) => browserSync.reload();

runBundle( argv.f )