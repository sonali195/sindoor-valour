<?php
/**
 * The front page template.
 *
 * Used when the site's front page is set to a static page. Each section is a
 * template part that removes itself when it has nothing to show or has been
 * switched off in the Customizer, so the page never renders an empty band.
 *
 * If the front page is set to show the latest posts, WordPress uses home.php
 * or index.php instead and this file is skipped entirely.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/home/hero' );
get_template_part( 'template-parts/home/impact' );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		if ( trim( (string) get_the_content() ) ) :
			?>
			<section class="sv-section">
				<div class="sv-container">
					<div class="entry-content sv-front-content">
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
				</div>
			</section>
			<?php
		endif;
	endwhile;
endif;

get_template_part( 'template-parts/home/programmes' );
get_template_part( 'template-parts/home/events' );
get_template_part( 'template-parts/home/cta' );
get_template_part( 'template-parts/home/news' );

get_footer();
