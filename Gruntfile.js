module.exports = function(grunt) {
/*----------------------------------------------------
 * default is the default task.
 *-----------------------------------------------------*/
'use strict';

 //load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

/*----------------------------------------------------
    // *号匹配任意任意文件夹或文件，不匹配/ ,
    // **号文件夹文件名，包括/
    // grunt.loadNpmTasks('grunt-contrib-htmlmin');加载htmlmin任务，可在cmd里grunt htmlmin执行htmlmin属性下的所有操作
    // htmlmin:test 表示执行htmlmin下面的 test操作
    // grunt.registerTask('css', ['cssmin:merge']);  //注册一个tesk叫 css(将css文件合并)，可 grunt css调用它
    // 若直接 grunt，则相当于 grunt default, 该default需要注册
  	// pkg: grunt.file.readJSON('package.json') //导入package.json到变量pgk,从而可以使用里面的配置数据如：<%= pkg.name%>
	// 输出文件源文件要是不存在，grunt会报错

 *-----------------------------------------------------*/

   var cfg = {
   	root: '',	//根目录
    src: '/',	//livereload 打开的index.html文件目录
    // Change 'localhost' to '0.0.0.0' to access the server from outside.
    serverHost: '0.0.0.0',
    serverPort: 9000,
    livereload: 35789
  }; 

  var _cssfiles = ['public/css/home/reset.css','public/css/home/common.css','public/css/home/home.style.css'];



  var _cssmin = 'public/css/home/assets/css/style.min.css';
  var jspath = 'public/js/home/';
  var imagespath = 'public/images/home/';

	// Project configuration.
  grunt.initConfig({
  	pkg: grunt.file.readJSON('package.json'),
 
		// Task htmlmin
		htmlmin: {
			dist: {
				options: {
					removeComments: true,		//去注析
					collapseWhitespace: true	//去换行
				},
				files: { // Dictionary of files
					'assets/html/index.html': ['src/html/index.html']
				}
			}
		},


		// Task jsmin //js 压缩
		uglify: {
			options: {
				mangle: false
			},
			compress: {
				files: {
					'public/js/home/asset/home.js': 
					[
					'public/js/home/public.js'
					,'public/js/home/home.script.js'
					]
				}
			},
      merge: {//压缩a.js，混淆变量名，保留注释，添加banner和footer
        options: {
            mangle: true, //混淆变量名
            preserveComments: false, //删除注释，all保留注释，还可以为 false（删除全部注释），some（保留@preserve @license @cc_on等注释）
            banner:'/*! <%= pkg.name %> 最后修改于： <%= grunt.template.today("yyyy-mm-dd") %> */\n'//添加footer
            //,report: "min"//输出压缩率，可选的值有 false(不输出信息)，gzip
        },
        files: {
            // 'assets/js_all/script.min.js': ['public/js/home/*.js']
           'public/js/home/asset/home.js': ['public/js/home/public.js','public/js/home/home.script.js']

        }
      },
		},

		// Task cssmin
		cssmin: { //调用cssmin任务会执行下面两个属性各自的任务，最好合并归合并，压缩归压缩，相当于两个功能
			
			compress: {    //下文中 css:compress 任务被 grunt css.min 注册

        options: {
          banner: '/*<%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %>*/'
        },
				files: {
				  _cssmin : _cssfiles,//压缩到assets文件夹，文件可添加
				}
			}, 
			
			/*
			smeite: {
				files: {
					'assets/smeite.all.css': ['/play21/smeite.com/public/assets/css/**.css']
				}
			},*/
			merge: {

				options: {
					banner: '/*<%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %>*/'
				},
				files: {  //合并css
					'public/css/home/assets/css/style.min.css': _cssfiles/*,'src/css/index.css'*/
				}
			}


		},

		 // Task imagemin
		 imagemin: {  //图片压缩
			dist: { // Target
				options: { // Target options
					optimizationLevel: 3
				},
				files: { // Dictionary of files
					'assets/img/icon.png': 'src/img/icon.png', // 'destination': 'source'
					// 'assets/img/pic1.jpg': 'src/img/pic1.jpg'
				}
			}
		},

		/* S [Task liverload] --------------------------------------------------------------------------*/
		   
		    cfg: cfg,

		    //======== 开发相关 ========
		   //开启服务
		    connect: {
		      options: {
		        port: cfg.serverPort,
		        hostname: cfg.serverHost,
		        middleware: function(connect, options) {
		          return [
		            require('connect-livereload')({
		              port: cfg.livereload
		            }),
		            // Serve static files.
		            connect.static(options.base),
		            // Make empty directories browsable.
		            // connect.directory(options.base),
		          ];
		        }
		      },
		      server: {
		        options: {
		          // keepalive: true,
		          base: cfg.src,	//需要是index.html对应的目录
		        }
		      }
		    },

		    //打开浏览器
		    open: {
		      server: {
		        url: 'http://localhost:' + cfg.serverPort
		      }
		    },

		    //监控文件变化
		    watch: {
		      options: {
		        livereload: cfg.livereload,
		      },
		      server: {
		        files: [cfg.root + '/**'],
		        // tasks: [''],
		      },
		    }

	});

	// Load the plugin HTML/CSS/JS/IMG min
	// grunt.loadNpmTasks('grunt-contrib-htmlmin');
	// grunt.loadNpmTasks('grunt-contrib-uglify');
	// grunt.loadNpmTasks('grunt-contrib-cssmin');
	// grunt.loadNpmTasks('grunt-contrib-imagemin');

/*--- zhan ----*/
	// Build task(s).
	grunt.registerTask('default', ['htmlmin', 'uglify', 'cssmin']);
	grunt.registerTask('build', ['htmlmin', 'uglify', 'cssmin', 'imagemin']);
	grunt.registerTask('css.min', ['cssmin:compress']);  //将css文件压缩到xxx.min.css
	grunt.registerTask('css', ['cssmin:merge']);  //将css文件合并
	grunt.registerTask('js.min', ['uglify:compress']);  //将css文件压缩到xxx.min.css
	grunt.registerTask('js', ['uglify:merge']);  //将css文件合并
	/* [liverload plugin & task ] ---------------*/
	grunt.registerTask('live', ['connect:server', 'open:server', 'watch:server']);
/*--- zhan ---*/
};