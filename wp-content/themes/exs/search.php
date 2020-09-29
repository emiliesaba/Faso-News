<?php
/**
 * The search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$exs_special_cats = exs_get_special_categories_from_options();
$exs_show_title   = ! exs_option( 'title_show_title', '' ) && get_the_title();


get_header();

?>
	<div id="layout" class="layout-search">
		<?php if ( ! empty( $exs_show_title ) ) : ?>
			<h1><?php get_template_part( 'template-parts/title/title-text' ); ?></h1>
			<?php
		endif; //show_title

		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) :
				the_post();
				if ( 'product' === get_post_type() && function_exists( 'wc_get_template' ) ) :
					?>
					<div class="woo woocommerce columns-1">
						<ul class="products search-results">
						<?php
							wc_get_template( 'content-product.php' );
						?>
						</ul>
					</div>
					<?php
				else :
					?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php

					the_title( '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></header>' );

					if (
						'post' === get_post_type()
						&&
						//exclude special categories
						! in_category( $exs_special_cats, get_the_ID() )
					) :
						?>
						<footer class="entry-footer"><?php exs_entry_meta(); ?></footer><!-- .entry-footer -->
						<?php
					endif; //'post'

					the_excerpt();
					?>
				</article><!-- #post-<?php the_ID(); ?> -->
					<?php
				endif;
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination(
				exs_get_the_posts_pagination_atts()
			);

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content', 'none' );

		}
		?>
	</div><!-- #layout -->
<?php

get_footer();
