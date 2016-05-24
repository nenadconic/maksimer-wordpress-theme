var gulp         = require('gulp');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify       = require('gulp-notify');


/*
 * Sass compile task
*/
gulp.task('sass', function () {
   gulp.src('sass/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe( autoprefixer( 'last 2 version', 'ie 8', 'ie 9' ) )
    .pipe(gulp.dest('../'));
});



/*
 * Watch task
*/
gulp.task('default', ['sass'], function() {
        gulp.watch('sass/**/*.scss', ['sass']);
});