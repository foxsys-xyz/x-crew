const colors = require('tailwindcss/colors');

module.exports = {
  mode: 'jit',
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      red: colors.red,
      yellow: colors.amber,
      blue: colors.blue,
      indigo: colors.indigo,
      green: colors.green
    },
    extend: {},
  },
  variants: {},
  plugins: [
    require('@tailwindcss/forms')
  ],
}
