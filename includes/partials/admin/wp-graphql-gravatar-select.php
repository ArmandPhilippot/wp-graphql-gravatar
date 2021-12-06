<?php
/**
 * Provides the markup for any select field
 *
 * This file is used to markup any select field used in admin settings page.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   1.1.0
 */

$wp_graphql_gravatar_options = array_key_exists( 'options', $args ) ? $args['options'] : array();
?>
<label for="<?php echo esc_attr( $args['label_for'] ); ?>">
	<select name="<?php echo esc_attr( $args['name'] ); ?>" id="<?php echo esc_attr( $args['id'] ); ?>">
		<?php
		foreach ( $wp_graphql_gravatar_options as $wp_graphql_gravatar_option => $wp_graphql_gravatar_value ) {
			?>
			<option
				name="<?php echo esc_attr( $wp_graphql_gravatar_value ); ?>"
				value="<?php echo esc_attr( $wp_graphql_gravatar_value ); ?>"
				<?php selected( $wp_graphql_gravatar_value, $args['value'] ); ?>
			>
				<?php echo esc_html( $wp_graphql_gravatar_value ); ?>
			</option>
			<?php
		}
		?>
	</select>
</label>
