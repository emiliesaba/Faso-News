<?php
/**
 * loop single
 *
 * @package Baltic
 */

while ( have_posts() ) :
	the_post();

	if ( is_singular( 'page' ) ) {
		get_template_part( 'components/content', 'page' );
	} elseif( is_attachment() ) {
		get_template_part( 'components/content', 'attachment' );
	} elseif ( is_singular() ) {
		get_template_part( 'components/content', 'single' );
		if( is_singular( 'post' ) && Baltic\Options::get_option( 'author_profile' ) ) {
			get_template_part( 'components/author', 'biography' );
		}
		get_template_part( 'components/nav', 'singular' );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
