<?php
/**
 * Front page: welfare programmes.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_get_option( 'programmes_enabled' ) || ! post_type_exists( 'sv-programme' ) ) {
	return;
}

$sindoor_valour_programmes = new WP_Query(
	array(
		'post_type'              => 'sv-programme',
		'posts_per_page'         => (int) sindoor_valour_get_option( 'programmes_count' ),
		'post_status'            => 'publish',
		'orderby'                => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_term_cache' => true,
	)
);

if ( ! $sindoor_valour_programmes->have_posts() ) {
	wp_reset_postdata();
	return;
}

$sindoor_valour_title = sindoor_valour_get_option( 'programmes_title' );
$sindoor_valour_text  = sindoor_valour_get_option( 'programmes_text' );
?>
<section class="sv-section sv-section--alt">
	<div class="sv-container">
		<div class="sv-section__head">
			<span class="sv-section__eyebrow"><?php esc_html_e( 'Programmes', 'sindoor-valour' ); ?></span>
			<?php if ( $sindoor_valour_title ) : ?>
				<h2 class="sv-section__title"><?php echo esc_html( $sindoor_valour_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $sindoor_valour_text ) : ?>
				<p class="sv-section__text"><?php echo esc_html( $sindoor_valour_text ); ?></p>
			<?php endif; ?>
		</div>

		<div class="sv-grid">
			<?php
			while ( $sindoor_valour_programmes->have_posts() ) :
				$sindoor_valour_programmes->the_post();

				get_template_part( 'template-parts/content/content', 'card' );
			endwhile;
			?>
		</div>

		<?php if ( get_post_type_archive_link( 'sv-programme' ) ) : ?>
			<p class="sv-section__more">
				<a class="sv-button sv-button--olive" href="<?php echo esc_url( get_post_type_archive_link( 'sv-programme' ) ); ?>">
					<?php esc_html_e( 'All programmes', 'sindoor-valour' ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</section>
<?php
wp_reset_postdata();
