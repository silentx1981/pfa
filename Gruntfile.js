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
			"pfa": {
				src: [
					'srcjs/test.js'
				],
				dest: 'httpdocs/js/pfa.js'
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-concat');

	grunt.registerTask('default', ['concat']);
}
