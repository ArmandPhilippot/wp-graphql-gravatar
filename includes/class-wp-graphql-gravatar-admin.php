<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   1.1.0
 */

namespace WP_GraphQL_Gravatar;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since 1.1.0
 */
class WP_GraphQL_Gravatar_Admin {
	/**
	 * The plugin name.
	 *
	 * @since 1.1.0
	 * @var string $plugin_name The plugin name.
	 */
	protected $plugin_name;

	/**
	 * The description of this plugin.
	 *
	 * @since  1.1.0
	 *
	 * @access protected
	 * @var    string The string used as description of this plugin.
	 */
	protected $plugin_description;

	/**
	 * The plugin version.
	 *
	 * @since 1.1.0
	 * @var string $plugin_version The current plugin version.
	 */
	protected $plugin_version;

	/**
	 * The option name to be used in this plugin
	 *
	 * @since 1.1.0
	 *
	 * @var string Option name of this plugin
	 */
	private $option_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.1.0
	 *
	 * @param string $plugin_name The plugin name.
	 * @param string $plugin_description The plugin description.
	 * @param string $plugin_version The version of this plugin.
	 */
	public function __construct( $plugin_name, $plugin_description, $plugin_version ) {
		$this->plugin_name        = $plugin_name;
		$this->plugin_description = $plugin_description;
		$this->plugin_version     = $plugin_version;
		$this->option_name        = 'wp_graphql_gravatar';
	}

	/**
	 * Init settings sections and fields.
	 *
	 * @since 1.1.0
	 */
	public function init_settings_sections_fields() {
		register_setting( $this->option_name, $this->option_name . '_size' );
		register_setting( $this->option_name, $this->option_name . '_rating' );
		register_setting( $this->option_name, $this->option_name . '_default' );

		add_settings_section(
			$this->option_name . '_options',
			__( 'Gravatar options', 'wpg-gravatar' ),
			array( $this, 'print_options_section' ),
			$this->option_name
		);

		add_settings_field(
			$this->option_name . '_size',
			__( 'Avatar size', 'wpg-gravatar' ),
			array( $this, 'print_size_field' ),
			$this->option_name,
			$this->option_name . '_options',
			array(
				'class'       => 'small-text',
				'default'     => '80',
				'id'          => $this->option_name . '_size',
				'label_for'   => $this->option_name . '_size',
				'min'         => '1',
				'max'         => '2048',
				'name'        => $this->option_name . '_size',
				'step'        => '1',
				'type'        => 'number',
			)
		);

		add_settings_field(
			$this->option_name . '_rating',
			__( 'Avatar rating', 'wpg-gravatar' ),
			array( $this, 'print_rating_field' ),
			$this->option_name,
			$this->option_name . '_options',
			array(
				'class'       => '',
				'default'     => 'g',
				'id'          => $this->option_name . '_rating',
				'label_for'   => $this->option_name . '_rating',
				'name'        => $this->option_name . '_rating',
				'options'     => array( 'g', 'pg', 'r', 'x' ),
			)
		);

		add_settings_field(
			$this->option_name . '_default',
			__( 'Default avatar', 'wpg-gravatar' ),
			array( $this, 'print_default_field' ),
			$this->option_name,
			$this->option_name . '_options',
			array(
				'class'       => '',
				'default'     => 'mp',
				'id'          => $this->option_name . '_default',
				'label_for'   => $this->option_name . '_default',
				'name'        => $this->option_name . '_default',
				'options'     => array( '404', 'mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'blank' ),
			)
		);
	}

	/**
	 * Add a new submenu under Settings menu.
	 *
	 * @since 1.1.0
	 */
	public function add_settings_menu() {
		$page_title = __( 'WP GraphQL Gravatar Settings', 'wpg-gravatar' );
		$menu_title = __( 'WP GraphQL Gravatar', 'wpg-gravatar' );
		$capability = 'manage_options';
		$menu_slug  = 'wp-graphql-gravatar-settings';
		$function   = array( $this, 'add_settings_menu_cb' );

		add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function );
	}

	/**
	 * Define the settings page content.
	 *
	 * @since 1.1.0
	 */
	public function add_settings_menu_cb() {
		include_once 'partials/admin/wp-graphql-gravatar-display.php';
	}

	/**
	 * Render the text for the options section.
	 *
	 * @since 1.1.0
	 */
	public function print_options_section() {
		printf(
			// translators: The gravatar url.
			esc_html__( 'You can find more information about the different options on Gravatar website: %s', 'wpg-gravatar' ),
			'<a href="https://gravatar.com/site/implement/images/">https://gravatar.com/site/implement/images/</a>'
		);
	}

	/**
	 * Render the input field for the size field.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args Arguments used when outputting the field.
	 */
	public function print_size_field( $args ) {
		$current_option = get_option( $args['name'] );
		$args['value']  = empty( $current_option ) ? $args['default'] : $current_option;

		include plugin_dir_path( __FILE__ ) . 'partials/admin/wp-graphql-gravatar-input.php';
	}

	/**
	 * Render the select field for the rating field.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args Arguments used when outputting the field.
	 */
	public function print_rating_field( $args ) {
		$current_option = get_option( $args['name'] );
		$args['value']  = empty( $current_option ) ? $args['default'] : $current_option;

		include plugin_dir_path( __FILE__ ) . 'partials/admin/wp-graphql-gravatar-select.php';
	}

	/**
	 * Render the select field for the default field.
	 *
	 * @since 1.1.0
	 *
	 * @param array $args Arguments used when outputting the field.
	 */
	public function print_default_field( $args ) {
		$current_option = get_option( $args['name'] );
		$args['value']  = empty( $current_option ) ? $args['default'] : $current_option;

		include plugin_dir_path( __FILE__ ) . 'partials/admin/wp-graphql-gravatar-select.php';
	}
}
