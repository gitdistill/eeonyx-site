/*!
 * gulp
 * $ npm install gulp-watch gulp-wiredep gulp-less gulp-autoprefixer gulp-clean-css gulp-jshint gulp-concat gulp-uglify gulp-notify gulp-rename gulp-cache del --save-dev
 */
/*
 */

// Load plugins
var gulp = require( 'gulp' ),
    less = require( 'gulp-less' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    // minifycss = require( 'gulp-clean-css' ),
    // jshint = require( 'gulp-jshint' ),
    // uglify = require( 'gulp-uglify' ),
    // rename = require( 'gulp-rename' ),
    concat = require( 'gulp-concat' ),
    notify = require( 'gulp-notify' ),
    // cache = require( 'gulp-cache' ),
    connect = require( 'gulp-connect' ),
    // wiredep = require('gulp-wiredep'),
    watch = require('gulp-watch'),
    plumber = require('gulp-plumber');
    // del = require( 'del' );

// Styles
gulp.task( 'generate-concatenated-styles', function () {
    return gulp.src( [ 'less/*.less' ] )
        // .pipe( concat( 'styles.css' ) )
        .pipe( less() )
        .pipe( autoprefixer( 'last 2 version' ) )
        .pipe( gulp.dest( '.' ) )
        // .pipe( rename( { suffix: '.min' } ) )
        // .pipe( minifycss() )
        .pipe( gulp.dest( '.' ) )
        .pipe( connect.reload() )
        .pipe( notify( { message: 'Concatenated styles task complete' } ) );
} );

// Scripts
gulp.task( 'generate-concatenated-scripts', function () {
    return gulp.src( 'js/*.js' )
        // .pipe( jshint( '.jshintrc' ) )
        // .pipe( jshint.reporter( 'default' ) )
        // .pipe( concat( 'scripts.js' ) )
        // .pipe( gulp.dest( 'dist' ) )
        // .pipe( rename( { suffix: '.min' } ) )
        // .pipe( uglify() )
        // .pipe( gulp.dest( 'dist' ) )
        .pipe( connect.reload() )
        .pipe( notify( { message: 'Scripts concat task complete' } ) );
} );

/*
// Templates
gulp.task( 'copy-templates', function () {
    return gulp.src( 'templates/*.html' )
        .pipe( wiredep() )
        .pipe( gulp.dest( 'dist' ) )
        .pipe( notify( { message: 'Copy templates task complete' } ) );
} );
*/

// Clean
gulp.task( 'clean', function ( cb ) {
    //del( [ 'dist' ], cb );
    cb();
} );

// Default task
gulp.task( 'default', [ 'clean' ], function () {
    gulp.start( [ 'generate-concatenated-styles' ] /*, [ 'generate-concatenated-scripts', 'copy-templates' ]*/ );
} );

// Watch
gulp.task( 'watch', function () {

    // Watch .less files
    gulp.watch( 'less/*.less', [ 'generate-concatenated-styles' ] );

    // // Watch html files
    // gulp.watch( [ 'templates/*.html' ], [ 'copy-templates' ] );

    // // Watch .js files
    gulp.watch( [ '*.js' ], [ 'generate-concatenated-scripts' ] );

    // // Watch any files in dist/, reload on change
    // watch( [ 'dist/**' ] ).pipe( connect.reload() );

    connect.server( {
        livereload: true
    } );


} );