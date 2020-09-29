<?php
/**
 * WooCommerce setup
 *
 * @package Baltic
 */

namespace Baltic\Connect\Woo;

use Baltic\Instance;
use Baltic\Layout;
use Baltic\Options;
use Baltic\Utils;

class Setup {

	use Instance;

	private $suffix;

	public function __construct() {

		$this->suffix 	= Utils::get_min_suffix();

		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		add_action( 'after_setup_theme', 						[ $this, 'setup' ] );
		add_action( 'wp_enqueue_scripts', 						[ $this, 'scripts' ] );
		add_filter( 'baltic_inline_style', 						[ $this, 'inline_style' ] );

		add_filter( 'loop_shop_per_page', 						[ $this, 'products_per_page' ] );
		add_filter( 'loop_shop_columns', 						[ $this, 'loop_columns' ] );
		add_filter( 'woocommerce_product_thumbnails_columns', 	[ $this, 'thumbnail_columns' ] );
		add_filter( 'woocommerce_output_related_products_args', [ $this, 'related_products_args' ] );
		add_filter( 'woocommerce_upsell_display_args', 			[ $this, 'related_products_args' ] );

		add_filter( 'post_type_archive_title', [ $this, 'breadcrumb_archive_title' ], 10, 2 );

		Template::instance();
		Thumbnail::instance();
		Quick_View::instance();

	}

	/**
	 * Theme support.
	 *
	 * @return void
	 */
	public function setup() {

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

	}

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @return void
	 */
	public function scripts() {

		$rtl = ( is_rtl() ) ? '-rtl' : '';

		wp_enqueue_style( "baltic-woocommerce-style{$rtl}",
			BALTIC_URI . "/assets/css/woocommerce{$rtl}{$this->suffix}.css"
		);

	}

	/**
	 * Print inline styles.
	 *
	 * @param  string $css inline style
	 * @return string
	 */
	public function inline_style( $css ) {

		$font_path   	= WC()->plugin_url() . '/assets/fonts/';
		$images_path 	= WC()->plugin_url() . '/assets/images/';

		$css .= '
			@font-face {
				font-family: "star";
				src: url("' . $font_path . 'star.eot");
				src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
					url("' . $font_path . 'star.woff") format("woff"),
					url("' . $font_path . 'star.ttf") format("truetype"),
					url("' . $font_path . 'star.svg#star") format("svg");
				font-weight: normal;
				font-style: normal;
			}
		';

		return $css;

	}

	/**
	 * Products per page.
	 *
	 * @return integer number of products.
	 */
	public function products_per_page() {
		return absint( Options::get_option( 'products__per-page' ) );
	}

	/**
	 * Default loop columns on product archives.
	 *
	 * @return integer products per row.
	 */
	public function loop_columns() {
		$col = Options::get_option( 'products__columns' );
		return absint( $col['desktop'] );
	}

	/**
	 * Product gallery thumnbail columns.
	 *
	 * @return integer number of columns.
	 */
	public function thumbnail_columns() {
		return 4;
	}

	/**
	 * Related Products Args.
	 *
	 * @param array $args related products args.
	 * @return array $args related products args.
	 */
	public function related_products_args( $args ) {

		$defaults = [
			'posts_per_page' => 4,
			'columns'        => 4,
		];

		$args = wp_parse_args( $defaults, $args );

		return $args;

	}

	/**
	 * Set shop page title as post type archive title.
	 *
	 * @param  [type] $label [description]
	 * @param  [type] $title [description]
	 * @return void
	 */
	function breadcrumb_archive_title( $label, $title ) {

		$shop_id 	= wc_get_page_id( 'shop' );
		$shop_title = get_the_title( $shop_id );

		if ( is_post_type_archive( 'product') && get_option( 'page_on_front' ) !== wc_get_page_id( 'shop' ) ) {
			$title = $shop_title;
		} elseif ( is_woocommerce() ) {
			$title = $shop_title;
		}

		return $title;

	}

}
