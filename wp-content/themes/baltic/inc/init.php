<?php
/**
 * Baltic init class
 *
 * @package Baltic
 */

namespace Baltic;

class Init {

	private static $classes_map = [
		'Admin'			=> 'theme/admin.php',
		'Components'	=> 'theme/components.php',
		'Customizer'	=> 'theme/customizer.php',
		'Frontend_Ajax'	=> 'theme/frontend-ajax.php',
		'Icons'			=> 'theme/icons.php',
		'Layout'		=> 'theme/layout.php',
		'Options'		=> 'theme/options.php',
		'Plugins'		=> 'theme/plugins.php',
		'Sanitize'		=> 'theme/sanitize.php',
		'Setup'			=> 'theme/setup.php',
		'Utils'			=> 'theme/utils.php',
		'Webfonts'		=> 'theme/webfonts.php',
	];

	private static $classes_aliases = [];

	/**
	 * Holds the theme instance.
	 *
	 * @access private
	 * @static
	 */
	private static $_instance;

	/**
	 * Instance
	 *
	 * @return void
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor.
	 */
	public function __construct() {

		spl_autoload_register( [ $this, 'autoload' ] );

		Setup::instance();
		Icons::instance();
		Plugins::instance();
		Customizer::instance();
		Frontend_Ajax::instance();
		Admin::instance();

		Structure\Header::instance();
		Structure\Content::instance();
		Structure\Footer::instance();

		Connect\Algolia\Setup::instance();
		Connect\Jetpack\Setup::instance();
		Connect\Woo\Setup::instance();

	}

	/**
	 * Load class for a given class name, require the class file.
	 *
	 * @param string $relative_class_name Class name.
	 * @return void
	 */
	private static function load_class( $relative_class_name ) {

		if ( isset( self::$classes_map[ $relative_class_name ] ) ) {
			$filename = BALTIC_INC . '/' . self::$classes_map[ $relative_class_name ];
		} else {
			$filename = strtolower(
				preg_replace(
					[ '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$relative_class_name
				)
			);

			$filename = BALTIC_INC . '/' . $filename . '.php';
		}

		if ( is_readable( $filename ) ) {
			require $filename;
		}

	}

	/**
	 * Autoload function.
	 *
	 * @param  string $class name of the class
	 * @return void
	 */
	public function autoload( $class ) {

		if ( 0 !== strpos( $class, __NAMESPACE__ . '\\' ) ) {
			return;
		}

		$relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $class );

		$has_class_alias = isset( self::$classes_aliases[ $relative_class_name ] );

		if ( $has_class_alias ) {
			$relative_class_name = self::$classes_aliases[ $relative_class_name ];
		}

		$final_class_name = __NAMESPACE__ . '\\' . $relative_class_name;

		if ( ! class_exists( $final_class_name ) ) {
			self::load_class( $relative_class_name );
		}

		if ( $has_class_alias ) {
			class_alias( $final_class_name, $class );
		}

	}

}
Init::instance();
