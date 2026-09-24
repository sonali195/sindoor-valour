<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#404-not-found
 *
 * @package Sindoor_Valour
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="sv-page-header">
	<div class="sv-container">
		<?php sindoor_valour_archive_breadcrumb(); ?>
		<h1 class="page-title"><?php esc_html_e( 'That page could not be found', 'sindoor-valour' ); ?></h1>
		<p><?php esc_html_e( 'The page may have been moved, or the address may have a typo in it.', 'sindoor-valour' ); ?></p>
	</div>
</div>

<div class="sv-container">
	<div class="sv-content-area">
		<main id="primary" class="site-main">
			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php esc_html_e( 'Try a search, or start again from the home page.', 'sindoor-valour' ); ?></p>

					<?php get_search_form(); ?>

					<p>
						<a class="sv-button sv-button--olive" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php esc_html_e( 'Go to the home page', 'sindoor-valour' ); ?>
						</a>
					</p>
				</div>
			</section>
		</main>
	</div>
</div>

<?php
get_footer();
