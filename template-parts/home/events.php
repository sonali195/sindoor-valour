<?php
/**
 * Front page: upcoming events.
 *
 * Events are ordered by their own date field, so a camp entered last week but
 * scheduled for next month still appears in the right place.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_get_option( 'events_enabled' ) || ! post_type_exists( 'sv-event' ) ) {
	return;
}

$sindoor_valour_events = new WP_Query(
	array(
		'post_type'      => 'sv-event',
		'posts_per_page' => (int) sindoor_valour_get_option( 'events_count' ),
		'post_status'    => 'publish',
		'meta_key'       => '_sindoor_valour_event_date', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Ordering events by their own date is the point of the field.
		'orderby'        => array(
			'meta_value' => 'ASC', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- An event list is ordered by event date, not publish date.
			'date'       => 'DESC',
		),
		'no_found_rows'  => true,
	)
);

if ( ! $sindoor_valour_events->have_posts() ) {
	wp_reset_postdata();
	return;
}

$sindoor_valour_title = sindoor_valour_get_option( 'events_title' );
?>
<section class="sv-section">
	<div class="sv-container">
		<div class="sv-section__head">
			<span class="sv-section__eyebrow"><?php esc_html_e( 'Calendar', 'sindoor-valour' ); ?></span>
			<?php if ( $sindoor_valour_title ) : ?>
				<h2 class="sv-section__title"><?php echo esc_html( $sindoor_valour_title ); ?></h2>
			<?php endif; ?>
		</div>

		<div class="sv-events">
			<?php
			while ( $sindoor_valour_events->have_posts() ) :
				$sindoor_valour_events->the_post();

				$sindoor_valour_location = get_post_meta( get_the_ID(), '_sindoor_valour_event_location', true );
				$sindoor_valour_stamp    = sindoor_valour_get_event_timestamp( get_the_ID() );
				$sindoor_valour_is_past  = $sindoor_valour_stamp < time();
				?>
				<article <?php post_class( 'sv-event' . ( $sindoor_valour_is_past ? ' sv-event--past' : '' ) ); ?>>
					<?php sindoor_valour_event_date_badge( get_the_ID() ); ?>

					<div class="sv-event__body">
						<?php the_title( '<h3 class="sv-event__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>

						<p class="sv-event__meta">
							<?php
							echo esc_html( wp_date( get_option( 'date_format' ), $sindoor_valour_stamp ) );

							if ( $sindoor_valour_location ) {
								echo ' &middot; ' . esc_html( $sindoor_valour_location );
							}
							?>
						</p>

						<?php the_excerpt(); ?>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<?php if ( get_post_type_archive_link( 'sv-event' ) ) : ?>
			<p class="sv-section__more">
				<a class="sv-button sv-button--olive" href="<?php echo esc_url( get_post_type_archive_link( 'sv-event' ) ); ?>">
					<?php esc_html_e( 'All events', 'sindoor-valour' ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</section>
<?php
wp_reset_postdata();
