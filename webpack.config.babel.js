const path      = require('path');
const webpack   = require('webpack');
const DIST_PATH = path.resolve('./build/js');

const config = {
	cache: true,
	entry: {
		maksimer: './assets/js/maksimer.js',
		// example: './assets/js/example.js', How to add another seperate compiled js file
	},

	output: {
		path: DIST_PATH,
		filename: '[name].min.js',
	},

	resolve: {
		modules: ['node_modules'],
	},

	devtool: 'source-map',

	module: {
		rules: [
			{
				test: /\.js$/,
				enforce: 'pre',
				loader: 'eslint-loader',
				options: {
					fix: true
				}
			},
			{
				test: /\.js$/,
				use: [{
					loader: 'babel-loader',
					options: {
						babelrc: true,
					}
				}]
			},
			{
				test: /\.(jpe?g|png|gif|svg)$/i,
				use: [
					{
						loader: 'file-loader', // Or `url-loader` or your other loader
					},
				],
			},
		]
	},
	mode: process.env.NODE_ENV,
	plugins: [
		new webpack.NoEmitOnErrorsPlugin(),
		new ImageminPlugin({
			bail: false, // Ignore errors on corrupted images
			cache: true,
			imageminOptions: {
				// Before using imagemin plugins make sure you have added them in `package.json` (`devDependencies`) and installed them

				// Lossless optimization with custom option
				// Feel free to experiment with options for better result for you
				plugins: [
					['gifsicle', {interlaced: true}],
					['jpegtran', {progressive: true}],
					['optipng', {optimizationLevel: 5}],
					[
						'svgo',
						{
							plugins: [
								{removeViewBox: false},
								{mergePaths: false},
								{cleanupIDs: false},
							],
						},
					],
				],
			},
		}),
	],
	stats: {
		colors: true
	},
	externals: {
		jquery: 'jQuery'
	}
};

module.exports = config;
