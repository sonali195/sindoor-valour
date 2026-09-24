<?php
/**
 * Block patterns.
 *
 * Ready-made arrangements for the blocks a welfare trust writes most often:
 * an appeal, a set of programme cards, the office details, and the documents
 * a family needs to bring. Each one is editable content, not a template — the
 * point is to save someone building the same layout by hand every time.
 *
 * @package Sindoor_Valour
 * @since   1.2.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the pattern category the theme's patterns are filed under.
 *
 * @since 1.2.0
 *
 * @return void
 */
function sindoor_valour_register_block_pattern_category() {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'sindoor-valour',
		array(
			'label'       => __( 'Sindoor Valour', 'sindoor-valour' ),
			'description' => __( 'Layouts for welfare trusts: appeals, programmes, notices and office details.', 'sindoor-valour' ),
		)
	);
}
add_action( 'init', 'sindoor_valour_register_block_pattern_category' );

/**
 * Registers the theme's block patterns.
 *
 * @since 1.2.0
 *
 * @return void
 */
function sindoor_valour_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	foreach ( sindoor_valour_block_patterns() as $slug => $pattern ) {
		register_block_pattern( 'sindoor-valour/' . $slug, $pattern );
	}
}
add_action( 'init', 'sindoor_valour_register_block_patterns' );

/**
 * The pattern definitions.
 *
 * @since 1.2.0
 *
 * @return array<string, array<string, mixed>> Patterns, keyed by slug.
 */
function sindoor_valour_block_patterns() {
	return array(
		'appeal'           => array(
			'title'       => __( 'Appeal with button', 'sindoor-valour' ),
			'description' => _x( 'A short appeal on the sindoor background, with a heading, one paragraph and a button.', 'Block pattern description', 'sindoor-valour' ),
			'categories'  => array( 'sindoor-valour', 'call-to-action' ),
			'keywords'    => array( 'donate', 'appeal', 'call to action' ),
			'content'     => sindoor_valour_pattern_appeal(),
		),
		'programme-cards'  => array(
			'title'       => __( 'Three programme cards', 'sindoor-valour' ),
			'description' => _x( 'Three columns, each with a heading and a short description of one welfare programme.', 'Block pattern description', 'sindoor-valour' ),
			'categories'  => array( 'sindoor-valour', 'columns' ),
			'keywords'    => array( 'programmes', 'columns', 'services' ),
			'content'     => sindoor_valour_pattern_programme_cards(),
		),
		'documents-notice' => array(
			'title'       => __( 'Documents to bring', 'sindoor-valour' ),
			'description' => _x( 'A highlighted notice listing the paperwork a family should carry to the office.', 'Block pattern description', 'sindoor-valour' ),
			'categories'  => array( 'sindoor-valour', 'text' ),
			'keywords'    => array( 'notice', 'documents', 'checklist' ),
			'content'     => sindoor_valour_pattern_documents(),
		),
		'office-details'   => array(
			'title'       => __( 'Office details and hours', 'sindoor-valour' ),
			'description' => _x( 'Two columns: the office address on one side, opening hours and the helpline on the other.', 'Block pattern description', 'sindoor-valour' ),
			'categories'  => array( 'sindoor-valour', 'contact' ),
			'keywords'    => array( 'contact', 'address', 'hours', 'office' ),
			'content'     => sindoor_valour_pattern_office(),
		),
	);
}

/**
 * Appeal pattern markup.
 *
 * @since 1.2.0
 *
 * @return string Block markup.
 */
function sindoor_valour_pattern_appeal() {
	$heading = esc_html__( 'Every contribution reaches a family', 'sindoor-valour' );
	$text    = esc_html__( 'Regular giving is what keeps a scholarship running for a full academic year. Replace this text with the appeal you are running now.', 'sindoor-valour' );
	$button  = esc_html__( 'Donate', 'sindoor-valour' );

	return '<!-- wp:group {"backgroundColor":"sv-sindoor","textColor":"sv-paper","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-sv-paper-color has-sv-sindoor-background-color has-text-color has-background">
<!-- wp:heading -->
<h2 class="wp-block-heading">' . $heading . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . $text . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"sv-paper","textColor":"sv-sindoor"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-sv-sindoor-color has-sv-paper-background-color has-text-color has-background wp-element-button">' . $button . '</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->';
}

/**
 * Programme cards pattern markup.
 *
 * @since 1.2.0
 *
 * @return string Block markup.
 */
function sindoor_valour_pattern_programme_cards() {
	$cards = array(
		array(
			esc_html__( 'Education', 'sindoor-valour' ),
			esc_html__( 'School and college fees, books and uniforms, paid directly to the institution.', 'sindoor-valour' ),
		),
		array(
			esc_html__( 'Medical aid', 'sindoor-valour' ),
			esc_html__( 'District camps, hospital referrals and help with costs outside the family entitlement.', 'sindoor-valour' ),
		),
		array(
			esc_html__( 'Livelihood', 'sindoor-valour' ),
			esc_html__( 'Trade certification and placement support for veterans entering civilian work.', 'sindoor-valour' ),
		),
	);

	$columns = '';

	foreach ( $cards as $card ) {
		$columns .= '<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . $card[0] . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . $card[1] . '</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

';
	}

	return '<!-- wp:columns -->
<div class="wp-block-columns">

' . trim( $columns ) . '

</div>
<!-- /wp:columns -->';
}

/**
 * Documents notice pattern markup.
 *
 * @since 1.2.0
 *
 * @return string Block markup.
 */
function sindoor_valour_pattern_documents() {
	$heading = esc_html__( 'What to bring', 'sindoor-valour' );
	$items   = array(
		esc_html__( 'Discharge book or service identity card.', 'sindoor-valour' ),
		esc_html__( 'Pension payment order, where a pension is drawn.', 'sindoor-valour' ),
		esc_html__( 'The student&#8217;s previous mark sheet, for a scholarship application.', 'sindoor-valour' ),
		esc_html__( 'The hospital estimate, for medical assistance.', 'sindoor-valour' ),
	);

	$list = '';

	foreach ( $items as $item ) {
		$list .= '<!-- wp:list-item -->
<li>' . $item . '</li>
<!-- /wp:list-item -->

';
	}

	return '<!-- wp:group {"className":"is-style-sv-notice","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-sv-notice">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . $heading . '</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list">

' . trim( $list ) . '

</ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->';
}

/**
 * Office details pattern markup.
 *
 * @since 1.2.0
 *
 * @return string Block markup.
 */
function sindoor_valour_pattern_office() {
	$address_heading = esc_html__( 'Office', 'sindoor-valour' );
	$address         = esc_html__( 'Replace with your street address, town and PIN code.', 'sindoor-valour' );
	$hours_heading   = esc_html__( 'Hours and helpline', 'sindoor-valour' );
	$hours           = esc_html__( 'Monday to Saturday, 10 am to 4 pm. Helpline 1800 000 0000.', 'sindoor-valour' );

	return '<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . $address_heading . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . $address . '</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . $hours_heading . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . $hours . '</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->';
}
