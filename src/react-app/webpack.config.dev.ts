import path from 'path';
import fs from 'fs';
import autoprefixer from 'autoprefixer';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import {Configuration, EnvironmentPlugin} from 'webpack';
import ForkTsCheckerWebpackPlugin from 'fork-ts-checker-webpack-plugin';
import ReactRefreshWebpackPlugin from '@pmmmwh/react-refresh-webpack-plugin';
import CircularDependencyPlugin from 'circular-dependency-plugin';

export default {
  mode: 'development',

  devtool: 'inline-source-map',
  devServer: {
    hot: true,
    port: 8000,
    open: true,
    historyApiFallback: true,
    https: false,
    key: fs.readFileSync(path.join(__dirname, 'certs', 'localhost.key')),
    cert: fs.readFileSync(path.join(__dirname, 'certs', 'localhost.crt')),
  },

  entry: [
    'webpack-dev-server/client?http://localhost:8000',
    'webpack/hot/only-dev-server',
    './app/index.tsx',
  ],
  output: {
    path: path.join(__dirname, 'dist'),
    publicPath: '/',
    filename: 'main.js',
  },

  plugins: [
    new EnvironmentPlugin({
      API_BASE_URL: 'http://localhost:5000/api/v1.0/',
      APP_BASE_URL: 'http://localhost:8000',
    }),
    new HtmlWebpackPlugin({template: 'app/index.ejs'}),
    new CircularDependencyPlugin({
      exclude: /node_modules/,
    }),
    new ForkTsCheckerWebpackPlugin({
      typescript: {
        diagnosticOptions: {
          syntactic: true,
        },
      },
    }),
    new ReactRefreshWebpackPlugin(),
  ],

  resolve: {
    modules: ['node_modules'],
    alias: {
      rootReducer: path.resolve(__dirname, './app/rootReducer'),
    },
    extensions: ['.ts', '.tsx', '.js', '.jsx'],
  },

  module: {
    rules: [
      {
        test: /\.(j|t)s(x)?$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              [
                '@babel/preset-env',
                {
                  useBuiltIns: 'entry',
                  corejs: 3,
                  modules: false,
                },
              ],
              '@babel/preset-typescript',
              '@babel/preset-react',
            ],
            plugins: [
              ['@babel/plugin-proposal-decorators', {legacy: true}],
              ['@babel/plugin-proposal-class-properties', {loose: true}],
              'react-refresh/babel',
            ],
          },
        },
      },
      {
        test: /\.scss$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
              importLoaders: 2,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
              postcssOptions: {
                plugins: [autoprefixer],
              },
            },
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.css$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.eot(\?v=\d+.\d+.\d+)?$/,
        use: ['asset/resource'],
      },
      {
        test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        use: ['asset/resource'],
      },
      {
        test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
        use: ['asset/resource'],
      },
      {
        test: /\.otf(\?v=\d+\.\d+\.\d+)?$/,
        use: ['asset/resource'],
      },
      {
        test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
        use: ['asset/resource'],
      },
      {
        test: /\.(jpe?g|png|gif)$/i,
        use: ['asset/resource'],
      },
    ],
  },
} as Configuration;
