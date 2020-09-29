<?php
/**
 * Algolia connect
 *
 * @package Baltic
 */

namespace Baltic\Connect\Algolia;

use Baltic\Instance;

class Setup {

	use Instance;

	public function __construct() {
		add_action( 'wp_print_styles', [ $this, 'dequeue_styles' ], 100 );
	}

	public function dequeue_styles() {
		wp_dequeue_style( 'algolia-autocomplete' );
		wp_dequeue_style( 'algolia-instantsearch' );
	}

}
