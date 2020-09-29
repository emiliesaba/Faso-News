<?php
/**
 * Options class
 *
 * @package Baltic
 */

namespace Baltic;

class Options {

	/**
	 * Get theme option.
	 *
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public static function get_option( $name ) {

		$default = self::defaults();

		if ( array_key_exists( $name, $default ) ) {
			return get_theme_mod( esc_attr( $name ), $default[$name] );
		} else {
			return get_theme_mod( esc_attr( $name ) );
		}

	}

	/**
	 * Get custom field.
	 *
	 * @param  string $field   [description]
	 * @param  int $post_id [description]
	 * @return mixed
	 */
	public static function get_custom_field( $field, $post_id = null ) {

		$post_id = empty( $post_id ) ? get_the_ID() : $post_id;

		if ( ! $post_id ) {
			return '';
		}

		$custom_field = get_post_meta( $post_id, $field, true );

		if ( ! $custom_field ) {
			return '';
		}

		return is_array( $custom_field ) ? $custom_field : wp_kses_decode_entities( $custom_field );

	}

	/**
	 * Default settings.
	 *
	 * @return array default settings value
	 */
	public static function defaults() {

		$defaults = array(
			// Preloader
			'preloader'							=> true,
			'preloader_type'					=> 'pulse',
			'color__preloader'					=> '#ff5722',
			'color__preloader-background'		=> '#ffffff',
			'sticky_header'						=> true,

			// Generic colors
			'color__selection-background'		=> '#ff5722',
			'color__selection-text'				=> '#ffffff',

			'color__text-primary'				=> '#505050',
			'color__text-secondary'				=> '#909090',

			'color__code'						=> '#e83e8c',
			'color__mark'						=> '#505050',
			'color__mark-background'			=> '#fff9c0',
			'color__blockquote'					=> '#ff5722',
			'color__pre'						=> '#505050',
			'color__pre-background'				=> '#eee',
			'color__hr'							=> '#ccc',

			'color__link'						=> '#ff5722',
			'color__link-hover'					=> '#ff8a65',

			'color__input'						=> 'rgba(255,255,255,.5)',
			'color__input-focus'				=> '#ffffff',
			'color__input-border'				=> '#cfd8dc',
			'color__input-border-focus'			=> '#cfd8dc',
			'color__input-text'					=> '#909090',
			'color__input-text-focus'			=> '#606060',
			'color__input-placeholder'			=> '#909090',

			'color__button'						=> '#ff5722',
			'color__button-hover'				=> '#ff8a65',
			'color__button-border'				=> '#ff5722',
			'color__button-border-hover'		=> '#ff8a65',
			'color__button-text'				=> '#ffffff',
			'color__button-text-hover'			=> '#ffffff',

			'color__container'					=> '#ffffff',
			'color__sticky'						=> '#673ab7',
			'color__border'						=> '#cfd8dc',

			// Header color
			'color__header-text'				=> '#505050',
			'color__header-background'			=> '#ffffff',
			'color__header-input'				=> 'rgba(255,255,255,0.5)',
			'color__header-input-focus'			=> 'rgba(255,255,255,1)',
			'color__header-input-border'		=> '#cfd8dc',
			'color__header-input-border-focus'	=> '#cfd8dc',
			'color__header-textfield'			=> '#909090',
			'color__header-textfield-focus'		=> '#505050',
			'color__header-btn'					=> 'rgba(255,255,255,0.5)',
			'color__header-btn-hover'			=> '#ff5722',
			'color__header-btn-icon'			=> '#505050',
			'color__header-btn-icon-hover'		=> '#ffffff',
			'color__submenu-background'			=> '#263238',
			'color__submenu-text'				=> '#ffffff',

			// Footer Color
			'color__footer-background'			=> '#ffffff',
			'color__footer-title'				=> '#505050',
			'color__footer-text'				=> '#909090',
			'color__footer-link'				=> '#505050',
			'color__footer-link-hover'			=> '#ff5722',

			// Notice
			'color__info'				=> '#3D9CD2',
			'color__success'			=> '#0f834d',
			'color__error'				=> '#e2401c',

			// Layout
			'site__layout'				=> 'full-layout',
			'layout__archive'			=> 'content-sidebar',
			'layout__attachment'		=> 'content-sidebar',
			'layout__page'				=> 'content-sidebar',
			'layout__single'			=> 'content-sidebar',

			// Breadcrumb
			'breadcrumb__archive'		=> true,
			'breadcrumb__attachment'	=> true,
			'breadcrumb__page'			=> true,
			'breadcrumb__single'		=> true,

			// Blog post
			'thumb_placeholder'			=> '',
			'meta__date'				=> true,
			'meta__author'				=> true,
			'meta__comment'				=> true,
			'meta__categories'			=> true,
			'meta__tags'				=> true,
			'author_profile'			=> true,
			'excerpt_length'			=> 30,
			'more_link_text'			=> esc_html__( 'Continue reading', 'baltic' ),
			'nav__posts'				=> 'posts_pagination',
			'nav__posts-prev'			=> esc_html( '&larr; Older posts', 'baltic' ),
			'nav__posts-next'			=> esc_html( 'Newer posts &rarr;', 'baltic' ),

			// Footer
			'footer__widgets-col'		=> [
				'desktop'	=> 4,
				'tablet'	=> 2,
				'mobile'	=> 1,
			],
			'footer__text'				=> esc_html__( 'Copyright &copy; 2017-{{YEAR}} {{SITE}}. Proudly powered by {{WP}}.', 'baltic' ),
			'footer__credits'			=> true,
			'return_top'				=> true,
			'payment_icons'				=> '',

			// Typography
			'main__family'		=> 'System',
			'main__weight'		=> '400',
			'main__transform'	=> 'inherit',
			'main__size'		=> [
				'desktop'		=> '1',
				'desktop-unit'	=> 'rem',
			],
			'main__line-height'	=> [
				'desktop'		=> '1.5',
				'desktop-unit'	=> 'em',
			],

			'heading__family'		=> 'System',
			'heading__weight'		=> '600',
			'heading__transform'	=> 'inherit',
			'heading__line-height'	=> [
				'desktop'		=> '1.25',
				'desktop-unit'	=> 'em',
			],
			'h1__size'			=> [
				'desktop'		=> '2.25',
				'desktop-unit'	=> 'rem',
			],
			'h2__size'			=> [
				'desktop'		=> '2',
				'desktop-unit'	=> 'rem',
			],
			'h3__size'			=> [
				'desktop'		=> '1.75',
				'desktop-unit'	=> 'rem',
			],
			'h4__size'			=> [
				'desktop'		=> '1.5',
				'desktop-unit'	=> 'rem',
			],
			'h5__size'			=> [
				'desktop'		=> '1.25',
				'desktop-unit'	=> 'rem',
			],
			'h6__size'			=> [
				'desktop'		=> '1',
				'desktop-unit'	=> 'rem',
			],

			'blockquote__family'		=> 'System',
			'blockquote__weight'		=> '400',
			'blockquote__transform'		=> 'inherit',
			'blockquote__size'			=> [
				'desktop'		=> '1',
				'desktop-unit'	=> 'rem',
			],
			'blockquote__line-height'	=> [
				'desktop'		=> '1.5',
				'desktop-unit'	=> 'em',
			],

			'code__family'		=> 'Courier',
			'code__weight'		=> '400',
			'code__transform'	=> 'inherit',
			'code__size'		=> [
				'desktop'		=> '0.875',
				'desktop-unit'	=> 'rem',
			],
			'code__line-height'	=> [
				'desktop'		=> '1.5',
				'desktop-unit'	=> 'em',
			],

			// WooCommerce
			'color__price'				=> '#77a464',
			'color__sale'				=> '#f44336',
			'color__sale-text'			=> '#ffffff',
			'color__stars'				=> '#ffc107',
			'color__notice-background'	=> '#3D9CD2',
			'color__notice-text'		=> 'rgba(255,255,255,.5)',
			'color__notice-link'		=> '#fff',
			'color__notice-link-hover'	=> '#fff',
			'color__quick-view-overlay'	=> 'rgba(255,255,255,.9)',
			'product__quick-view'		=> true,
			'products__per-page'		=> 12,
			'products__columns'		=> [
				'desktop'	=> 3,
				'tablet'	=> 2,
				'mobile'	=> 2,
			],
			'products__nav'				=> 'products_pagination',
			'products__nav-prev'		=> esc_html( '&larr; Older product', 'baltic' ),
			'products__nav-next'		=> esc_html( 'Newer product &rarr;', 'baltic' ),

		);

		return apply_filters( 'baltic_setting_defaults', $defaults );

	}

}
