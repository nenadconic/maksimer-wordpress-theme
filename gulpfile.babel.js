/**
 * Required plugins
 */
// SCSS:
const gulp          = require('gulp');
const postcss       = require('gulp-postcss');
const sass          = require('gulp-sass');
const autoprefixer  = require('autoprefixer');
const flexbugsfixes = require('postcss-flexbugs-fixes');
const cleanCSS      = require('gulp-clean-css');

// JS:
const pump          = require('pump');
const webpack       = require('webpack');
const webpackStream = require('webpack-stream');

// BrowserSync
const packageJson = require('./package.json');
const browserSync = require('browser-sync');
const bs          = browserSync.create();
const proxyUrl    = packageJson.browserSync.proxyUrl;

gulp.task( 'bs-reload-css', ( cb ) => {
	bs.reload('*.css');
	cb();
});

gulp.task( 'bs-reload', ( cb ) => {
	bs.reload();
	cb();
});





/**
 * File sources and output
 */
const sass_src   = './assets/sass/**/*scss';
const theme_root = './';





/**
 * Style Task
 */
gulp.task( 'styles', function() {
	// Plugins that run on sass compiling. Remember to keep autoprefixer below other plugins.
	var plugins = [
		flexbugsfixes(),
		autoprefixer() // Browserslist is defined in package.json
	];
	return gulp.src( sass_src )
		.pipe(sass().on('error',sass.logError))
		.pipe(postcss(plugins))
		.pipe(cleanCSS())
		.pipe( gulp.dest( theme_root ) );
} );




/**
 * JS Task
 * Handled by webpack
 */
function processWebpack( src, conf, dest, cb ) {
	pump( [
		gulp.src( src ),
		webpackStream( require( conf ), webpack ),
		gulp.dest( dest )
	], cb );
}

gulp.task( 'webpack', ( cb ) => {
	const src = './assets/js/**/*.js';
	const conf = './webpack.config.babel.js';
	const dest = './dist/js';
	processWebpack( src, conf, dest );
	cb();
} );

gulp.task( 'js', gulp.series( 'webpack' ) );





/**
 * Watch task
 */
gulp.task( 'watch', function() {
	process.env.NODE_ENV = 'development';

	if ( proxyUrl ) {
		// https://browsersync.io/docs/options
		bs.init({
			proxy: proxyUrl,
			snippetOptions: {
				whitelist: ["/wp-admin/admin-ajax.php"],
				blacklist: ["/wp-admin/**"]
			}
		});
	}

	gulp.watch( './assets/sass/**/*scss', gulp.series( 'styles', 'bs-reload-css' ) );
	gulp.watch( './assets/js/**/*.js', gulp.series( 'js', 'bs-reload' ) );
} );





/**
 * Set node.env
 */
gulp.task( 'set-prod-node-env', ( cb ) => {
	process.env.NODE_ENV = 'production';
	cb();
} );






/**
 * Production build
 */
gulp.task( 'default', gulp.parallel( 'styles', gulp.series( 'set-prod-node-env', 'webpack' ) ) );
