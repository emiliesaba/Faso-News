<?php
/**
 * Layout class
 *
 * @package Baltic
 */

namespace Baltic;

class Layout {

	/**
	 * Get site layout
	 *
	 * @return string
	 */
	public static function get_layout() {

		$layout 		= '';
		$layout_meta 	= Options::get_custom_field( '_layout', get_the_ID() );
		$blog_id 		= get_option( 'page_for_posts' );
		$blog_layout 	= Options::get_custom_field( '_layout', $blog_id );

		if( is_post_type_archive( 'product' ) ) {
			$layout = self::get_shop_layout();
		} elseif ( is_home() && ! empty( $blog_layout ) ){
			$layout = $blog_layout;
		} elseif ( is_home() || is_archive() || is_search() ) {
			$layout = Options::get_option( 'layout__archive' );
		} elseif( is_attachment() ) {
			$layout = Options::get_option( 'layout__attachment' );
		} elseif ( is_singular( 'page' ) && ! empty( $layout_meta ) ) {
			$layout = $layout_meta;
		} elseif ( is_singular( 'page' ) ) {
			$layout = Options::get_option( 'layout__page' );
		} elseif( is_single() && ! empty( $layout_meta ) ) {
			$layout = $layout_meta;
		} elseif( is_single() ) {
			$layout = Options::get_option( 'layout__single' );
		}

		return apply_filters( 'baltic_site_layout', $layout );

	}

	/**
	 * Get shop layout.
	 *
	 * @return string
	 */
	public static function get_shop_layout() {

		$layout = Options::get_option( 'layout__archive' );

		if ( function_exists( 'wc_get_page_id' ) ) {
			$shop_id 		= wc_get_page_id( 'shop' );
			$layout_meta 	= Options::get_custom_field( '_layout', $shop_id );
			if ( ! empty( $layout_meta ) ) {
				$layout = $layout_meta;
			}
		}

		return $layout;

	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return string
	 */
	public static function get_content_sidebar() {
		return 'content-sidebar';
	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return string
	 */
	public static function get_sidebar_content() {
		return 'sidebar-content';
	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return string
	 */
	public static function get_narrow() {
		return 'narrow';
	}

	/**
	 * [get_content_sidebar description]
	 *
	 * @return string
	 */
	public static function get_full_width() {
		return 'full-width';
	}

	/**
	 * [boxed_layout description]
	 *
	 * @return string
	 */
	public static function boxed_layout() {
		return 'boxed-layout';
	}

	/**
	 * [full_width_layout description]
	 *
	 * @return string
	 */
	public static function full_layout() {
		return 'full-layout';
	}

}
