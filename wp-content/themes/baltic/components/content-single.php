<?php
/**
 * Content single
 *
 * @package Baltic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-inner">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title"><span class="screen-reader-text">', '</span></h1>' ); ?>
			<div class="entry-meta">
			<?php
			get_template_part( 'components/meta', 'posted_on' );
			get_template_part( 'components/meta', 'posted_by' );
			get_template_part( 'components/meta', 'comments' );
			?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
		<?php get_template_part( 'components/post', 'content' );?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
			get_template_part( 'components/meta', 'categories' );
			get_template_part( 'components/meta', 'tags' );
			get_template_part( 'components/meta', 'edit_link' );
			?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
