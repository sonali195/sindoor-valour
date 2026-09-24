<?php
/**
 * Starter content.
 *
 * WordPress's own mechanism for "what the site looks like the moment the theme
 * is switched on" (since 4.7). On a *fresh* site — one that has not published
 * anything yet — activating the theme opens the Customizer already populated
 * with these pages, menus, widgets and settings, previewed as drafts.
 *
 * Two things are worth being clear about, because they are what makes this the
 * correct approach rather than writing rows on activation:
 *
 *  1. Nothing is saved until the person clicks Publish in the Customizer. If
 *     they close it, the site is untouched.
 *  2. WordPress ignores all of it on a site that already has content, so an
 *     existing site can never have demo pages appear in its admin.
 *
 * For a site that is NOT fresh, the importer in inc/demo-content.php offers the
 * same content behind an explicit button under Appearance.
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-starter-content
 *
 * @package Sindoor_Valour
 * @since   1.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the block markup for the front page's own content area.
 *
 * The front page template renders the hero and the impact figures above this,
 * and the programmes, events, appeal and updates below it, so this block is
 * deliberately short: it is the trust's own words, not another section.
 *
 * @since 1.1.0
 *
 * @return string Block markup.
 */
function sindoor_valour_starter_home_content() {
	$heading = __( 'Who we are', 'sindoor-valour' );
	$intro   = __( 'We are a registered charitable trust working with veterans, war widows and the families of serving personnel. Our work is unglamorous and long-term: school fees paid on time, a hospital bill settled, a pension file followed up until it moves, a trade certificate that leads to a job.', 'sindoor-valour' );
	$second  = __( 'Everything we do is funded by regular donors and audited annually. Replace this text with your own introduction, and the figures above with numbers your trust can account for.', 'sindoor-valour' );

	return sprintf(
		"<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">%1\$s</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>%2\$s</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>%3\$s</p>\n<!-- /wp:paragraph -->",
		esc_html( $heading ),
		esc_html( $intro ),
		esc_html( $second )
	);
}

/**
 * Returns the block markup for the About page.
 *
 * @since 1.1.0
 *
 * @return string Block markup.
 */
function sindoor_valour_starter_about_content() {
	$blocks = array(
		array( 'p', __( 'This page is where you set out what the trust exists to do, who it serves and who runs it. Keep it concrete: the districts you cover, the year you were registered, the registration number, and the names of the trustees.', 'sindoor-valour' ) ),
		array( 'h2', __( 'How we work', 'sindoor-valour' ) ),
		array( 'p', __( 'Applications come through the district sainik welfare office or directly from the family. Every case is verified against service records before any assistance is released, and assistance is paid to the institution or hospital rather than in cash.', 'sindoor-valour' ) ),
		array( 'h2', __( 'Governance', 'sindoor-valour' ) ),
		array( 'p', __( 'List your trustees, your auditor, and where the annual report and accounts can be read. Donors ask, and a trust that answers before being asked raises more.', 'sindoor-valour' ) ),
	);

	return sindoor_valour_starter_blocks( $blocks );
}

/**
 * Returns the block markup for the Donate page.
 *
 * @since 1.1.0
 *
 * @return string Block markup.
 */
function sindoor_valour_starter_donate_content() {
	$blocks = array(
		array( 'p', __( 'Replace this page with your own giving instructions. The theme deliberately does not collect payments: put your payment gateway shortcode, your UPI handle or your bank details here, whichever your trust actually uses.', 'sindoor-valour' ) ),
		array( 'h2', __( 'What a contribution covers', 'sindoor-valour' ) ),
		array(
			'ul',
			array(
				__( 'One school year for a child, including fees, books and uniform.', 'sindoor-valour' ),
				__( 'A district medical camp, including medicines and a visiting physician.', 'sindoor-valour' ),
				__( 'A trade certification course for a veteran entering civilian work.', 'sindoor-valour' ),
			),
		),
		array( 'h2', __( 'Bank transfer', 'sindoor-valour' ) ),
		array( 'p', __( 'Account name, account number, IFSC and branch go here. Add your 80G registration details if your trust holds one, and say plainly what a donor will receive as a receipt.', 'sindoor-valour' ) ),
	);

	return sindoor_valour_starter_blocks( $blocks );
}

/**
 * Returns the block markup for the Contact page.
 *
 * @since 1.1.0
 *
 * @return string Block markup.
 */
function sindoor_valour_starter_contact_content() {
	$blocks = array(
		array( 'p', __( 'Office address, helpline number, email and the hours the office is actually open. If families have to travel to reach you, say which day of the week the welfare officer sits in.', 'sindoor-valour' ) ),
		array( 'h2', __( 'Applying for assistance', 'sindoor-valour' ) ),
		array( 'p', __( 'List the documents a family should bring: discharge book, pension payment order, the child\'s previous mark sheet, and the hospital estimate where the application is for medical aid.', 'sindoor-valour' ) ),
	);

	return sindoor_valour_starter_blocks( $blocks );
}

/**
 * Builds block markup from a simple list of [ type, content ] pairs.
 *
 * @since 1.1.0
 *
 * @param array<int, array{0:string, 1:string|string[]}> $blocks Block definitions.
 * @return string Block markup.
 */
function sindoor_valour_starter_blocks( $blocks ) {
	$markup = array();

	foreach ( $blocks as $block ) {
		list( $type, $content ) = $block;

		if ( 'h2' === $type ) {
			$markup[] = sprintf(
				"<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">%s</h2>\n<!-- /wp:heading -->",
				esc_html( $content )
			);
			continue;
		}

		if ( 'ul' === $type ) {
			$items = '';

			foreach ( (array) $content as $item ) {
				$items .= sprintf(
					"<!-- wp:list-item -->\n<li>%s</li>\n<!-- /wp:list-item -->\n\n",
					esc_html( $item )
				);
			}

			$markup[] = sprintf(
				"<!-- wp:list -->\n<ul class=\"wp-block-list\">%s</ul>\n<!-- /wp:list -->",
				"\n\n" . trim( $items ) . "\n"
			);
			continue;
		}

		$markup[] = sprintf(
			"<!-- wp:paragraph -->\n<p>%s</p>\n<!-- /wp:paragraph -->",
			esc_html( $content )
		);
	}

	return implode( "\n\n", $markup );
}

/**
 * The demo programmes, events and post, shared by starter content and the
 * importer so the two can never drift apart.
 *
 * @since 1.1.0
 *
 * @return array<string, array<int, array<string, string>>> Demo content definitions.
 */
function sindoor_valour_demo_definitions() {
	return array(
		'programmes' => array(
			array(
				'title'   => __( 'Scholarships for children', 'sindoor-valour' ),
				'excerpt' => __( 'Full-year school and college fees, books and uniforms for the children of veterans and war widows, paid directly to the institution.', 'sindoor-valour' ),
				'content' => __( 'The scholarship covers tuition, examination fees, books and one set of uniform for a full academic year. Payment is made to the school or college, never in cash, and is renewed on the strength of the previous year\'s results. Applications open in April and close at the end of June.', 'sindoor-valour' ),
				'area'    => __( 'Education', 'sindoor-valour' ),
			),
			array(
				'title'   => __( 'Medical assistance', 'sindoor-valour' ),
				'excerpt' => __( 'Quarterly medical camps, hospital referrals and reimbursement of treatment costs that fall outside the family\'s entitlement.', 'sindoor-valour' ),
				'content' => __( 'A visiting physician holds a camp in each district every quarter, with basic diagnostics and a month\'s medicines. Cases that need hospital care are referred to a panel hospital, and the trust settles the portion of the bill that is not covered by the family\'s existing entitlement.', 'sindoor-valour' ),
				'area'    => __( 'Health', 'sindoor-valour' ),
			),
			array(
				'title'   => __( 'Skilling and placement', 'sindoor-valour' ),
				'excerpt' => __( 'Trade certification, interview preparation and placement support for veterans moving into civilian employment.', 'sindoor-valour' ),
				'content' => __( 'Veterans leaving service in their forties have two decades of working life ahead of them and a skill set that civilian employers often fail to read. The programme pays for a recognised trade certificate, rewrites the service record as a civilian CV, and introduces the candidate to employers who have hired from the programme before.', 'sindoor-valour' ),
				'area'    => __( 'Livelihood', 'sindoor-valour' ),
			),
			array(
				'title'   => __( 'Pension and records assistance', 'sindoor-valour' ),
				'excerpt' => __( 'Help with pension files, corrections to service records and the paperwork a family faces after a bereavement.', 'sindoor-valour' ),
				'content' => __( 'A stalled pension file is the most common problem a widow brings to the office, and it is almost always a paperwork problem rather than an entitlement one. The trust keeps a welfare officer who knows the forms, follows the file until it moves, and tells the family plainly where it has reached.', 'sindoor-valour' ),
				'area'    => __( 'Entitlements', 'sindoor-valour' ),
			),
		),
		'events'     => array(
			array(
				'title'    => __( 'District medical camp', 'sindoor-valour' ),
				'excerpt'  => __( 'Open to all registered beneficiaries. Carry your discharge book and canteen card.', 'sindoor-valour' ),
				'content'  => __( 'General physician, eye screening and blood sugar testing, with one month of medicines issued on the spot. Registration opens at 8:30 am and the last token is issued at 1 pm.', 'sindoor-valour' ),
				'offset'   => '+21 days',
				'location' => __( 'District Sainik Welfare Office', 'sindoor-valour' ),
			),
			array(
				'title'    => __( 'Scholarship application help desk', 'sindoor-valour' ),
				'excerpt'  => __( 'Bring last year\'s mark sheet and the school fee structure. Forms are filled in and submitted on the spot.', 'sindoor-valour' ),
				'content'  => __( 'A welfare officer will fill in the form with you, check the documents against your service record, and give you an acknowledgement with the file number before you leave.', 'sindoor-valour' ),
				'offset'   => '+45 days',
				'location' => __( 'Trust Office, Ground Floor', 'sindoor-valour' ),
			),
			array(
				'title'    => __( 'Annual commemoration and family day', 'sindoor-valour' ),
				'excerpt'  => __( 'The yearly gathering of beneficiary families, with the annual report read out and accounts placed on the table.', 'sindoor-valour' ),
				'content'  => __( 'The trustees present the year\'s accounts, the scholarship results are read out, and families who have moved into employment through the skilling programme speak about it themselves. Lunch is provided.', 'sindoor-valour' ),
				'offset'   => '+90 days',
				'location' => __( 'Community Hall', 'sindoor-valour' ),
			),
		),
		'posts'      => array(
			array(
				'title'   => __( 'Scholarship applications are open', 'sindoor-valour' ),
				'excerpt' => __( 'Applications for the coming academic year are open until the end of June. Forms are available at the district office and at the help desk.', 'sindoor-valour' ),
				'content' => __( 'Applications for the coming academic year are open. Families already on the register do not need to apply again; a renewal form will be sent to the address we hold. New applicants should bring the discharge book, the pension payment order and the child\'s previous mark sheet to the district office.', 'sindoor-valour' ),
			),
			array(
				'title'   => __( 'Medical camp reaches its four hundredth family', 'sindoor-valour' ),
				'excerpt' => __( 'The quarterly camp crossed four hundred families this month, with eye screening added to the standard set of tests.', 'sindoor-valour' ),
				'content' => __( 'The quarterly camp crossed four hundred families this month. Eye screening has been added to the standard set of tests after last year\'s camps found untreated cataracts in a third of the veterans over seventy who attended.', 'sindoor-valour' ),
			),
			array(
				'title'   => __( 'Annual report and accounts published', 'sindoor-valour' ),
				'excerpt' => __( 'The audited accounts and the trustees\' report for the year are now available to read and download.', 'sindoor-valour' ),
				'content' => __( 'The audited accounts and the trustees\' report for the year are now published. They set out what was received, what was spent on each programme, and what the trust holds in reserve. Donors who would like a printed copy can ask at the office.', 'sindoor-valour' ),
			),
		),
	);
}

/**
 * Registers starter content with WordPress.
 *
 * @since 1.1.0
 *
 * @return void
 */
function sindoor_valour_starter_content() {
	$definitions = sindoor_valour_demo_definitions();
	$posts       = array();

	$posts['home'] = array(
		'post_type'    => 'page',
		'post_title'   => _x( 'Home', 'Theme starter content', 'sindoor-valour' ),
		'post_content' => sindoor_valour_starter_home_content(),
	);

	$posts['about'] = array(
		'post_type'    => 'page',
		'post_title'   => _x( 'About the trust', 'Theme starter content', 'sindoor-valour' ),
		'post_content' => sindoor_valour_starter_about_content(),
	);

	$posts['donate'] = array(
		'post_type'    => 'page',
		'post_title'   => _x( 'Donate', 'Theme starter content', 'sindoor-valour' ),
		'post_content' => sindoor_valour_starter_donate_content(),
		// 'template' is the key core honours here; meta_input is stripped out.
		'template'     => 'page-templates/template-donate.php',
	);

	$posts['contact'] = array(
		'post_type'    => 'page',
		'post_title'   => _x( 'Contact', 'Theme starter content', 'sindoor-valour' ),
		'post_content' => sindoor_valour_starter_contact_content(),
	);

	$posts['blog'] = array(
		'post_type'  => 'page',
		'post_title' => _x( 'Updates', 'Theme starter content', 'sindoor-valour' ),
	);

	/*
	 * Programmes and events come from the companion plugin. Without it the post
	 * types do not exist, and starter content that referenced them would create
	 * orphaned rows the editor cannot open — so the pages and posts are offered
	 * on their own and the two sections simply stay empty.
	 *
	 * The test is the plugin's constant, not post_type_exists(): starter content
	 * is assembled at `after_setup_theme` and post types are not registered
	 * until `init`, so post_type_exists() is always false at this point. The
	 * constant is defined the moment the plugin loads, before any theme code.
	 */
	$sindoor_valour_has_content_types = defined( 'SINDOOR_VALOUR_CONTENT_VERSION' );

	/**
	 * Filters whether starter content includes programmes and events.
	 *
	 * Lets a site that registers the same post types from its own plugin opt
	 * back in.
	 *
	 * @since 1.2.0
	 *
	 * @param bool $include Whether to include the content types.
	 */
	$sindoor_valour_has_content_types = (bool) apply_filters( 'sindoor_valour_starter_content_types', $sindoor_valour_has_content_types );

	foreach ( $sindoor_valour_has_content_types ? $definitions['programmes'] : array() as $index => $programme ) {
		$posts[ 'programme-' . $index ] = array(
			'post_type'    => 'sv-programme',
			'post_title'   => $programme['title'],
			'post_excerpt' => $programme['excerpt'],
			'post_content' => $programme['content'],
		);
	}

	/*
	 * Events carry no meta here: core keeps only a fixed subset of post fields
	 * in starter content (post_type, post_title, post_excerpt, post_name,
	 * post_content, menu_order, comment_status, thumbnail, template), so
	 * meta_input would be silently dropped. The date and location are stamped
	 * on afterwards by sindoor_valour_date_starter_events().
	 */
	foreach ( $sindoor_valour_has_content_types ? $definitions['events'] : array() as $index => $event ) {
		$posts[ 'event-' . $index ] = array(
			'post_type'    => 'sv-event',
			'post_title'   => $event['title'],
			'post_excerpt' => $event['excerpt'],
			'post_content' => $event['content'],
		);
	}

	foreach ( $definitions['posts'] as $index => $post ) {
		$posts[ 'update-' . $index ] = array(
			'post_type'    => 'post',
			'post_title'   => $post['title'],
			'post_excerpt' => $post['excerpt'],
			'post_content' => $post['content'],
		);
	}

	$archive_items = array();

	if ( $sindoor_valour_has_content_types ) {
		$archive_items = array(
			'programmes' => array(
				'type'   => 'post_type_archive',
				'object' => 'sv-programme',
				'title'  => _x( 'Programmes', 'Theme starter content', 'sindoor-valour' ),
			),
			'events'     => array(
				'type'   => 'post_type_archive',
				'object' => 'sv-event',
				'title'  => _x( 'Events', 'Theme starter content', 'sindoor-valour' ),
			),
		);
	}

	$primary_items = array_merge(
		array(
			'page_home'  => 'page_home',
			'page_about' => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{about}}',
			),
		),
		$archive_items,
		array(
			'page_blog'    => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{blog}}',
			),
			'page_contact' => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{contact}}',
			),
		)
	);

	add_theme_support(
		'starter-content',
		array(
			'posts'      => $posts,

			'options'    => array(
				'show_on_front'   => 'page',
				'page_on_front'   => '{{home}}',
				'page_for_posts'  => '{{blog}}',
				'blogdescription' => _x( 'Welfare for veterans and their families', 'Theme starter content', 'sindoor-valour' ),
			),

			'theme_mods' => array(
				'sindoor_valour_topbar_phone'   => _x( '1800 000 0000', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_topbar_email'   => _x( 'welfare@example.org', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_topbar_note'    => _x( 'Office open Mon–Sat, 10 am to 4 pm', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_impact_1_value' => _x( '1,240', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_impact_2_value' => _x( '380', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_impact_3_value' => _x( '64', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_impact_4_value' => _x( '19', 'Theme starter content', 'sindoor-valour' ),
				'sindoor_valour_footer_credit'  => _x( 'A registered charitable trust. Replace this line with your registration number.', 'Theme starter content', 'sindoor-valour' ),
			),

			'nav_menus'  => array(
				'primary' => array(
					'name'  => _x( 'Primary Menu', 'Theme starter content', 'sindoor-valour' ),
					'items' => $primary_items,
				),
				'footer'  => array(
					'name'  => _x( 'Footer Menu', 'Theme starter content', 'sindoor-valour' ),
					'items' => array(
						'page_about'   => array(
							'type'      => 'post_type',
							'object'    => 'page',
							'object_id' => '{{about}}',
						),
						'page_donate'  => array(
							'type'      => 'post_type',
							'object'    => 'page',
							'object_id' => '{{donate}}',
						),
						'page_contact' => array(
							'type'      => 'post_type',
							'object'    => 'page',
							'object_id' => '{{contact}}',
						),
					),
				),
			),

			/*
			 * Widget keys are namespaced on purpose. Core reserves several of
			 * them for its own starter widgets (text_about, text_business_info
			 * and the rest) and merges a theme's array *into* its own, which for
			 * a numerically-indexed widget definition appends rather than
			 * overrides — so a theme reusing one of those names silently ships
			 * core's placeholder text instead of its own.
			 */
			'widgets'    => array(
				'sidebar-1' => array( 'search', 'recent-posts', 'categories' ),
				'footer-1'  => array(
					'text_sindoor_valour_intro' => array(
						'text',
						array(
							'title' => _x( 'About the trust', 'Theme starter content', 'sindoor-valour' ),
							'text'  => _x( 'Education, medical aid, skilling and entitlements assistance for veterans, war widows and the families of serving personnel.', 'Theme starter content', 'sindoor-valour' ),
						),
					),
				),
				'footer-2'  => array( 'recent-posts' ),
				'footer-3'  => array(
					'text_sindoor_valour_office' => array(
						'text',
						array(
							'title' => _x( 'Office', 'Theme starter content', 'sindoor-valour' ),
							'text'  => _x( 'Replace this with your address, helpline number and office hours.', 'Theme starter content', 'sindoor-valour' ),
						),
					),
				),
			),
		)
	);
}
add_action( 'after_setup_theme', 'sindoor_valour_starter_content' );

/**
 * Gives the starter-content events their dates once the Customizer is published.
 *
 * Starter content cannot carry post meta, so an event created that way would
 * arrive with no date and fall back to its publish date — every event dated
 * today, under a heading that says "Upcoming". This stamps the intended dates
 * on afterwards.
 *
 * It only ever touches a post that carries core's own `_customize_changeset_uuid`
 * marker for the changeset being published AND has no date of its own, so an
 * event the user typed themselves is never modified.
 *
 * @since 1.1.0
 *
 * @param WP_Customize_Manager $manager Customizer manager.
 * @return void
 */
function sindoor_valour_date_starter_events( $manager ) {
	if ( ! method_exists( $manager, 'changeset_uuid' ) ) {
		return;
	}

	$events = get_posts(
		array(
			'post_type'        => 'sv-event',
			'post_status'      => 'publish',
			'posts_per_page'   => 20,
			'no_found_rows'    => true,
			'suppress_filters' => false,
			'meta_key'         => '_customize_changeset_uuid', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Core's own marker is the only way to tell a starter-content post apart.
			'meta_value'       => $manager->changeset_uuid(), // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- See above.
		)
	);

	if ( empty( $events ) ) {
		return;
	}

	$definitions = sindoor_valour_demo_definitions();
	$by_title    = array();

	foreach ( $definitions['events'] as $event ) {
		$by_title[ $event['title'] ] = $event;
	}

	foreach ( $events as $event ) {
		if ( get_post_meta( $event->ID, '_sindoor_valour_event_date', true ) ) {
			continue;
		}

		if ( ! isset( $by_title[ $event->post_title ] ) ) {
			continue;
		}

		$definition = $by_title[ $event->post_title ];
		$timestamp  = strtotime( $definition['offset'] );

		if ( false === $timestamp ) {
			continue;
		}

		update_post_meta( $event->ID, '_sindoor_valour_event_date', gmdate( 'Y-m-d', $timestamp ) );
		update_post_meta( $event->ID, '_sindoor_valour_event_location', $definition['location'] );
	}
}
add_action( 'customize_save_after', 'sindoor_valour_date_starter_events' );
