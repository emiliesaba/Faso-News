<?php
/**
 * Jetpack setup
 *
 * @package Baltic
 */

namespace Baltic\Connect\Jetpack;

use Baltic\Instance;
use Baltic\Utils;

class Setup {

	use Instance;

	public function __construct() {

		if ( ! defined( 'JETPACK__VERSION' ) ) {
			return;
		}

		add_action( 'init', 			[ $this, 'jetpack_setup' ] );
		add_action( 'wp_print_styles', 	[ $this, 'deregister_script' ] );

	}

	public function jetpack_setup() {

		add_theme_support( 'infinite-scroll', apply_filters( 'baltic_jetpack_infinite_scroll_args', [
			'container'      => 'main',
			'footer'         => 'page',
			'render'         => [ $this, 'jetpack_infinite_scroll_loop' ],
			'footer_widgets' => array(
				'sidebar-2',
			),
		] ) );

	}

	/**
	 * Jetpack infinite scroll loop.
	 *
	 * @return void
	 */
	public function jetpack_infinite_scroll_loop() {

		if ( Utils::is_shop() ) {
			woocommerce_product_loop_start();
		}

		while ( have_posts() ) : the_post();

			if ( is_search() ) {
				get_template_part( 'components/content', 'search' );
			} elseif( Utils::is_shop() ) {
				wc_get_template_part( 'content', 'product' );
			} else {
				get_template_part( 'components/content', get_post_type() );
			}

		endwhile;

		if ( Utils::is_shop() ) {
			woocommerce_product_loop_end();
		}

	}

	/**
	 * Deregister script.
	 *
	 * @return void
	 */
	public function deregister_script() {
		wp_deregister_style( 'the-neverending-homepage' );
	}

}
