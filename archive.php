<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="sv-page-header">
	<div class="sv-container">
		<?php
		sindoor_valour_archive_breadcrumb();
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</div>
</div>

<div class="sv-container">
	<div class="sv-content-area">
		<main id="primary" class="site-main">
			<?php if ( have_posts() ) : ?>

				<?php if ( is_post_type_archive( array( 'sv-programme', 'sv-event' ) ) ) : ?>

					<div class="sv-grid">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content/content', 'card' );
						endwhile;
						?>
					</div>

				<?php else : ?>

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content/content', get_post_type() );
					endwhile;
					?>

				<?php endif; ?>

				<?php
				the_posts_pagination(
					array(
						'mid_size'           => 2,
						'prev_text'          => esc_html__( 'Previous', 'sindoor-valour' ),
						'next_text'          => esc_html__( 'Next', 'sindoor-valour' ),
						'screen_reader_text' => esc_html__( 'Posts navigation', 'sindoor-valour' ),
					)
				);
				?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

			<?php endif; ?>
		</main>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
