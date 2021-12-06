<?php
/**
 * WPGraphQL Gravatar
 *
 * Plugin definition.
 *
 * @package   WP_GraphQL_Gravatar
 * @link      https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @author    Armand Philippot <contact@armandphilippot.com>
 *
 * @copyright 2021 Armand Philippot
 * @license   GPL-2.0-or-later
 * @since     0.1.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP GraphQL Gravatar
 * Plugin URI:        https://github.com/ArmandPhilippot/wp-graphql-gravatar#readme
 * Description:       This plugin adds a WP GraphQL field containing the Gravatar url of the comment author.
 * Author:            Armand Philippot
 * Author URI:        https://www.armandphilippot.com
 * Text Domain:       wpg-gravatar
 * Domain Path:       /languages
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.3
 */

namespace WP_GraphQL_Gravatar;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Currently plugin version.
 */
define( 'WP_GRAPHQL_GRAVATAR_VERSION', '1.1.0' );

/**
 * Initialize the plugin.
 *
 * @since 0.1.0
 */
function wp_graphql_gravatar_init() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-graphql-gravatar.php';
	$plugin = new WP_GRAPHQL_GRAVATAR();
	$plugin->run();
}
wp_graphql_gravatar_init();
