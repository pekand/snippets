const path = require('path');
 
module.exports = {
  entry: path.resolve(__dirname, './src/webpack/index.js'),
  mode: 'production',
  module: {
    rules: [
      {
        test: /\.(js)$/,
        exclude: /node_modules/,
        use: ['babel-loader']
      }
    ]
  },
  resolve: {
    extensions: ['*', '.js'],
    fallback: { 
      "crypto": false,
      //"crypto": require.resolve("crypto-browserify"),
      //"buffer": require.resolve("buffer/"),
      //"stream": require.resolve("stream-browserify")
    }
  },
  output: {
    path: path.resolve(__dirname, 'public/assets/js'),
    filename: 'script.js'
  }
};
