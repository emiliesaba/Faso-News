<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baltic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-inner">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title"><span class="screen-reader-text">', '</span></h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php get_template_part( 'components/post', 'content' );?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php get_template_part( 'components/meta', 'edit_link' );?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
