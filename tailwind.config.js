import preset from './vendor/filament/support/tailwind.config.preset'
import colors from 'tailwindcss/colors'

export default {
    presets: [preset],
    content: [
        './app/Livewire/**/*.php',
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: colors.red,
                gray: colors.gray,
            },
        }
    },
}
