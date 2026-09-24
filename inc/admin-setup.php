<?php
/**
 * Theme Setup screen and welcome notice.
 *
 * A read-only getting-started checklist under Appearance, and a one-time,
 * permanently dismissible notice pointing to it. Nothing here creates or
 * changes content: new sites get the theme's starter content from the
 * Customizer instead.
 *
 * @package Sindoor_Valour
 * @since   1.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Adds the setup screen under Appearance.
 *
 * @since 1.1.0
 *
 * @return void
 */
function sindoor_valour_add_setup_page() {
	add_theme_page(
		esc_html__( 'Sindoor Valour Setup', 'sindoor-valour' ),
		esc_html__( 'Theme Setup', 'sindoor-valour' ),
		'edit_theme_options',
		'sindoor-valour-setup',
		'sindoor_valour_render_setup_page'
	);
}
add_action( 'admin_menu', 'sindoor_valour_add_setup_page' );

/**
 * Renders the setup screen.
 *
 * @since 1.1.0
 *
 * @return void
 */
function sindoor_valour_render_setup_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to change theme settings.', 'sindoor-valour' ) );
	}
	?>
	<div class="wrap sindoor-valour-setup">
		<h1><?php esc_html_e( 'Sindoor Valour Setup', 'sindoor-valour' ); ?></h1>

		<p><?php esc_html_e( 'A short checklist for getting the front page looking the way it does in the screenshot.', 'sindoor-valour' ); ?></p>

		<?php if ( get_option( 'fresh_site' ) ) : ?>
			<div class="notice notice-info inline">
				<p>
					<?php
					printf(
						/* translators: %s: Link to the Customizer. */
						wp_kses_post( __( 'This site is still empty, so WordPress will offer the theme&#8217;s starter content as a live preview in <a href="%s">the Customizer</a>. Nothing is saved until you press Publish.', 'sindoor-valour' ) ),
						esc_url( admin_url( 'customize.php' ) )
					);
					?>
				</p>
			</div>
		<?php endif; ?>

		<h2><?php esc_html_e( 'Setting the site up', 'sindoor-valour' ); ?></h2>

		<ol>
			<li>
				<?php
				printf(
					/* translators: %s: Link to the Reading settings screen. */
					wp_kses_post( __( 'Under <a href="%s">Settings &rarr; Reading</a>, set the homepage to a static page. The sectioned front page only applies to a static front page.', 'sindoor-valour' ) ),
					esc_url( admin_url( 'options-reading.php' ) )
				);
				?>
			</li>
			<li>
				<?php
				printf(
					/* translators: %s: Link to the Customizer. */
					wp_kses_post( __( 'Open <a href="%s">Appearance &rarr; Customize</a> and fill in the Sindoor Valour Options panel.', 'sindoor-valour' ) ),
					esc_url( admin_url( 'customize.php' ) )
				);
				?>
			</li>
			<li>
				<?php
				printf(
					/* translators: %s: Link to the Menus screen. */
					wp_kses_post( __( 'Build your menus under <a href="%s">Appearance &rarr; Menus</a> and assign them to Primary, Footer and Social Links.', 'sindoor-valour' ) ),
					esc_url( admin_url( 'nav-menus.php' ) )
				);
				?>
			</li>
			<li>
				<?php
				printf(
					/* translators: %s: Link to the Widgets screen. */
					wp_kses_post( __( 'Add widgets to the Main Sidebar and the three footer columns under <a href="%s">Appearance &rarr; Widgets</a>.', 'sindoor-valour' ) ),
					esc_url( admin_url( 'widgets.php' ) )
				);
				?>
			</li>
		</ol>
	</div>
	<?php
}

/**
 * Meta key that records a user has dismissed the welcome notice.
 *
 * @since 1.2.1
 */
define( 'SINDOOR_VALOUR_NOTICE_META', 'sindoor_valour_notice_dismissed' );

/**
 * Points a new user at the setup screen after activating the theme.
 *
 * The notice stays hidden for good once the user dismisses it, either with
 * the core "×" button (saved over AJAX) or the "Dismiss permanently" link
 * (works without JavaScript).
 *
 * @since 1.1.0
 *
 * @return void
 */
function sindoor_valour_activation_notice() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	if ( get_user_meta( get_current_user_id(), SINDOOR_VALOUR_NOTICE_META, true ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( $screen && 'appearance_page_sindoor-valour-setup' === $screen->id ) {
		return;
	}

	$dismiss_url = wp_nonce_url(
		add_query_arg( 'sindoor-valour-dismiss-notice', '1' ),
		'sindoor_valour_dismiss_notice',
		'sindoor_valour_nonce'
	);
	?>
	<div class="notice notice-info is-dismissible sindoor-valour-welcome-notice" data-nonce="<?php echo esc_attr( wp_create_nonce( 'sindoor_valour_dismiss_notice' ) ); ?>">
		<p>
			<strong><?php esc_html_e( 'Sindoor Valour is active.', 'sindoor-valour' ); ?></strong>
			<?php
			printf(
				/* translators: %s: Link to the theme setup screen. */
				wp_kses_post( __( 'The front page shows its sections once there is something to put in them — <a href="%s">open Theme Setup</a> for a short checklist.', 'sindoor-valour' ) ),
				esc_url( admin_url( 'themes.php?page=sindoor-valour-setup' ) )
			);
			?>
		</p>
		<p><a href="<?php echo esc_url( $dismiss_url ); ?>"><?php esc_html_e( 'Dismiss permanently', 'sindoor-valour' ); ?></a></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'sindoor_valour_activation_notice' );

/**
 * Saves the dismissal when the "×" button is clicked (AJAX).
 *
 * @since 1.2.1
 *
 * @return void
 */
function sindoor_valour_ajax_dismiss_notice() {
	check_ajax_referer( 'sindoor_valour_dismiss_notice', 'nonce' );

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( null, 403 );
	}

	update_user_meta( get_current_user_id(), SINDOOR_VALOUR_NOTICE_META, 1 );
	wp_send_json_success();
}
add_action( 'wp_ajax_sindoor_valour_dismiss_notice', 'sindoor_valour_ajax_dismiss_notice' );

/**
 * Saves the dismissal when the "Dismiss permanently" link is followed.
 *
 * @since 1.2.1
 *
 * @return void
 */
function sindoor_valour_link_dismiss_notice() {
	if ( ! isset( $_GET['sindoor-valour-dismiss-notice'], $_GET['sindoor_valour_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['sindoor_valour_nonce'] ) ), 'sindoor_valour_dismiss_notice' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	update_user_meta( get_current_user_id(), SINDOOR_VALOUR_NOTICE_META, 1 );

	wp_safe_redirect( remove_query_arg( array( 'sindoor-valour-dismiss-notice', 'sindoor_valour_nonce' ) ) );
	exit;
}
add_action( 'admin_init', 'sindoor_valour_link_dismiss_notice' );

/**
 * Sends the dismissal to the server when the core "×" button is clicked.
 *
 * @since 1.2.1
 *
 * @return void
 */
function sindoor_valour_dismiss_notice_script() {
	if ( ! current_user_can( 'edit_theme_options' ) || get_user_meta( get_current_user_id(), SINDOOR_VALOUR_NOTICE_META, true ) ) {
		return;
	}

	wp_enqueue_script( 'jquery' );
	wp_add_inline_script(
		'jquery',
		"jQuery( function( $ ) {\n" .
		"\t$( document ).on( 'click', '.sindoor-valour-welcome-notice .notice-dismiss', function() {\n" .
		"\t\tvar notice = $( this ).closest( '.sindoor-valour-welcome-notice' );\n" .
		"\t\t$.post( ajaxurl, { action: 'sindoor_valour_dismiss_notice', nonce: notice.data( 'nonce' ) } );\n" .
		"\t} );\n" .
		'} );'
	);
}
add_action( 'admin_enqueue_scripts', 'sindoor_valour_dismiss_notice_script' );
