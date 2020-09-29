<?php
/**
 * Attachment template
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
			<?php
			if ( wp_attachment_is_image( get_the_ID() ) ) {
				echo wp_get_attachment_image( get_the_ID(), 'full' );
				echo wp_kses_post( wpautop( get_the_content() ) );
			} else {
				the_content();
			}
			?>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php get_template_part( 'components/meta', 'edit_link' );?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div><!-- .entry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
