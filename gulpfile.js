var gulp = require('gulp'),
    bower = require('gulp-bower'),
    mainBowerFiles = require('main-bower-files');
	
var config = {
     bowerDir: './bower_components'
}

gulp.task('bower', function() {
    return bower()
        .pipe(gulp.dest(config.bowerDir))
});

gulp.task("bower-files", function() {
    return gulp.src(mainBowerFiles())
        .pipe(gulp.dest('./public_html/js/lib'))
});

gulp.task('default', ['bower','bower-files']);