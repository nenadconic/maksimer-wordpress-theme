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
	// plugins: [
	// 	...defaultConfig.plugins,
	// 	new MiniCssExtractPlugin( {
	// 		filename: '/assets/css/[name].css',
	// 	} ),
	// ],
};
