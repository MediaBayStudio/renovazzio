// npm i -D yargs fs mkdirpsync path gulp gulp-cli gulp-sass gulp-clean-css gulp-autoprefixer gulp-html-minifier gulp-include gulp-remove-logging gulp-uglify gulp-rename gulp-strip-comments gulp-tap gulp-beautify gulp-if gulp-flatten

// npm i -D gulp-babel @babel/core @babel/plugin-transform-block-scoping @babel/plugin-transform-template-literals @babel/plugin-transform-arrow-functions

let { src, dest, watch, series, parallel, task } = require('gulp'),
  path = require('path').posix,
  fs = require('fs'),
  argv = require('yargs').argv,
  mkdirpsync = require('mkdirpsync'),

  srcPath = './src',
  config = require('./scripts/config.js'),
  wordpress = config.wordpress,
  flexibleWordpress = config.flexibleWordpress,

  createBlock = require('./scripts/start/create-block.js'),
  createFile = require('./scripts/start/create-file.js'),

  removeLogging = require('gulp-remove-logging'),
  babel = require('gulp-babel'),
  uglify = require('gulp-uglify'),

  start = require('./scripts/start/start.js'),

  createStartCatalogs = function(cb) {
    // for (dir in config.src) {
    //   mkdirpsync(config.src[dir]);
    //   console.log('Создано: ' + config.src[dir]);
    // }
    cb();
  },

  moveSource = require('./scripts/move/move-src.js'), { moveImages, moveFonts, moveFavicons, moveJSON, moveParts, movePHP, moveHTML } = require('./scripts/move/move-files.js'),
  moveJs = require('./scripts/move/move-js.js'),

  buildJs = require('./scripts/watch/build-js.js'),
  buildCss = require('./scripts/watch/build-css.js'),

  createPage = require('./scripts/createPage.js');


task('start', series(createStartCatalogs, start));

task('createblock', function(cb) {
  let newPath = argv.src;
  if (newPath.constructor !== Boolean) {
    createBlock(newPath);
  }
  cb();
});

task('renameblock', function(cb) {
  let oldPath = argv.src,
    newPath = argv.dest,
    blocksSrc = config.src.blocks;

  if (oldPath.constructor !== Boolean && newPath.constructor !== Boolean) {
    if (flexibleWordpress) {
      let parsedPath = path.parse(path.normalize(oldPath)),
        filedir = path.normalize(blocksSrc + '/' + parsedPath.name),
        files;

      try {
        files = fs.readdirSync(filedir);
      } catch (err) {
        console.log('Не удалось прочитать папку ' + filedir);
        console.error(err);
        return;
      }

      files.forEach(function(file) {
        let filebase = path.parse(file).base, //file.txt
          oldFilepath = path.normalize(filedir + '/' + filebase),
          newFilepath = path.normalize(filedir + '/' + filebase.replace(parsedPath.name, newPath));

        console.log('Хочу переименовать ' + oldFilepath + ' в ' + newFilepath);
        try {
          fs.renameSync(oldFilepath, newFilepath);
          console.log('Файл ' + oldFilepath + ' переименован в ' + newFilepath);
        } catch {
          console.log('Ошибка переименования файла ' + oldFilepath)
        }

      });

      // Переименовываем саму папку
      try {
        fs.renameSync(filedir, filedir.replace(parsedPath.name, newPath));
        console.log('Файл ' + filedir + ' переименован в ' + filedir.replace(parsedPath.name, newPath));
      } catch {
        console.log('Ошибка переименования файла ' + filedir)
      }
    }
  }
  cb();
});

task('createpage', createPage);

task('default', function(done) {
  // moveSource(); // Перемещаем исходный код
  if (wordpress) {
    if (flexibleWordpress) {
      watch(config.src.blocks + '**/*.js', buildJs);
      watch(config.src.js + 'components/*.js', buildJs);

      watch(config.src + 'style.scss', buildCss);
      watch(config.src.blocks + '**/*.scss', buildCss);
      // watch(config.src.scss + '**/*.scss', buildCss);
      watch(config.src.scss + '**/!(style-)*.scss', buildCss);

      watch(config.src.blocks + '**/*.php', moveParts);
      watch(config.src.path + '*.php', movePHP);
      watch(config.src.inc + '*.php', movePHP);
    } else {
      watch(config.src.js + 'components/*.js', buildJs) /*.on('unlink', path => removeFiles(path, 'unlink'))*/ ;
      watch(config.src.path + '*.html', moveHTML);
    }
  }

  watch(config.src.fonts + '**/*', moveFonts);
  watch(config.src.img + '**/*', moveImages);
  watch(config.src.path + '**/*.json', moveJSON);
});

task('movesrc', moveSource);
task('buildjs', buildJs);
task('movejs', moveJs);
// При flexiblewordpress собираются только blocks и assets
task('movecss', buildCss);
// html, php
task('moveparts', moveParts);
task('movephp', movePHP);
task('movehtml', moveHTML);
task('movefonts', moveFonts);
task('moveimg', moveImages);
task('movefavicons', moveFavicons);
task('movejson', moveJSON);

task('moveall', parallel(
  'movesrc',
  'movejs',
  'movecss',
  'moveparts',
  'movephp',
  'movehtml',
  'movefonts',
  'moveimg',
  'movefavicons',
  'movejson'));