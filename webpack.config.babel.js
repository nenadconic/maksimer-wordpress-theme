import path from 'path';
import webpack from 'webpack';

const DIST_PATH = path.resolve( './assets/dist/js' );

const config = {
	cache: true,
	entry: {
		admin: './assets/js/admin.js',
		frontend: './assets/js/maksimer.js',
		shared: './assets/js/shared.js'
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
			}
		]
	},
	mode: process.env.NODE_ENV,
	plugins: [
		new webpack.NoEmitOnErrorsPlugin(),
	],
	stats: {
		colors: true
	},
	externals: {
		jquery: 'jQuery'
	}
};

module.exports = config;
