<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Baltic
 */

add_filter( 'baltic_site_layout', [ 'Baltic\Layout', 'get_narrow' ] );
get_header();
?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">

				<header class="404-header">
					<h1 class="404-title"><?php esc_html_e( 'Error 404.', 'baltic' ); ?></h1>
				</header><!-- .page-header -->

				<div class="404-content">
					<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found. It looks like nothing was found at this location.', 'baltic' ); ?></p>
					<p><a href="<?php echo esc_url( home_url('/') ) ;?>" class="button"><?php esc_html_e( 'Back to Homepage', 'baltic' );?></a></p>
				</div><!-- .page-content -->

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php
get_footer();
