var coffee, concat, destinations, gulp, less, livereload, source, swallowError;

gulp = require('gulp');

less = require('gulp-less');

coffee = require('gulp-coffee');

concat = require('gulp-concat');

livereload = require('gulp-livereload');

source = {
  admin: {
    less: {
      src: 'web/less/admin/**/*.less',
      main: 'web/less/admin/admin.less'
    }
  },
  front: {
    coffee: {
      src: 'ng-app/**/*.coffee',
      main: 'ng-app/main.coffee'
    },
    less: {
      src: 'web/less/front/**/*.less',
      main: 'web/less/front/style.less',
      redactor: 'web/less/front/style-redactor.less'
    }
  },
  php: {
    src: [
		'yii-app/components/**/*.php', 
		'yii-app/config/**/*.php', 
		'yii-app/modules/**/*.php'
	],
    main: 'web/index.php'
  }
};

destinations = {
  css: 'web/css',
  js: 'web/js'
};

gulp.task('php', function() {
  gulp.src(source.php.main)
	.pipe(livereload());
});

gulp.task('less-admin', function() {
  gulp.src([source.admin.less.main])
	.pipe(less()).on('error', swallowError)
	.pipe(gulp.dest(destinations.css))
	.pipe(livereload());
});

gulp.task('less-front', function() {
   gulp.src([source.front.less.main, source.front.less.redactor])
	.pipe(less()).on('error', swallowError)
	.pipe(gulp.dest(destinations.css))
	.pipe(livereload());
});

gulp.task('watch', function() {
  livereload.listen();
  gulp.watch(source.admin.less.src, ['less-admin']);
  gulp.watch(source.front.less.src, ['less-front']);
  gulp.watch(source.php.src, ['php']);
});

gulp.task('coffee', function() {
  gulp.src([source.front.coffee.main, source.front.coffee.src])
	.pipe(coffee({
    bare: true
  })).on('error', swallowError)
	.pipe(concat('main.js'))
	.pipe(gulp.dest(destinations.js))
	.pipe(livereload());
});

gulp.task('build', ['coffee']);

gulp.task('default', ['less-admin', 'less-front', 'build', 'watch']);

swallowError = function(error) {
  console.log(error.toString());
  return this.emit('end');
};
