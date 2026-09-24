<?php
/**
 * Front page: latest posts.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_get_option( 'news_enabled' ) ) {
	return;
}

$sindoor_valour_news = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => (int) sindoor_valour_get_option( 'news_count' ),
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( ! $sindoor_valour_news->have_posts() ) {
	wp_reset_postdata();
	return;
}

$sindoor_valour_title = sindoor_valour_get_option( 'news_title' );
?>
<section class="sv-section sv-section--alt">
	<div class="sv-container">
		<div class="sv-section__head">
			<span class="sv-section__eyebrow"><?php esc_html_e( 'Newsroom', 'sindoor-valour' ); ?></span>
			<?php if ( $sindoor_valour_title ) : ?>
				<h2 class="sv-section__title"><?php echo esc_html( $sindoor_valour_title ); ?></h2>
			<?php endif; ?>
		</div>

		<div class="sv-grid">
			<?php
			while ( $sindoor_valour_news->have_posts() ) :
				$sindoor_valour_news->the_post();

				get_template_part( 'template-parts/content/content', 'card' );
			endwhile;
			?>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
