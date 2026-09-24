<?php
/**
 * Front page: hero banner.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! sindoor_valour_get_option( 'hero_enabled' ) ) {
	return;
}

$sindoor_valour_eyebrow      = sindoor_valour_get_option( 'hero_eyebrow' );
$sindoor_valour_title        = sindoor_valour_get_option( 'hero_title' );
$sindoor_valour_text         = sindoor_valour_get_option( 'hero_text' );
$sindoor_valour_primary_text = sindoor_valour_get_option( 'hero_primary_text' );
$sindoor_valour_primary_url  = sindoor_valour_get_option( 'hero_primary_url' );

if ( ! $sindoor_valour_primary_url ) {
	$sindoor_valour_primary_url = sindoor_valour_donate_url();
}
$sindoor_valour_secondary_text = sindoor_valour_get_option( 'hero_secondary_text' );
$sindoor_valour_secondary_url  = sindoor_valour_programmes_url();
$sindoor_valour_hero_image     = get_header_image();
?>
<section class="sv-hero"<?php echo $sindoor_valour_hero_image ? ' style="background-image: url(' . esc_url( $sindoor_valour_hero_image ) . ');"' : ''; ?>>
	<div class="sv-container">
		<div class="sv-hero__inner">
			<?php if ( $sindoor_valour_eyebrow ) : ?>
				<span class="sv-hero__eyebrow"><?php echo esc_html( $sindoor_valour_eyebrow ); ?></span>
			<?php endif; ?>

			<?php if ( $sindoor_valour_title ) : ?>
				<h1 class="sv-hero__title"><?php echo esc_html( $sindoor_valour_title ); ?></h1>
			<?php endif; ?>

			<?php if ( $sindoor_valour_text ) : ?>
				<p class="sv-hero__text"><?php echo esc_html( $sindoor_valour_text ); ?></p>
			<?php endif; ?>

			<?php if ( ( $sindoor_valour_primary_text && $sindoor_valour_primary_url ) || ( $sindoor_valour_secondary_text && $sindoor_valour_secondary_url ) ) : ?>
				<div class="sv-hero__actions">
					<?php if ( $sindoor_valour_primary_text && $sindoor_valour_primary_url ) : ?>
						<a class="sv-button" href="<?php echo esc_url( $sindoor_valour_primary_url ); ?>">
							<?php echo esc_html( $sindoor_valour_primary_text ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $sindoor_valour_secondary_text && $sindoor_valour_secondary_url ) : ?>
						<a class="sv-button sv-button--ghost" href="<?php echo esc_url( $sindoor_valour_secondary_url ); ?>">
							<?php echo esc_html( $sindoor_valour_secondary_text ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
