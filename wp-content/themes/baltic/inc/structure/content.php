<?php
/**
 * Content structure
 *
 * @package Baltic
 */
namespace Baltic\Structure;

use Baltic\Instance;
use Baltic\Layout;
use Baltic\Components;

class Content {

	use Instance,
		Components;

	public function __construct() {

		add_action( 'baltic_content_area_before', [ __class__, 'do_container_open' ], 10 );
		//add_action( 'baltic_content_area_before', [ __class__, 'do_columns_open' ], 11 );

		add_action( 'baltic_site_main', [ __class__, 'do_loop' ], 10 );
		add_action( 'baltic_site_main_after', [ __class__, 'do_posts_navigation' ], 10 );
		add_action( 'baltic_content_area_after', [ __class__, 'do_sidebar' ], 10 );

		//add_action( 'baltic_content_area_after', [ __class__, 'do_columns_close' ], 9 );
		add_action( 'baltic_content_area_after', [ __class__, 'do_container_close' ], 10 );

	}

	public static function do_loop() {

		if ( is_singular() ) {
			get_template_part( 'components/loop', 'singular' );
		} else {
			get_template_part( 'components/loop', 'index' );
		}

	}

	public static function do_posts_navigation() {
		if ( ! is_singular() ) {
			get_template_part( 'components/nav', 'archives' );
		}
	}

	public static function do_sidebar() {

		if ( is_customize_preview() ) {
			get_sidebar();
		} elseif ( Layout::get_layout() == 'full-width' || Layout::get_layout() == 'narrow' ) {
			return;
		}

		get_sidebar();

	}

}
