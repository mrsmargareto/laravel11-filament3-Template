import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/App/**/*.php',
        './resources/views/filament/app/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/guava/filament-knowledge-base/src/**/*.php',
        './vendor/guava/filament-knowledge-base/resources/**/*.blade.php',
        './vendor/kenepa/banner/resources/**/*.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
    ],
}
