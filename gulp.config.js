export const sassPaths = [
	// Maksimer theme
	{
		input: './assets/sass/**/*.scss',
		output: './build/css/',
	},
	// Plugin 1
	{
		input: './assets/scss/**/*.scss',
		output: './build/csss/',
	},
];

export const jsPaths = [
	// Maksimer theme
	{
		input: './assets/js/maksimer.js',
		output: './build/js/',
		outname: 'maksimer.min.js',
	},

	// Plugin 1
	{
		input: './assets/jss/kim.js',
		output: './build/jsss/',
		outname: 'kim.min.js',
	},
];

