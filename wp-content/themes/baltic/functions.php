<?php
/**
 * Baltic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Baltic
 */

$_baltic = wp_get_theme();
define( 'BALTIC_NAME',			$_baltic->get( 'Name' ) );
define( 'BALTIC_URL', 			$_baltic->get( 'ThemeURI' ) );
define( 'BALTIC_AUTHOR', 		$_baltic->get( 'Author' ) );
define( 'BALTIC_AUTHOR_URI', 	$_baltic->get( 'AuthorURI' ) );
define( 'BALTIC_VERSION', 		$_baltic->get( 'Version' ) );
define( 'BALTIC_DOMAIN', 		$_baltic->get( 'TextDomain' ) );

// Dir path
define( 'BALTIC_DIR', wp_normalize_path( get_template_directory() ) );
define( 'BALTIC_INC', BALTIC_DIR . "/inc" );

// URI path
define( 'BALTIC_URI', get_template_directory_uri() );

/**
 * Prevent switching Baltic theme if did not meet minimum requirement.
 *
 * @return void
 */
function baltic_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'baltic_compatibility_notice' );
}

/**
 * Compatibility notice
 *
 * @return void
 */
function baltic_compatibility_notice() {

	$html_message = '';
	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		// Translators: %1$s: Theme name, %2$s: Current WordPress version
		$message = sprintf( __( '%1$s theme requires at least WordPress version 4.7. You are running version %2$s. Please upgrade and try again.', 'baltic' ),
			esc_html( BALTIC_NAME ),
			$GLOBALS['wp_version']
		);
		$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	} elseif( version_compare( PHP_VERSION, '5.4', '<' ) ) {
		// translators: %1$s: Theme name, %2$s: Current PHP version
		$message = sprintf( esc_html__( '%1$s theme requires at least PHP version 5.4. You are running version %2$s. Please ask your hosting provider.', 'baltic' ),
			esc_html( BALTIC_NAME ),
			PHP_VERSION
		);
		$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	}

	echo wp_kses_post( $html_message );

}

/** Backward compatibilty */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) || version_compare( PHP_VERSION, '5.4', '<' ) ) {
	add_action( 'after_switch_theme', 'baltic_switch_theme' );
	return;
} else {
	/** Include Baltic core */
	require_once ( BALTIC_DIR . "/inc/init.php" );
}
