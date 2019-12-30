const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: {
		'./build/js/maksimer': path.resolve(process.cwd(), 'assets/js',
				'maksimer.js'),
		'./build/js/test': path.resolve(process.cwd(), 'assets/js',
				'test.js'),
		//'./build/css/sass': path.resolve( process.cwd(), 'assets/sass', 'admin.scss' ),
		// 'editor-style': path.resolve( process.cwd(), 'assets/sass', 'editor-style.scss' ),
		// index: path.resolve( process.cwd(), 'assets/sass', 'index.scss' ),
	},

	output: {
		filename: '[name].js',
		path: path.resolve(process.cwd()),
	},

	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.scss$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							minimize: ('production' === process.env.NODE_ENV),
						},
					},
					'postcss-loader',
					{loader: 'sass-loader'},
				],
			},
			{
				test: /\.(jpe?g|png|gif|svg)$/i,
				use: [
					{
						loader: 'file-loader', // Or `url-loader` or your other loader
					},
				],
			},
		],
	},
	plugins: [
		// Copy the images folder and optimize all the images
		new CopyWebpackPlugin([
			{
				from: 'assets/images', to: 'build/images',
			}]),
		new ImageminPlugin({
			test: /\.(jpe?g|png|gif|svg)$/i,
			plugins: [
				['gifsicle', {interlaced: true}],
				['jpegtran', {progressive: true}],
				['optipng', {optimizationLevel: 5}],
				[
					'svgo',
					{
						plugins: [
							{
								removeViewBox: false,
								mergePaths: false,
								cleanupIDs: false,
							},
						],
					},
				],
			],
		}),
	],
};
