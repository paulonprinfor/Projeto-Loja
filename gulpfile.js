const gulp = require('gulp');
const minify = require('gulp-clean-css');
const rename = require('gulp-rename');
const minifyJs = require('gulp-minify');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
const reload = browserSync.reload;
const sass = require('gulp-sass')(require('sass'));

const SCSS_PATH = 'src/scss/*.scss';
const JS_PATH = 'src/js/core/*.js';
const JS_PLUGINS_PATH = 'src/js/plugins/*.js';

const minifyConfig = {
  ext:{ src:'.min.js', min:'.js' },
};




function scssTask() {
  return gulp.src(SCSS_PATH)
    .pipe(sass().on('error', sass.logError))
    .pipe(rename({ basename: 'styles', suffix: '.min' }))
    .pipe(gulp.dest('dist'));
    
}


function jsPluginTask() {
  return gulp.src(JS_PLUGINS_PATH)
    .pipe(sourcemaps.init())
    .pipe(concat('plugins.js'))
    .pipe(minifyJs(minifyConfig))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist'));
}

function jsTask() {
  return gulp.src(JS_PATH)
    .pipe(sourcemaps.init())
    .pipe(concat('scripts.js'))
    .pipe(minifyJs(minifyConfig))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('dist'));
}

function watch() {
  
  gulp.watch(SCSS_PATH, scssTask).on('change', reload);
  gulp.watch(JS_PLUGINS_PATH, jsPluginTask).on('change', reload);
  gulp.watch(JS_PATH, jsTask).on('change', reload);
  gulp.watch("./*.html").on('change', reload);
}


exports.scssTask = scssTask;
exports.jsTask = jsTask;
exports.jsPluginTask = jsPluginTask;
exports.watch = watch;