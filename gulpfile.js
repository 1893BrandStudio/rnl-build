const autoprefixer   = require('gulp-autoprefixer')
const argv           = require('yargs').argv
const babel          = require('gulp-babel')
const browsersync    = require('browser-sync').create()
const clean          = require('gulp-clean')
const gulp           = require('gulp')
const gutil          = require('gulp-util')
const gulpif         = require('gulp-if')
const imagemin       = require('gulp-imagemin')
const jshint         = require('gulp-jshint')
const nano           = require('gulp-cssnano')
const notify         = require('gulp-notify')
const plumber        = require('gulp-plumber')
const rename         = require('gulp-rename')
const sass           = require('gulp-sass')
const sourcemaps     = require('gulp-sourcemaps')
const stylish        = require('jshint-stylish')
const uglify         = require('gulp-uglify')

const config = require('./gulp-config')

const errHandler = (err, cb) => {
  notify.onError(err.messageOriginal)
  handler('red', err.messageFormatted)
  if(typeof this.emit === 'function') this.emit('end')
}

const handler = (color, msg, skip) => {
  if(skip) return
  gutil.log(gutil.colors[color](msg))
}

const isProd = a => !!a.prod

// Dumps ACF fields into /lib/dev/acf.xml so that they can be version controlled
gulp.task('acf', () => {
  const axios = require('axios')
  const fs    = require('fs')
  const path = './lib/dev/acf.xml'

  axios.get(`http://${config.url}/wp-json/dev/acf`)
    .then(res => {
      try {
        fs.writeFileSync(path, res.data.xml)
      } catch(e){
        handler('red', 'Error writing to export file :|')
      }
      handler('green', `ACF data saved to ${path}`)
    })
    .catch((err) => {
      handler('red', err.message)
    })
})

// Removes existing fonts from /dist
gulp.task('clean-fonts', () => {
  return gulp.src('./dist/fonts', {read: false})
    .pipe(clean())
    .on('end', () => handler('white', 'Fonts cleaned!'))
})

// Adds fonts from /assets to /dist
gulp.task('fonts', ['clean-fonts'], () => {
  return gulp.src('./assets/fonts/**/*.*')
    .pipe(gulp.dest('./dist/fonts'))
    .pipe(browsersync.stream())
})

// Remove existing javascript from /dist
gulp.task('clean-js', () => {
  return gulp.src('./dist/js', {read: false})
    .pipe(clean())
    .on('end', () => handler('white', 'JS cleaned!'))
})

// Run JS through JSHint, Babel, and Uglify. Produces source maps.
gulp.task('js', ['clean-js'], () => {
  return gulp.src('./assets/js/**/*.js')
    .pipe(jshint({
      esversion: 6,
      eqeqeq: true,
      asi: true,
      browser: true,
      jquery: true
    }))
    .pipe(jshint.reporter(stylish))
      .on('end', () => handler('green', 'JS passed linter!'))
    .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(babel({
        presets: ['es2015']
      }))
        .on('end', () => handler('yellow', 'Babelification complete!'))
        .on('error', errHandler)
      .pipe(uglify())
        .on('end', () => handler('blue', 'Uglification complete!'))
        .on('error', errHandler)
      .pipe(rename({extname: '.min.js'}))
    .pipe(sourcemaps.write('../maps'))
    .pipe(gulp.dest('./dist/js/'))
      .on('end', () => handler('green', 'JS task complete!'))
    .pipe(browsersync.stream())
})

gulp.task('clean-css', () => {
  return gulp.src('dist/css', {read: false})
    .pipe(clean())
    .on('end', () => handler('white', 'CSS cleaned!'))
})

gulp.task('css', ['clean-css'], () => {
  return gulp.src('./assets/scss/main.scss')
    .pipe(plumber())
    .pipe(sourcemaps.init())
      .on('end', () => handler('yellow', 'SCSS Source map started!'))
      .pipe(sass())
        .on('end', () => handler('blue', 'SCSS compilation complete!'))
        .on('error', errHandler)
      .pipe(autoprefixer({ browsers: 'last 2 versions' }))
        .on('end', () => handler('cyan', 'Autoprefixer complete!'))
      .pipe(nano())
        .on('end', () => handler('magenta', 'Nano complete!'))
      .pipe(rename({extname: '.min.css'}))
    .pipe(sourcemaps.write('../maps'))
      .on('end', () => handler('yellow', 'SCSS Source map complete!'))
    .pipe(gulp.dest('./dist/css/'))
      .on('end', () => handler('green', 'CSS task complete!'))
    .pipe(browsersync.stream())
})

gulp.task('clean-images', () => {
  return gulp.src('./dist/img', {read: false})
    .pipe(clean())
    .on('end', () => handler('white', 'Images cleaned!'))
})

gulp.task('images', ['clean-images'], () => {
  return gulp.src('./assets/img/**/*.*')
    .pipe(imagemin({
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest('dist/img'))
    .pipe(browsersync.stream())
})

gulp.task('build', ['css', 'js', 'images', 'fonts'])

gulp.task('watch', ['build'], () => {
  let path = './assets/'

  gulp.watch(`${path}scss/**/*`, ['css'])
  gulp.watch(`${path}js/**/*`, ['js'])
  gulp.watch(`${path}fonts/**/*`, ['fonts'])
  gulp.watch(`${path}img/**/*`, ['images'])

  browsersync.init({
    files: ['{lib,partials}/**/*.php', '*.php'],
    proxy: config.url,
    snippetOptions: {
      whitelist: ['/wp-admin/admin-ajax.php'],
      blacklist: ['wp-admin/**']
    }
  })
})
