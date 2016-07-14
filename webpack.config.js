var path = require('path');
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    entry: [
        './index.js'
    ],
    output: {
        publicPath: '/dist/',
        path: path.join(__dirname, 'dist'),
        filename: 'index.js'
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'babel',
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract('style', 'css-loader!postcss-loader')
            }
        ]
    },
    postcss: function (webpack) {
        return [
            require('autoprefixer'),
            require('postcss-import')({
                addDependencyTo: webpack
            }),
            require('postcss-apply'),
            require('precss')
        ];
    },
    plugins: [
        new ExtractTextPlugin('bundle.css', {
            allChunks: true
        })
    ],
    devServer: {
        hot: true
    }
};
