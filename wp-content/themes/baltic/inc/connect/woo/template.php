<?php
/**
 * WooCommerce template
 *
 * @package Baltic
 */

namespace Baltic\Connect\Woo;

use Baltic\Instance;
use Baltic\Icons;
use Baltic\Components;
use Baltic\Layout;
use Baltic\Options;

class Template {

	use Instance,
		Components;

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'baltic_header', [ __class__, 'extra_header'], 25 );
		add_filter( 'woocommerce_add_to_cart_fragments', [ __class__, 'cart_link_fragment' ] );
		add_action( 'baltic_header', [ __class__, 'extra_toggle'], 35 );

		$this->markup();
		$this->product_markup();
		add_action( 'admin_action_elementor', array( $this, 'register_wc_hooks' ), 9 );
		add_action( 'admin_action_elementor', array( $this, 'product_markup' ), 9 );

	}

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	/**
	 * Hooks products markup.
	 *
	 * @return void
	 */
	public function markup() {

		add_filter( 'wp_nav_menu_items', array( __class__, 'myaccount_menu' ), 10, 2 );

		/** Add archive page header */
		add_action( 'baltic_header_after', array( __class__, 'page_header' ), 50 );
		add_action( 'woocommerce_archive_description', array( __class__, 'page_header_thumbnail' ), 20 );

		/** Breadcrumb */
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		add_action( 'woocommerce_archive_description', [ __class__, 'do_breadcrumb' ], 20 );

		/** Wrap #primary and #secondary within container class */
		add_action( 'woocommerce_before_main_content', array( __class__, 'do_container_open' ), 5 );
		add_action( 'woocommerce_sidebar', array( __class__, 'do_container_close' ), 15 );

		/** Add primary main wrapper */
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( __class__, 'wrapper_before' ) );
		add_action( 'woocommerce_after_main_content', array( __class__, 'wrapper_after' ) );

		/** Remove WooCommerce Pagination*/
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

		/** Wrap result and sort within a div */
		add_action( 'woocommerce_before_shop_loop', array( __class__, 'result_wrap_open' ), 19 );
		add_action( 'woocommerce_before_shop_loop', array( __class__, 'result_wrap_close' ), 31 );

		/** Remove sidebar if full-width layout is selected */
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_action( 'woocommerce_sidebar', array( __class__, 'get_sidebar' ), 10 );

	}

	/**
	 * Hooks product markup.
	 *
	 * @return void.
	 */
	public function product_markup() {

		/** Add entry-inner inside li.product */
		add_action( 'woocommerce_before_shop_loop_item', array( __class__, 'entry_inner_open' ), 5 );
		add_action( 'woocommerce_after_shop_loop_item', array( __class__, 'entry_inner_close' ), 99 );

		/** Remove Onsale flash */
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

		/** Product thumbnail wrap */
		add_action( 'woocommerce_before_shop_loop_item', array( __class__, 'product_thumbnail_wrap_open' ), 7 );
		add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 9 );
		add_action( 'woocommerce_before_shop_loop_item', array( __class__, 'product_extra_buttons' ), 9 );
		add_action( 'woocommerce_before_shop_loop_item', array( __class__, 'product_thumbnail_wrap_close' ), 9 );

		/** Reposition rating */
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	}

	/**
	 * Extra header.
	 *
	 * @return void
	 */
	public static function extra_header() {
		wc_get_template( 'header-extra.php' );
	}

	public static function page_header() {
		if( is_woocommerce() ){
			wc_get_template( 'page-header.php' );
		}
	}

	public static function page_header_thumbnail() {

		$shop_id 	= wc_get_page_id( 'shop' );

	    if ( is_product_category() ){
		    global $wp_query;
		    $cat 		= $wp_query->get_queried_object();
		    $image_id 	= get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		    $image 		= wp_get_attachment_image_src( $image_id, 'full' );

		    if ( $image ) {
		    	echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image[0] ) );
			}

		} elseif ( is_shop() || ( is_post_type_archive( 'product' ) && is_search() ) ) {

			$image 		= get_the_post_thumbnail_url( $shop_id, 'full' );

			if ( $image ) {
				echo sprintf( '<div class="page-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
			}

		}

	}

	/**
	 * Cart link value.
	 *
	 * @return void
	 */
	public static function cart_link() {
	?>
	<div class="site-header-extra-value">
		<?php
		Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'cart' ] );

		if( \WC()->cart->get_cart_contents_count() !== 0 ) : ?>
			<span class="total">
				<?php echo wp_kses_data( \WC()->cart->get_cart_contents_count() );?>
			</span>
		<?php endif;?>
	</div>
	<?php
	}

	/**
	 * Cart link fragment.
	 *
	 * @uses  cart_link()
	 * @return void
	 */
	public static function cart_link_fragment( $fragments ) {
		ob_start();
		self::cart_link();
		$fragments['.site-header-extra-value'] = ob_get_clean();

		return $fragments;
	}

	/**
	 * [baltic_wc_header_cart description]
	 *
	 * @uses  is_checkout() [<description>]
	 * @uses  is_cart() [<description>]
	 * @uses  the_widget( $widget, $instance = array, $args = array ) [<description>]
	 * @return [type] [description]
	 */
	public static function extra_toggle() {
		if( is_cart() || is_checkout() ) {
			return;
		}
	?>
		<div id="site-header-extra-toggle" class="site-header-extra-toggle">
			<?php the_widget( 'WC_Widget_Cart', array( 'title' => '' ) );?>
		</div><!-- .site-header-cart -->
	<?php
	}

	/**
	 * Add list of account menu.
	 *
	 * @uses  wc_get_account_menu_items() [<description>]
	 * @return string html
	 */
	public static function endpoint_menu() {

		$menu_items = wc_get_account_menu_items();

		$myaccount_menu = '';

		foreach ( $menu_items as $endpoint => $label ) {
			$myaccount_menu .= sprintf( '<li class="menu-item"><a href="%s">%s</a></li>',
				esc_url( wc_get_account_endpoint_url( $endpoint ) ),
				esc_html( $label )
			);
		}

		return $myaccount_menu;

	}

	/**
	 * Add Login/ my account menu at menu-1
	 *
	 * @uses  Baltic_Icons::get_svg( array() )
	 * @return string html
	 */
	public static function myaccount_menu( $menu, $args ) {

		$args = (array)$args;

		if ( ! class_exists( 'WooCommerce' ) ) {
			return $menu;
		}

		if ( 'menu-1' !== $args['theme_location']  ){
			return $menu;
		}

		$toggle_menu = sprintf( '<button class="sub-menu-toggle" role="button" aria-expanded="false">%s%s</button>',
			Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'chevron-top' ) ),
			Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'chevron-bottom' ) ) );

		$icon = Icons::get_svg( array( 'class' => 'icon-stroke', 'icon' => 'user' ) );

		$myaccount_page = ( is_page( wc_get_page_id( 'myaccount' ) ) ) ? ' current-menu-item' : '';

		if ( is_user_logged_in() ) {
			$link = '
				<li class="menu-item menu-item-has-children menu-right'. esc_attr(  $myaccount_page ) .'">
					<a href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'">'. $icon . esc_html__( 'My Account', 'baltic' ) . $toggle_menu .'</a>
					<ul class="sub-menu">
						'. self::endpoint_menu() .'
					</ul>
				</li>'
			;
		} else {
			$link = '
				<li class="menu-item menu-right'. esc_attr(  $myaccount_page ) .'">
					<a href="'. get_permalink( wc_get_page_id( 'myaccount' ) ) .'">'. $icon . esc_html__( 'Login', 'baltic' ) .'</a>
				</li>'
			;
		}

		return $menu . $link;

	}

	/**
	 * Jumbotron header for WooCommerce page.
	 *
	 * @return string html
	 */
	public static function jumbotron_header(){
	?>
	    <header class="jumbotron-header woocommerce-products-header">
	    	<div class="container">
				<div class="jumbotron-header-inner">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

						<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

					<?php endif; ?>

					<?php
						/**
						 * woocommerce_archive_description hook.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
					?>
				</div><!-- .jumbotron-header-inner -->
			</div><!-- .container -->
	    </header><!-- .jumbotron-header -->
	<?php
	}

	/**
	 * Archive thumbnail that hooked to jumbotron header.
	 *
	 * @return string html
	 */
	public static function archive_thumbnail(){

		$shop_id 	= wc_get_page_id( 'shop' );

	    if ( is_product_category() ){
		    global $wp_query;
		    $cat 		= $wp_query->get_queried_object();
		    $image_id 	= get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		    $image 		= wp_get_attachment_image_src( $image_id, 'full' );

		    if ( $image ) {
		    	echo sprintf( '<div class="jumbotron-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image[0] ) );
			}

		} elseif ( is_shop() || ( is_post_type_archive( 'product' ) && is_search() ) ) {

			$image 		= get_the_post_thumbnail_url( $shop_id, 'full' );

			if ( $image ) {
				echo sprintf( '<div class="jumbotron-header-thumbnail" style="background-image:url(%s)" ></div>', esc_url( $image ) );
			}

		}

	}

	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	public static function wrapper_before() {
		?>
		<div id="primary" class="content-area is-woocommerce">
			<main id="main" class="site-main woocommerce" role="main">
		<?php
	}


	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	public static function wrapper_after() {
		?>
			</main><!-- #main -->
			<?php get_template_part( 'components/nav', 'products' );?>
		</div><!-- #primary -->
		<?php
	}

	/**
	 * Result count wrapper open.
	 *
	 * @return string html
	 */
	public static function result_wrap_open(){
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		echo '<div class="result-count-wrap clear">';
	}

	/**
	 * Result count wrapper close.
	 *
	 * @return string html
	 */
	public static function result_wrap_close(){
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}
		echo '</div>';
	}

	/**
	 * Get shop sidebar.
	 *
	 * @uses   Layout::get_shop_layout() [<description>]
	 * @return void
	 */
	public static function get_sidebar(){

		$layout = Layout::get_layout();

		if( $layout == 'content-sidebar' || $layout == 'sidebar-content' ) {
			woocommerce_get_sidebar();
		}

	}

	/**
	 * Wrap product inner withing an open div.
	 *
	 * @return string html
	 */
	public static function entry_inner_open(){
		echo '<div class="entry-product">';
	}

	/**
	 * Wrap product inner withing a closing div.
	 *
	 * @return string html
	 */
	public static function entry_inner_close(){
		echo '</div>';
	}

	/**
	 * Thumbnail wrap open div.
	 *
	 * @return string html
	 */
	public static function product_thumbnail_wrap_open(){
		echo '<div class="baltic-product-thumbnail-wrap">';
	}

	/**
	 * Thumbnail wrap close div.
	 *
	 * @return string html
	 */
	public static function product_thumbnail_wrap_close(){
		echo '</div>';
	}

	/**
	 * Add extra button hook.
	 *
	 * @return void
	 */
	public static function product_extra_buttons() {
		wc_get_template( 'product-extra-button.php' );
	}

}
