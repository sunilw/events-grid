var gulp = require('gulp') ;
var sass = require('gulp-sass') ;
var watch = require('gulp-watch') ;
var sourcemaps = require('gulp-sourcemaps') ;
var browserSync = require('browser-sync');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var combiner = require('stream-combiner2');
var util = require('gulp-util');


gulp.task('watch', function () {
    gulp.watch('./src/sass/**.scss', ['sass']);
    gulp.watch('./src/js/**.js', ['scripts']);
});

gulp.task( 'sass', function() {

    return gulp.src('./src/sass/**.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream()) ;
}) ;

gulp.task('scripts', function() {

    return gulp.src('./src/js/**.js')
        .pipe(concat('purified.js'))
        .pipe(gulp.dest('./js'))
        .pipe(uglify())
        .pipe(rename('purified.min.js'))
        .pipe(gulp.dest('./js')) 
	.pipe(uglify().on('error', util.log)) ;
});

gulp.task('serve', function() {
    browserSync({
        proxy : 'http://wp3'
    });

    gulp.watch("./js/**").on('change', browserSync.reload);
    
});

gulp.task('default', ['sass', 'scripts','watch', 'serve']) ;
