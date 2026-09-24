<?php
/**
 * Template Name: Donation Page
 * Template Post Type: page
 *
 * A full-width page that ends with the donation call to action set in the
 * Customizer. The page's own content carries the bank details, the 80G
 * position, or whichever payment block the trust uses — this template does not
 * collect payment itself and never asks a visitor for card details.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<div class="sv-page-header">
		<div class="sv-container">
			<?php sindoor_valour_archive_breadcrumb(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="sv-container">
		<main id="primary" class="site-main">
			<?php get_template_part( 'template-parts/content/content', 'page' ); ?>
		</main>
	</div>

	<?php
endwhile;

get_template_part( 'template-parts/home/cta' );

get_footer();
