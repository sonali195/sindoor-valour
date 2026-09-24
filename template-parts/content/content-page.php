<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php sindoor_valour_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sindoor-valour' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Post title. */
					esc_html__( 'Edit %s', 'sindoor-valour' ),
					'<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span>'
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article>
