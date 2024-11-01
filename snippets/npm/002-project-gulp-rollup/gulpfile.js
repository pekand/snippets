const { src, dest, series, parallel, watch} = require("gulp");
const plumber = require("gulp-plumber");
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const babel = require('gulp-babel');
const minify = require('gulp-minify');
const uglify = require('gulp-uglify');
const del = require('del');

const rollupStream = require('@rollup/stream');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');

const { nodeResolve } = require('@rollup/plugin-node-resolve');
const commonjsRollup = require('@rollup/plugin-commonjs');
const babelRollup = require('@rollup/plugin-babel');
const { terser } = require('rollup-plugin-terser');


function depsTask(cb) {
  const files = [
    "node_modules/jquery/dist/jquery.js"
  ]
  
  src(files)
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(plumber())
    .pipe(concat("deps.js"))
    //.pipe(minify())
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(dest("./public/assets/js"))
  
  cb();
}

let cache;

function jsTask(cb) {
    const options = { 
      input: 'src/index.js',
      cache,
      output: {
        format: 'cjs'
      },
      plugins: [
        nodeResolve({ignoreGlobal: false, include: ['node_modules/**']}),
        commonjsRollup(),
        babelRollup.babel({ babelHelpers: 'bundled' }),
        terser()
      ]
    };

  rollupStream(options)
    .pipe(source('script.js'))
    .on('bundle', (bundle) => {
      cache = bundle;
    })
    .pipe(buffer())
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(plumber())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./public/assets/js'));

    cb();
}

function cleanTask(cb) {
  const files = [
      './public/assets/js/*.js',
      './public/assets/js/*.map'
    ];

  del(files);

  cb();
}

function change() {
  watch('./src/**/*.js', {delay: 500}, jsTask);
}

exports.clean = cleanTask;
exports.watch = change;
exports.js = jsTask;
exports.deps = depsTask;
exports.bundle = series(cleanTask, parallel(jsTask, depsTask));
exports.default = series(cleanTask, parallel(jsTask, depsTask));
