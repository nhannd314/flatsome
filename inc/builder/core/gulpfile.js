const gulp = require('gulp')
const $ = require('gulp-load-plugins')()

// True if dist task is running.
var dist = $.util.env._.indexOf('dist') > -1

//
// Scripts
//

gulp.task('webpack', function () {
    return gulp.src('./app/index.js')
        .pipe($.plumber({errorHandler: $.notify.onError("Error: <%= error.message %>")}))
        .pipe($.webpack(require('./build/webpack.config')))
        .pipe(gulp.dest('./assets/js'))
        .pipe($.notify('Scripts compiled successfully'))
})

//
// Create template cache.
//

gulp.task('js:templates', function () {
    return gulp.src('./app/**/*.html')
        .pipe($.plumber({errorHandler: $.notify.onError("Error: <%= error.message %>")}))
        .pipe($.angularTemplatecache({standalone: true, module: 'app.templates'}))
        .pipe($.if(dist, $.uglify()))
        .pipe(gulp.dest('./assets/js'))
        .pipe($.notify('Templates compiled successfully'))
})

//
// Styles
//

gulp.task('sass:master', function () {
    return compileCss('master')
})

gulp.task('sass:iframe', function () {
    return compileCss('iframe')
})

function compileCss(style) {
    return gulp.src('./app/' + style + '.scss')
        .pipe($.plumber({errorHandler: $.notify.onError("Error: <%= error.message %>")}))
        .pipe($.sassGlob())
        .pipe($.concat(style + '.css'))
        .pipe($.sass(require('./build/sass.config')))
        .pipe($.autoprefixer('last 3 version'))
        .pipe(gulp.dest('./assets/css'))
        .pipe($.notify(style + ' css compiled successfully'))
}

//
// Watch
//

gulp.task('watch', ['build-js', 'build-tpl', 'build-css'], function () {

    $.livereload.listen()

    gulp.watch(['app/**/*.html'], ['webpack', 'build-tpl'])
    gulp.watch(['app/**/*.scss'], ['build-css'])
    gulp.watch(['app/**/*.js'], ['webpack'])
    gulp.watch(['*.php']).on('change', $.livereload.changed)
    gulp.watch(['server/**/*.php']).on('change', $.livereload.changed)
    gulp.watch(['shortcodes/**/*.php']).on('change', $.livereload.changed)
    gulp.watch(['components/**/*.php']).on('change', $.livereload.changed)
    gulp.watch(['assets/css/**/*.css']).on('change', $.livereload.changed)
    gulp.watch(['assets/js/**/*.js']).on('change', $.livereload.changed)
    gulp.watch(['assets/img/**/*']).on('change', $.livereload.changed)

})

//
// Create plugin archive
//

gulp.task('dist', ['build-js', 'build-tpl', 'build-css'], function() {

    return gulp.src(['**',
        '!.*',
        '!bower.json',
        '!gulpfile.js',
        '!package.json',
        '!app{,/**}',
        '!tmp{,/**}',
        '!dist{,/**}',
        '!node_modules{,/**}',
        '!bower_components{,/**}'])
        .pipe($.archiver('ux-builder.zip'))
        .pipe(gulp.dest('./dist'))
})

//
// Tasks
//

gulp.task('default',    ['watch'])
gulp.task('build-css',  ['sass:master', 'sass:iframe'])
gulp.task('build-js',   ['webpack'])
gulp.task('build-tpl',  ['js:templates'])
