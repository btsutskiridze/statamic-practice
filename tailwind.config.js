module.exports = {
    content: [
        "./resources/**/*.antlers.html",
        "./resources/**/*.blade.php",
        "./resources/**/*.vue",
        "./content/**/*.md",
    ],
    theme: {
        extend: {
            screens: {
                xs: "440px",
            },
        },
    },
    // corePlugins: {
    //     preflight: false,
    // },
    plugins: [require("@tailwindcss/typography")],
};
