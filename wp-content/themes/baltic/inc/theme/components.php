<?php
/**
 * Components class
 *
 * @package Baltic
 */

namespace Baltic;

use Baltic\Extras\Breadcrumb;

trait Components {

	public static function baltic_breadcrumb( $args = array() ) {

		$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

		if ( ! is_object( $breadcrumb ) ) {
			$breadcrumb = new Breadcrumb( $args );
		}

		return $breadcrumb->trail();

	}

	public static function breadcrumb() {

		if ( function_exists( 'bcn_display' ) ) {
			echo '<div class="breadcrumb">';
			bcn_display();
			echo '</div>';
		}
		elseif ( function_exists( 'breadcrumbs' ) ) {
			breadcrumbs();
		}
		elseif ( function_exists( 'crumbs' ) ) {
			crumbs();
		}
		elseif ( class_exists( 'WPSEO_Breadcrumbs' ) ) {
			yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
		}
		elseif ( function_exists( 'yoast_breadcrumb' ) && ! class_exists( 'WPSEO_Breadcrumbs' ) ) {
			yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
		}
		else {
			echo self::baltic_breadcrumb(); // WPCS: XSS ok.
		}

	}

	public static function do_breadcrumb() {

		$breadcrumb__archive 	= Options::get_option( 'breadcrumb__archive' );
		$breadcrumb__attachment	= Options::get_option( 'breadcrumb__attachment' );
		$breadcrumb__page 		= Options::get_option( 'breadcrumb__page' );
		$breadcrumb__single 	= Options::get_option( 'breadcrumb__single' );

		if( is_home() && $breadcrumb__archive ) {
			self::breadcrumb();
		} elseif ( is_archive() && $breadcrumb__archive ) {
			self::breadcrumb();
		} elseif( is_attachment() && $breadcrumb__attachment ) {
			self::breadcrumb();
		} elseif( is_singular( 'page' ) && Options::get_custom_field( '_breadcrumb' ) ) {
			if ( Options::get_custom_field( '_breadcrumb' ) === 'show' ) {
				self::breadcrumb();
			}
		} elseif( is_singular( 'page' ) && $breadcrumb__page ) {
			self::breadcrumb();
		} elseif( is_single() && Options::get_custom_field( '_breadcrumb' )  ) {
			if( Options::get_custom_field( '_breadcrumb' ) === 'show' ) {
				self::breadcrumb();
			}
		} elseif( is_single() && $breadcrumb__single ) {
			self::breadcrumb();
		}

	}

	/**
	 * Container open.
	 *
	 * @return string
	 */
	public static function do_container_open() {
		echo '<div class="container">';
	}

	/**
	 * Container close.
	 *
	 * @return string
	 */
	public static function do_container_close() {
		echo '</div>';
	}

	/**
	 * Columns open.
	 *
	 * @return string
	 */
	public static function do_columns_open( $mobile = "", $tablet = "", $desktop = "") {
		echo sprintf( '<div class="columns%1$s%2$s%3$s">',
			' ' . sanitize_html_class( $mobile ),
			' ' . sanitize_html_class( $tablet ),
			' ' . sanitize_html_class( $desktop )
		); // WPCS: XSS ok.
	}

	/**
	 * Columns close.
	 *
	 * @return string
	 */
	public static function do_columns_close() {
		echo '</div>';
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function blogdescription() {
		bloginfo( 'description' );
	}

	public static function do_header_toggle() {
		if( ! Options::get_option( 'sticky_header' ) ) {
			return;
		}
		?>
		<button id="header-menu-toggle" class="header-menu-toggle" aria-controls="site-navigation" aria-expanded="false">
			<?php
			Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'menu' ] );
			Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'close' ] );
			echo '<span class="screen-reader-text">' . esc_html__( 'Toggle Main Navigation', 'baltic' ) . '</span>';
			?>
		</button>
		<?php
	}

	public static function do_products_navigation() {
		get_template_part( 'components/nav', 'products' );
	}

	/**
	 * Preloader.
	 *
	 * @return void
	 */
	public static function preloader() {

		$preloader = Options::get_option( 'preloader_type' );

		$markup = '';

		switch( $preloader ){
			case 'rotating-plane':
				$markup .= '
					<div class="sk-rotating-plane"></div>
				';
			break;
			case 'double-bounce' :
				$markup .= '
					<div class="sk-double-bounce">
						<div class="sk-child sk-double-bounce1"></div>
						<div class="sk-child sk-double-bounce2"></div>
					</div>
				';
			break;
			case 'wave' :
				$markup .= '
					<div class="sk-wave">
						<div class="sk-rect sk-rect1"></div>
						<div class="sk-rect sk-rect2"></div>
						<div class="sk-rect sk-rect3"></div>
						<div class="sk-rect sk-rect4"></div>
						<div class="sk-rect sk-rect5"></div>
					</div>
				';
			break;
			case 'wandering-cubes' :
				$markup .= '
					<div class="sk-wandering-cubes">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
					</div>
				';
			break;
			case 'pulse' :
				$markup .= '
					<div class="sk-spinner-pulse"></div>
				';
			break;
			case 'chasing-dots' :
				$markup .= '
					<div class="sk-chasing-dots">
						<div class="sk-child sk-dot1"></div>
						<div class="sk-child sk-dot2"></div>
					</div>
				';
			break;
			case 'three-bounce' :
				$markup .= '
					<div class="sk-three-bounce">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
				';
			break;
			case 'circle' :
				$markup .= '
					<div class="sk-circle">
						<div class="sk-circle1 sk-child"></div>
						<div class="sk-circle2 sk-child"></div>
						<div class="sk-circle3 sk-child"></div>
						<div class="sk-circle4 sk-child"></div>
						<div class="sk-circle5 sk-child"></div>
						<div class="sk-circle6 sk-child"></div>
						<div class="sk-circle7 sk-child"></div>
						<div class="sk-circle8 sk-child"></div>
						<div class="sk-circle9 sk-child"></div>
						<div class="sk-circle10 sk-child"></div>
						<div class="sk-circle11 sk-child"></div>
						<div class="sk-circle12 sk-child"></div>
					</div>
				';
			break;
			case 'cube-grid' :
				$markup .= '
					<div class="sk-cube-grid">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
						<div class="sk-cube sk-cube3"></div>
						<div class="sk-cube sk-cube4"></div>
						<div class="sk-cube sk-cube5"></div>
						<div class="sk-cube sk-cube6"></div>
						<div class="sk-cube sk-cube7"></div>
						<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
				';
			break;
			case 'fading-circle' :
				$markup .= '
					<div class="sk-fading-circle">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>
				';
			break;
			case 'folding-cube' :
				$markup .= '
					<div class="sk-folding-cube">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>
				';
			break;

		}

		$markup = str_replace( array( "\n", "\t", "\r" ), '', $markup );

		return sprintf( '<div class="spinner">%s</div>', $markup );

	}
}
