var gulp = require('gulp')
var jshint = require('gulp-jshint')
var uglify = require('gulp-uglify')
var pump = require('pump')
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename')

/* paths */
var mainjs = './js/main.js';
var mainscss = './css/main.scss'

/* 检查代码 */
gulp.task('lint', function() {
    return gulp.src(mainjs)
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

/* 压缩混淆js */
gulp.task('script', ['lint'], function (cb) {
    pump([
            gulp.src(mainjs),
            uglify(),
            rename('main.min.js'),
            gulp.dest('./js')
        ],
        cb
    );
});

/* compile sass */
gulp.task('stylesheet', function () {
    return gulp.src(mainscss)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./css'));
});

/* 监控js和scss */
gulp.task('watch', ['script', 'stylesheet'], function () {
    gulp.watch(mainjs, ['script']);
    gulp.watch('src/css/*.scss', ['stylesheet']);
})