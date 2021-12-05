<?php
/**
 * Define the core plugin class.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   0.1.0
 */

namespace WP_GraphQL_Gravatar;

/**
 * The core plugin class.
 *
 * This class defines defines internationalization, admin hooks, and public
 * hooks.
 */
class WP_GraphQL_Gravatar {
	/**
	 * The plugin name.
	 *
	 * @since 0.1.0
	 * @var string $plugin_name The plugin name.
	 */
	protected $plugin_name;

	/**
	 * The description of this plugin.
	 *
	 * @since  0.1.0
	 *
	 * @access protected
	 * @var    string The string used as description of this plugin.
	 */
	protected $plugin_description;

	/**
	 * The plugin version.
	 *
	 * @since 0.1.0
	 * @var string $plugin_version The current plugin version.
	 */
	protected $plugin_version;

	/**
	 * Define the plugin functionality.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->plugin_version     = defined( WP_GRAPHQL_GRAVATAR_VERSION ) ? WP_GRAPHQL_GRAVATAR_VERSION : '1.0.0';
		$this->plugin_name        = 'WP GraphQL Gravatar';
		$this->plugin_description = __( 'This plugin adds a WP GraphQL field containing the Gravatar url of the comment author.', 'wpg-gravatar' );

		$this->load_dependencies();
		$this->set_locale();
	}

	/**
	 * Check if WPGraphQL is installed and activated.
	 *
	 * @since 0.1.0
	 */
	public function check_plugin_dependencies() {
		if ( ! class_exists( '\WPGraphQL' ) ) {
			add_action(
				'admin_notices',
				function() {
					?>
					<div class="error notice">
						<p>
							<?php
								esc_html__(
									'You must install and activate WPGraphQL before running WP GraphQL Gravatar.',
									'wpg-gravatar'
								);
							?>
						</p>
					</div>
					<?php
				}
			);
		}
	}

	/**
	 * Loads the required dependencies for this plugin.
	 *
	 * @since  0.1.0
	 *
	 * @access private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for defining internationalization
		 * functionality of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-graphql-gravatar-i18n.php';
	}

	/**
	 * Define the locale used by the plugin.
	 *
	 * @since 0.1.0
	 */
	private function set_locale() {
		$translation = new WP_GraphQL_Gravatar_I18n();
		$translation->init();
	}

	/**
	 * Register a new gravatarUrl field for Commenter Type.
	 *
	 * @since 0.1.0
	 */
	public function add_gravatar_url_field() {
		$type        = 'String';
		$description = __( 'The author gravatar url.', 'wpg-gravatar' );

		register_graphql_field(
			'Commenter',
			'gravatarUrl',
			array(
				'type'        => $type,
				'description' => $description,
				'resolve'     => function( $comment_author ) {
					// phpcs:ignore WordPress.NamingConventions.ValidVariableName
					$author_email = get_comment_author_email( $comment_author->databaseId );
					$args    = array(
						'size'    => '60',
						'default' => 'mystery',
						'rating'  => 'g',
					);
					$gravatar_url = get_avatar_url( $author_email, $args );

					return $gravatar_url;
				},
			)
		);
	}

	/**
	 * Execute the plugin.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		$this->set_locale();
		add_action( 'plugins_loaded', array( $this, 'check_plugin_dependencies' ) );
		add_action( 'graphql_register_types', array( $this, 'add_gravatar_url_field' ) );
	}

	/**
	 * Retrieve the plugin name.
	 *
	 * @since 0.1.0
	 *
	 * @return string The plugin name.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieves the description of the plugin.
	 *
	 * @since 0.1.0
	 *
	 * @return string The description of the plugin.
	 */
	public function get_plugin_description() {
		return $this->plugin_description;
	}

	/**
	 * Retrieve the current plugin version.
	 *
	 * @since 0.1.0
	 *
	 * @return string The current version of the plugin.
	 */
	public function get_plugin_version() {
		return $this->plugin_version;
	}
}
