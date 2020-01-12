/**
 * Get config containing what paths to watch, compile and output
 */
const { sassPaths, jsPaths } = require( './gulp.config' );

/**
 * SCSS
 */
const { watch, series, src, dest } = require( 'gulp' );
const postcss = require( 'gulp-postcss' );
const sass = require( 'gulp-sass' );
const autoprefixer = require( 'autoprefixer' );
const postcssFlexbugsFixes = require( 'postcss-flexbugs-fixes' );
const postcssImport = require( 'postcss-import' );
const cssNano = require( 'cssnano' );
const scssWatchPaths = [];
sassPaths.forEach( ( path ) => {
	scssWatchPaths.push( path.input );
} );

function style( cb ) {
	sassPaths.map( function( file ) {
		return pump( [
			src( file.input, { sourcemaps: true } ),
			sass().on( 'error', sass.logError ),
			postcss( [
				autoprefixer,
				postcssFlexbugsFixes,
				postcssImport,
				cssNano( {
					preset: [ 'default', {
						normalizeWhitespace: process.env.NODE_ENV === 'production',
					} ],
				} ),
			] ),
			dest( file.output, { sourcemaps: '.' } ),
		], cb );
	} );
}

/**
 * JS
 * Handled by webpack
 */
const pump = require( 'pump' );
const webpack = require( 'webpack' );
const webpackStream = require( 'webpack-stream' );
const jsWatchPaths = [];
jsPaths.forEach( ( path ) => {
	jsWatchPaths.push( path.input );
} );

function script( cb ) {
	jsPaths.map( function( file ) {
		process.env.currentJsFileInput = file.input;
		process.env.currentJsFileOutput = file.output;
		process.env.currentJsFileOutname = file.outname;
		return pump( [
			src( file.input ),
			webpackStream( { config: require( './webpack.config.babel.js' ) }, webpack ),
			dest( file.output ),
		], cb );
	} );
}

/**
 * General tasks
 * watch and node_env setters
 */
function watchfiles() {
	setDevEnv();
	watch( scssWatchPaths, style );
	watch( jsWatchPaths, script );
}

function setDevEnv() {
	process.env.NODE_ENV = 'development';
}

function setProdEnv( cb ) {
	process.env.NODE_ENV = 'production';
	cb();
}

exports.style = style;
exports.script = script;
exports.watch = watchfiles;
exports.default = series( setProdEnv, style, script );
