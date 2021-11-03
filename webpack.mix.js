const mix = require('laravel-mix')
const path = require('path')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    //
  ])
  .vue({ version: 2 })
  .sourceMaps()
  .webpackConfig({
    module: {
      rules: [
        // Vuetify
        {
          test: /\.s(c|a)ss$/,
          use: [
            'vue-style-loader',
            'css-loader',
            {
              loader: 'sass-loader',
              options: {
                implementation: require('sass'),
                sassOptions: {
                  indentedSyntax: true,
                },
              },
            },
          ],
        },
      ],
    },

    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/js'),
      },
    },
  })
  .version();
