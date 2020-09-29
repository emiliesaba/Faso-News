<?php
/**
 * Quick view template.
 *
 * @package Baltic
 */

?>
<div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>
	<?php do_action( 'baltic_woo_product_image' ); ?>
	<div class="summary entry-summary">
		<div class="summary-content">
			<?php do_action( 'baltic_woo_product_summary' ); ?>
		</div>
	</div>
</div>
