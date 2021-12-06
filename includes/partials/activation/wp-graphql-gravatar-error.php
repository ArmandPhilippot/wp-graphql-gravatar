<?php
/**
 * Provide an error notice view during plugin activation.
 *
 * This file is used to markup the error notice during activation.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   1.1.0
 */

?>
<div class="notice notice-error">
	<p><?php esc_html_e( 'WPGraphQL plugin need to be installed and activated in order for WP GraphQL Gravatar to work.', 'wpg-gravatar' ); ?></p>
</div>
