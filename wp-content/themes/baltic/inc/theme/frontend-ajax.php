<?php
/**
 * Frontend Ajax.
 *
 * @package Baltic
 */
namespace Baltic;

class Frontend_Ajax {

	use Instance;

	/**
	 * Ajax end-point handler.
	 *
	 * @var string
	 */
	private $endpoint = 'ajax-request';

	public function __construct() {

        add_action( 'parse_request',	[ $this, 'parse_request' ] );
        add_filter( 'query_vars',   	[ $this, 'query_vars' ] );

	}

	/**
	 * Add query vars.
	 *
	 * @param  array
	 * @return void
	 */
	public function query_vars( $vars ) {

        $vars[] = $this->endpoint;
        $vars[] = 'action';
        return $vars;

	}

	/**
	 * [output description]
	 * @param  [type] $output [description]
	 * @return [type]         [description]
	 */
	public function output( $output ) {
		return str_replace( array( "\n", "\t", "\r" ), '', $output );
	}

	/**
	 * Is doing ajax.
	 *
	 * @return boolean true|false
	 */
	public function is_doing_ajax() {
		return true;
	}

	/**
	 * Parse request of ajax.
	 *
	 * @param  $wp
	 * @return void
	 */
	public function parse_request( $wp ) {

		if ( array_key_exists( $this->endpoint, $wp->query_vars ) ) {

			add_filter( 'wp_doing_ajax', [ $this, 'is_doing_ajax' ] );

			if ( isset( $wp->query_vars['action'] ) ) {

				$action = $wp->query_vars['action'];

				switch ( $action ) {

					case 'quick_view_product':
						$this->quick_view();
					break;

					case 'wishlist_count' :
						$this->wishlist_count();
					break;

					default:
						echo esc_html__( 'Wrong paramater.', 'baltic' );
					break;

				}
			}

			exit;

		}

	}

	/**
	 * Quick view response.
	 *
	 * @return string html
	 */
	public function quick_view() {

		if ( ! isset( $_REQUEST['product_id'] ) ) {
			die();
		}

		$product_id = intval( $_REQUEST['product_id'] );

		$query_args = [
			'p'         	=> $product_id,
			'post_type' 	=> 'product',
			'no_found_rows' => 1,
		];

		$r = new \WP_Query( $query_args );

		ob_start();
		if( $r->have_posts() ):
			while( $r->have_posts() ): $r->the_post();
				wc_get_template( 'quick-view-content.php' );
			endwhile;
		endif;
		wp_reset_postdata();

		$content = $this->output( ob_get_clean() );

		echo $content; // WPCS: XSS ok.

		die();

	}

	/**
	 * Wisthlist count response.
	 *
	 * @return string json
	 */
	public function wishlist_count() {

		if ( ! function_exists( 'yith_wcwl_count_all_products' ) ) {
			die();
		}

		wp_send_json( array(
			'total' => yith_wcwl_count_all_products()
		) );

		die();

	}

}
