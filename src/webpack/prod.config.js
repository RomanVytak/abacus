const merge = require('webpack-merge')
const common = require('./base.config.js')

const path = require('path')
const autoprefixer = require('autoprefixer')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

const TerserJSPlugin = require('terser-webpack-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const CompressionPlugin = require('compression-webpack-plugin')

module.exports = merge(common, {
	mode: 'production',

	module: {
		rules: [{
			test: /\.scss$/,
			use: [
				MiniCssExtractPlugin.loader, {
					loader: 'css-loader',
					options: {
						url: false
					}
				},
				// {
				// 	loader: 'postcss-loader',
				// 	options: {
				// 		plugins: [
				// 			require('autoprefixer')({
				// 				browsers: ['last 2 versions']
				// 			})
				// 		]
				// 	}
				// },
				{
					loader: 'sass-loader'
				}
			]
		},
		{
			test: /\.js$/,
			loader: 'babel-loader',
			exclude: [
				path.join(__dirname, '../node_modules'),
				// path.join(__dirname, '../app/js/vendor')
			],

			// (???)
			// options to configure babel with
			// query: {
			// 	plugins: ['transform-runtime'],
			// 	presets: ['es2015', 'stage-0']
			// }
		}]

		// (???)
		// ,
		// loaders: [
		//   { test: require.resolve('jquery'), loader: 'expose?jQuery!expose?$' },
		//   { test: /jquery-mousewheel/, loader: 'imports?define=>false&this=>window' },
		//   { test: /malihu-custom-scrollbar-plugin/, loader: 'imports?define=>false&this=>window' }
		// ]
	},

	performance: {
		hints: false
	},

	optimization: {
		minimizer: [
			new TerserJSPlugin({}),
			new OptimizeCSSAssetsPlugin({})
		]
	},

	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name]/style.min.css'
		}),

		new CompressionPlugin({
			test: /\.js$|\.css$|/,
		})
	]
})