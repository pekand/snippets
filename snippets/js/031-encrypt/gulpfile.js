const { series, src, dest } = require("gulp")
const concat = require('gulp-concat');
const plumber = require("gulp-plumber")
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const minify = require('gulp-minify');
const uglify = require('gulp-uglify');

const rollupStream = require('rollup-stream');
const rollup = require('gulp-rollup');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');

const resolveRollup = require('@rollup/plugin-node-resolve');
const commonjsRollup = require('@rollup/plugin-commonjs');
const babelRollup = require('@rollup/plugin-babel');

function builsSourceTask() {
  return src([
    'node_modules/crypto-js/crypto-js.js',
    'src/gulp/*.js'
    ])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(concat('script.js'))
    .pipe(
        babel({
          presets: [
            [
              "@babel/env",
              {
                modules: false
              }
            ]
          ]
        })
      )
    
    //.pipe(minify())
    //.pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/assets/js'));
    
}

function bundleTask() {
    return rollupStream({
      input: './src/rollup/index.js',
      sourcemap: true,
      format: "cjs",
      plugins: [ ]
    })
    .pipe(source('script.js', './src'))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./public/assets/js'));
}

exports.bundle = bundleTask
exports.build = builsSourceTask
exports.default = builsSourceTask
