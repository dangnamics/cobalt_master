'use strict';
module.exports = function(grunt) {
	// Load all tasks
	require('load-grunt-tasks')(grunt);
	// Show elapsed time
	require('time-grunt')(grunt);

	var jsFileList = [ require('./files.json')	];// Get List of files from files.json (ND)

	grunt.initConfig({
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/js/*.js',
				'!assets/js/scripts.js',
				'!assets/**/*.min.*',
				'assets/js/plugins/*.js',
				'assets/js/features/*.js'
			]
		},
		less: {
			dev: {
				files: {
					'assets/css/main.css': [
						'assets/less/main.less'
					]
				},
				options: {
					compress: false,
					// LESS source map
					// To enable, set sourceMap to true and update sourceMapRootpath based on your install
					sourceMap: true,
					sourceMapFilename: 'assets/css/main.css.map',
					sourceMapRootpath: '/wp-content/themes/cobalt/',
					plugins: [
						require('less-plugin-glob') //Allow use of wildcards in LESS @import statements. Ex. @import "features/**" (ND)
					]
				}
			},
			build: {
				files: {
					'assets/css/main.min.css': [
						'assets/less/main.less'
					]
				},
				options: {
					compress: true,
					plugins: [
						require('less-plugin-glob') //Allow use of wildcards in LESS @import statements. Ex. @import "features/**" (ND)
					]
				}
			}
		},
		concat: {
			options: {
				separator: ';'
			},
			dist: {
				src: [jsFileList],
				dest: 'assets/js/scripts.js'
			}
		},
		uglify: {
			dist: {
				files: {
					'assets/js/scripts.min.js': [jsFileList]
				}
			},
			options: {
				compress: {
					drop_console: true // Remove Console.log functions (ND)
			 }
			}
		},
		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
			},
			dev: {
				options: {
					map: {
						prev: 'assets/css/'
					}
				},
				src: 'assets/css/main.css'
			},
			build: {
				src: 'assets/css/main.min.css'
			}
		},
		modernizr: {
			build: {
				devFile: 'assets/vendor/modernizr/modernizr.js',
				outputFile: 'assets/js/vendor/modernizr.min.js',
				files: {
					'src': [
						['assets/js/scripts.min.js'],
						['assets/css/main.min.css']
					]
				},
				extra: {
					shiv: false
				},
				uglify: true,
				parseFiles: true
			}
		},
		criticalcss: {
			custom: {
				options: {
					url: "http://cobalt-nd-ndowns.c9.io/basic",
					width: 1200,
					height: 900,
					outputfile: "assets/css/critical.css",
					filename: "assets/css/main.css", // Using path.resolve( path.join( ... ) ) is a good idea here
					buffer: 800*1024,
					ignoreConsole: false
				}
			}
		},
		version: {
			default: {
				options: {
					format: true,
					length: 32,
					manifest: 'assets/manifest.json',
					querystring: {
						style: 'cobalt_css',
						script: 'cobalt_js'
					}
				},
				files: {
					'lib/scripts.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
				}
			}
		},
		watch: {
			less: {
				files: [
					'assets/less/*.less',
					'assets/less/**/*.less'
				],
				tasks: ['less:dev', 'autoprefixer:dev', 'notify:less'] // Notify Success Message (ND)
			},
			js: {
				files: [
					jsFileList,
					'<%= jshint.all %>',
					'files.json'
				],
				tasks: ['jshint', 'concat', 'notify:jshint']
			},
			livereload: {
				// Browser live reloading
				// https://github.com/gruntjs/grunt-contrib-watch#live-reloading
				options: {
					livereload: 1337
				},
				files: [
					'assets/css/main.css',
					'assets/js/scripts.js',
					'templates/*.php',
					'*.php'
				]
			}
		},
		notify: { //Success Notification Tasks (ND)
			less:{
					options:{
							title: "LESS Success",
							message: "New main.css file compiled."
					}
			},
			jshint:{
					options:{
							title: "JSHINT Success",
							message: "New scripts.js file compiled."
					}
			}
		}
	});

	// Load Tasks
	grunt.loadNpmTasks('grunt-notify'); // OSX desktop notifications (ND)
	grunt.loadNpmTasks('grunt-contrib-less'); // Add support for less plugins: less-plugin-** (ND)
	grunt.loadNpmTasks('grunt-criticalcss'); // Add support for Grunt Critical CSS (ND)

	// Run Tasks
	grunt.task.run('notify_hooks'); // Custom Success Messages (ND)

	// Register tasks
	grunt.registerTask('default', [
		'dev',
	]);
	grunt.registerTask('dev', [
		'jshint',
		'less:dev',
		'autoprefixer:dev',
		'concat',
		'notify'
	]);
	grunt.registerTask('build', [
		'jshint',
		'less:build',
		'autoprefixer:build',
		'uglify',
		'criticalcss',
		'modernizr',
		'version',
		'notify'
	]);
};
