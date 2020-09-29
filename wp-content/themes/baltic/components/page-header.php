<?php
/**
 * Page Header
 *
 * @package Baltic
 */
?>
<div id="page-header" class="page-header">
	<div class="container">
		<div class="page-header-inner">
			<?php

			if ( is_archive() ) {

				echo sprintf( '<h1 class="page-header-title">%s</h1>',
					wp_kses_post( get_the_archive_title() )
				);

				$description = get_the_archive_description();

				if ( ! empty( $description ) ) {
					echo sprintf( '<div class="page-header-description">%s</div>',
						wp_kses_post( wpautop( get_the_archive_description() ) )
					);
				}

				if ( get_queried_object() ) {
					$term_id 	= get_queried_object()->term_id;
					$image_id 	= get_term_meta( $term_id, 'image', true );
					$image 		= wp_get_attachment_image_src( $image_id, 'full' );
					if ( ! empty( $image_id ) ) {
						echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image[0] ) );
					}
				}

			} elseif( is_search() ) {

				$blog_id = get_option( 'page_for_posts' );
				$image = get_the_post_thumbnail_url( $blog_id, 'full' );

				echo sprintf( '<h1 class="page-header-title">%s</h1>',
					/* translators: %s: Search query */
					sprintf( esc_html__( 'Search Results for: %s', 'baltic' ), '<span>' . get_search_query() . '</span>' )
				);

				if ( has_post_thumbnail( $blog_id ) ) {
					echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
				}

			} elseif ( get_option( 'page_for_posts' ) && is_home() ) {

				$blog_id = get_option( 'page_for_posts' );
				$image = get_the_post_thumbnail_url( $blog_id, 'full' );

				echo sprintf( '<h1 class="page-header-title">%s</h1>',
					get_the_title( absint( $blog_id ) )
				);

				$excerpt = get_post_field( 'post_content', absint( $blog_id ) );
				if ( ! empty( $excerpt ) ) {
					echo sprintf( '<div class="page-header-description">%s</div>',
						wp_kses_post( wpautop( get_post_field( 'post_content', absint( $blog_id ) ) ) )
					);
				}

				if ( has_post_thumbnail( $blog_id ) ) {
					echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
				}

			} elseif ( is_attachment() ) {

				if ( wp_attachment_is_image( get_the_ID() ) ) {
					$image = wp_get_attachment_image_src( get_the_id(), 'full' );
					$image = $image[0];
				} else {
					$image = get_the_post_thumbnail_url( get_the_id(), 'full' );
				}

				echo sprintf( '<p class="page-header-title">%s</p>',
					get_the_title( absint( get_the_id() ) )
				);

				if ( get_the_excerpt() ) {
					echo sprintf( '<div class="page-header-description">%s</div>',
						wp_kses_post( wpautop( get_the_excerpt() ) )
					);
				}

				if ( $image ) {
					echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
				}

			} elseif ( is_singular() ) {

				$image = get_the_post_thumbnail_url( get_the_id(), 'full' );

				echo sprintf( '<p class="page-header-title">%s</p>',
					get_the_title( absint( get_the_id() ) )
				);

				if ( has_post_thumbnail( get_the_id() ) ) {
					echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
				}

			}

			Baltic\Components::do_breadcrumb();

			?>
		</div><!-- .page-header-inner -->
	</div><!-- .container -->
</div><!-- #page-header -->
