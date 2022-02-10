module.exports = function(grunt) {

	grunt.initConfig({
		concat: {
			options: {
				stripBanners: true,
				separator: ';\n'
			},
			"libraries": {
				src: [
					'node_modules/vue/dist/vue.js',
					'node_modules/axios/dist/axios.js'
				],
				dest: 'httpdocs/js/libraries.js'
			},
			"design": {
				src: [
					'node_modules/bootstrap/dist/js/bootstrap.js'
				],
				dest: 'httpdocs/js/design.js'
			},
			"pfa": {
				src: [
					'srcjs/test.js',
					//'srcjs/Core/rwHttp.js',
					'srcjs/Analyze/Import.js',
				],
				dest: 'httpdocs/js/pfa.js'
			},
			"css": {
				src: [
					'node_modules/bootstrap/dist/css/bootstrap.css'
				],
				dest: 'httpdocs/css/design.css'
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-concat');

	grunt.registerTask('default', ['concat']);
}
