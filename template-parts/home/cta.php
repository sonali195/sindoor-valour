<?php
/**
 * Front page: donation call to action.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_get_option( 'cta_enabled' ) ) {
	return;
}

$sindoor_valour_title       = sindoor_valour_get_option( 'cta_title' );
$sindoor_valour_text        = sindoor_valour_get_option( 'cta_text' );
$sindoor_valour_button_text = sindoor_valour_get_option( 'cta_button_text' );
$sindoor_valour_button_url  = sindoor_valour_donate_url();

if ( ! $sindoor_valour_title && ! $sindoor_valour_text ) {
	return;
}
?>
<section class="sv-cta">
	<div class="sv-container sv-cta__inner">
		<div class="sv-cta__copy">
			<?php if ( $sindoor_valour_title ) : ?>
				<h2 class="sv-cta__title"><?php echo esc_html( $sindoor_valour_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $sindoor_valour_text ) : ?>
				<p class="sv-cta__text"><?php echo esc_html( $sindoor_valour_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $sindoor_valour_button_text && $sindoor_valour_button_url ) : ?>
			<a class="sv-button" href="<?php echo esc_url( $sindoor_valour_button_url ); ?>">
				<?php echo esc_html( $sindoor_valour_button_text ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>
