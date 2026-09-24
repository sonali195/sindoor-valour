<?php
/**
 * The template for displaying a single event.
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

	$sindoor_valour_stamp    = sindoor_valour_get_event_timestamp( get_the_ID() );
	$sindoor_valour_location = get_post_meta( get_the_ID(), '_sindoor_valour_event_location', true );
	?>

	<div class="sv-page-header">
		<div class="sv-container">
			<?php sindoor_valour_archive_breadcrumb(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p>
				<?php
				echo esc_html( wp_date( get_option( 'date_format' ), $sindoor_valour_stamp ) );

				if ( $sindoor_valour_location ) {
					echo ' &middot; ' . esc_html( $sindoor_valour_location );
				}
				?>
			</p>
		</div>
	</div>

	<div class="sv-container">
		<main id="primary" class="site-main">
			<?php
			get_template_part( 'template-parts/content/content', 'single' );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous event:', 'sindoor-valour' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next event:', 'sindoor-valour' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
			?>
		</main>
	</div>

	<?php
endwhile;

get_template_part( 'template-parts/home/cta' );

get_footer();
