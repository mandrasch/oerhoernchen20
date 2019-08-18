var HtmlWebpackPlugin = require('html-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const FileManagerPlugin = require('filemanager-webpack-plugin');


module.exports = {
  entry: './src/index.js',
  output: {
    path: __dirname + '/build',
    /* BEWARE DELETES FOLDER!!!! path: __dirname +'/../web/assets/js',*/
    /*publicPath: '/',*/
    filename: 'oerhoernchen.higher_education.react.js'
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
    ]),
    new FileManagerPlugin({
      onEnd: {
        copy: [
          { source: 'build/oerhoernchen.higher_education.react.js', destination: '../web/assets/js' }
        ]
        }
      })
  ]
  /*,
   plugins: [
        new HtmlWebpackPlugin({
            hash: true,
            filename: 'index.html' //relative to root of the application
        })
   ]*/
};
