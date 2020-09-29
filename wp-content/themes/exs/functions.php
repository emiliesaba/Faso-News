<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'EXS_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

//https://developer.wordpress.org/themes/basics/linking-theme-files-directories/#linking-to-theme-directories
define( 'EXS_THEME_URI', get_parent_theme_file_uri() );
define( 'EXS_THEME_PATH', get_parent_theme_file_path() );
define( 'EXS_DEV_MODE', is_dir( EXS_THEME_PATH . '/dev' ) );
define( 'EXS_EXTRA', is_dir( EXS_THEME_PATH . '/extra' ) );

//THEME SETUP
//theme support
//image sizes
//register menus
//register sidebars

require_once EXS_THEME_PATH . '/inc/setup.php';

//THEME OPTIONS helpers and default options
require_once EXS_THEME_PATH . '/inc/options.php';

//STATIC ASSETS
require_once EXS_THEME_PATH . '/inc/static.php';

//HTML OUTPUT FILTERS
require_once EXS_THEME_PATH . '/inc/output-filters.php';

//WooCommerce support
if ( class_exists( 'WooCommerce' ) ) {
	require_once EXS_THEME_PATH . '/inc/woocommerce.php';
}
//EDD support
if ( class_exists( 'Easy_Digital_Downloads' ) ) {
	require_once EXS_THEME_PATH . '/inc/edd.php';
}
if ( EXS_EXTRA ) {
	require_once EXS_THEME_PATH . '/extra/functions.php';
}

//only for front end
if ( ! is_admin() ) {

	//TEMPLATE HELPERS
	require_once EXS_THEME_PATH . '/inc/template-helpers.php';

}

//only for admin
if ( is_admin() ) {

	//TGM plugin activation and demo-content
	require_once EXS_THEME_PATH . '/inc/tgm-plugin-activation/plugins.php';

}

//only for customizer
if ( is_admin() || is_customize_preview() || EXS_DEV_MODE ) {

	//CUSTOMIZER INIT
	require_once EXS_THEME_PATH . '/inc/customizer.php';

}

if ( EXS_DEV_MODE ) :
	require_once EXS_THEME_PATH . '/dev/extensions/functions.php';
endif;

//only if our fields plugin not activated and if is_admin
if ( is_admin() && ! class_exists( 'Exs_Fields_Taxonomy' ) && EXS_EXTRA ) {
	require_once EXS_THEME_PATH . '/extra/taxonomy-options/class-exs-fields.php';
	require_once EXS_THEME_PATH . '/extra/taxonomy-options/class-exs-fields-taxonomy.php';
}
