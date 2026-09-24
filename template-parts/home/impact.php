<?php
/**
 * Front page: impact figures.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_get_option( 'impact_enabled' ) ) {
	return;
}

$sindoor_valour_tiles = array();

for ( $sindoor_valour_index = 1; $sindoor_valour_index <= 4; $sindoor_valour_index++ ) {
	$sindoor_valour_value = sindoor_valour_get_option( 'impact_' . $sindoor_valour_index . '_value' );

	if ( '' === $sindoor_valour_value || null === $sindoor_valour_value ) {
		continue;
	}

	$sindoor_valour_tiles[] = array(
		'value' => $sindoor_valour_value,
		'label' => sindoor_valour_get_option( 'impact_' . $sindoor_valour_index . '_label' ),
	);
}

if ( empty( $sindoor_valour_tiles ) ) {
	return;
}
?>
<section class="sv-section">
	<div class="sv-container">
		<div class="sv-impact">
			<?php foreach ( $sindoor_valour_tiles as $sindoor_valour_tile ) : ?>
				<div class="sv-impact__item">
					<span class="sv-impact__value"><?php echo esc_html( $sindoor_valour_tile['value'] ); ?></span>
					<span class="sv-impact__label"><?php echo esc_html( $sindoor_valour_tile['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
