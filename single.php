<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			<div class="entry-meta">
				<?php
				sindoor_valour_posted_on();
				sindoor_valour_posted_by();
				?>
			</div>
		</div>
	</div>

	<div class="sv-container">
		<div class="sv-content-area">
			<main id="primary" class="site-main">
				<?php
				get_template_part( 'template-parts/content/content', 'single' );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'sindoor-valour' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'sindoor-valour' ) . '</span> <span class="nav-title">%title</span>',
					)
				);

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
