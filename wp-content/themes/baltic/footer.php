<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baltic
 */

?>
		<?php do_action( 'baltic_site_content_bottom' );?>
	</div><!-- #content -->
	<?php do_action( 'baltic_footer_before'); ?>
	<footer id="colophon" class="site-footer">
		<?php do_action( 'baltic_footer');?>
	</footer><!-- #colophon -->
	<?php do_action( 'baltic_footer_after');?>
</div><!-- #page -->
<?php
do_action( 'baltic_after' );
wp_footer(); ?>

</body>
</html>
