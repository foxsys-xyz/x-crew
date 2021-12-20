const colors = require('tailwindcss/colors');

module.exports = {
	// mode: 'jit',
	content: [
		'./storage/framework/views/*.php',
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
	],
	theme: {
		extend: {
			fontSize: {
				sm: ['0.775rem', '1.15rem'],
			},
			colors: {
				gray: colors.zinc,
			},
		},
	},
	plugins: [
		require('@tailwindcss/forms')
	],
}
