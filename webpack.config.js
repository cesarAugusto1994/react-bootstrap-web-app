/**
 * Created by cesar on 21/11/16.
 */

var webpack = require('webpack');
var path = require('path');

module.exports = {
    entry: ["./src/js/template.js", "./src/js/categorias.js", "./src/js/musica.js", "./src/js/login.js"],
    output: {
        filename: "web/assets/js/bundle.js",
    },
    devtool: 'source-map',
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            "React": "react",
        }),
    ],
    externals: {
        //don't bundle the 'react' npm package with our bundle.js
        //but get it from a global 'React' variable
        'react': 'React',
        'react-dom': 'ReactDOM'
    },
    resolve: {
        extensions: ['', '.js', '.jsx']
    }
}