<?php
/**
 * Sindoor Valour functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'SINDOOR_VALOUR_VERSION' ) ) {
	/**
	 * Theme version, used to bust asset caches.
	 *
	 * Read from style.css so the number lives in exactly one place.
	 */
	define( 'SINDOOR_VALOUR_VERSION', wp_get_theme( 'sindoor-valour' )->get( 'Version' ) );
}

if ( ! function_exists( 'sindoor_valour_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for WordPress features.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function sindoor_valour_setup() {
		/*
		 * Translations live in the theme's own languages directory, and a child
		 * theme or the WordPress languages directory may override them.
		 */
		load_theme_textdomain( 'sindoor-valour', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'               => 96,
				'width'                => 320,
				'flex-height'          => true,
				'flex-width'           => true,
				'unlink-homepage-logo' => true,
			)
		);

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f4f1e8',
				'default-image' => '',
			)
		);

		/*
		 * The header image doubles as the front-page hero backdrop, so it is
		 * intentionally wide and croppable.
		 */
		add_theme_support(
			'custom-header',
			array(
				'default-text-color' => 'ffffff',
				'width'              => 1920,
				'height'             => 720,
				'flex-height'        => true,
				'flex-width'         => true,
				'header-text'        => false,
			)
		);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'sindoor-valour' ),
				'footer'  => esc_html__( 'Footer Menu', 'sindoor-valour' ),
				'social'  => esc_html__( 'Social Links Menu', 'sindoor-valour' ),
			)
		);

		add_image_size( 'sindoor-valour-card', 720, 405, true );
		add_image_size( 'sindoor-valour-hero', 1920, 720, true );

		// Let WordPress manage the document title separator.
		add_filter( 'document_title_separator', 'sindoor_valour_title_separator' );
	}
}
add_action( 'after_setup_theme', 'sindoor_valour_setup' );

/**
 * Uses an en dash between the page name and the site name.
 *
 * @since 1.0.0
 *
 * The default is replaced outright, so the filtered value is not used and
 * the parameter is not declared.
 *
 * @return string Filtered separator.
 */
function sindoor_valour_title_separator() {
	return '–';
}

/**
 * Registers the content width in pixels, based on the theme's design.
 *
 * @since 1.0.0
 *
 * @global int $content_width
 *
 * @return void
 */
function sindoor_valour_content_width() {
	$width = 780;

	if ( is_page_template( 'page-templates/template-full-width.php' ) || is_page_template( 'page-templates/template-donate.php' ) ) {
		$width = 1180;
	}

	/**
	 * Filters the content width in pixels.
	 *
	 * @since 1.0.0
	 *
	 * @param int $width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'sindoor_valour_content_width', $width );
}
add_action( 'template_redirect', 'sindoor_valour_content_width', 0 );

/**
 * Registers widget areas.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'sindoor-valour' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Shown beside posts, archives and the blog page.', 'sindoor-valour' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	$footer_columns = 3;

	for ( $column = 1; $column <= $footer_columns; $column++ ) {
		register_sidebar(
			array(
				'name'          => sprintf(
					/* translators: %d: Footer widget column number. */
					esc_html__( 'Footer Column %d', 'sindoor-valour' ),
					$column
				),
				'id'            => 'footer-' . $column,
				'description'   => esc_html__( 'Widgets placed here appear in the site footer.', 'sindoor-valour' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'sindoor_valour_widgets_init' );

/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_scripts() {
	wp_enqueue_style(
		'sindoor-valour-style',
		get_stylesheet_uri(),
		array(),
		SINDOOR_VALOUR_VERSION
	);

	/*
	 * RTL overrides only — the main stylesheet still applies, so the two files
	 * never drift out of step the way a full mirrored copy does.
	 */
	if ( is_rtl() ) {
		wp_enqueue_style(
			'sindoor-valour-rtl',
			get_template_directory_uri() . '/rtl.css',
			array( 'sindoor-valour-style' ),
			SINDOOR_VALOUR_VERSION
		);
	}

	wp_enqueue_script(
		'sindoor-valour-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		SINDOOR_VALOUR_VERSION,
		true
	);

	wp_localize_script(
		'sindoor-valour-navigation',
		'sindoorValourNav',
		array(
			'expand'   => esc_html__( 'Open sub-menu', 'sindoor-valour' ),
			'collapse' => esc_html__( 'Close sub-menu', 'sindoor-valour' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sindoor_valour_scripts' );

/**
 * Registers the editor colour palette and font sizes.
 *
 * Kept separate from sindoor_valour_setup() so the palette is easy to find
 * and to keep in step with the CSS custom properties in style.css.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_editor_support() {
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Olive', 'sindoor-valour' ),
				'slug'  => 'sv-olive',
				'color' => '#33422a',
			),
			array(
				'name'  => esc_html__( 'Sindoor', 'sindoor-valour' ),
				'slug'  => 'sv-sindoor',
				'color' => '#9c2a1f',
			),
			array(
				'name'  => esc_html__( 'Sand', 'sindoor-valour' ),
				'slug'  => 'sv-sand',
				'color' => '#f4f1e8',
			),
			array(
				'name'  => esc_html__( 'Ink', 'sindoor-valour' ),
				'slug'  => 'sv-ink',
				'color' => '#1b1f18',
			),
			array(
				'name'  => esc_html__( 'Paper', 'sindoor-valour' ),
				'slug'  => 'sv-paper',
				'color' => '#ffffff',
			),
		)
	);

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => esc_html__( 'Small', 'sindoor-valour' ),
				'slug' => 'small',
				'size' => 14,
			),
			array(
				'name' => esc_html__( 'Normal', 'sindoor-valour' ),
				'slug' => 'normal',
				'size' => 16,
			),
			array(
				'name' => esc_html__( 'Large', 'sindoor-valour' ),
				'slug' => 'large',
				'size' => 22,
			),
			array(
				'name' => esc_html__( 'Extra Large', 'sindoor-valour' ),
				'slug' => 'extra-large',
				'size' => 30,
			),
		)
	);
}
add_action( 'after_setup_theme', 'sindoor_valour_editor_support' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/starter-content.php';
require get_template_directory() . '/inc/block-styles.php';
require get_template_directory() . '/inc/block-patterns.php';

if ( is_admin() ) {
	require get_template_directory() . '/inc/admin-setup.php';
}
