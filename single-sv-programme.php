<?php
/**
 * The template for displaying a single programme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
			<?php
			$sindoor_valour_areas = get_the_term_list( get_the_ID(), 'sv-programme-area', '', ', ' );

			if ( $sindoor_valour_areas && ! is_wp_error( $sindoor_valour_areas ) ) :
				?>
				<p><?php echo wp_kses_post( $sindoor_valour_areas ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="sv-container">
		<main id="primary" class="site-main">
			<?php
			get_template_part( 'template-parts/content/content', 'single' );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous programme:', 'sindoor-valour' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next programme:', 'sindoor-valour' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
			?>
		</main>
	</div>

	<?php
endwhile;

get_template_part( 'template-parts/home/cta' );

get_footer();
