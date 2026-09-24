<?php
/**
 * The template for displaying the search form.
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

$sindoor_valour_search_id = wp_unique_id( 'sv-search-field-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form__field">
		<label for="<?php echo esc_attr( $sindoor_valour_search_id ); ?>">
			<?php echo esc_html_x( 'Search', 'label', 'sindoor-valour' ); ?>
		</label>
		<input
			type="search"
			id="<?php echo esc_attr( $sindoor_valour_search_id ); ?>"
			class="search-field"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
			placeholder="<?php echo esc_attr_x( 'Search this site&hellip;', 'placeholder', 'sindoor-valour' ); ?>"
		>
	</div>
	<button type="submit" class="search-submit">
		<?php echo esc_html_x( 'Search', 'submit button', 'sindoor-valour' ); ?>
	</button>
</form>
