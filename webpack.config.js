const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');

const NODE_ENV = process.env.NODE_ENV || 'development';

module.exports = {
	...defaultConfig,
	entry: {
		'./build/js/maksimer': path.resolve(process.cwd(), 'assets/js',
				'maksimer.js'),
		'./build/js/test': path.resolve(process.cwd(), 'assets/js',
				'test.js'),
		'./build/css/index': './assets/sass/style.scss',
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
				test: /\.(sc|sa|c)ss$/,
				exclude: [ /node_modules/ ],
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
						options: {
							hmr: process.env.NODE_ENV === 'development',
							publicPath: ( resourcePath, context ) => {
								// publicPath is the relative path of the resource to the context
								// e.g. for ./css/admin/main.css the publicPath will be ../../
								// while for ./css/main.css the publicPath will be ../
								return path.relative( path.dirname( resourcePath ), context ) + '/';
							},
						},
					},
					{ loader: 'css-loader' },
					{ loader: 'postcss-loader' },
					{ loader: 'sass-loader' },
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
		...defaultConfig.plugins,
		new MiniCssExtractPlugin( {
			moduleFilename: ( { name } ) => `${ name.replace( '/js/', '/css/' ) }.css`,
		} ),
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
