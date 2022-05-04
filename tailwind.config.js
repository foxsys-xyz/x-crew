const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme')

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
			fontFamily: {
				'mono': ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
			},
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
