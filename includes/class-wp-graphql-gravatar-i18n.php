<?php
/**
 * Fired during plugin activation.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   0.1.0
 */

namespace WP_GraphQL_Gravatar;

/**
 * The responsible class of plugin internationalization.
 *
 * This class defines and load all the files needed for translation.
 *
 * @since 0.1.0
 */
class WP_GraphQL_Gravatar_I18n {
	/**
	 * Load textdomain once plugin is loaded.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Load the plugin text domain.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'wpg-gravatar', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}
}
