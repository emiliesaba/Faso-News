<?php
/**
 * The template for displaying all single posts
 */
get_header(); ?>

<main id="main" role="main">
	<div class="container">
		<div class="row">
			<?php
		    $tijarat_business_layout_settings = get_theme_mod( 'tijarat_business_layout_settings', __('Right Sidebar','tijarat-business') );
			if($tijarat_business_layout_settings == 'Left Sidebar'){ ?>
			    <div id="sidebox" class="col-lg-4 col-md-4">
					<?php dynamic_sidebar('sidebox-1'); ?>
				</div>
				<div class="col-lg-8 col-md-8">
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post(); 

							get_template_part( 'template-parts/post/single-post' );
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();

							endif;

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tijarat-business' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tijarat-business' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );

							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'tijarat-business' ) . '</span>',
								'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'tijarat-business' ) . '</span>',
							) );

						endwhile; // End of the loop.

					?>
				</div>
			<?php }else if($tijarat_business_layout_settings == 'Right Sidebar'){ ?>
				<div class="col-lg-8 col-md-8">
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post(); 

							get_template_part( 'template-parts/post/single-post' ); 
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tijarat-business' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tijarat-business' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );

							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'tijarat-business' ) . '</span>',
								'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'tijarat-business' ) . '</span>',
							) );

						endwhile; // End of the loop.

					?>
				</div>
				<div id="sidebox" class="col-lg-4 col-md-4">
					<?php dynamic_sidebar('sidebox-1'); ?>
				</div>
			<?php }else if($tijarat_business_layout_settings == 'One Column'){ ?>
				<div class="col-lg-12 col-md-12">
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post(); 

							get_template_part( 'template-parts/post/single-post' ); 
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tijarat-business' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tijarat-business' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );

							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'tijarat-business' ) . '</span>',
								'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'tijarat-business' ) . '</span>',
							) );

						endwhile; // End of the loop.

					?>
				</div>
			<?php }else if($tijarat_business_layout_settings == 'Grid Layout'){ ?>
				<div class="col-lg-8 col-md-8">
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post(); 

							get_template_part( 'template-parts/post/single-post' ); // If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tijarat-business' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tijarat-business' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );

							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'tijarat-business' ) . '</span>',
								'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'tijarat-business' ) . '</span>',
							) );

						endwhile; // End of the loop.

					?>
				</div>
				<div id="sidebox" class="col-lg-4 col-md-4">
					<?php dynamic_sidebar('sidebox-1'); ?>
				</div>
			<?php }else {?>
				<div class="col-lg-8 col-md-8">
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post(); 

							get_template_part( 'template-parts/post/single-post' ); 
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tijarat-business' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tijarat-business' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );

							the_post_navigation( array(
								'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'tijarat-business' ) . '</span>',
								'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'tijarat-business' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'tijarat-business' ) . '</span>',
							) );

						endwhile; // End of the loop.

					?>
				</div>
				<div id="sidebox" class="col-lg-4 col-md-4">
					<?php dynamic_sidebar('sidebox-1'); ?>
				</div>
			<?php }?>
		</div>
	</div>
</main>

<?php get_footer();
