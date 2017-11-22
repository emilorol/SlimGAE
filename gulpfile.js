/*!
 * gulp
 * $ npm install gulp-ruby-sass gulp-autoprefixer gulp-cssnano gulp-jshint gulp-concat gulp-uglify gulp-imagemin gulp-notify gulp-rename gulp-livereload gulp-cache del --save-dev
 */

// Load plugins
var gulp          = require('gulp'),
    sass          = require('gulp-ruby-sass'),
    autoprefixer  = require('gulp-autoprefixer'),
    cssnano       = require('gulp-cssnano'),
    jshint        = require('gulp-jshint'),
    uglify        = require('gulp-uglify'),
    imagemin      = require('gulp-imagemin'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    notify        = require('gulp-notify'),
    cache         = require('gulp-cache'),
    livereload    = require('gulp-livereload'),
    del           = require('del');

// Styles
gulp.task('styles', function() {
  return sass('backend/Resources/styles/main.css', { style: 'expanded' })
    .pipe(autoprefixer('last 2 version'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(cssnano())
    .pipe(gulp.dest('public/assets/css'))
    .pipe(notify({ message: 'Styles task complete' }));
});

// Scripts
gulp.task('scripts', function() {
  return gulp.src('backend/Resources/scripts/**/*.js')
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('default'))
    .pipe(concat('main.js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('public/assets/js'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Images
gulp.task('images', function() {
  return gulp.src('backend/Resources/images/*')
    .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
    .pipe(gulp.dest('public/assets/images'))
    .pipe(notify({ message: 'Images task complete' }));
});

// Clean
gulp.task('clean', function() {
  return del(['public/assets/css', 'public/assets/js', 'public/assets/images']);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('styles', 'scripts', 'images');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('backend/Resources/styles/**/*.css', ['styles']);

  // Watch .js files
  gulp.watch('backend/Resources/scripts/**/*.js', ['scripts']);

  // Watch image files
  gulp.watch('backend/Resources/images/**/*', ['images']);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in public/, reload on change
  gulp.watch(['public/**']).on('change', livereload.changed);

});
