const { series, src, dest } = require("gulp")
const plumber = require("gulp-plumber")
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');

const rollupStream = require('@rollup/stream');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const terser = require('gulp-terser');

const { nodeResolve } = require('@rollup/plugin-node-resolve');
const commonjsRollup = require('@rollup/plugin-commonjs');
const babelRollup = require('@rollup/plugin-babel');

function bundleTask() {
    const options = { 
      input: 'src/index.js',
      output: {
        format: 'cjs'
      },
      plugins: [
        nodeResolve({ignoreGlobal: false, include: ['node_modules/**']}),
        commonjsRollup(),
        babelRollup.babel({ babelHelpers: 'bundled' })
      ]
    };
  return rollupStream(options)
    .pipe(source('script.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(plumber())
    //.pipe(terser({ keep_fnames: true, mangle: false }))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./public/assets/js'));
}


exports.bundle = bundleTask
exports.default = bundleTask
