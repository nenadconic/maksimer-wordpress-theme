/**
 * Required plugins
 * SCSS:
*/
var gulp          = require( 'gulp' );
var postcss       = require( 'gulp-postcss' );
var sass          = require( 'gulp-sass' );
var autoprefixer  = require( 'autoprefixer' );
var flexbugsfixes = require( 'postcss-flexbugs-fixes' );
var cssnano       = require( 'cssnano' );

// JS:
var concat = require( 'gulp-concat' );
var uglify = require( 'gulp-uglify' );

// BrowserSync
var browserSync = require( 'browser-sync' ).create();





/**
 * BrowserSync options
*/
var browserSyncOptions = {
	'proxy': 'woo.dev',
	'notify': true,
	'reloadDelay': 500
};

var browserSyncWatchFiles = [
	'./style.css',
	'./js/*.min.js'
	// './**/*.php'
];





/**
 * File sources
*/
const sass_src   = './sass/**/*scss';
const theme_root = './../';
const js_src     = './js/*.js';
const js_output  = './js/min/';





/**
 * Style Task
*/
gulp.task( 'styles', function() {
	// Plugins that run on sass compiling. Remember to keep autoprefixer below other plugins.
	var plugins = [
		flexbugsfixes(),
		cssnano({
			zindex: false,
			autoprefixer: false,
			safe: true,
			discardUnused: false,
			mergeIdents: false,
			reduceIdents: false
		}),
		autoprefixer() // Browserslist is defined in package.json
	];
	return gulp.src( sass_src )
		.pipe( sass().on( 'error', sass.logError ) )
		.pipe( postcss( plugins ) )
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
 * Browser sync task
*/
gulp.task('browser-sync', function() {
	browserSync.init( browserSyncWatchFiles, browserSyncOptions );
});






/**
 * Browser sync watch task
*/
gulp.task('watch-bs', ['browser-sync', 'watch'], function () {});





/**
 * Watch task
*/
gulp.task( 'watch', function() {
	gulp.watch( sass_src, ['styles'] ); // CSS changes
	gulp.watch( js_src, ['scripts'] ); // JavaScript changes
} );
