<?php
/**
 * Block styles.
 *
 * Variations an editor can pick from the block sidebar, so the look the theme
 * uses in its own templates is available inside post content too. Each one is
 * a class the stylesheet already knows about.
 *
 * @package Sindoor_Valour
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the theme's block style variations.
 *
 * @since 1.2.0
 *
 * @return void
 */
function sindoor_valour_register_block_styles() {
	if ( ! function_exists( 'register_block_style' ) ) {
		return;
	}

	$styles = array(
		array(
			'block' => 'core/paragraph',
			'name'  => 'sv-notice',
			'label' => __( 'Notice', 'sindoor-valour' ),
		),
		array(
			'block' => 'core/group',
			'name'  => 'sv-notice',
			'label' => __( 'Notice', 'sindoor-valour' ),
		),
		array(
			'block' => 'core/list',
			'name'  => 'sv-checklist',
			'label' => __( 'Checklist', 'sindoor-valour' ),
		),
		array(
			'block' => 'core/quote',
			'name'  => 'sv-testimony',
			'label' => __( 'Testimony', 'sindoor-valour' ),
		),
		array(
			'block' => 'core/image',
			'name'  => 'sv-framed',
			'label' => __( 'Framed', 'sindoor-valour' ),
		),
		array(
			'block' => 'core/separator',
			'name'  => 'sv-rule',
			'label' => __( 'Sindoor rule', 'sindoor-valour' ),
		),
		array(
			'block' => 'core/table',
			'name'  => 'sv-schedule',
			'label' => __( 'Schedule', 'sindoor-valour' ),
		),
	);

	foreach ( $styles as $style ) {
		register_block_style(
			$style['block'],
			array(
				'name'  => $style['name'],
				'label' => $style['label'],
			)
		);
	}
}
add_action( 'init', 'sindoor_valour_register_block_styles' );
