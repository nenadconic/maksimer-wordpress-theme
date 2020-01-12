const path = require( 'path' );
const webpack = require( 'webpack' );
const DIST_PATH = path.resolve( process.env.currentJsFileOutput );

const config = {
	cache: true,
	entry: process.env.currentJsFileInput,

	output: {
		path: DIST_PATH,
		filename: process.env.currentJsFileOutname,
	},

	resolve: {
		modules: [ 'node_modules' ],
	},

	devtool: 'source-map',

	module: {
		rules: [
			{
				test: /\.js$/,
				enforce: 'pre',
				loader: 'eslint-loader',
				options: {
					fix: true,
				},
			},
			{
				test: /\.js$/,
				use: [ {
					loader: 'babel-loader',
					options: {
						babelrc: true,
					},
				} ],
			},
		],
	},
	mode: process.env.NODE_ENV,
	plugins: [
		new webpack.NoEmitOnErrorsPlugin(),
	],
	stats: {
		colors: true,
	},
	externals: {
		jquery: 'jQuery',
	},
};

module.exports = config;
