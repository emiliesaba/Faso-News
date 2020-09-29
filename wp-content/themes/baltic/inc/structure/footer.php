<?php
/**
 * Footer structure
 *
 * @package Baltic
 */
namespace Baltic\Structure;

use Baltic\Instance;
use Baltic\Components;

class Footer {

	use Instance,
		Components;

	public function __construct() {

		add_action( 'baltic_footer_before', [ __class__, 'do_nav_social' ], 10 );
		add_action( 'baltic_footer_before', [ __class__, 'do_footer_widgets' ], 20 );
		add_action( 'baltic_footer_before', [ __class__, 'do_payment_icons' ], 30 );

		add_action( 'baltic_footer', [ __class__, 'do_container_open' ], 5 );
		add_action( 'baltic_footer', [ __class__, 'do__columns_open' ], 10 );

		add_action( 'baltic_footer', [ __class__, 'do_site_info' ], 20 );
		add_action( 'baltic_footer', [ __class__, 'do_nav_secondary' ], 30 );

		add_action( 'baltic_footer', [ __class__, 'do_columns_close' ], 80 );
		add_action( 'baltic_footer', [ __class__, 'do_container_close' ], 90 );

		add_action( 'baltic_after', [ __class__, 'do_skip_top' ], 10 );
	}

	public static function do_nav_social() {
		get_template_part( 'components/nav', 'social' );
	}

	public static function do__columns_open() {
		self::do_columns_open( 'columns-sm-1', 'columns-md-2', 'columns-lg-2' );
	}

	public static function do_footer_widgets() {
		get_sidebar( 'footer' );
	}

	public static function do_payment_icons() {
		get_template_part( 'components/payment', 'icons' );
	}

	public static function do_site_info() {
		get_template_part( 'components/site', 'info' );
	}

	public static function do_nav_secondary() {
		get_template_part( 'components/nav', 'secondary' );
	}

	public static function do_skip_top() {
		get_template_part( 'components/skip', 'top' );
	}
}
