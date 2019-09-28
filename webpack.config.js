const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

const NODE_ENV = process.env.NODE_ENV || 'development';

console.log( NODE_ENV );
const path = require( 'path' );

module.exports = {
	...defaultConfig,

	entry: {
		'./build/js/index': './assets/js/index.js',
		'./build/css/index': './assets/sass/index.scss',
	},

	output: {
		filename: '[name].js',
		path: path.resolve( process.cwd() ),
	},

	// Bring in sourcemaps for non-production builds.
	devtool: 'production' === NODE_ENV ? 'none' : 'cheap-module-eval-source-map',

	// We need to extend the module.rules & plugins to add the SCSS build process.
	// @todo remove this when https://github.com/WordPress/gutenberg/issues/14801 is resolved.
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
					// { loader: 'postcss-loader' },
					{ loader: 'sass-loader' },
				],
			},
		],
	},

	// Extend default config by including MiniCssExtractPlugin
	plugins: [
		...defaultConfig.plugins,
		new MiniCssExtractPlugin( {
			moduleFilename: ( { name } ) => `${ name.replace( '/js/', '/css/' ) }.css`,
		} ),
	],
};
