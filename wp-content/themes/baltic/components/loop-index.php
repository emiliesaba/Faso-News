<?php
/**
 * Loop index
 *
 * @package Baltic
 */

if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		if ( is_search() ) {
			get_template_part( 'components/content', 'search' );
		} else {
			get_template_part( 'components/content', get_post_type() );
		}

	endwhile;

else :

	get_template_part( 'components/content', 'none' );

endif;
