module.exports = function(grunt) {
	grunt.initConfig({
		pug: {
			debug: {
				options: {
					pretty: true
				},
				files: [{
					expand: true, //свойство, которое позволяет нам указать сразу все файлы, а не каждый по отдельности
					cwd: 'resources/assets/templates/pages', //папка в которой грунт возьмет файлы
					src: ['*.pug'], //возьми все файлы (*) с расширением pug
					dest: 'public/slice', //скомпилируй их в корневую папку
					ext: '.html' //с расширением html
				}]
			}
		},

		concat_css: {
			options: {
				// Task-specific options go here.
			},
			concat_stylus: {
				files: {
					'resources/tmp/stylus-blocks/settings.styl': ["resources/assets/stylus/settings/settings.styl", "resources/assets/stylus/settings/fonts.styl", "resources/assets/stylus/settings/common.styl"],
					'resources/tmp/stylus-blocks/main.styl': ["resources/assets/stylus/main/*.styl"],
					'resources/tmp/stylus-blocks/media.styl': ["resources/assets/stylus/media/*.styl"],
					'resources/tmp/styles.styl': ['resources/tmp/stylus-blocks/settings.styl', 'resources/tmp/stylus-blocks/main.styl', 'resources/tmp/stylus-blocks/media.styl']
				}
			}

		},


		stylus: {
			compile: {
				options: {
					compress: false
				},
				files: {
					'public/assets/css/styles.css': ['resources/tmp/styles.styl']
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 6 versions']
			},
			dist: {
				files: {
					'public/assets/css/styles.css': 'public/assets/css/styles.css'
				}
			}
		},

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'public/assets/css/',
					src: ['styles.css'],
					dest: 'public/assets/css/',
					ext: '.min.css' //название файла будет подставлено из 3 пункта
				}]
			}
		},

		svgstore: {
			options: {
				prefix: 'shape-', // This will prefix each <g> ID
				svg: { // will add and overide the the default xmlns="http://www.w3.org/2000/svg" attribute to the resulting SVG
					viewBox: '0 0 100 100',
					xmlns: 'http://www.w3.org/2000/svg'
				}
			},
			target: {
				files: {
					'public/assets/images/svg-sprite.svg': ['public/assets/images/icons-sprite/*.svg']
				}
			}
		},

		concat: {
			options: {
				banner: "'use strict';\n",
				separator: ';'
			},
			dist: {
				src: [
					'resources/assets/js/globals.js',
					'resources/assets/js/common.js',
					'resources/assets/js/carousel.js',
					'resources/assets/js/scroll.js',
					'resources/assets/js/form.js',
					'resources/assets/js/admin-team.js',
					'resources/assets/js/tabs.js',
					'resources/assets/js/toogle.js',
					'resources/assets/js/search.js'
				],
				dest: 'public/assets/js/main.js'
			}
		},

		uglify: {
			my_target: {
				files: {
					'public/assets/js/main.min.js': ['public/assets/js/main.js']
				}
			}
		},

		validation: { // Grunt w3c validation plugin
			options: {
				reset: grunt.option('reset') || false,
				stoponerror: false,
				generateCheckstyleReport: 'validation.xml',
				relaxerror: ['Bad value X-UA-Compatible for attribute http-equiv on element meta.',
					'Element title must not be empty.']
			},
			files: {
				src: ['public/index.html']
			}
		},

		clean: {
			tmp: ['resources/tmp']
		},

		watch: {
			stylus_watch: {
				files: ['resources/assets/stylus/**/*.styl'], //Изменяемые файлы
				tasks: ['build_styles'],
				options: {
					spawn: false,
					livereload: true
				}
			},
			pug_watch: {
				files: ['resources/assets/templates/**/*.pug'], //Изменяемые файлы
				tasks: ['pug'],
				options: {
					spawn: false,
					livereload: true
				}
			},
			js_watch: {
				files: ['resources/assets/js/*.js'], //Изменяемые файлы
				tasks: ['build_js'],
				options: {
					spawn: false,
					livereload: true
				}
			}
		}
	});

  // Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-pug');
	grunt.loadNpmTasks('grunt-concat-css');
	grunt.loadNpmTasks('grunt-contrib-stylus');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-svgstore');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-w3c-html-validation');
	grunt.loadNpmTasks('grunt-contrib-clean');

  // Default task(s).
	grunt.registerTask('build_styles', ['concat_css', 'stylus', 'autoprefixer', 'cssmin']);
	grunt.registerTask('build_js', ['concat', 'uglify']);
	grunt.registerTask('svg_concat', ['svgstore']);
	grunt.registerTask('html_validation', ['validation']);
	grunt.registerTask('build', ['pug', 'build_styles', 'build_js', 'svg_concat', 'clean']);
	grunt.registerTask('default', ['build', 'watch']);
};