const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	entry: {
		'./build/js/index': path.resolve( process.cwd(), 'assets/js', 'index.js' ),
	},

	output: {
		filename: '[name].js',
		path: path.resolve( process.cwd() ),
	},

	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
		],
	},
};
