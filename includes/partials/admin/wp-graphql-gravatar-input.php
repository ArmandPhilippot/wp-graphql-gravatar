<?php
/**
 * Provides the markup for any input field
 *
 * This file is used to markup any input field used in admin settings page.
 *
 * @package WP_GraphQL_Gravatar
 * @link    https://github.com/ArmandPhilippot/wp-graphql-gravatar
 * @since   1.1.0
 */

$wp_graphql_gravatar_min  = array_key_exists( 'min', $args ) ? $args['min'] : null;
$wp_graphql_gravatar_max  = array_key_exists( 'max', $args ) ? $args['max'] : null;
$wp_graphql_gravatar_step = array_key_exists( 'step', $args ) ? $args['step'] : null;

?>
<label for="<?php echo esc_attr( $args['label_for'] ); ?>">
	<input
		class="<?php echo esc_attr( $args['class'] ); ?>"
		id="<?php echo esc_attr( $args['id'] ); ?>"
		name="<?php echo esc_attr( $args['name'] ); ?>"
		type="<?php echo esc_attr( $args['type'] ); ?>"
		value="<?php echo esc_attr( $args['value'] ); ?>"
		<?php
		if ( $wp_graphql_gravatar_min ) {
			echo 'min="' . esc_attr( $wp_graphql_gravatar_min ) . '"';
		}
		if ( $wp_graphql_gravatar_max ) {
			echo 'max="' . esc_attr( $wp_graphql_gravatar_max ) . '"';
		}
		if ( $wp_graphql_gravatar_step ) {
			echo 'step="' . esc_attr( $wp_graphql_gravatar_step ) . '"';
		}
		?>
	/>
</label>
