<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_has_sidebar() ) {
	return;
}
?>

<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Sidebar', 'sindoor-valour' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
