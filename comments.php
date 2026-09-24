<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both
 * the current comments and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered it, return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$sindoor_valour_comment_count = get_comments_number();

			if ( '1' === $sindoor_valour_comment_count ) {
				esc_html_e( 'One message', 'sindoor-valour' );
			} else {
				printf(
					/* translators: %s: Comment count number. */
					esc_html( _nx( '%s message', '%s messages', $sindoor_valour_comment_count, 'comments title', 'sindoor-valour' ) ),
					esc_html( number_format_i18n( $sindoor_valour_comment_count ) )
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Messages are closed.', 'sindoor-valour' ); ?></p>
			<?php
		endif;

	endif;

	comment_form(
		array(
			'title_reply'       => esc_html__( 'Leave a message', 'sindoor-valour' ),
			/* translators: %s: Author of the comment being replied to. */
			'title_reply_to'    => esc_html__( 'Reply to %s', 'sindoor-valour' ),
			'cancel_reply_link' => esc_html__( 'Cancel reply', 'sindoor-valour' ),
			'label_submit'      => esc_html__( 'Post message', 'sindoor-valour' ),
			'comment_field'     => sprintf(
				'<p class="comment-form-comment"><label for="comment">%1$s</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>',
				esc_html__( 'Message', 'sindoor-valour' )
			),
		)
	);
	?>

</div><!-- #comments -->
