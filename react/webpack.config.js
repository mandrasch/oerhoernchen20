var HtmlWebpackPlugin = require('html-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const CopyPlugin = require('copy-webpack-plugin');

module.exports = {
  entry: './src/index.js',
  output: {
    path: __dirname + '/build',
    /*publicPath: '/',*/
    filename: 'oerhoernchen.community_bookmarks.react.js'
  },
  devServer: {
    contentBase: './',
    publicPath: '/build/'
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
       	use: {
          loader: "babel-loader"
        }
      },
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
      {
         test: /\.(png|svg|jpg|gif)$/,
         use: [
           'file-loader'
         ]
      }
    ]
  },
  plugins:[new CleanWebpackPlugin(),
    new CopyPlugin([
      { from: 'public/index.html', to: 'index.html' },
    ])
  ]
  /*,
   plugins: [
        new HtmlWebpackPlugin({
            hash: true,
            filename: 'index.html' //relative to root of the application
        })
   ]*/
};




