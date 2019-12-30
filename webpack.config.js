const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	entry: {
		'./build/js/index': path.resolve( process.cwd(), 'assets/js', 'index.js' ),
		'./build/css/sass': path.resolve( process.cwd(), 'assets/sass', 'admin.scss' ),
		// 'editor-style': path.resolve( process.cwd(), 'assets/sass', 'editor-style.scss' ),
		// index: path.resolve( process.cwd(), 'assets/sass', 'index.scss' ),
	},

	output: {
		filename: '[name].js',
		path: path.resolve( process.cwd() ),
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
							minimize: ( 'production' === process.env.NODE_ENV ),
						},
					},
					'postcss-loader',
					{ loader: 'sass-loader' },
				],
			},
		],
	},
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
	]
};
