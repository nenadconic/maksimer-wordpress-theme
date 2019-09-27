module.exports = {
	plugins: {
		'postcss-import': {},
		'postcss-preset-env': {},
		autoprefixer: {},
		'postcss-flexbugs-fixes': {},
		cssnano: {
			preset: [
				'default', {
					normalizeWhitespace: false,
				},
			],
		},
	},
};
