"use strict";

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sass   = require('gulp-sass'),
    maps   = require('gulp-sourcemaps'),
    del    = require('del'),
    browserSync   = require('browser-sync'),
    autoprefixer = require('gulp-autoprefixer'),
    plumber = require('gulp-plumber'),
    mmq = require('gulp-merge-media-queries');

function swallowError (error) {
    //Prints details of the error in the console
    console.log(error.toString());
    this.emit('end')
}

gulp.task('bt4concatScripts', function () {
    return gulp.src([
        'js/bootstrap4/alert.js',
        'js/bootstrap4/button.js',
        'js/bootstrap4/carousel.js',
        'js/bootstrap4/collapse.js',
        'js/bootstrap4/dropdown.js',
        'js/bootstrap4/index.js',
        'js/bootstrap4/modal.js',
        'js/bootstrap4/popover.js',
        'js/bootstrap4/scrollspy.js',
        'js/bootstrap4/tab.js',
        'js/bootstrap4/tooltip.js',
        'js/bootstrap4/util.js',
    ])
        .pipe(maps.init())
        .pipe(concat('app.js'))
        .on('error', swallowError)
        .pipe(maps.write('./maps'))
        .pipe(gulp.dest('js'));
});

gulp.task('minifyScripts', function (cb) {
    return gulp.src('js/scripts.js')
        .pipe(maps.init())
        .on('error', swallowError)
        .pipe(uglify())
        .pipe(rename('scripts.min.js'))
        .pipe(maps.write('./maps'))
        .pipe(gulp.dest('js'))
        .pipe(browserSync.stream({match: 'js/app.min.js'}));
});

gulp.task('compileSass', function (cb) {
    return gulp.src('style.scss')
            .pipe(plumber())
            .pipe(sass())
            .pipe(mmq({
                log: true
            }))
            .pipe(autoprefixer())
            .pipe(maps.init())
            .pipe(maps.write('./'))
            .pipe(gulp.dest(''))
            .pipe(browserSync.stream({match: 'style.css'}));
});

gulp.task('compileEditorSass', function (cb) {
    return gulp.src('editor-styles.scss')
            .pipe(plumber())
            .pipe(sass())
            .pipe(mmq({
                log: true
            }))
            .pipe(autoprefixer())
            .pipe(maps.init())
            .pipe(maps.write('./'))
            .pipe(gulp.dest(''))
            .pipe(browserSync.stream({match: 'editor-styles.css'}));
});

gulp.task('watchFiles', function () {
    gulp.watch(['assets/css/scss/components/*.scss', 'assets/css/scss/pages/*.scss', 'assets/css/scss/*.scss', '*.scss'], ['compileSass', 'compileEditorSass']).on('change', browserSync.reload);
    gulp.watch(['assets/js/app*.js*', 'assets/js/bootstrap.js', 'assets/js/scripts.js'], ['minifyScripts']).on('change', browserSync.reload);
});

gulp.task("build", ['minifyScripts', 'compileSass', 'compileEditorSass']);

gulp.task("default", ["watchFiles"], function() {
    gulp.start('build');
});