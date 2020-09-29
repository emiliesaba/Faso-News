<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-inner">

		<?php get_template_part( 'components/post', 'thumbnail' );?>

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
			?>
				<div class="entry-meta">
					<?php
					get_template_part( 'components/meta', 'posted_on' );
					get_template_part( 'components/meta', 'posted_by' );
					get_template_part( 'components/meta', 'comments' );
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php get_template_part( 'components/post', 'content' );?>
		</div><!-- .entry-content -->

		<?php if ( 'post' === get_post_type() ) :?>
		<footer class="entry-footer">
			<?php
			get_template_part( 'components/meta', 'categories' );
			get_template_part( 'components/meta', 'tags' );
			get_template_part( 'components/meta', 'edit_link' );
			?>
		</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
