<?php
/**
 * Custom template tags for this theme.
 *
 * Every function here echoes escaped output and is safe to call from a
 * template without further escaping.
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'sindoor_valour_posted_on' ) ) {
	/**
	 * Prints the publication date of the current post.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function sindoor_valour_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%s</span>',
			sprintf(
				/* translators: %s: Post date. */
				esc_html__( 'Published %s', 'sindoor-valour' ),
				// Already escaped piece by piece above.
				$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			)
		);
	}
}

if ( ! function_exists( 'sindoor_valour_posted_by' ) ) {
	/**
	 * Prints the author of the current post, linked to the author archive.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function sindoor_valour_posted_by() {
		printf(
			'<span class="byline">%1$s <a class="url fn n" href="%2$s">%3$s</a></span>',
			esc_html__( 'By', 'sindoor-valour' ),
			esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
}

if ( ! function_exists( 'sindoor_valour_entry_footer' ) ) {
	/**
	 * Prints categories, tags and the comment link for the current post.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function sindoor_valour_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$categories = get_the_category_list( esc_html__( ', ', 'sindoor-valour' ) );

			if ( $categories ) {
				printf(
					'<span class="cat-links">%1$s %2$s</span>',
					esc_html__( 'Filed under:', 'sindoor-valour' ),
					wp_kses_post( $categories )
				);
			}

			$tags = get_the_tag_list( '', esc_html__( ', ', 'sindoor-valour' ) );

			if ( $tags ) {
				printf(
					'<span class="tags-links">%1$s %2$s</span>',
					esc_html__( 'Tagged:', 'sindoor-valour' ),
					wp_kses_post( $tags )
				);
			}
		}

		if ( ! is_single() || post_password_required() || ! ( comments_open() || get_comments_number() ) ) {
			return;
		}

		echo '<span class="comments-link">';
		comments_popup_link(
			esc_html__( 'Leave a message', 'sindoor-valour' ),
			esc_html__( '1 message', 'sindoor-valour' ),
			esc_html__( '% messages', 'sindoor-valour' )
		);
		echo '</span>';
	}
}

if ( ! function_exists( 'sindoor_valour_post_thumbnail' ) ) {
	/**
	 * Prints the featured image, linked on archives and plain on singular views.
	 *
	 * @since 1.0.0
	 *
	 * @param string $size Optional. Registered image size. Default 'large'.
	 * @return void
	 */
	function sindoor_valour_post_thumbnail( $size = 'large' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$attributes = array( 'loading' => 'lazy' );

		if ( is_singular() ) {
			?>
			<figure class="post-thumbnail">
				<?php the_post_thumbnail( $size, $attributes ); ?>
			</figure>
			<?php
			return;
		}
		?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( $size, $attributes ); ?>
		</a>
		<?php
	}
}

if ( ! function_exists( 'sindoor_valour_read_more_link' ) ) {
	/**
	 * Prints a "read more" link that names the post it leads to.
	 *
	 * A bare "Read more" is useless to anyone tabbing through links, so the
	 * post title travels with it for screen readers.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function sindoor_valour_read_more_link() {
		printf(
			'<a class="sv-more-link" href="%1$s">%2$s<span class="screen-reader-text"> %3$s</span> <span aria-hidden="true">&rarr;</span></a>',
			esc_url( get_permalink() ),
			esc_html__( 'Read more', 'sindoor-valour' ),
			esc_html( get_the_title() )
		);
	}
}

if ( ! function_exists( 'sindoor_valour_archive_breadcrumb' ) ) {
	/**
	 * Prints a minimal "Home / current page" trail.
	 *
	 * Deliberately simple: it never queries, and it never guesses a hierarchy
	 * the site has not actually got.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function sindoor_valour_archive_breadcrumb() {
		if ( is_front_page() ) {
			return;
		}

		$current = '';

		if ( is_home() ) {
			$current = get_the_title( (int) get_option( 'page_for_posts' ) );
		} elseif ( is_singular() ) {
			$current = get_the_title();
		} elseif ( is_search() ) {
			$current = esc_html__( 'Search results', 'sindoor-valour' );
		} elseif ( is_404() ) {
			$current = esc_html__( 'Page not found', 'sindoor-valour' );
		} elseif ( is_archive() ) {
			$current = wp_strip_all_tags( get_the_archive_title() );
		}

		if ( '' === $current ) {
			return;
		}
		?>
		<nav class="sv-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sindoor-valour' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sindoor-valour' ); ?></a>
			<span aria-hidden="true"> / </span>
			<span><?php echo esc_html( $current ); ?></span>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'sindoor_valour_event_date_badge' ) ) {
	/**
	 * Prints the day/month badge used in event listings.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Optional. Event post ID. Default current post.
	 * @return void
	 */
	function sindoor_valour_event_date_badge( $post_id = 0 ) {
		$post_id   = $post_id ? (int) $post_id : get_the_ID();
		$timestamp = sindoor_valour_get_event_timestamp( $post_id );
		$is_past   = $timestamp < current_time( 'timestamp' ); // phpcs:ignore WordPress.DateTime.CurrentTimeTimestamp.Requested
		?>
		<div class="sv-event__date<?php echo $is_past ? ' sv-event__date--past' : ''; ?>">
			<span class="sv-event__day"><?php echo esc_html( wp_date( 'j', $timestamp ) ); ?></span>
			<span class="sv-event__month"><?php echo esc_html( wp_date( 'M', $timestamp ) ); ?></span>
		</div>
		<?php
	}
}

if ( ! function_exists( 'sindoor_valour_get_event_timestamp' ) ) {
	/**
	 * Returns an event's start time, falling back to its publish date.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Event post ID.
	 * @return int Unix timestamp.
	 */
	function sindoor_valour_get_event_timestamp( $post_id ) {
		$stored = get_post_meta( (int) $post_id, '_sindoor_valour_event_date', true );

		if ( is_string( $stored ) && '' !== $stored ) {
			$timestamp = strtotime( $stored );

			if ( false !== $timestamp ) {
				return $timestamp;
			}
		}

		return (int) get_post_time( 'U', true, $post_id );
	}
}

if ( ! function_exists( 'sindoor_valour_donate_url' ) ) {
	/**
	 * Where the donate buttons point.
	 *
	 * The Customizer field wins. When it is empty — which it is on a site that
	 * has just been set up — the theme finds the page using the Donation Page
	 * template instead, so the header button and both calls to action work
	 * without anyone having to paste a URL anywhere.
	 *
	 * @since 1.1.0
	 *
	 * @return string URL, or an empty string when there is nothing to link to.
	 */
	function sindoor_valour_donate_url() {
		$configured = sindoor_valour_get_option( 'cta_button_url' );

		if ( $configured ) {
			return $configured;
		}

		$configured = sindoor_valour_get_option( 'header_cta_url' );

		if ( $configured ) {
			return $configured;
		}

		$pages = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'no_found_rows'  => true,
				'fields'         => 'ids',
				'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- The page template is only queryable through its meta.
				'meta_value'     => 'page-templates/template-donate.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- See above.
			)
		);

		if ( empty( $pages ) ) {
			return '';
		}

		return (string) get_permalink( (int) $pages[0] );
	}
}

if ( ! function_exists( 'sindoor_valour_programmes_url' ) ) {
	/**
	 * Where the hero's secondary button points.
	 *
	 * @since 1.1.0
	 *
	 * @return string URL, or an empty string when there is nothing to link to.
	 */
	function sindoor_valour_programmes_url() {
		$configured = sindoor_valour_get_option( 'hero_secondary_url' );

		if ( $configured ) {
			return $configured;
		}

		if ( ! post_type_exists( 'sv-programme' ) ) {
			return '';
		}

		return (string) get_post_type_archive_link( 'sv-programme' );
	}
}
