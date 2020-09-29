<?php
/**
 * Customizer
 *
 * @package Baltic
 */

namespace Baltic;

use Baltic\Options;
use Baltic\Webfonts;
use Baltic\Customizer\Settings;

class Customizer {

	use Instance;

	public $suffix;

	public function __construct() {

		$this->suffix = Utils::get_min_suffix();

		add_action( 'customize_preview_init', 				[ $this, 'preview_js' ] );
		add_action( 'customize_controls_enqueue_scripts', 	[ $this, 'controls_script' ], 15 );

		add_action( 'customize_register', 					[ $this, 'register_controls' ], 2 );
		add_action( 'customize_register', 					[ $this, 'override_default' ] );

		$this->register_settings();

		add_action( 'customize_save_after', [ $this, 'dont_save' ] );

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	public function preview_js() {

		wp_enqueue_script( 'baltic-customizer',
			BALTIC_URI . "/assets/js/customizer{$this->suffix}.js",
			[ 'customize-preview', 'customize-selective-refresh' ],
			BALTIC_VERSION,
			true
		);
		wp_add_inline_script( 'baltic-customizer', $this->webfont_var() , 'before' );

	}

	/**
	 * Additional customizer control scripts.
	 *
	 * @return void
	 */
	public function controls_script() {

		$rtl = ( is_rtl() ) ? '-rtl' : '';

		if ( ! wp_style_is( 'selectWoo', 'enqueued' ) ) {
			wp_enqueue_style( 'selectWoo',
				BALTIC_URI . "/assets/js/selectWoo/css/selectWoo{$this->suffix}.css",
				[],
				'1.0.1'
			);
		}

		wp_enqueue_style( "baltic-customizer-control-style{$rtl}",
			BALTIC_URI . "/assets/css/customizer-control{$rtl}{$this->suffix}.css",
			[ 'wp-color-picker' ],
			BALTIC_VERSION
		);

		if ( ! wp_script_is( 'selectWoo', 'enqueued' ) ) {
			wp_enqueue_script( 'selectWoo',
				BALTIC_URI . "/assets/js/selectWoo/js/selectWoo{$this->suffix}.js",
				[ 'jquery' ],
				'1.0.1',
				true
			);
		}

		if ( ! wp_script_is( 'wp-color-picker-alpha', 'enqueued' ) ) {
			wp_enqueue_script( 'wp-color-picker-alpha',
				BALTIC_URI . "/assets/js/wp-color-picker-alpha/wp-color-picker-alpha{$this->suffix}.js",
				[ 'jquery', 'customize-base', 'wp-color-picker' ],
				BALTIC_VERSION,
				true
			);
		}

		wp_enqueue_script( 'baltic-customizer-control-script',
			BALTIC_URI . "/assets/js/customizer-control{$this->suffix}.js",
			[ 'jquery', 'customize-base', 'customize-controls', 'wp-color-picker', 'wp-color-picker-alpha', 'selectWoo' ],
			BALTIC_VERSION,
			true
		);

		$string = [
			'inherit' 	=> esc_html__( 'Inherit', 'baltic' ),
			'100'     	=> esc_html__( 'Thin 100', 'baltic' ),
			'200'     	=> esc_html__( 'Extra-Light 200', 'baltic' ),
			'300'     	=> esc_html__( 'Light 300', 'baltic' ),
			'400'     	=> esc_html__( 'Normal 400', 'baltic' ),
			'500'     	=> esc_html__( 'Medium 500', 'baltic' ),
			'600'     	=> esc_html__( 'Semi-Bold 600', 'baltic' ),
			'700'     	=> esc_html__( 'Bold 700', 'baltic' ),
			'800'     	=> esc_html__( 'Extra-Bold 800', 'baltic' ),
			'900'     	=> esc_html__( 'Ultra-Bold 900', 'baltic' ),
		];

		wp_localize_script( 'baltic-customizer-control-script', 'balticCustomize', $string );

		wp_add_inline_script( 'baltic-customizer-control-script', $this->webfont_var() , 'before' );

	}

	public function webfont_var() {
		$system = json_encode( Webfonts::get_system_fonts() );
		$google = json_encode( Webfonts::get_google_fonts() );
		$custom = json_encode( Webfonts::get_custom_fonts() );
		if ( ! empty( $custom ) ) {
			return 'var balticFontFamilies = { system: ' . $system . ', custom: ' . $custom . ', google: ' . $google . ' };';
		} else {
			return 'var balticFontFamilies = { system: ' . $system . ', google: ' . $google . ' };';
		}
	}

	/**
	 * Register custom customizer controls.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function register_controls( $wp_customize ) {

		$wp_customize->register_control_type( 'Baltic\Customizer\Controls\Color_Alpha' );
		$wp_customize->register_control_type( 'Baltic\Customizer\Controls\Responsive_Slider' );
		$wp_customize->register_control_type( 'Baltic\Customizer\Controls\Responsive_Spacing' );
		$wp_customize->register_control_type( 'Baltic\Customizer\Controls\Responsive_Units' );
		$wp_customize->register_control_type( 'Baltic\Customizer\Controls\Select' );

	}

	/**
	 * Override default customizer.
	 * @param  [type] $wp_customize [description]
	 * @return [type]               [description]
	 */
	public function override_default( $wp_customize ) {

		$wp_customize->add_panel( BALTIC_DOMAIN . '-color', [
			'title' 		=> esc_html__( 'Theme Color', 'baltic' ),
			'priority' 		=> 199,
		] );

		$wp_customize->add_panel( BALTIC_DOMAIN . '-theme-settings', [
			'title' 		=> esc_html__( 'Theme Settings', 'baltic' ),
			'priority' 		=> 199,
		] );

		$wp_customize->add_panel( BALTIC_DOMAIN . '-typography', [
			'title' 	=> esc_html__( 'Typography', 'baltic' ),
			'priority' 	=> 199,
		] );

		/** WP */
		$wp_customize->get_section( 'title_tagline' )->panel 		= BALTIC_DOMAIN . '-theme-settings';
		$wp_customize->get_section( 'header_image' )->panel 		= BALTIC_DOMAIN . '-theme-settings';
		$wp_customize->get_section( 'background_image' )->panel 	= BALTIC_DOMAIN . '-theme-settings';

		$wp_settings = array(
			'blogname',
			'blogdescription',
			'header_textcolor',
			'header_image',
			'header_image_data',
		);
		foreach ( $wp_settings as $wp_setting ) {
			$wp_customize->get_setting( $wp_setting )->transport = 'postMessage';
		}

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => [ 'Baltic\Components', 'blogname' ],
			) );
			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => [ 'Baltic\Components', 'blogdescription' ],
			) );
		}

	}

	/**
	 * Register customizer settings.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function register_settings() {

		Settings\Color::instance();
		Settings\General::instance();
		Settings\Typography::instance();
		Settings\Woo::instance();
		Customizer\Output::instance();

	}

	public function dont_save() {
		set_theme_mod( 'preloader_preview', '' );
	}

}
