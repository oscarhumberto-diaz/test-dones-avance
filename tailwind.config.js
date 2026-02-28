export default {
  content: [
    './resources/**/*.blade.php',
    './app/Livewire/**/*.php',
    './vendor/livewire/livewire/src/**/*.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui')],
  daisyui: {
    themes: ['light', 'cupcake'],
  }
};
