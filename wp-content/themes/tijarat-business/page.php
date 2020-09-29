<?php
/**
 * The template for displaying all pages
 */
get_header(); ?>

<main id="main" role="main">
	<?php do_action( 'tijarat_business_page_header' ); ?>
	<div class="container">
		<?php
			while ( have_posts() ) : the_post();?>
	            <?php the_post_thumbnail(); ?>
				<h1><?php the_title();?></h1>
				<div class="text"><p><?php the_content(); ?></p></div>
				
				<?php
			        // If comments are open or we have at least one comment, load up the comment template.
			        if ( comments_open() || get_comments_number() ) {
			            comments_template();
			        }
			    ?>

			<?php endwhile; // End of the loop.

		wp_reset_postdata(); ?>
	</div>
</main>

	<?php do_action( 'tijarat_business_page_footer' ); ?>

	<?php get_footer();
