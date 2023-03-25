const path = require('path')
const webpack = require('webpack')
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')

module.exports = {
  entry: {
    // css
    'css': path.join(__dirname, '../app/scss/styles.scss'),
    // js
    'main': path.join(__dirname, '../app/js/main.js'),
    // 'main-new': path.join(__dirname, '../app/js/main-new.js'),
    // 'map': path.join(__dirname, '../app/js/map.js'),
    // 'jquery.min': path.join(__dirname, '../app/js/jquery.min.js'),
    // 'jquery.easing.1.3': path.join(__dirname, '../app/js/jquery.easing.1.3.js'),
  },

  output: {
    path: path.join(__dirname, '../../wp-content/themes/abacus/assets'),
    filename: 'js/[name].js',
    // chunkFilename: 'js/chunks/chunk.[id].js',
    // publicPath: '/wp-content/themes/custome_theme/assets/'
  },

  optimization: {
    splitChunks: {
      chunks: 'async',
      maxInitialRequests: Infinity,

      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/]/,
          name(module) {
            const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1]
            return `.${packageName.replace('@', '')}`
          },
        },
      },
    },
  },

  // externals: {
  //   // require("jquery") is external and available
  //   //  on the global var jQuery
  //   jquery: "jQuery"
  // },

  plugins: [
    new FixStyleOnlyEntriesPlugin(),

    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
    }),

    new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),

    new CleanWebpackPlugin({
      dry: false,
      verbose: true,
      cleanOnceBeforeBuildPatterns: [
        'css/', 'js/' // remove here
      ]
    })
  ]
}