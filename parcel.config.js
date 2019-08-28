// We use console to print events during build
/* eslint-disable no-console */

// dotenv is needed for process.env
// eslint-disable-next-line no-unused-vars
const dotenv = require( 'dotenv' ).config();
const fs = require( 'fs-extra' );
const fg = require( 'fast-glob' );
const Bundler = require( 'parcel-bundler' );
const argv = require( 'minimist' )( process.argv.slice( 2 ) );
const watch = require( 'glob-watcher' );
const browserSync = require( 'browser-sync' ).create();
const chalk = require( 'chalk' );

// Set some constants
const srcDir = 'src';
process.env.NODE_ENV = argv.env || 'development';
const watchFiles = [
	`${ srcDir }/**/*/*.php`,
	`${ srcDir }/**/*/*.twig`,
	`${ srcDir }/**/*/*.css`,
	`${ srcDir }/**/*/*.svg`,
	`${ srcDir }/**/*/*.js`,
	`!${ srcDir }/**/*/*.bundle.js`,
];
const options = {
	outDir: process.env.OUTDIR !== undefined ? process.env.OUTDIR : './dist',
	sourceMaps: process.env.NODE_ENV !== 'production',
	production: process.env.NODE_ENV === 'production',
	hmr: false,
	publicURL: `${ process.env.DEV_URL }/wp-content/`,
};

// Move files from one directory to another
const moveFile = ( from, to, reload = false ) => {
	from = `./${ from }`;
	to = `${ to }/${ from.replace( 'src', '' ) }`;
	const file = from.substring( from.lastIndexOf( '/' ) + 1 );

	fs.copy( from, to )
		.then( () => {
			console.log( chalk.bgGreenBright.black( `✔ ${ file } successfully moved.` ) );
		} )
		.then( () => {
			if ( reload ) {
				reloadBrowsers();
			}
		} )
		.catch( ( err ) => console.error( err ) );
};

// Our first build that runs on watch
const build = async ( dest ) => {
	const stream = fg.stream( watchFiles );

	// enttry is used but linter is saying it isnt
	// eslint-disable-next-line no-unused-vars
	for await ( const entry of stream ) {
		moveFile( entry, dest );
	}
};

// Run parcel-bundler and glob-watcher
async function runBundle( files ) {
	const bundler = new Bundler( files, options );
	const bundle = await bundler.bundle(); // eslint-disable-line no-unused-vars

	// console.log(bundler.options);
	// return;

	await build( bundler.options.outDir );

	if ( process.env.NODE_ENV === 'development' ) {
		console.clear();
		browserSync.init( {
			proxy: process.env.DEV_URL,
		} );
		runWatcher( bundler );
		bundler.on( 'bundled', () => reloadBrowsers() );
	}
}

// Create a glob of files to watch and watch them
const runWatcher = ( bundler ) => {
	const watcher = watch( watchFiles );

	watcher.on( 'change', ( filePath ) => moveFile( filePath, bundler.options.outDir, true ) );
	watcher.on( 'add', ( filePath ) => moveFile( filePath, bundler.options.outDir, true ) );
};

// Tell parcel to reload our browser
const reloadBrowsers = () => browserSync.reload();

runBundle( argv.f );

/* eslint-enable no-console */