<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: Search query. */
				esc_html__( 'Search results for: %s', 'sindoor-valour' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
		<?php
		$sindoor_valour_found = (int) $GLOBALS['wp_query']->found_posts;
		?>
		<p>
			<?php
			printf(
				/* translators: %s: Number of results found. */
				esc_html( _n( '%s result found.', '%s results found.', $sindoor_valour_found, 'sindoor-valour' ) ),
				esc_html( number_format_i18n( $sindoor_valour_found ) )
			);
			?>
		</p>
	</div>
</div>

<div class="sv-container">
	<div class="sv-content-area">
		<main id="primary" class="site-main">
			<?php if ( have_posts() ) : ?>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content/content', 'search' );
				endwhile;

				the_posts_pagination(
					array(
						'mid_size'           => 2,
						'prev_text'          => esc_html__( 'Previous', 'sindoor-valour' ),
						'next_text'          => esc_html__( 'Next', 'sindoor-valour' ),
						'screen_reader_text' => esc_html__( 'Search results navigation', 'sindoor-valour' ),
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
