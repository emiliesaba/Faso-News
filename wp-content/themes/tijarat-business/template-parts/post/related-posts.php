<?php 
if ( ! function_exists( 'tijarat_business_related_posts_function' ) ) {
	function tijarat_business_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'    => absint( get_theme_mod( 'tijarat_business_change_related_posts_number', '3' ) ),
		);
		// Related by categories
		if ( get_theme_mod( 'tijarat_business_show_related_post', 'categories' ) == 'categories' ) {

			$cats = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $cats ) {
				$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( get_theme_mod( 'tijarat_business_show_related_post', 'categories' ) == 'tags' ) {

			$tags = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $tags ) {
				$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode( ',', $tags );
			}
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}
}

$related_posts = tijarat_business_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="related-posts clearfix">
		<?php if ( get_theme_mod('tijarat_business_change_related_post_title','Related Posts') != '' ) {?>
			<h2 class="related-posts-main-title"><?php echo esc_html( get_theme_mod('tijarat_business_change_related_post_title',__('Related Posts','tijarat-business')) ); ?></h2>
		<?php }?>
		<div class="row">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="col-lg-4 col-md-4">
					<article class="page-box">
						<div class="category">
						  	<a href="<?php echo esc_url( get_permalink() ); ?>"><?php foreach((get_the_category()) as $category) { echo esc_html($category->cat_name) . ' '; } ?></a>
						</div>
						<h3><a href="<?php echo esc_url( get_permalink() );  ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
						<div class="post-image">
						    <?php 
						      if(has_post_thumbnail()) { 
						        the_post_thumbnail(); 
						      }
						    ?>
					 	</div>
				        <?php if(get_the_excerpt()) { ?>
				            <div class="text"><p><?php $excerpt = get_the_excerpt(); echo esc_html( tijarat_business_string_limit_words( $excerpt, esc_attr(get_theme_mod('tijarat_business_excerpt_number','20')))); ?> <?php echo esc_html( get_theme_mod('tijarat_business_post_excerpt_suffix','{...}') ); ?></p></div>
				        <?php } ?>
					    <?php if( get_theme_mod('tijarat_business_button_text','Continue Reading....') != ''){ ?>
				      		<div class="post-link">
					        	<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html(get_theme_mod('tijarat_business_button_text','Continue Reading....'));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('tijarat_business_button_text','Continue Reading....'));?></span></a>
				      		</div>
					    <?php } ?>
					</article>
				</div> 
			<?php endwhile; ?>
		</div>

	</div><!--/.post-related-->
<?php endif; ?>

<?php wp_reset_postdata(); ?>