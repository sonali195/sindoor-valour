<?php
/**
 * Template part shown when no posts are found.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="no-results not-found entry">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Nothing found', 'sindoor-valour' ); ?></h2>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php
				printf(
					/* translators: %s: Link to the new-post screen. */
					wp_kses_post( __( 'Ready to publish the first update? <a href="%s">Write one now</a>.', 'sindoor-valour' ) ),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Nothing matched those words. Try again with a different term.', 'sindoor-valour' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'There is nothing here yet. A search may help.', 'sindoor-valour' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
