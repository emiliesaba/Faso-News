<?php
/**
 * Utils
 *
 * @package Baltic
 */
namespace Baltic;

trait Utils {

	/**
	 * Get min suffix.
	 *
	 * @return boolean
	 */
	public static function get_min_suffix() {
		return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}

	/**
	 * Is sticky.
	 *
	 * @return boolean [description]
	 */
	public static function is_sticky() {
		return (bool) is_sticky() && ! is_paged() && ! is_singular() && ! is_archive();
	}

	/**
	 * Is blog.
	 *
	 * @return boolean [description]
	 */
	public static function is_blog() {
		return (bool) is_home() || is_category() || is_tag() || is_author() || is_date() || is_search();
	}

	/**
	 * Is woocommerce callback.
	 *
	 * @return boolean [description]
	 */
	public static function is_woocommerce() {
		if ( function_exists( 'is_woocommerce' ) ) {
			return (bool) is_woocommerce();
		}
	}

	/**
	 * Is shop callback.
	 *
	 * @return boolean [description]
	 */
	public static function is_shop() {

		if ( self::is_woocommerce() ) {
			if ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	/**
	 * [is_homepage_template description]
	 *
	 * @return boolean [description]
	 */
	public static function is_homepage_template() {
		return (bool) is_page_template( 'baltic-homepage.php' );
	}

	/**
	 * Get list of preloader animation.
	 *
	 * @return array
	 */
	public static function get_preloader_type() {

		$layout = [
			"rotating-plane"	=> esc_html__( 'rotating-plane', 'baltic' ),
			"double-bounce"		=> esc_html__( 'double-bounce', 'baltic' ),
			"wave"				=> esc_html__( 'wave', 'baltic' ),
			"wandering-cubes"	=> esc_html__( 'wandering-cubes', 'baltic' ),
			"pulse"				=> esc_html__( 'pulse', 'baltic' ),
			"chasing-dots"		=> esc_html__( 'chasing-dots', 'baltic' ),
			"three-bounce"		=> esc_html__( 'three-bounce', 'baltic' ),
			"circle"			=> esc_html__( 'circle', 'baltic' ),
			"cube-grid"			=> esc_html__( 'cube-grid', 'baltic' ),
			"fading-circle"		=> esc_html__( 'fading-circle', 'baltic' ),
			"folding-cube"		=> esc_html__( 'folding-cube', 'baltic' ),
		];

		return apply_filters( 'baltic_preloader_type', $layout );
	}

	/**
	 * Baltic Main layout selector.
	 *
	 * @return array available layout
	 */
	public static function get_main_layout() {

		$layout = array(
			'content-sidebar'  	=> esc_attr__( 'Content Sidebar', 'baltic' ),
			'sidebar-content' 	=> esc_attr__( 'Sidebar Content', 'baltic' ),
			'full-width' 		=> esc_attr__( 'Full Width', 'baltic' ),
			'narrow'	 		=> esc_attr__( 'Narrow', 'baltic' ),
		);

		return apply_filters( 'baltic_main_layout', $layout );

	}

	/**
	 * Baltic Main layout selector.
	 *
	 * @return array available layout
	 */
	public static function get_posts_layout() {

		$layout = array(
			'default'  	=> esc_attr__( 'Default', 'baltic' ),
			'grid' 		=> esc_attr__( 'Grid', 'baltic' ),
			'zig-zag' 	=> esc_attr__( 'Zig Zag', 'baltic' ),
		);

		return apply_filters( 'baltic_main_layout', $layout );

	}

	/**
	 * Button style.
	 *
	 * @return array
	 */
	public static function get_button_style() {

		$button = array(
			'primary'   		=> esc_attr__( 'Primary', 'baltic' ),
			'secondary' 		=> esc_attr__( 'Secondary', 'baltic' ),
			'success' 			=> esc_attr__( 'Success', 'baltic' ),
			'danger'  			=> esc_attr__( 'Danger', 'baltic' ),
			'warning'  			=> esc_attr__( 'Warning', 'baltic' ),
			'info'  			=> esc_attr__( 'Info', 'baltic' ),
			'white'  			=> esc_attr__( 'White', 'baltic' ),
			'outline-primary'   => esc_attr__( 'Primary Outline', 'baltic' ),
			'outline-secondary' => esc_attr__( 'Secondary Outline', 'baltic' ),
			'outline-success'  	=> esc_attr__( 'Success Outline', 'baltic' ),
			'outline-danger'  	=> esc_attr__( 'Danger Outline', 'baltic' ),
			'outline-warning'  	=> esc_attr__( 'Warning Outline', 'baltic' ),
			'outline-info'  	=> esc_attr__( 'Info Outline', 'baltic' ),
			'outline-white'  	=> esc_attr__( 'White Outline', 'baltic' ),
		);

		return apply_filters( 'baltic_button_style', $button );

	}

	/**
	 * Payment icons.
	 *
	 * @return array
	 */
	public static function get_payment_icons() {

		$icons = array(
			'alipay'		=> esc_html__( 'Alipay', 'baltic' ),
			'amex'			=> esc_html__( 'Amex', 'baltic' ),
			'diners'		=> esc_html__( 'Diners', 'baltic' ),
			'discover'		=> esc_html__( 'Discover', 'baltic' ),
			'elo'			=> esc_html__( 'Elo', 'baltic' ),
			'hipercard'		=> esc_html__( 'Hipercard', 'baltic' ),
			'jcb'			=> esc_html__( 'JCB', 'baltic' ),
			'maestro'		=> esc_html__( 'Maestro', 'baltic' ),
			'mastercard'	=> esc_html__( 'Mastercard', 'baltic' ),
			'paypal'		=> esc_html__( 'Paypal', 'baltic' ),
			'unionpay'		=> esc_html__( 'Unionpay', 'baltic' ),
			'verve'			=> esc_html__( 'Verve', 'baltic' ),
			'visa'			=> esc_html__( 'Visa', 'baltic' ),
		);

		return apply_filters( 'baltic_payment_icons', $icons );

	}

	/**
	 * Get an array of terms from a taxonomy.
	 *
	 * @param string|array $taxonomies See https://developer.wordpress.org/reference/functions/get_terms/ for details.
	 * @return array
	 */
	public static function get_terms( $taxonomies ) {

		$items = array();

		// Get the post types.
		$terms = get_terms( array(
	    	'taxonomy' 		=> $taxonomies
		) );

		// Build the array.
		foreach ( $terms as $term ) {
			$items[ $term->term_id ] = $term->name;
		}

		return $items;

	}

	/**
	 * Get an array of terms from a taxonomy.
	 *
	 * @param string|array $taxonomies See https://developer.wordpress.org/reference/functions/get_terms/ for details.
	 * @return array
	 */
	public static function get_terms_slug( $taxonomies ) {

		$items = array();

		// Get the post types.
		$terms = get_terms( array(
	    	'taxonomy' 		=> $taxonomies
		) );

		// Build the array.
		foreach ( $terms as $term ) {
			$items[ $term->slug ] = $term->name;
		}

		return $items;

	}

	/**
	 * Replace widget text content by title.
	 *
	 * @param  string $title   [description]
	 * @param  [type] $old_value [description]
	 * @param  [type] $new_value [description]
	 * @return [type]          [description]
	 */
	public static function widget_replace_content( $title = '', $old_value, $new_value ) {

	    $widgets = get_option( 'widget_text' );
	    if ( isset( $widgets ) ) {
		    foreach( $widgets as $key => $widget ) {
		        // Compare and ignore case:
		        if( mb_strtolower( $title ) === mb_strtolower( $widget['title'] ) ) {
		            // Replace the widget text:
		            $widgets[$key]['text'] = str_replace( $old_value, $new_value, $widgets[$key]['text'] );

		            // Update database and exit on first found match:
		            return update_option( 'widget_text', $widgets );
		        }
		    }
		    return false;
	    }

	}

}
