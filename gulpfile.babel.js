const
	// Paths
	dir = {
		src         : './assets/',
		build       : './build/'
	},

	// SCSS:
	gulp          = require('gulp'),
	postcss       = require('gulp-postcss'),
	sass          = require('gulp-sass'),
	newer         = require('gulp-newer'),
	imagemin      = require('gulp-imagemin'),
	gulpif        = require('gulp-if'),

	// JS:
	pump          = require('pump'),
	webpack       = require('webpack'),
	webpackStream = require('webpack-stream'),

	// BrowserSync
	browserSync = require('browser-sync'),
	bs          = browserSync.create(),
	proxyUrl    = 'http://localhost:8000' // Set this to the hosted site url and port if needed
;





/**
 * Image optimizing
 */
const images = {
  src   : dir.src + 'images/**/*',
  build : dir.build + 'images/'
};


// image processing
gulp.task('images', (cb) => {
	pump([
  	gulp.src(images.src),
    newer(images.build),
    imagemin(),
		gulp.dest(images.build)
	], cb);
});





/**
 * SCSS
 */
const css = {
	src   : dir.src + 'sass/**/*',
	watch : dir.src + 'sass/**/*',
	build : './',

	processors: [
    require('autoprefixer'),
		require('postcss-flexbugs-fixes'),
		require('postcss-import'),
		require('cssnano'),
	],

	processorsDev: [
		require('autoprefixer'),
		require('postcss-flexbugs-fixes'),
		require('postcss-import'),
		require('postcss-prettify'),
		require('postcss-discard-comments')
	],
}


gulp.task('scss', (cb) => {
	pump([
		gulp.src(css.src),
		sass().on('error',sass.logError),
		postcss(gulpif(process.env.NODE_ENV === 'development', css.processorsDev, css.processors)),
		gulp.dest(css.build)
	], cb);
});

gulp.task('css', gulp.series('images', 'scss'));





/**
 * JS
 * Handled by webpack
 */
const js = {
	src   : dir.src + 'js/**/*',
  build : dir.build + 'js/',
  conf  : './webpack.config.babel.js'
}


gulp.task('webpack', (cb) => {
	pump([
		gulp.src(js.src),
		webpackStream(require(js.conf), webpack),
		gulp.dest(js.build)
	], cb);
});

gulp.task('js', gulp.series('webpack'));





/**
 * Watch task
 */
gulp.task('watch', () => {
	process.env.NODE_ENV = 'development';

	gulp.watch(images.src, gulp.series('images'));
	gulp.watch(css.src, gulp.series('css'));
	gulp.watch(js.src, gulp.series('js'));
});





/**
 * Watch with browsersync
 */
gulp.task('watch-bs', () => {
	process.env.NODE_ENV = 'development';

	bs.init({
		proxy: proxyUrl,
		snippetOptions: {
			whitelist: ['/wp-admin/admin-ajax.php'],
			blacklist: ['/wp-admin/**']
		}
	});

	gulp.watch(images.src, gulp.series('images'));
	gulp.watch(css.src, gulp.series('css', 'bs-reload-css'));
	gulp.watch(js.src, gulp.series('js', 'bs-reload'));
});

gulp.task('bs-reload-css', (cb) => {
	bs.reload('*.css');
	cb();
});

gulp.task('bs-reload', (cb) => {
	bs.reload();
	cb();
});





/**
 * Set NODE_ENV to production
 */
gulp.task( 'set-prod-node-env', (cb) => {
	process.env.NODE_ENV = 'production';
	cb();
});





/**
 * Production build
 */
gulp.task('default', gulp.parallel(gulp.series('images', 'css'), gulp.series('set-prod-node-env', 'webpack')));
