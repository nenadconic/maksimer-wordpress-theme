/**
 * Required plugins
 */
// SCSS:
var gulp          = require( 'gulp' );
var postcss       = require( 'gulp-postcss' );
var sass          = require( 'gulp-sass' );
var autoprefixer  = require( 'autoprefixer' );
var flexbugsfixes = require( 'postcss-flexbugs-fixes' );
var cleanCSS      = require( 'gulp-clean-css' );

// JS:
var concat = require( 'gulp-concat' );
var uglify = require( 'gulp-uglify' );





/**
 * File sources and output
 */
const sass_src   = './assets/sass/**/*scss';
const theme_root = './';
const js_src     = './assets/js/*.js';
const js_output  = './assets/js/min/';





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
 * Task: Compile JavaScript
 */
gulp.task( 'scripts', function() {
	return gulp.src( js_src )
		.pipe( concat( 'maksimer.min.js' ) )
		.pipe( uglify() )
		.pipe( gulp.dest( js_output ) );
} );





/**
 * Watch task
 */
gulp.task( 'watch', function() {
	gulp.watch( sass_src, gulp.series('styles') ); // CSS changes
	gulp.watch( js_src, gulp.series('scripts') ); // JavaScript changes
} );
