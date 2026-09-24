<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and everything after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="sv-container">
				<div class="sv-footer-widgets">
					<?php
					for ( $sindoor_valour_column = 1; $sindoor_valour_column <= 3; $sindoor_valour_column++ ) {
						if ( is_active_sidebar( 'footer-' . $sindoor_valour_column ) ) {
							echo '<div class="sv-footer-widgets__column">';
							dynamic_sidebar( 'footer-' . $sindoor_valour_column );
							echo '</div>';
						}
					}
					?>
				</div>
			</div>
		<?php endif; ?>

		<div class="sv-container">
			<div class="sv-site-info">
				<p>
					<?php
					printf(
						/* translators: 1: Current year, 2: Site name. */
						esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'sindoor-valour' ),
						esc_html( wp_date( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) )
					);
					?>
				</p>

				<?php
				$sindoor_valour_credit = sindoor_valour_get_option( 'footer_credit' );

				if ( $sindoor_valour_credit ) :
					?>
					<p class="sv-site-info__credit"><?php echo esc_html( $sindoor_valour_credit ); ?></p>
				<?php endif; ?>

				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location'       => 'footer',
							'menu_class'           => 'sv-footer-menu',
							'container'            => 'nav',
							'container_class'      => 'sv-footer-navigation',
							'container_aria_label' => esc_attr__( 'Footer menu', 'sindoor-valour' ),
							'depth'                => 1,
							'fallback_cb'          => false,
						)
					);
				}
				?>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
