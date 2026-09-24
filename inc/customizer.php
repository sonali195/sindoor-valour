<?php
/**
 * Theme Customizer settings.
 *
 * Every setting declares a sanitize_callback, and every one is read back
 * through sindoor_valour_get_option() so a default is never missing.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the theme's Customizer defaults.
 *
 * @since 1.0.0
 *
 * @return array<string, mixed> Setting key => default value.
 */
function sindoor_valour_default_options() {
	return array(
		'topbar_phone'        => '',
		'topbar_email'        => '',
		'topbar_note'         => '',
		'header_cta_text'     => __( 'Donate', 'sindoor-valour' ),
		'header_cta_url'      => '',
		'hero_enabled'        => true,
		'hero_eyebrow'        => __( 'Veterans Welfare', 'sindoor-valour' ),
		'hero_title'          => __( 'Standing by those who stood for us', 'sindoor-valour' ),
		'hero_text'           => __( 'Support for veterans, war widows and the families of serving personnel — education, medical aid, skilling and pension assistance.', 'sindoor-valour' ),
		'hero_primary_text'   => __( 'Support a family', 'sindoor-valour' ),
		'hero_primary_url'    => '',
		'hero_secondary_text' => __( 'Our programmes', 'sindoor-valour' ),
		'hero_secondary_url'  => '',
		'impact_enabled'      => true,
		'impact_1_value'      => '',
		'impact_1_label'      => __( 'Families supported', 'sindoor-valour' ),
		'impact_2_value'      => '',
		'impact_2_label'      => __( 'Children in education', 'sindoor-valour' ),
		'impact_3_value'      => '',
		'impact_3_label'      => __( 'Medical camps held', 'sindoor-valour' ),
		'impact_4_value'      => '',
		'impact_4_label'      => __( 'Districts reached', 'sindoor-valour' ),
		'programmes_enabled'  => true,
		'programmes_title'    => __( 'What we do', 'sindoor-valour' ),
		'programmes_text'     => __( 'Long-term welfare, delivered close to the families who need it.', 'sindoor-valour' ),
		'programmes_count'    => 3,
		'events_enabled'      => true,
		'events_title'        => __( 'Upcoming events', 'sindoor-valour' ),
		'events_count'        => 4,
		'news_enabled'        => true,
		'news_title'          => __( 'Latest updates', 'sindoor-valour' ),
		'news_count'          => 3,
		'cta_enabled'         => true,
		'cta_title'           => __( 'Every contribution reaches a family', 'sindoor-valour' ),
		'cta_text'            => __( 'Regular giving is what keeps a scholarship running for a full academic year.', 'sindoor-valour' ),
		'cta_button_text'     => __( 'Donate now', 'sindoor-valour' ),
		'cta_button_url'      => '',
		'footer_credit'       => '',
	);
}

/**
 * Reads a theme option, falling back to its registered default.
 *
 * @since 1.0.0
 *
 * @param string $key Setting key, without the theme prefix.
 * @return mixed Setting value.
 */
function sindoor_valour_get_option( $key ) {
	$defaults = sindoor_valour_default_options();

	if ( ! array_key_exists( $key, $defaults ) ) {
		return null;
	}

	return get_theme_mod( 'sindoor_valour_' . $key, $defaults[ $key ] );
}

/**
 * Registers Customizer panels, sections, settings and controls.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @return void
 */
function sindoor_valour_customize_register( $wp_customize ) {
	$defaults = sindoor_valour_default_options();

	/*
	 * Make the core fields live-previewable. Each is checked first: the core
	 * settings are normally registered before this callback runs, but a plugin
	 * that builds its own WP_Customize_Manager can invert that order, and a
	 * missing setting must not take the whole Customizer down.
	 */
	foreach ( array( 'blogname', 'blogdescription', 'header_textcolor' ) as $core_setting ) {
		$setting = $wp_customize->get_setting( $core_setting );

		if ( $setting instanceof WP_Customize_Setting ) {
			$setting->transport = 'postMessage';
		}
	}

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'sindoor_valour_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'sindoor_valour_customize_partial_blogdescription',
		)
	);

	$wp_customize->add_panel(
		'sindoor_valour_panel',
		array(
			'title'       => esc_html__( 'Sindoor Valour Options', 'sindoor-valour' ),
			'description' => esc_html__( 'Header details, the front-page sections and the footer credit.', 'sindoor-valour' ),
			'priority'    => 130,
		)
	);

	// Header.

	$wp_customize->add_section(
		'sindoor_valour_header',
		array(
			'title'       => esc_html__( 'Header', 'sindoor-valour' ),
			'description' => esc_html__( 'The contact strip above the logo, and the header button.', 'sindoor-valour' ),
			'panel'       => 'sindoor_valour_panel',
		)
	);

	sindoor_valour_add_text_control( $wp_customize, 'topbar_phone', esc_html__( 'Helpline number', 'sindoor-valour' ), 'sindoor_valour_header', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'topbar_email', esc_html__( 'Contact email', 'sindoor-valour' ), 'sindoor_valour_header', $defaults, 'email' );
	sindoor_valour_add_text_control( $wp_customize, 'topbar_note', esc_html__( 'Short notice', 'sindoor-valour' ), 'sindoor_valour_header', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'header_cta_text', esc_html__( 'Header button label', 'sindoor-valour' ), 'sindoor_valour_header', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'header_cta_url', esc_html__( 'Header button link', 'sindoor-valour' ), 'sindoor_valour_header', $defaults, 'url' );

	// Hero.

	$wp_customize->add_section(
		'sindoor_valour_hero',
		array(
			'title'       => esc_html__( 'Front Page: Hero', 'sindoor-valour' ),
			'description' => esc_html__( 'The banner at the top of the front page. Its background is the header image set under Header Media.', 'sindoor-valour' ),
			'panel'       => 'sindoor_valour_panel',
		)
	);

	sindoor_valour_add_checkbox_control( $wp_customize, 'hero_enabled', esc_html__( 'Show the hero', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'hero_eyebrow', esc_html__( 'Eyebrow', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'hero_title', esc_html__( 'Heading', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'hero_text', esc_html__( 'Text', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults, 'textarea' );
	sindoor_valour_add_text_control( $wp_customize, 'hero_primary_text', esc_html__( 'Primary button label', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'hero_primary_url', esc_html__( 'Primary button link', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults, 'url' );
	sindoor_valour_add_text_control( $wp_customize, 'hero_secondary_text', esc_html__( 'Secondary button label', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'hero_secondary_url', esc_html__( 'Secondary button link', 'sindoor-valour' ), 'sindoor_valour_hero', $defaults, 'url' );

	// Impact.

	$wp_customize->add_section(
		'sindoor_valour_impact',
		array(
			'title'       => esc_html__( 'Front Page: Impact Figures', 'sindoor-valour' ),
			'description' => esc_html__( 'Leave a figure empty to hide that tile. Publish only numbers the trust can account for.', 'sindoor-valour' ),
			'panel'       => 'sindoor_valour_panel',
		)
	);

	sindoor_valour_add_checkbox_control( $wp_customize, 'impact_enabled', esc_html__( 'Show impact figures', 'sindoor-valour' ), 'sindoor_valour_impact', $defaults );

	for ( $index = 1; $index <= 4; $index++ ) {
		sindoor_valour_add_text_control(
			$wp_customize,
			'impact_' . $index . '_value',
			sprintf(
				/* translators: %d: Impact tile number. */
				esc_html__( 'Figure %d', 'sindoor-valour' ),
				$index
			),
			'sindoor_valour_impact',
			$defaults
		);
		sindoor_valour_add_text_control(
			$wp_customize,
			'impact_' . $index . '_label',
			sprintf(
				/* translators: %d: Impact tile number. */
				esc_html__( 'Label %d', 'sindoor-valour' ),
				$index
			),
			'sindoor_valour_impact',
			$defaults
		);
	}

	// Sections.

	$wp_customize->add_section(
		'sindoor_valour_sections',
		array(
			'title' => esc_html__( 'Front Page: Sections', 'sindoor-valour' ),
			'panel' => 'sindoor_valour_panel',
		)
	);

	sindoor_valour_add_checkbox_control( $wp_customize, 'programmes_enabled', esc_html__( 'Show programmes', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'programmes_title', esc_html__( 'Programmes heading', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'programmes_text', esc_html__( 'Programmes intro', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults, 'textarea' );
	sindoor_valour_add_number_control( $wp_customize, 'programmes_count', esc_html__( 'Programmes to show', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );

	sindoor_valour_add_checkbox_control( $wp_customize, 'events_enabled', esc_html__( 'Show events', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'events_title', esc_html__( 'Events heading', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );
	sindoor_valour_add_number_control( $wp_customize, 'events_count', esc_html__( 'Events to show', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );

	sindoor_valour_add_checkbox_control( $wp_customize, 'news_enabled', esc_html__( 'Show latest updates', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'news_title', esc_html__( 'Updates heading', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );
	sindoor_valour_add_number_control( $wp_customize, 'news_count', esc_html__( 'Updates to show', 'sindoor-valour' ), 'sindoor_valour_sections', $defaults );

	// Donation call to action.

	$wp_customize->add_section(
		'sindoor_valour_cta',
		array(
			'title'       => esc_html__( 'Donation Call to Action', 'sindoor-valour' ),
			'description' => esc_html__( 'Shown near the bottom of the front page and on the donation template.', 'sindoor-valour' ),
			'panel'       => 'sindoor_valour_panel',
		)
	);

	sindoor_valour_add_checkbox_control( $wp_customize, 'cta_enabled', esc_html__( 'Show the call to action', 'sindoor-valour' ), 'sindoor_valour_cta', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'cta_title', esc_html__( 'Heading', 'sindoor-valour' ), 'sindoor_valour_cta', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'cta_text', esc_html__( 'Text', 'sindoor-valour' ), 'sindoor_valour_cta', $defaults, 'textarea' );
	sindoor_valour_add_text_control( $wp_customize, 'cta_button_text', esc_html__( 'Button label', 'sindoor-valour' ), 'sindoor_valour_cta', $defaults );
	sindoor_valour_add_text_control( $wp_customize, 'cta_button_url', esc_html__( 'Button link', 'sindoor-valour' ), 'sindoor_valour_cta', $defaults, 'url' );

	// Footer.

	$wp_customize->add_section(
		'sindoor_valour_footer',
		array(
			'title' => esc_html__( 'Footer', 'sindoor-valour' ),
			'panel' => 'sindoor_valour_panel',
		)
	);

	sindoor_valour_add_text_control(
		$wp_customize,
		'footer_credit',
		esc_html__( 'Footer credit line', 'sindoor-valour' ),
		'sindoor_valour_footer',
		$defaults
	);
}
add_action( 'customize_register', 'sindoor_valour_customize_register' );

/**
 * Adds a text, textarea, email or URL setting and control.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Setting key without the prefix.
 * @param string               $label        Control label.
 * @param string               $section      Section ID.
 * @param array<string, mixed> $defaults     Default values.
 * @param string               $type         Optional. text|textarea|email|url. Default 'text'.
 * @return void
 */
function sindoor_valour_add_text_control( $wp_customize, $key, $label, $section, $defaults, $type = 'text' ) {
	$sanitizers = array(
		'text'     => 'sanitize_text_field',
		'textarea' => 'sanitize_textarea_field',
		'email'    => 'sanitize_email',
		'url'      => 'esc_url_raw',
	);

	$wp_customize->add_setting(
		'sindoor_valour_' . $key,
		array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
			'sanitize_callback' => isset( $sanitizers[ $type ] ) ? $sanitizers[ $type ] : 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'sindoor_valour_' . $key,
		array(
			'label'   => $label,
			'section' => $section,
			'type'    => 'textarea' === $type ? 'textarea' : ( 'url' === $type ? 'url' : ( 'email' === $type ? 'email' : 'text' ) ),
		)
	);
}

/**
 * Adds a checkbox setting and control.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Setting key without the prefix.
 * @param string               $label        Control label.
 * @param string               $section      Section ID.
 * @param array<string, mixed> $defaults     Default values.
 * @return void
 */
function sindoor_valour_add_checkbox_control( $wp_customize, $key, $label, $section, $defaults ) {
	$wp_customize->add_setting(
		'sindoor_valour_' . $key,
		array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : false,
			'sanitize_callback' => 'sindoor_valour_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'sindoor_valour_' . $key,
		array(
			'label'   => $label,
			'section' => $section,
			'type'    => 'checkbox',
		)
	);
}

/**
 * Adds a bounded number setting and control.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Setting key without the prefix.
 * @param string               $label        Control label.
 * @param string               $section      Section ID.
 * @param array<string, mixed> $defaults     Default values.
 * @return void
 */
function sindoor_valour_add_number_control( $wp_customize, $key, $label, $section, $defaults ) {
	$wp_customize->add_setting(
		'sindoor_valour_' . $key,
		array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : 3,
			'sanitize_callback' => 'sindoor_valour_sanitize_count',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'sindoor_valour_' . $key,
		array(
			'label'       => $label,
			'section'     => $section,
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 1,
				'max'  => 12,
				'step' => 1,
			),
		)
	);
}

/**
 * Sanitises a checkbox value.
 *
 * @since 1.0.0
 *
 * @param mixed $value Raw value.
 * @return bool Sanitised value.
 */
function sindoor_valour_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Sanitises a "how many to show" value into the range 1-12.
 *
 * @since 1.0.0
 *
 * @param mixed $value Raw value.
 * @return int Sanitised value.
 */
function sindoor_valour_sanitize_count( $value ) {
	$value = absint( $value );

	if ( $value < 1 ) {
		return 1;
	}

	if ( $value > 12 ) {
		return 12;
	}

	return $value;
}

/**
 * Renders the site title for selective refresh.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Renders the site description for selective refresh.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Loads the Customizer live-preview script.
 *
 * @since 1.0.0
 *
 * @return void
 */
function sindoor_valour_customize_preview_js() {
	wp_enqueue_script(
		'sindoor-valour-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		SINDOOR_VALOUR_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'sindoor_valour_customize_preview_js' );
