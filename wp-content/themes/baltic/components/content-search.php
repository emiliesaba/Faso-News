<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-inner">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				get_template_part( 'components/meta', 'posted_on' );
				get_template_part( 'components/meta', 'posted_by' );
				get_template_part( 'components/meta', 'comments' );
				?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

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
