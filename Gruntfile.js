module.exports = function( grunt ) {

	// Project configuration
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		makepot: {
			target: {
				options: {
					type:        'wp-plugin',
					mainFile:    'wp-rest-api-log.php'
				}
			}
		},

		clean: {
			main: [ 'release/' ]
		},


		copy:   {
			// create release for WordPress repository
			wp: {
				files: [

					// root dir files
					{
						expand: true,
						src: [
							'*.php',
							'readme.txt',
							],
						dest: 'release/'
					}

				]
			} // wp
		},


		phplint: {
			options: {
				limit: 10,
				stdout: true,
				stderr: true
			},
			files: [
				'*.php'
			]
		},

		phpunit: {
			'default': {
				cmd: 'phpunit',
				args: ['-c', 'phpunit.xml.dist']
			},
		},

	} );

	// Load tasks
	require('load-grunt-tasks')(grunt);
	require('phplint').gruntPlugin(grunt);

	// Register tasks
	grunt.registerTask( 'default', [  ] );

	grunt.registerTask( 'build', [ 'default', 'clean', 'copy' ] );

	grunt.registerTask( 'test', [ 'phplint', 'phpunit' ] );

	grunt.util.linefeed = '\n';
};
