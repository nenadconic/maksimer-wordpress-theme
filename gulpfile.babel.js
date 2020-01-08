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
	return pump( [
		src( 'assets/sass/*.scss', { sourcemaps: true } ),
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
		dest( 'build/css/', { sourcemaps: '.' } ),
	], cb );
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
	pump( [
		src( 'assets/js/*.js' ),
		webpackStream( require( './webpack.config.babel.js' ), webpack ),
		dest( 'build/js/' ),
	], cb );
}

/**
 * General tasks
 * watch and node_env setters
 */
function watchfiles() {
	setDevEnv();
	watch( 'assets/sass/*.scss', style );
	watch( 'assets/js/*.js', script );
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
