<?php
/**
 * Payment icons.
 *
 * @package Baltic
 */

$icons 	= Baltic\Options::get_option( 'payment_icons' );

if ( is_customize_preview() ) {
	echo '<div id="footer-payments-card-wrap">';
}

if ( ! empty( $icons ) ) {
echo '<div id="footer-payments-card" class="footer-payments-card">';
	echo '<div class="container">';

		echo '<ul class="baltic__payment-icons">';
		foreach ( $icons as $icon) {
			echo '<li>';
				Baltic\Icons::svg( array(
					'class'	=> 'icon icon-payment',
					'icon' 	=> esc_attr( $icon )
				) );
			echo '</li>';
		}
		echo '</ul>';

	echo '</div>';
echo '</div>';
}

if ( is_customize_preview() ) {
	echo '</div>';
}
?>
