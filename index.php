<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two files required by every theme. It is used to display a page when nothing
 * more specific matches the query.
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
		<?php sindoor_valour_archive_breadcrumb(); ?>
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php esc_html_e( 'Latest updates', 'sindoor-valour' ); ?></h1>
		<?php endif; ?>
	</div>
</div>

<div class="sv-container">
	<div class="sv-content-area">
		<main id="primary" class="site-main">
			<?php if ( have_posts() ) : ?>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content/content', get_post_type() );
				endwhile;

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
