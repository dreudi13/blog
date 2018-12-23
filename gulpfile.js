/* REQUIRE
   =========================================*/
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var browserSync = require('browser-sync').create();
var sourcemaps = require('gulp-sourcemaps');

/* TASKS
   =========================================*/
// SASS
// Admin Master
gulp.task('admin_sass', function() {
    return gulp.src('web/bundles/dradmin/scss/master.scss')
        .pipe($.plumber())
        .pipe(sourcemaps.init())
        .pipe($.sass().on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers : ['last 2 versions'],
            cascade : false
        }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('src/DrAdminBundle/Resources/public/css/'))
        .pipe(browserSync.stream());
})

// JS
// Tâche à ajouter par la suite

/* WATCH
   =========================================*/
gulp.task('default', ['admin_sass'], function() {
    browserSync.init({
        proxy: 'localhost:8000'
    });
    gulp.watch('src/**/*.scss', ['admin_sass']).on('change', function(event) {
        console.log('le fichier '+ event.path +' a été modifié')
    });
    gulp.watch('src/**/*.js').on('change', browserSync.reload).on('change', function(event) {
        console.log('le fichier '+ event.path +' a été modifié')
    });
    gulp.watch('src/**/*.html.twig').on('change', browserSync.reload).on('change', function(event) {
        console.log('le fichier '+ event.path +' a été modifié')
    });
})
   
