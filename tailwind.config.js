export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './app/Livewire/**/*.php',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php'
  ],
  theme: { extend: {} },
  plugins: [require('daisyui')],
  daisyui: { themes: ['light', 'cupcake'] }
};
