var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify       = require('gulp-notify');
var uglify       = require('gulp-uglify');
var concat       = require('gulp-concat');





/*
 * JavaScript compile task
*/
gulp.task('scripts', function() {
  gulp.src(['js/**/*.js', '!js/analytics.js', '!js/min/maksimer.min.js'])
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(concat('maksimer.min.js'))
    .pipe(uglify())
    .pipe(notify({title: '💩', icon: '', message: 'Compiling <%= file.relative %> complete' }))
    .pipe(gulp.dest('js/min/'))
});





/*
 * Style compile task
*/
gulp.task('styles', function () {
   gulp.src('sass/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}))
        .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(autoprefixer( 'last 2 version', 'ie 8', 'ie 9' ) )
    .pipe(notify({title: '💩', icon: '', message: 'Compiling <%= file.relative %> complete' }))
    .pipe(gulp.dest('../'));
});





/*
 * Watch files for changes
 * Type "gulp watch" to run this function
*/
gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', ['styles']);
    gulp.watch('js/**/*.js', ['scripts']);
});





/*
 * Default task's that run when you type "gulp" in terminal
*/
gulp.task('default', ['styles', 'scripts']);
