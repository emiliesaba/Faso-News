<?php
/**
 * Product extra button
 *
 * @package Baltic
 */
if ( ! defined( 'YITH_WCWL' ) && false === Baltic\Options::get_option( 'product__quick-view' ) ) {
    return;
}
?>
<div class="baltic-extra-button">
	<ul>
		<?php if( defined( 'YITH_WCWL' ) ) :?>
		<li>
			<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );?>
		</li>
		<?php endif;?>
		<?php if( Baltic\Options::get_option( 'product__quick-view' ) === true ) : ?>
			<li>
				<a href="<?php the_permalink( get_the_id() );?>" class="extra-button baltic-quick-view-button" title="<?php esc_html_e( 'Quick View', 'baltic' );?>" data-product_id="<?php echo get_the_ID();?>">
					<?php Baltic\Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'search' ] ); ?>
				</a>
			</li>
		<?php endif;?>
	</ul>
</div>
