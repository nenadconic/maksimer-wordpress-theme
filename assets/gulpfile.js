var gulp         = require('gulp');
var sass         = require('gulp-sass');
var minifycss    = require('gulp-uglifycss');
var autoprefixer = require('gulp-autoprefixer');
var mmq          = require('gulp-merge-media-queries');
var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var rename       = require('gulp-rename');
var lineec       = require('gulp-line-ending-corrector');
var notify       = require('gulp-notify');
var browserSync  = require('browser-sync').create();
var reload       = browserSync.reload;





/*
* Task: browser-sync
*/
gulp.task( 'browser-sync', function() {
	browserSync.init( './../style.css', {
		proxy: 'theme.dev',
		open: false,
		injectChanges: true,
		reloadDelay: 500
	} );
});





/*
 * Style compile task
*/
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 8',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 6',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

gulp.task('styles', function () {
	gulp.src( './sass/**/*.scss' )
	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'compressed'
	} ) )
	.on('error', console.error.bind(console))
	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )
	.pipe( mmq() )
	.pipe( minifycss({
		uglyComments: false
	}) )
	.pipe( lineec() )
	.pipe( gulp.dest( './../' ) )
	.pipe( browserSync.stream() )
	// Uncomment line below to enable notifications
	//.pipe( notify( { title: '💩', message: 'Compiling <%= file.relative %> complete', onLast: true } ) )
});





/*
* Task: Compile JavaScript
*/
gulp.task( 'scripts', function() {
	gulp.src( './js/*.js' )
	.pipe( concat( 'maksimer.min.js' ) )
	.pipe( lineec() )
	.pipe( uglify() )
	.pipe( gulp.dest( './js/min/' ) )
	// Uncomment line below to enable notifications
	//.pipe( notify( { title: '💩', message: 'Compiling <%= file.relative %> complete', onLast: true } ) );
});





/*
 * Watch Tasks.
*/
gulp.task( 'watch', ['styles', 'scripts'], function () {
	gulp.watch( './../*.php', reload );
	gulp.watch( './sass/**/*.scss', [ 'styles' ] );
	gulp.watch( './js/*.js', [ 'scripts', reload ] );
});





/*
 * Default task's that run when you type "gulp" in terminal
*/
gulp.task( 'default', ['styles', 'scripts']);