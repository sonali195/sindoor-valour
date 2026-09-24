<?php
/**
 * Template part for displaying a post in a list.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php sindoor_valour_post_thumbnail( 'sindoor-valour-card' ); ?>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				sindoor_valour_posted_on();
				sindoor_valour_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<?php sindoor_valour_read_more_link(); ?>
	</div>

	<footer class="entry-footer">
		<?php sindoor_valour_entry_footer(); ?>
	</footer>
</article>
