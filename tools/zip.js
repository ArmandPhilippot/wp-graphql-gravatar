/**
 * zip.js
 *
 * Generate a zip archive of your plugin directory without development files.
 * Paths must be relative to the plugin root.
 */
const archiver = require( 'archiver' );
const fs = require( 'fs' );
const path = require( 'path' );

/**
 * Create a zip archive of the plugin excluding dev files.
 *
 * @return {Promise} The zip archive.
 */
const zipPlugin = () => {
	const pluginName = 'wp-graphql-excerpt';
	const dest = path.resolve( __dirname, '../' + pluginName + '.zip' );
	const output = fs.createWriteStream( dest );
	const archive = archiver( 'zip', {
		zlib: { level: 9 }, // Compression level.
	} );
	const ignore = [
		'node_modules/**',
		'src/**',
		'tools/**',
		'vendor/**',
		'*.log',
		'*.lock',
		'*.zip',
		'.git/**',
		'.husky/**',
		'.browserslistrc',
		'.commitlintrc.json',
		'.editorconfig',
		'.env',
		'.env.*',
		'.gitignore',
		'.prettierrc.js',
		'lint-staged.config.js',
		'package-lock.json',
		'phpcs.xml',
	];

	return new Promise( ( resolve, reject ) => {
		archive
			.glob( '**', {
				ignore,
			} )
			.on( 'error', ( err ) => reject( err ) )
			.pipe( output );
		output.on( 'close', () => resolve() );
		archive.finalize();
	} );
};

zipPlugin();
