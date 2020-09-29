<?php
/**
 * General theme settings
 *
 * @package Baltic
 */

namespace Baltic\Customizer\Settings;

use Baltic\Instance;
use Baltic\Options;
use Baltic\Sanitize;
use Baltic\Utils;
use Baltic\Customizer\Controls;

class Woo {

	use Instance,
		Sanitize,
		Utils;

	public $default;

	public function __construct() {

		if( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$this->default = Options::defaults();

		add_action( 'customize_register', [ $this, 'notice' ] );
		add_action( 'customize_register', [ $this, 'color' ] );
		add_action( 'customize_register', [ $this, 'catalog' ] );
		add_action( 'customize_register', [ $this, 'quick_view' ] );

	}

	/**
	 * WooCommerce store notice demo color settings.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function notice( $wp_customize ) {

		$wp_customize->add_setting( 'color__notice-background', [
			'default'           => $this->default['color__notice-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__notice-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background', 'baltic' ),
			'section'  	=> 'woocommerce_store_notice',
		] ) );

		$wp_customize->add_setting( 'color__notice-text', [
			'default'           => $this->default['color__notice-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__notice-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text', 'baltic' ),
			'section'  	=> 'woocommerce_store_notice',
		] ) );

		$wp_customize->add_setting( 'color__notice-link', [
			'default'           => $this->default['color__notice-link'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__notice-link', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Link', 'baltic' ),
			'section'  	=> 'woocommerce_store_notice',
		] ) );

		$wp_customize->add_setting( 'color__notice-link-hover', [
			'default'           => $this->default['color__notice-link-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__notice-link-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Link hover', 'baltic' ),
			'section'  	=> 'woocommerce_store_notice',
		] ) );

	}

	/**
	 * WooCommerce colors group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function color( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-woo_color', [
			'title' 		=> esc_html__( 'Color', 'baltic' ),
			'panel'			=> 'woocommerce',
			'priority'		=> 100
		] );

		$wp_customize->add_setting( 'color__price', [
			'default'           => $this->default['color__price'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__price', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Price color', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-woo_color',
		] ) );

		$wp_customize->add_setting( 'color__sale', [
			'default'           => $this->default['color__sale'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__sale', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Sale', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-woo_color',
		] ) );

		$wp_customize->add_setting( 'color__sale-text', [
			'default'           => $this->default['color__sale-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__sale-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Sale text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-woo_color',
		] ) );

		$wp_customize->add_setting( 'color__stars', [
			'default'           => $this->default['color__stars'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__stars', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Stars rating', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-woo_color',
		] ) );

	}

	/**
	 * Shop catalog settings group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function catalog( $wp_customize ) {

		$wp_customize->add_setting(	'products__per-page', [
		    'default' 			=> $this->default['products__per-page'],
		    'sanitize_callback' => [ __class__, 'sanitize_integer' ],
		] );
		$wp_customize->add_control( 'products__per-page', [
			'label'    		=> esc_html__( 'Products per page', 'baltic' ),
			'section'  		=> 'woocommerce_product_catalog',
			'type'     		=> 'number',
		    'input_attrs' => array(
		        'min'   => 1,
		        'max'   => 9999,
		    )
		] );

		$wp_customize->add_setting( 'products__columns', [
			'default'           => $this->default['products__columns'],
			'sanitize_callback' => [ __class__, 'sanitize_responsive_slider' ],
		] );
		$wp_customize->add_control(	new Controls\Responsive_Slider(	$wp_customize, 'products__columns', [
			'type'        => 'baltic-responsive-slider',
			'section'     => 'woocommerce_product_catalog',
			'label'       => esc_html__( 'Products columns', 'baltic' ),
			'input_attrs' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 6,
			),
		] ) );

		$wp_customize->add_setting( 'products__nav' , [
		    'default' 			=> $this->default['products__nav'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'products__nav', [
			'label'    => esc_html__( 'Product navigation', 'baltic' ),
			'section'  => 'woocommerce_product_catalog',
			'type'     => 'select',
			'choices'	=> [
				'products_navigation'	=> esc_html__( 'Prev / Next', 'baltic' ),
				'products_pagination'	=> esc_html__( 'Pagination', 'baltic' ),
			]
		] );
		$wp_customize->selective_refresh->add_partial( 'products__nav', [
			'selector' 				=> '#primary.is-woocommerce .navigation',
			'settings' 				=> array( 'products__nav' ),
			'render_callback' 		=> [ 'Baltic\Components', 'do_products_navigation' ],
			'container_inclusive'	=> true,
		] );

		$wp_customize->add_setting( 'products__nav-prev]' , [
		    'default' 			=> $this->default['products__nav-prev'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'products__nav-prev', [
			'label'    => esc_html__( 'Previous product text', 'baltic' ),
			'section'  => 'woocommerce_product_catalog',
			'type'     => 'text'
		] );

		$wp_customize->add_setting( 'products__nav-next]' , [
		    'default' 			=> $this->default['products__nav-next'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'products__nav-next', [
			'label'    => esc_html__( 'Next product text', 'baltic' ),
			'section'  => 'woocommerce_product_catalog',
			'type'     => 'text'
		] );

	}

	/**
	 * Quick view settings.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function quick_view( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-quick-view', [
			'title' 		=> esc_html__( 'Quick View', 'baltic' ),
			'panel'			=> 'woocommerce',
			'priority' 		=> 1,
		] );

		$wp_customize->add_setting( 'product__quick-view', [
			'default' 			=> $this->default['product__quick-view'],
			'sanitize_callback' => [ __class__, 'sanitize_switch' ]
		] );
		$wp_customize->add_control( new Controls\Toggle_Switch( $wp_customize, 'product__quick-view', [
			'label' 			=> esc_html__( 'Product quick view', 'baltic' ),
			'section' 			=> BALTIC_DOMAIN . '-quick-view'
		] ) );

		$wp_customize->add_setting( 'color__quick-view-overlay', [
			'default'           => $this->default['color__quick-view-overlay'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__quick-view-overlay', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Overlay color', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-quick-view',
		] ) );

	}

}
