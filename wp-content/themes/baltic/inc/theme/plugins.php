<?php
/**
 * Plugins class
 *
 * @package Baltic
 */

namespace Baltic;

class Plugins {

	use Instance;

	private $demo_url;
	private $data_url;
	private $site_url;
	private $upload_dir;

	public function __construct() {

		$this->demo_url = esc_url( "https://baltic.wpcampaignkit.com/" );
		$this->data_url = esc_url( "https://gitlab.com/elevatethemes/baltic-demo/raw/master/" );
		$this->site_url = esc_url( home_url('/') );
		$this->upload_dir = wp_upload_dir();

		require_once ( BALTIC_INC . "/extras/class-tgm-plugin-activation.php" );

		add_action( 'tgmpa_register', array( $this, 'required_plugins' ) );

		add_filter( 'pt-ocdi/plugin_intro_text', array( $this, 'import_intro' ) );
		add_filter( 'pt-ocdi/import_files', array( $this, 'import_files' ) );
		add_action( 'pt-ocdi/before_widgets_import', [ $this, 'before_widgets'] );
		add_action( 'pt-ocdi/after_import', array( $this, 'after_import' ) );
		// Moved to readme.txt
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

	}

	/**
	 * TGMPA plugin requirement list.
	 *
	 * @return void
	 */
	public function required_plugins() {

		$plugins = array(

			array(
				'name'      => esc_html_x( 'Baltic Kit', 'Recommended plugin name','baltic' ),
				'slug'      => 'baltic-kit',
				'required'  => false
			),

			array(
				'name'      => esc_html_x( 'Elementor', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'elementor',
				'required'  => false
			),

			array(
				'name'      => esc_html_x( 'WooCommerce', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'woocommerce',
				'required'  => false
			),

			array(
				'name'      => esc_html_x( 'Contact Form 7', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),

			array(
				'name'      => esc_html_x( 'YITH WooCommerce Wishlist', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'yith-woocommerce-wishlist',
				'required'  => false,
			),

			array(
				'name'      => esc_html_x( 'WP Term Images', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'wp-term-images',
				'required'  => false,
			),

			array(
				'name'      => esc_html_x( 'WP Instagram Widget', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'wp-instagram-widget',
				'required'  => false,
			),

			array(
				'name'      => esc_html_x( 'One Click Demo Import', 'Recommended plugin name', 'baltic' ),
				'slug'      => 'one-click-demo-import',
				'required'  => false,
			),

		);

		/*
		 * Array of configuration settings.
		 */
		$config = array(
			'id'           => 'baltic',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );

	}

	/**
	 * Import intro.
	 *
	 * @param  string $default_text
	 * @return string
	 */
	public function import_intro( $default_text ) {
		$default_text = __( 'Please install and activate all recommended plugin before start the importing progress.', 'baltic' );
		$default_text = sprintf( '<div class="notice notice-warning is-dismissible">%s</div>', wpautop( $default_text ) );
		return wp_kses_post( $default_text );
	}

	/**
	 * List of import data.
	 *
	 * @return void
	 */
	public function import_files() {

		$data = array(
			array(
				'import_file_name'           => esc_html( 'Default' ),
				'import_file_url'            => esc_url( $this->data_url . 'default/data.xml' ),
				'import_widget_file_url'     => esc_url( $this->data_url . 'default/widgets.json' ),
				'import_customizer_file_url' => esc_url( $this->data_url . 'default/customizer.dat' ),
				'import_preview_image_url'   => get_parent_theme_file_uri( "screenshot.jpg" ),
				'import_notice'              => esc_html__( 'Please make it sure to install all the recommended plugin before start the import progress.', 'baltic' ),
			),
			array(
				'import_file_name'           => esc_html( 'Dark' ),
				'import_file_url'            => esc_url( $this->data_url . 'dark/data.xml' ),
				'import_widget_file_url'     => esc_url( $this->data_url . 'dark/widgets.json' ),
				'import_customizer_file_url' => esc_url( $this->data_url . 'dark/customizer.dat' ),
				'import_preview_image_url'   => esc_url( $this->data_url . 'dark/screenshot.jpg' ),
				'import_notice'              => esc_html__( 'Please make it sure to install all the recommended plugin before start the import progress.', 'baltic' ),
			),
			array(
				'import_file_name'           => esc_html( 'Green' ),
				'import_file_url'            => esc_url( $this->data_url . 'green/data.xml' ),
				'import_widget_file_url'     => esc_url( $this->data_url . 'green/widgets.json' ),
				'import_customizer_file_url' => esc_url( $this->data_url . 'green/customizer.dat' ),
				'import_preview_image_url'   => esc_url( $this->data_url . 'green/screenshot.jpg' ),
				'import_notice'              => esc_html__( 'Please make it sure to install all the recommended plugin before start the import progress.', 'baltic' ),
			),
		);

		return apply_filters( 'baltic_import_data', $data );

	}

	/**
	 * Remove default widgets from current position.
	 *
	 * @param  [type] $selected_import [description]
	 * @return [type]                  [description]
	 */
	public function before_widgets( $selected_import ) {

		$widgets  = get_option( 'sidebars_widgets' );
		$defaults = array(
			0 => 'search-2',
			1 => 'recent-posts-2',
			2 => 'recent-comments-2',
			3 => 'archives-2',
			4 => 'categories-2',
			5 => 'meta-2',
		);

		if ( isset( $widgets['sidebar-1'] ) && $defaults === $widgets['sidebar-1'] ) {
			$widgets['sidebar-1'] = array();
			update_option( 'sidebars_widgets', $widgets );
		}

	}

	/**
	 * After import setup.
	 *
	 * @return void
	 */
	public function after_import( $selected_import ) {

		// Assign menus to their locations.
		$menu_1 = get_term_by( 'name', 'primary', 'nav_menu' );
		$menu_2 = get_term_by( 'name', 'secondary', 'nav_menu' );
		$menu_3 = get_term_by( 'name', 'social', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', [
			'menu-1' => $menu_1->term_id,
			'menu-2' => $menu_2->term_id,
			'menu-3' => $menu_3->term_id,
		] );

		// Assign front page and posts page (blog page).
		$front_page 	= get_page_by_title( 'Homepage' );
		$blog_page  	= get_page_by_title( 'Blog' );
		$privacy_page 	= get_page_by_title( 'Privacy Policy' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page->ID );
		update_option( 'page_for_posts', $blog_page->ID );
		update_option( 'wp_page_for_privacy_policy', $privacy_page->ID );

		// WooCommerce Assign Page
		$shop_page 			= get_page_by_title( 'Shop' );
		$cart_page 			= get_page_by_title( 'Cart' );
		$checkout_page 		= get_page_by_title( 'Checkout' );
		$my_account_page 	= get_page_by_title( 'My account' );
		$wishlist_page 		= get_page_by_title( 'Wishlist' );
		$terms_page			= get_page_by_title( 'Terms and conditions' );

		update_option( 'woocommerce_shop_page_id', 		$shop_page->ID );
		update_option( 'woocommerce_cart_page_id', 		$cart_page->ID );
		update_option( 'woocommerce_checkout_page_id', 	$checkout_page->ID );
		update_option( 'woocommerce_myaccount_page_id', $my_account_page->ID );
		update_option( 'woocommerce_terms_page_id', 	$terms_page->ID );
		update_option( 'yith_wcwl_wishlist_page_id', 	$wishlist_page->ID );

		// WooCommerce Options
		update_option( 'woocommerce_enable_checkout_login_reminder', 'yes' );
		update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'yes' );
		update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
		update_option( 'woocommerce_bacs_settings', [ 'enabled' => 'yes' ] );

	    if ( function_exists( 'wc_delete_product_transients' ) ) {
	        wc_delete_product_transients();
	    }
	    if ( function_exists( 'wc_delete_shop_order_transients' ) ) {
	        wc_delete_shop_order_transients();
	    }
	    if ( function_exists( 'wc_delete_expired_transients' ) ) {
	        wc_delete_expired_transients();
	    }

		// Disable Elementor default colors
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );

		// Update URL
		if ( 'Default' === $selected_import['import_file_name'] ) {
			// Set custom logo
			$logo = get_page_by_title( 'baltic-logo', OBJECT, 'attachment' );
			set_theme_mod( 'custom_logo', $logo->ID );
			if ( class_exists( '\Elementor\Utils' ) ) {
				\Elementor\Utils::replace_urls( esc_url( $this->demo_url . 'default/wp-content/uploads/sites/2/2018/08/' ), esc_url( trailingslashit( $this->upload_dir['url'] ) ) );
				\Elementor\Utils::replace_urls( esc_url( $this->demo_url . 'default/' ), esc_url( $this->site_url ) );
			}
			Utils::widget_replace_content( 'About Baltic', esc_url( $this->demo_url . 'default/wp-content/uploads/sites/2/2018/08/' ), esc_url( trailingslashit( $this->upload_dir['url'] ) ) );
		} elseif ( 'Dark' === $selected_import['import_file_name'] ) {
			// Set custom logo
			$logo = get_page_by_title( 'baltic-logo-light', OBJECT, 'attachment' );
			set_theme_mod( 'custom_logo', $logo->ID );
			if ( class_exists( '\Elementor\Utils' ) ) {
				\Elementor\Utils::replace_urls( esc_url( $this->demo_url . 'dark/wp-content/uploads/sites/3/2018/08/' ), esc_url( trailingslashit( $this->upload_dir['url'] ) ) );
				\Elementor\Utils::replace_urls( esc_url( $this->demo_url . 'dark/' ), esc_url( $this->site_url ) );
			}
			Utils::widget_replace_content( 'About Baltic', esc_url( $this->demo_url . 'dark/wp-content/uploads/sites/3/2018/08/' ), esc_url( trailingslashit( $this->upload_dir['url'] ) ) );
		} elseif ( 'Green' === $selected_import['import_file_name'] ) {
			// Set custom logo
			$logo = get_page_by_title( 'baltic-logo-light', OBJECT, 'attachment' );
			set_theme_mod( 'custom_logo', $logo->ID );
			if ( class_exists( '\Elementor\Utils' ) ) {
				\Elementor\Utils::replace_urls( esc_url( $this->demo_url . 'dark/wp-content/uploads/sites/4/2018/08/' ), esc_url( trailingslashit( $this->upload_dir['url'] ) ) );
				\Elementor\Utils::replace_urls( esc_url( $this->demo_url . 'dark/' ), esc_url( $this->site_url ) );
			}
			Utils::widget_replace_content( 'About Baltic', esc_url( $this->demo_url . 'dark/wp-content/uploads/sites/4/2018/08/' ), esc_url( trailingslashit( $this->upload_dir['url'] ) ) );
		}

		// Update contact form
		if ( class_exists( '\WPCF7_ContactForm' ) ) {

			$contact = get_page_by_title( 'Baltic Contact Form', OBJECT, \WPCF7_ContactForm::post_type );
			wp_delete_post( $contact->ID, true );

			$form 			= get_page_by_title( 'Contact Form 1', OBJECT, \WPCF7_ContactForm::post_type );
			$contactPage	= get_page_by_title( 'Contact' );

			$content = sprintf( "If you have any question, please get in touch with us via contact form below.\r\n\r\n%s",
				'[contact-form-7 id="'. absint( $form->ID ) .'" title="Contact form 1"]' );

			$args = [
		      'ID'           => absint( $contactPage->ID ),
		      'post_content' => wp_kses_post( $content ),
			];

			wp_update_post( $args );

		}


	}

}
