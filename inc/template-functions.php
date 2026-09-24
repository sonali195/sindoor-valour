<?php
/**
 * Functions that shape the theme's markup, independent of any one template.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Adds layout-describing classes to the body element.
 *
 * @since 1.0.0
 *
 * @param string[] $classes Existing body classes.
 * @return string[] Filtered body classes.
 */
function sindoor_valour_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( sindoor_valour_has_sidebar() ) {
		$classes[] = 'sv-has-sidebar';
	} else {
		$classes[] = 'sv-no-sidebar';
	}

	if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
		$classes[] = 'sv-no-footer-widgets';
	}

	// The hero is full-bleed, so the content wrapper drops its top padding.
	if ( is_front_page() && ! is_home() && sindoor_valour_get_option( 'hero_enabled' ) ) {
		$classes[] = 'sv-front-hero';
	}

	return $classes;
}
add_filter( 'body_class', 'sindoor_valour_body_classes' );

/**
 * Says whether the current view shows the sidebar.
 *
 * The sidebar is for reading contexts. Landing pages, the front page and the
 * two wide page templates are full-width by design.
 *
 * @since 1.0.0
 *
 * @return bool True when the sidebar should render.
 */
function sindoor_valour_has_sidebar() {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return false;
	}

	if ( is_front_page() || is_page_template( 'page-templates/template-full-width.php' ) || is_page_template( 'page-templates/template-donate.php' ) ) {
		return false;
	}

	if ( is_singular( array( 'sv-programme', 'sv-event' ) ) || is_post_type_archive( array( 'sv-programme', 'sv-event' ) ) ) {
		return false;
	}

	if ( is_page() && ! is_page_template() ) {
		return false;
	}

	return true;
}

/**
 * Adds a pingback header on singular views that accept pings.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf(
			'<link rel="pingback" href="%s">',
			esc_url( get_bloginfo( 'pingback_url' ) )
		);
	}
}
add_action( 'wp_head', 'sindoor_valour_pingback_header' );

/**
 * Replaces the excerpt's trailing ellipsis with a plain one.
 *
 * @since 1.0.0
 *
 * @param string $more Default "more" string.
 * @return string Filtered string.
 */
function sindoor_valour_excerpt_more( $more ) {
	return is_admin() ? $more : '&hellip;';
}
add_filter( 'excerpt_more', 'sindoor_valour_excerpt_more' );

/**
 * Shortens the default excerpt a little, for tidier cards.
 *
 * @since 1.0.0
 *
 * @param int $length Default excerpt length in words.
 * @return int Filtered length.
 */
function sindoor_valour_excerpt_length( $length ) {
	return is_admin() ? $length : 28;
}
add_filter( 'excerpt_length', 'sindoor_valour_excerpt_length' );

/**
 * Gives every menu item's sub-menu a toggle button and the right ARIA state.
 *
 * Doing it in PHP means the markup is correct before any script runs, so
 * keyboard users are never left with an unlabelled control.
 *
 * @since 1.0.0
 *
 * @param string   $output Menu item output so far.
 * @param WP_Post  $item   Menu item.
 * @param int      $depth  Depth of the item.
 * @param stdClass $args   Menu arguments.
 * @return string Filtered output.
 */
function sindoor_valour_submenu_toggle( $output, $item, $depth, $args ) {
	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( ! in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
		return $output;
	}

	$icon = '<svg viewBox="0 0 20 20" aria-hidden="true" focusable="false"><path d="M10 13.4 3.3 6.7l1.4-1.4L10 10.6l5.3-5.3 1.4 1.4z"/></svg>';

	$output .= sprintf(
		'<button type="button" class="sv-submenu-toggle" aria-expanded="false"><span class="screen-reader-text">%1$s</span>%2$s</button>',
		esc_html__( 'Open sub-menu', 'sindoor-valour' ),
		$icon
	);

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'sindoor_valour_submenu_toggle', 10, 4 );

/**
 * Makes the "read more" link inside the_content() name its post.
 *
 * @since 1.0.0
 *
 * The default markup is replaced outright, so the filtered value is not
 * used and the parameter is not declared.
 *
 * @return string Filtered markup.
 */
function sindoor_valour_content_more_link() {
	return sprintf(
		'<p><a class="sv-more-link" href="%1$s#more-%2$d">%3$s<span class="screen-reader-text"> %4$s</span></a></p>',
		esc_url( get_permalink() ),
		(int) get_the_ID(),
		esc_html__( 'Continue reading', 'sindoor-valour' ),
		esc_html( get_the_title() )
	);
}
add_filter( 'the_content_more_link', 'sindoor_valour_content_more_link' );
