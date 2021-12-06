<?php
/**
 * Provide a success notice view after plugin activation.
 *
 * This file is used to markup the success notice after activation.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   1.1.0
 */

?>
<div class="notice notice-success is-dismissible">
	<p><?php esc_html_e( 'WP GraphQL Gravatar is now activated! You can configure it under Settings menu.', 'wpg-gravatar' ); ?></p>
</div>
