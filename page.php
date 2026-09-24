<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
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
		</div>
	</div>

	<div class="sv-container">
		<div class="sv-content-area">
			<main id="primary" class="site-main">
				<?php
				get_template_part( 'template-parts/content/content', 'page' );

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</main>

			<?php get_sidebar(); ?>
		</div>
	</div>

	<?php
endwhile;

get_footer();
