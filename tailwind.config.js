const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            borderWidth: ['hover', 'active'],
            borderColor: ['hover', 'active'],
            fontWeight: ['hover', 'active'],
            inset: ['hover', 'active'],
            translate: ['hover', 'active'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
