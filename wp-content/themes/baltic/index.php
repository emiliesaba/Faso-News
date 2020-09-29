<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

get_header();
do_action( 'baltic_content_area_before' );?>
<div id="primary" class="content-area">
	<?php do_action( 'baltic_site_main_before' );?>
	<main id="main" class="site-main">
		<?php do_action( 'baltic_site_main' );?>
	</main><!-- #main -->
	<?php do_action( 'baltic_site_main_after' );?>
</div><!-- #primary -->
<?php do_action( 'baltic_content_area_after' );
get_footer();
