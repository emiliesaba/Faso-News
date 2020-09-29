<?php
/**
 * Footer Copyright
 *
 * @package Baltic
 */
?>

<div class="site-info column-item">
<?php
	$footer_text = Baltic\Options::get_option( 'footer__text' );
	if ( ! empty( $footer_text ) ) {
		$footer_text = str_replace( '{{YEAR}}', date_i18n( __( 'Y', 'baltic' ) ), $footer_text );
		$footer_text = str_replace( '{{SITE}}', '<a href="'. esc_url( home_url('/') ) .'">'. esc_attr( get_bloginfo( 'name' ) ) .'</a>', $footer_text );
		$footer_text = str_replace( '{{WP}}', '<a href="'. esc_url( __( 'https://wordpress.org/', 'baltic' ) ) .'">WordPress</a>', $footer_text );
		echo '<div id="site-copyright" class="site-copyright">';
		echo wp_kses_post( $footer_text );
		echo '</div>';
	}

	if ( Baltic\Options::get_option( 'footer__credits' ) ) {
		echo '<div id="site-designer" class="site-designer">';
		// Translators: %1$s: Theme designer logo, %2$s: Theme designer site link
		printf( esc_html__( 'Theme design by %1$s %2$s.', 'baltic' ), // WPCS: XSS ok.
			Baltic\Icons::get_svg( [ 'icon' => 'campaignkit' ] ),
			'<a href="'. esc_url( 'https://campaignkit.co/' ) .'" target="_blank">Campaign Kit</a>' );
		echo '</div>';
	}
?>
</div>
