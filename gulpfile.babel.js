import { sassFiles, jsFiles } from './gulp.config';
const watchPaths = [];
const outPaths = [];
sassFiles.forEach( ( x ) => {
	watchPaths.push( x.input );
	outPaths.push( x.output );
} );

console.log( watchPaths );
/**
 * Base paths
 */
const dir = {
	src: './assets/',
	build: './build/',
};

/**
 * SCSS
 */
import gulp from 'gulp';
import postcss from 'gulp-postcss';
import sass from 'gulp-sass';
import autoprefixer from 'autoprefixer';
import postcssFlexbugsFixes from 'postcss-flexbugs-fixes';
import postcssImport from 'postcss-import';
import cssNano from 'cssnano';
import sourcemaps from 'gulp-sourcemaps';

const css = {
	src: dir.src + 'sass/**/*.scss',
	watch: dir.src + 'sass/**/*.scss',
	build: dir.build + 'css/',
};

gulp.task( 'scss', ( cb ) => {
	sassFiles.map( function( file ) {
		return pump( [
			gulp.src( file.input ),
			sourcemaps.init(),
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
			sourcemaps.write( '.' ),
			gulp.dest( file.output ),
		], cb );
	} );
} );

/**
 * JS
 * Handled by webpack
 */
import pump from 'pump';
import webpack from 'webpack';
import webpackStream from 'webpack-stream';

const js = {
	src: dir.src + 'js/**/*',
	build: dir.build + 'js/',
	conf: './webpack.config.babel.js',
};

gulp.task( 'js', ( cb ) => {
	pump( [
		gulp.src( js.src ),
		webpackStream( require( js.conf ), webpack ),
		gulp.dest( js.build ),
	], cb );
} );

/**
 * Watch task
 */
gulp.task( 'watch', () => {
	gulp.watch( watchPaths, gulp.series( 'set-dev-node-env', 'scss' ) );
	gulp.watch( js.src, gulp.series( 'set-dev-node-env', 'js' ) );
} );

/**
 * Set NODE_ENV to development
 */
gulp.task( 'set-dev-node-env', ( cb ) => {
	process.env.NODE_ENV = 'development';
	cb();
} );

/**
 * Set NODE_ENV to production
 */
gulp.task( 'set-prod-node-env', ( cb ) => {
	process.env.NODE_ENV = 'production';
	cb();
} );

/**
 * Production build
 */
gulp.task( 'default', gulp.series( 'set-prod-node-env', 'scss', 'js' ) );
