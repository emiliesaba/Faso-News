<?php
/**
 * Quick view
 *
 * @package Baltic
 */

namespace Baltic\Connect\Woo;

use Baltic\Instance;
use Baltic\Icons;
use Baltic\Options;

class Quick_View {

	use Instance;

	/**
	 * Constructor
	 */
	public function __construct() {

		if( false === Options::get_option( 'product__quick-view' ) ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', 	array( $this, 'scripts' ) );

		add_action( 'baltic_after', array( $this, 'container' ) );
		add_action( 'wp_footer', 'woocommerce_photoswipe' );

		// Image
		add_action( 'baltic_woo_product_image', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'baltic_woo_product_image', 'woocommerce_show_product_images', 20 );

		// Summary
		add_action( 'baltic_woo_product_summary', 'woocommerce_template_single_title', 5 );
		add_action( 'baltic_woo_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'baltic_woo_product_summary', 'woocommerce_template_single_price', 15 );
		add_action( 'baltic_woo_product_summary', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'baltic_woo_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		add_action( 'baltic_woo_product_summary', 'woocommerce_template_single_meta', 30 );

	}

	/**
	 * [scripts description]
	 *
	 * @return [type] [description]
	 */
	public function scripts() {

		wp_enqueue_script( 'zoom' );
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'photoswipe-ui-default' );
		wp_enqueue_style(  'photoswipe-default-skin' );
		wp_enqueue_script( 'wc-single-product' );
		wp_enqueue_script( 'wc-add-to-cart-variation' );

	}

	/**
	 * [container description]
	 * @return [type] [description]
	 */
	public function container() {
		wc_get_template( 'quick-view-container.php' );
	}

}
