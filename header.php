<?php
/**
 * The header for our theme.
 *
 * Contains everything up to the opening #content div.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sindoor-valour' ); ?></a>

	<header id="masthead" class="site-header">
		<?php
		$sindoor_valour_phone = sindoor_valour_get_option( 'topbar_phone' );
		$sindoor_valour_email = sindoor_valour_get_option( 'topbar_email' );
		$sindoor_valour_note  = sindoor_valour_get_option( 'topbar_note' );

		if ( $sindoor_valour_phone || $sindoor_valour_email || $sindoor_valour_note || has_nav_menu( 'social' ) ) :
			?>
			<div class="sv-topbar">
				<div class="sv-container sv-topbar__inner">
					<?php if ( $sindoor_valour_phone || $sindoor_valour_email || $sindoor_valour_note ) : ?>
						<ul class="sv-topbar__contact">
							<?php if ( $sindoor_valour_phone ) : ?>
								<li>
									<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $sindoor_valour_phone ) ); ?>">
										<?php
										printf(
											/* translators: %s: Helpline phone number. */
											esc_html__( 'Helpline: %s', 'sindoor-valour' ),
											esc_html( $sindoor_valour_phone )
										);
										?>
									</a>
								</li>
							<?php endif; ?>

							<?php if ( $sindoor_valour_email ) : ?>
								<li>
									<a href="<?php echo esc_url( 'mailto:' . $sindoor_valour_email ); ?>"><?php echo esc_html( $sindoor_valour_email ); ?></a>
								</li>
							<?php endif; ?>

							<?php if ( $sindoor_valour_note ) : ?>
								<li><?php echo esc_html( $sindoor_valour_note ); ?></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>

					<?php
					if ( has_nav_menu( 'social' ) ) {
						wp_nav_menu(
							array(
								'theme_location'       => 'social',
								'menu_class'           => 'sv-social-menu',
								'container'            => 'nav',
								'container_class'      => 'sv-social-navigation',
								'container_aria_label' => esc_attr__( 'Social links menu', 'sindoor-valour' ),
								'depth'                => 1,
								'fallback_cb'          => false,
							)
						);
					}
					?>
				</div>
			</div>
		<?php endif; ?>

		<div class="sv-container site-header__inner">
			<div class="site-branding">
				<?php the_custom_logo(); ?>

				<div class="site-branding__text">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php
					$sindoor_valour_description = get_bloginfo( 'description', 'display' );

					if ( $sindoor_valour_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo esc_html( $sindoor_valour_description ); ?></p>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<button
					type="button"
					class="sv-menu-toggle"
					aria-controls="primary-menu"
					aria-expanded="false"
				>
					<span class="sv-menu-toggle__bars" aria-hidden="true"></span>
					<span><?php esc_html_e( 'Menu', 'sindoor-valour' ); ?></span>
				</button>

				<nav
					id="site-navigation"
					class="main-navigation"
					aria-label="<?php esc_attr_e( 'Primary menu', 'sindoor-valour' ); ?>"
				>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>

			<?php
			$sindoor_valour_cta_text = sindoor_valour_get_option( 'header_cta_text' );
			$sindoor_valour_cta_url  = sindoor_valour_get_option( 'header_cta_url' );

			if ( ! $sindoor_valour_cta_url ) {
				$sindoor_valour_cta_url = sindoor_valour_donate_url();
			}

			if ( $sindoor_valour_cta_text && $sindoor_valour_cta_url ) :
				?>
				<a class="sv-button sv-header-cta" href="<?php echo esc_url( $sindoor_valour_cta_url ); ?>"><?php echo esc_html( $sindoor_valour_cta_text ); ?></a>
			<?php endif; ?>
		</div>
	</header>

	<div id="content" class="site-content">
