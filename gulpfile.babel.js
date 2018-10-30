'use strict';

import plugins       from 'gulp-load-plugins';
import yargs         from 'yargs';
import browser       from 'browser-sync';
import gulp          from 'gulp';
import rimraf        from 'rimraf';
import yaml          from 'js-yaml';
import fs            from 'fs';
import dateFormat    from 'dateformat';
import webpackStream from 'webpack-stream';
import webpack2      from 'webpack';
import named         from 'vinyl-named';
import log           from 'fancy-log';
import colors        from 'ansi-colors';
import path          from 'path';

// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Check for --development flag unminified with sourcemaps
const DEV = !!(yargs.argv.dev);

// Load settings from settings.yml
const { BROWSERSYNC, COMPATIBILITY, REVISIONING, PATHS } = loadConfig();

// Check if file exists synchronously
function checkFileExists(filepath) {
  let flag = true;
  try {
    fs.accessSync(filepath, fs.F_OK);
  } catch(e) {
    flag = false;
  }
  return flag;
}

// Load default or custom YML config file
function loadConfig() {
  log('Loading config file...');

  if (checkFileExists('config.yml')) {
    // config.yml exists, load it
    log(colors.cyan('config.yml'), 'exists, loading', colors.cyan('config.yml'));
    let ymlFile = fs.readFileSync('config.yml', 'utf8');
    return yaml.load(ymlFile);

  } else if(checkFileExists('config-default.yml')) {
    // config-default.yml exists, load it
    log(colors.cyan('config.yml'), 'does not exist, loading', colors.cyan('config-default.yml'));
    let ymlFile = fs.readFileSync('config-default.yml', 'utf8');
    return yaml.load(ymlFile);

  } else {
    // Exit if config.yml & config-default.yml do not exist
    log('Exiting process, no config file exists.');
    log('Error Code:', err.code);
    process.exit(1);
  }
}

// Delete the "dist" folder
// This happens every time a build starts
function clean(done) {
  rimraf(PATHS.dist, done);
}

// Copy files out of the assets folder
// This task skips over the "img", "js", and "scss" folders, which are parsed separately
function copy() {
  return gulp.src(PATHS.assets)
    .pipe(gulp.dest(PATHS.dist + '/assets'));
}

// Compile Sass into CSS
// In production, the CSS is compressed
function sass() {

	return gulp.src( PATHS.entries.scss, { allowEmpty: true, base: '*' } )
		.pipe( named() )
		.pipe( $.sourcemaps.init() )
		.pipe(
			$.sass( {
				includePaths: PATHS.sass,
				outputStyle: 'compressed'
			} )
			.on( 'error', $.sass.logError )
		)
		.pipe(
			$.autoprefixer( {
				browsers: COMPATIBILITY
			} )
		)
		.pipe(
			$.if( PRODUCTION, $.cleanCss( { compatibility: 'ie9' } ) )
		)
		.pipe( $.rename( function( file ) {
			file.dirname = file.dirname.replace( '../src/assets/scss', '' );
			return file;
		 } ) )
		.pipe(
			$.if( ! PRODUCTION, $.sourcemaps.write() )
		)
		.pipe(
			$.if( REVISIONING && PRODUCTION || REVISIONING && DEV, $.rev() )
		)
		.pipe(
			gulp.dest( PATHS.dist + '/assets/css' )
		)
		.pipe(
			$.if( REVISIONING && PRODUCTION || REVISIONING && DEV, $.rev.manifest() )
		)
		.pipe(
			gulp.dest( PATHS.dist + '/assets/css' )
		);

}

// Combine JavaScript into one file
// In production, the file is minified
const webpack = {
	
  config: {
    module: {
      rules: [
        {
          test: /.js$/,
          loader: 'babel-loader',
          exclude: /node_modules(?![\\\/]foundation-sites)/,
        },
      ],
    },
    externals: {
      jquery: 'jQuery',
    },
  },

  changeHandler(err, stats) {
    log('[webpack]', stats.toString({
      colors: true,
    }));

    browser.reload();
  },

  build() {
    return gulp.src(PATHS.entries.js, { allowEmpty: true } )
      .pipe(named())
      .pipe(webpackStream(webpack.config, webpack2))
      .pipe($.if(PRODUCTION, $.uglify()
        .on('error', e => { console.log(e); }),
      ))
      .pipe($.if(REVISIONING && PRODUCTION || REVISIONING && DEV, $.rev()))
      .pipe(gulp.dest(PATHS.dist + '/assets/js'))
      .pipe($.if(REVISIONING && PRODUCTION || REVISIONING && DEV, $.rev.manifest()))
      .pipe(gulp.dest(PATHS.dist + '/assets/js'));
  },

  watch() {
    const watchConfig = Object.assign(webpack.config, {
      watch: true,
      devtool: 'inline-source-map',
    });

    return gulp.src(PATHS.entries.js, { allowEmpty: true } )
      .pipe(named())
      .pipe(webpackStream(watchConfig, webpack2, webpack.changeHandler)
        .on('error', (err) => {
          log('[webpack:error]', err.toString({
            colors: true,
          }));
        }),
      )
      .pipe(gulp.dest(PATHS.dist + '/assets/js'));
  },
	
  gutenberg_build() {
    return gulp.src(PATHS.entries.gutenberg, { allowEmpty: true } )
      .pipe(named())
      .pipe(webpackStream(webpack.config, webpack2))
      .pipe($.if(PRODUCTION, $.uglify()
        .on('error', e => { console.log(e); }),
      ))
      .pipe($.if(REVISIONING && PRODUCTION || REVISIONING && DEV, $.rev()))
      .pipe(gulp.dest(PATHS.dist + '/assets/js/gutenberg'))
      .pipe($.if(REVISIONING && PRODUCTION || REVISIONING && DEV, $.rev.manifest()))
      .pipe(gulp.dest(PATHS.dist + '/assets/js/gutenberg'));
  },

  gutenberg_watch() {
    const watchConfig = Object.assign(webpack.config, {
      watch: true,
      devtool: 'inline-source-map',
    });

    return gulp.src(PATHS.entries.gutenberg, { allowEmpty: true } )
      .pipe(named())
      .pipe(webpackStream(watchConfig, webpack2, webpack.changeHandler)
        .on('error', (err) => {
          log('[webpack:error]', err.toString({
            colors: true,
          }));
        }),
      )
      .pipe(gulp.dest(PATHS.dist + '/assets/js/gutenberg'));
  },
	
};

gulp.task('webpack:build', webpack.build);
gulp.task('webpack:watch', webpack.watch);
gulp.task('webpack:gutenberg_build', webpack.gutenberg_build);
gulp.task('webpack:gutenberg_watch', webpack.gutenberg_watch);

function tinymce() {

	return gulp.src( "src/assets/js/admin/tinymce/**/*.js" )
		.pipe( $.foreach( function( stream, file ) {
			return stream
				.pipe( $.babel() )
				.pipe( $.uglify() )
				.pipe( gulp.dest( PATHS.dist + '/assets/js/tinymce' ) )
		} ) );

}

// Copy images to the "dist" folder
// In production, the images are compressed
function images() {
  return gulp.src('src/assets/img/**/*')
    .pipe($.if(PRODUCTION, $.imagemin({
      progressive: true
    })))
    .pipe(gulp.dest(PATHS.dist + '/assets/img'));
}

// Start BrowserSync to preview the site in
function server(done) {
  browser.init({
    proxy: BROWSERSYNC.url,

    ui: {
      port: 8080
    },

  });
  done();
}

// Reload the browser with BrowserSync
function reload(done) {
  browser.reload();
  done();
}

// Watch for changes to static assets, pages, Sass, and JavaScript
function watch() {
  gulp.watch(PATHS.assets, copy);
  gulp.watch('src/assets/scss/**/*.scss').on('all', sass);
  gulp.watch('**/*.php').on('all', browser.reload);
  gulp.watch( ['src/assets/js/**/*.js', '!src/assets/js/admin/gutenberg/**/*.js'] ).on('all', gulp.series('webpack:build', tinymce, browser.reload));
  gulp.watch( 'src/assets/js/admin/gutenberg/**/*.js' ).on('all', gulp.series('webpack:gutenberg_build', browser.reload));
  gulp.watch('src/assets/img/**/*').on('all', gulp.series(images, browser.reload));
}

// Build the "dist" folder by running all of the below tasks
gulp.task('build',
 gulp.series(clean, sass, 'webpack:build', 'webpack:gutenberg_build', tinymce, images, copy));

// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', server, watch));