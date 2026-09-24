<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="entry-meta">
			<span class="sv-result-type">
				<?php
				$sindoor_valour_type = get_post_type_object( get_post_type() );

				if ( $sindoor_valour_type instanceof WP_Post_Type ) {
					echo esc_html( $sindoor_valour_type->labels->singular_name );
				}
				?>
			</span>
			<?php
			if ( 'post' === get_post_type() ) {
				sindoor_valour_posted_on();
			}
			?>
		</div>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<?php sindoor_valour_read_more_link(); ?>
	</div>
</article>
