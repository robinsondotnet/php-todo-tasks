/**
 * Created by kento on 5/7/17.
 */
var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'src/client/public');
var APP_DIR = path.resolve(__dirname, 'src/client/app');

var config = {
    context: __dirname + "/src",
    entry: "./main.js",

    output: {
        filename: "bundle.js",
        path: path.dirname(__dirname) + "/public",
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
            }
        ],
    },
};
module.exports = config;
