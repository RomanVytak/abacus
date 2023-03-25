const merge = require('webpack-merge')
const common = require('./base.config.js')

const path = require('path')
const autoprefixer = require('autoprefixer')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = merge(common, {
	mode: 'development',
	devtool: 'source-map',

	module: {
		rules: [{
			test: /\.scss$/,
			use: [
				MiniCssExtractPlugin.loader, {
					loader: 'css-loader',
					options: {
						sourceMap: true,
						url: false
					}
				},
				// {
				// 	loader: 'postcss-loader',
				// 	options: {
				// 		plugins: [
				// 			require('autoprefixer')({
				// 				// browsers: ['last 2 versions']
				// 			})
				// 		],
				// 		sourceMap: true
				// 	}
				// },
				{
					loader: 'sass-loader',
					options: {
						sourceMap: true
					}
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
		},
		],
	},

	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name]/style.css'
		}),

		new BrowserSyncPlugin({
			open: false,
			// host: 'localhost',
			// port: 3000,
			proxy: 'http://localhost',
			files: [{
				// match: ['wp-content/themes/**/*.php'],
				fn: function(event, file) {
					if(event === 'change') {
						const bs = require('browser-sync').get('bs-webpack-plugin')
						bs.reload()
					}
				}
			}]
		}, {
			reload: true
		})
	]
})