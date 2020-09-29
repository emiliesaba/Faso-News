<?php
/**
 * Header structure
 *
 * @package Baltic
 */
namespace Baltic\Structure;

use Baltic\Instance;
use Baltic\Icons;
use Baltic\Options;
use Baltic\Components;
use Baltic\Utils;

class Header {

	use Instance,
		Components,
		Utils;

	public function __construct() {

		add_action( 'baltic_before', [ __class__, 'do_preloader' ], 10 );

		add_action( 'baltic_header_before', [ __class__, 'do_skip_link' ], 10 );

		add_action( 'baltic_header', [ __class__, 'do_container_open' ], 0 );

		add_action( 'baltic_header', [ __class__, 'do_header_toggle' ], 10 );
		add_action( 'baltic_header', [ __class__, 'do_site_branding' ], 20 );
		add_action( 'baltic_header', [ __class__, 'do_header_search' ], 30 );
		add_action( 'baltic_header', [ __class__, 'do_nav_primary' ], 40 );

		add_action( 'baltic_header', [ __class__, 'do_container_close' ], 90 );

		add_action( 'baltic_header_after', [ __class__, 'do_page_header' ], 50 );

	}

	/**
	 * Do preloader.
	 *
	 * @return string
	 */
	public static function do_preloader() {
		if ( Options::get_option( 'preloader' ) === true ) {
			get_template_part( 'components/site', 'preloader' );
		}
	}

	/**
	 * Skip link.
	 *
	 * @return void
	 */
	public static function do_skip_link() {
		get_template_part( 'components/skip', 'links' );
	}

	/**
	 * Site branding.
	 *
	 * @return void
	 */
	public static function do_site_branding() {
		get_template_part( 'components/site', 'branding' );
	}

	/**
	 * Site branding.
	 *
	 * @return void
	 */
	public static function do_header_search() {
		get_template_part( 'components/header', 'search' );
	}

	/**
	 * Nav primary.
	 *
	 * @return void
	 */
	public static function do_nav_primary() {
		get_template_part( 'components/nav', 'primary' );
	}

	public static function do_page_header() {

		if( Options::get_custom_field( '_wp_page_template', get_the_ID() ) === 'elementor_header_footer' ) {
			return;
		}

		if( is_page_template( 'templates/canvas.php' ) || is_404() ) {
			return;
		}

		if( ! Utils::is_woocommerce() ) {
			get_template_part( 'components/page', 'header' );
		}

	}

}
