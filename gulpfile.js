// Paths
const dir = {
	src: './assets/',
	build: './build/',
};

// SCSS;
const gulp = require( 'gulp' );
const postcss = require( 'gulp-postcss' );
const sass = require( 'gulp-sass' );
const autoprefixer = require( 'autoprefixer' );
const postcssFlexbugsFixes = require( 'postcss-flexbugs-fixes' );
const postcssImport = require( 'postcss-import' );
const cssNano = require( 'cssnano' );

// JS;
const pump = require( 'pump' );
const webpack = require( 'webpack' );
const webpackStream = require( 'webpack-stream' );

/**
 * SCSS
 */
const css = {
	src: dir.src + 'sass/**/*.scss',
	watch: dir.src + 'sass/**/*.scss',
	build: dir.build + 'css/',
};

// scss to css
gulp.task( 'scss', ( cb ) => {
	pump( [
		gulp.src( css.src ),
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
		gulp.dest( css.build ),
	], cb );
} );

gulp.task( 'css', gulp.series( 'scss' ) );

/**
 * JS
 * Handled by webpack
 */
const js = {
	src: dir.src + 'js/**/*',
	build: dir.build + 'js/',
	conf: './webpack.config.js',
};

// Stream files to webpack
gulp.task( 'webpack', ( cb ) => {
	pump( [
		gulp.src( js.src ),
		webpackStream( require( js.conf ), webpack ),
		gulp.dest( js.build ),
	], cb );
} );

gulp.task( 'js', gulp.series( 'webpack' ) );

/**
 * Watch task
 */
gulp.task( 'watch', () => {
	gulp.watch( css.src, gulp.series( 'set-dev-node-env', 'css' ) );
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
gulp.task( 'default', gulp.series( 'set-prod-node-env', 'css', 'webpack' ) );
