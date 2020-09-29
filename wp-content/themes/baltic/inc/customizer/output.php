<?php
/**
 * Customizer output
 *
 * @package Baltic
 */

namespace Baltic\Customizer;

use Baltic\Instance;
use Baltic\Options;
use Baltic\Utils;
use Baltic\Webfonts;

class Output {

	use Instance;

	public function __construct() {

		add_action( 'wp_head', [ $this, 'root' ], 5 );
		add_action( 'wp_enqueue_scripts', [ $this, 'print_inline_style' ], 15 );

		add_filter( 'tiny_mce_before_init', [ $this, 'editor_style' ] );

	}

	/**
	 * Root colors
	 *
	 * @return void
	 */
	public function root() {

		$font_main 				= Options::get_option( 'main__family' );
		$font__main 			= Webfonts::get_font_family( $font_main );
		$main__line_height 		= Options::get_option( 'main__line-height' );
		$main__size 			= Options::get_option( 'main__size' );

		$font_heading 			= Options::get_option( 'heading__family' );
		$font__heading 			= Webfonts::get_font_family( $font_heading );
		$heading__line_height 	= Options::get_option( 'heading__line-height' );

		$h1_size = Options::get_option( 'h1__size' );
		$h2_size = Options::get_option( 'h2__size' );
		$h3_size = Options::get_option( 'h3__size' );
		$h4_size = Options::get_option( 'h4__size' );
		$h5_size = Options::get_option( 'h5__size' );
		$h6_size = Options::get_option( 'h6__size' );

		$font_blockquote 			= Options::get_option( 'blockquote__family' );
		$font__blockquote 			= Webfonts::get_font_family( $font_blockquote );
		$blockquote__line_height 	= Options::get_option( 'blockquote__line-height' );
		$blockquote__size 			= Options::get_option( 'blockquote__size' );

		$font_code 			= Options::get_option( 'code__family' );
		$font__code 		= Webfonts::get_font_family( $font_code );
		$code__line_height 	= Options::get_option( 'code__line-height' );
		$code__size 		= Options::get_option( 'code__size' );

		$css = '
		:root {
			--color__selection-background: '. Options::get_option( 'color__selection-background' ) .';
			--color__selection-text: '. Options::get_option( 'color__selection-text' ) .';

			--color__preloader:'. Options::get_option( 'color__preloader' ) .';
			--color__preloader-background:'. Options::get_option( 'color__preloader-background' ) .';

			--color__text-primary:'. Options::get_option( 'color__text-primary' ) .';
			--color__text-secondary:'. Options::get_option( 'color__text-secondary' ) .';

			--color__code:'. Options::get_option( 'color__code' ) .';
			--color__mark:'. Options::get_option( 'color__mark' ) .';
			--color__mark-background:'. Options::get_option( 'color__mark-background' ) .';
			--color__blockquote:'. Options::get_option( 'color__blockquote' ) .';
			--color__pre:'. Options::get_option( 'color__pre' ) .';
			--color__pre-background:'. Options::get_option( 'color__pre-background' ) .';
			--color__hr:'. Options::get_option( 'color__hr' ) .';

			--color__link:'. Options::get_option( 'color__link' ) .';
			--color__link-hover:'. Options::get_option( 'color__link-hover' ) .';

			--color__input:'. Options::get_option( 'color__input' ) .';
			--color__input-focus:'. Options::get_option( 'color__input-focus' ) .';
			--color__input-border:'. Options::get_option( 'color__input-border' ) .';
			--color__input-border-focus:'. Options::get_option( 'color__input-border-focus' ) .';
			--color__input-text:'. Options::get_option( 'color__input-text' ) .';
			--color__input-text-focus:'. Options::get_option( 'color__input-text-focus' ) .';
			--color__input-placeholder:'. Options::get_option( 'color__input-placeholder' ) .';

			--color__button:'. Options::get_option( 'color__button' ) .';
			--color__button-hover:'. Options::get_option( 'color__button-hover' ) .';
			--color__button-border:'. Options::get_option( 'color__button-border' ) .';
			--color__button-border-hover:'. Options::get_option( 'color__button-border-hover' ) .';
			--color__button-text:'. Options::get_option( 'color__button-text' ) .';
			--color__button-text-hover:'. Options::get_option( 'color__button-text-hover' ) .';

			--color__container:'. Options::get_option( 'color__container' ) .';
			--color__sticky:'. Options::get_option( 'color__sticky' ) .';
			--color__border:'. Options::get_option( 'color__border' ) .';

			--color__header-background:'. Options::get_option( 'color__header-background' ) .';
			--color__header-text:'. Options::get_option( 'color__header-text' ) .';
			--color__header-input:'. Options::get_option( 'color__header-input' ) .';
			--color__header-input-focus:'. Options::get_option( 'color__header-input-focus' ) .';
			--color__header-input-border:'. Options::get_option( 'color__header-input-border' ) .';
			--color__header-input-border-focus:'. Options::get_option( 'color__header-input-border-focus' ) .';
			--color__header-textfield:'. Options::get_option( 'color__header-textfield' ) .';
			--color__header-textfield-focus:'. Options::get_option( 'color__header-textfield-focus' ) .';
			--color__header-btn:'. Options::get_option( 'color__header-btn' ) .';
			--color__header-btn-hover:'. Options::get_option( 'color__header-btn-hover' ) .';
			--color__header-btn-icon:'. Options::get_option( 'color__header-btn-icon' ) .';
			--color__header-btn-icon-hover:'. Options::get_option( 'color__header-btn-icon-hover' ) .';

			--color__submenu-background:'. Options::get_option( 'color__submenu-background' ) .';
			--color__submenu-text:'. Options::get_option( 'color__submenu-text' ) .';

			--color__footer-background:'. Options::get_option( 'color__footer-background' ) .';
			--color__footer-title:'. Options::get_option( 'color__footer-title' ) .';
			--color__footer-text:'. Options::get_option( 'color__footer-text' ) .';
			--color__footer-link:'. Options::get_option( 'color__footer-link' ) .';
			--color__footer-link-hover:'. Options::get_option( 'color__footer-link-hover' ) .';

			--color__border:'. Options::get_option( 'color__border' ) .';

			--color__info:'. Options::get_option( 'color__info' ) .';
			--color__success:'. Options::get_option( 'color__success' ) .';
			--color__error:'. Options::get_option( 'color__error' ) .';

			--color__price:'. Options::get_option( 'color__price' ) .';
			--color__sale:'. Options::get_option( 'color__sale' ) .';
			--color__sale-text:'. Options::get_option( 'color__sale-text' ) .';
			--color__stars:'. Options::get_option( 'color__stars' ) .';
			--color__quick-view-overlay:'. Options::get_option( 'color__quick-view-overlay' ) .';
			--color__notice-background:'. Options::get_option( 'color__notice-background' ) .';
			--color__notice-text:'. Options::get_option( 'color__notice-text' ) .';
			--color__notice-link:'. Options::get_option( 'color__notice-link' ) .';
			--color__notice-link-hover:'. Options::get_option( 'color__notice-link-hover' ) .';

			--main__family: '. $font__main .';
			--main__weight: '. Options::get_option( 'main__weight' ) .';
			--main__transform: '. Options::get_option( 'main__transform' ) .';
			--main__size-px: '. ( $main__size['desktop'] * 16 ) * 1 .'px;
			--main__size:'. $main__size['desktop'] . $main__size['desktop-unit'] .';
			--main__line-height:'. $main__line_height['desktop'] .';

			--heading__family: '. $font__heading .';
			--heading__weight: '. Options::get_option( 'heading__weight' ) .';
			--heading__transform: '. Options::get_option( 'heading__transform' ) .';
			--heading__line-height:'. $heading__line_height['desktop'] .';

			--h1__size-px:'. ( $h1_size['desktop'] * 16 ) * 1 .'px;
			--h1__size:'. $h1_size['desktop'] . $h1_size['desktop-unit'] .';

			--h2__size-px:'. ( $h2_size['desktop'] * 16 ) * 1 .'px;
			--h2__size:'. $h2_size['desktop'] . $h2_size['desktop-unit'] .';

			--h3__size-px:'. ( $h3_size['desktop'] * 16 ) * 1 .'px;
			--h3__size:'. $h3_size['desktop'] . $h3_size['desktop-unit'] .';

			--h4__size-px:'. ( $h4_size['desktop'] * 16 ) * 1 .'px;
			--h4__size:'. $h4_size['desktop'] . $h4_size['desktop-unit'] .';

			--h5__size-px:'. ( $h5_size['desktop'] * 16 ) * 1 .'px;
			--h5__size:'. $h5_size['desktop'] . $h5_size['desktop-unit'] .';

			--h6__size-px:'. ( $h6_size['desktop'] * 16 ) * 1 .'px;
			--h6__size:'. $h6_size['desktop'] . $h6_size['desktop-unit'] .';

			--blockquote__family: '. $font__blockquote .';
			--blockquote__weight: '. Options::get_option( 'blockquote__weight' ) .';
			--blockquote__transform: '. Options::get_option( 'blockquote__transform' ) .';
			--blockquote__size-px:'. ( $blockquote__size['desktop'] * 16 ) * 1 . 'px;
			--blockquote__size:'. $blockquote__size['desktop'] . $blockquote__size['desktop-unit'] .';
			--blockquote__line-height:'. $blockquote__line_height['desktop'] .';

			--code__family: '. $font__code .';
			--code__weight: '. Options::get_option( 'code__weight' ) .';
			--code__transform: '. Options::get_option( 'code__transform' ) .';
			--code__size-px:'. ( $code__size['desktop'] * 16 ) * 1 . 'px;
			--code__size:'. $code__size['desktop'] . $code__size['desktop-unit'] .';
			--code__line-height:'. $code__line_height['desktop'] .';
		}
		';

		if ( ! empty( $css ) ) {
			$css = '<style type=\'text/css\'>'. str_replace( array( "\n", "\t", "\r" ), '', $css ) .'</style>';
			echo trim( $css ); // WPCS: XSS ok.
		}

	}

	/**
	 * Header style callback.
	 *
	 * @return string css
	 */
	public static function header_style() {

		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.

		$css = '';

		if ( ! display_header_text() ) {
			$css .= '
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			';
		}

		if ( ! empty( $css ) ) {
			return trim( $css );
		}

	}

	/**
	 * Dynamic inline CSS
	 *
	 * @return void
	 */
	public function get_inline_css() {

		$css = '';

		$css .= self::header_style();

		if( get_header_image() ) {
			$css .= '.site-header{background-image:url("'. esc_url( get_header_image() ) .'")}';
		}

		if( Options::get_option( 'meta__date' ) === false ) {
			$css .='span.posted-on{display:none}';
		}
		if( Options::get_option( 'meta__author' ) === false ) {
			$css .='span.byline{display:none}';
		}
		if( Options::get_option( 'meta__comment' ) === false ) {
			$css .='span.comments-link{display:none}';
		}
		if( Options::get_option( 'meta__categories' ) === false ) {
			$css .='span.cat-links{display:none}';
		}
		if( Options::get_option( 'meta__tags' ) === false ) {
			$css .='span.tags-links{display:none}';
		}

		$css = apply_filters( 'baltic_inline_style', $css );

		$css = str_replace( array( "\n", "\t", "\r" ), '', $css );

		return $css;

	}

	/**
	 * Print inline style.
	 *
	 * @return void
	 */
	public function print_inline_style() {

		$rtl = ( is_rtl() ) ? '-rtl' : '';
		$css = $this->get_inline_css();

		if ( ! empty( $css ) ) {
			if ( class_exists( 'WooCommerce' ) ) {
				wp_add_inline_style( "baltic-woocommerce-style{$rtl}", trim( $css ) );
			} else {
				wp_add_inline_style( "baltic-style{$rtl}", trim( $css ) );
			}
		}

	}

	/**
	 * Print dynamic style for the editor.
	 *
	 * @return string css
	 */
	public function editor_style( $mceInit ) {

		$styles = '';

		$styles .= '
		:root {
			--color__selection-background: '. Options::get_option( 'color__selection-background' ) .';
			--color__selection-text: '. Options::get_option( 'color__selection-text' ) .';

			--color__preloader:'. Options::get_option( 'color__preloader' ) .';
			--color__preloader-background:'. Options::get_option( 'color__preloader-background' ) .';

			--color__text-primary:'. Options::get_option( 'color__text-primary' ) .';
			--color__text-secondary:'. Options::get_option( 'color__text-secondary' ) .';

			--color__code:'. Options::get_option( 'color__code' ) .';
			--color__mark:'. Options::get_option( 'color__mark' ) .';
			--color__mark-background:'. Options::get_option( 'color__mark-background' ) .';
			--color__blockquote:'. Options::get_option( 'color__blockquote' ) .';
			--color__pre:'. Options::get_option( 'color__pre' ) .';
			--color__pre-background:'. Options::get_option( 'color__pre-background' ) .';
			--color__hr:'. Options::get_option( 'color__hr' ) .';

			--color__link:'. Options::get_option( 'color__link' ) .';
			--color__link-hover:'. Options::get_option( 'color__link-hover' ) .';

			--color__button:'. Options::get_option( 'color__button' ) .';
			--color__button-hover:'. Options::get_option( 'color__button-hover' ) .';
			--color__button-border:'. Options::get_option( 'color__button-border' ) .';
			--color__button-border-hover:'. Options::get_option( 'color__button-border-hover' ) .';
			--color__button-text:'. Options::get_option( 'color__button-text' ) .';
			--color__button-text-hover:'. Options::get_option( 'color__button-text-hover' ) .';

		}
		';

		$styles = str_replace( array( "\n", "\t", "\r" ), '', $styles );

		if ( ! isset( $mceInit['content_style'] ) ) {
			$mceInit['content_style'] = trim( $styles ) . ' ';
		} else {
			$mceInit['content_style'] .= ' ' . trim( $styles ) . ' ';
		}

		return $mceInit;

	}

}
