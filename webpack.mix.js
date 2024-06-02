const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("react/src/index.js", "public/js")
    .react()
    .sass("resources/sass/app.scss", "public/css")
    .styles(
        [
            "react/src/styles/reset.css",
            "react/src/styles/common.css",
            // "react/src/styles/fonts.css",
        ],
        "public/css/app.css"
    )
    .sourceMaps();

    mix.webpackConfig({
        module: {
            rules: [
                {
                    test: /\.tsx?$/,
                    loader: 'babel-loader',
                    exclude: /node_modules/,
                    options: {
                        presets: [
                            '@babel/preset-env',
                            '@babel/preset-react',
                            '@babel/preset-typescript',
                        ],
                    },
                },
            ],
        },
        resolve: {
            extensions: ['.js', '.jsx', '.ts', '.tsx'],
        },
    });
