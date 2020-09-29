<?php
/**
 * Header extra
 *
 * @package Baltic
 */
?>
<div id="site-header-extra" class="site-header-extra">
	<ul>
		<?php if( defined( 'YITH_WCWL' ) ) : ?>
		<li>
			<a href="<?php the_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) );?>" title="<?php esc_html_e( 'Wishlist', 'baltic' );?>" id="site-header-extra-wishlist" class="site-header-extra-wishlist">
				<?php Baltic\Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'heart' ] );?> <span class="total hide">0</span>
			</a>
		</li>
		<?php endif;?>
		<li>
			<a href="<?php the_permalink( wc_get_page_id( 'cart' ) );?>" title="<?php echo esc_html__( 'Cart', 'baltic' );?>" id="site-header-extra-cart-link" class="site-header-extra-cartlink">
				<?php Baltic\Connect\Woo\Template::cart_link();?>
			</a>
		</li>
	</ul>
</div><!-- .site-header-extra -->
