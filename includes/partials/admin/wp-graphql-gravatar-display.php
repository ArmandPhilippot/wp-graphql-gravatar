<?php
/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   1.1.0
 */

?>
<div class="wrap">
	<h1><?php esc_html_e( 'WP GraphQL Gravatar Settings', 'wpg-gravatar' ); ?></h1>
	<form name="wp_graphql_gravatar_options" method='post' action='options.php'>
		<?php
		do_settings_sections( $this->option_name );
		settings_fields( $this->option_name );
		submit_button();
		?>
	</form>
</div>
