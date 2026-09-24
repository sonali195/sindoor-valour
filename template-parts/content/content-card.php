<?php
/**
 * Template part for displaying a post as a card in a grid.
 *
 * Used by the programme and event archives and by the front-page sections.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'sv-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="sv-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'sindoor-valour-card', array( 'loading' => 'lazy' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="sv-card__body">
		<?php
		$sindoor_valour_terms = get_the_terms( get_the_ID(), 'sv-programme-area' );

		if ( $sindoor_valour_terms && ! is_wp_error( $sindoor_valour_terms ) ) :
			?>
			<p class="sv-card__meta"><?php echo esc_html( $sindoor_valour_terms[0]->name ); ?></p>
		<?php endif; ?>

		<?php the_title( '<h2 class="sv-card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="sv-card__excerpt">
			<?php the_excerpt(); ?>
		</div>

		<p class="sv-card__action"><?php sindoor_valour_read_more_link(); ?></p>
	</div>
</article>
