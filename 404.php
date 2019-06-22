<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Petals
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'petals' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'petals' ); ?></p>

					<?php get_search_form(); ?>
					<div class="error-widgets">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					
					<?php
					/* translators: %1$s: smiley */
					$petals_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'petals' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$petals_archive_content" );
					?>
					</div><!-- .error-widgets -->
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
