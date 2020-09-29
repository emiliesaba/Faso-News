<?php
/**
 * Customizer color settings.
 *
 * @package Baltic
 */

namespace Baltic\Customizer\Settings;

use Baltic\Instance;
use Baltic\Options;
use Baltic\Sanitize;
use Baltic\Utils;
use Baltic\Customizer\Controls;

class Color {

	use Instance,
		Sanitize,
		Utils;

	public $default;

	public function __construct() {

		$this->default = Options::defaults();

		$colors = [
			'selection',
			'text',
			'tags',
			'link',
			'input',
			'buttons',
			'container',
			'header',
			'menu',
			'footer',
			'background',
			'notice',
		];

		foreach ( $colors as $color ) {
			add_action( 'customize_register', [ $this, $color ] );
		}

	}

	/**
	 * Selection color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function selection( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_selection', [
			'title' 		=> esc_html__( 'Selection', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__selection-background', [
			'default'           => $this->default['color__selection-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__selection-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background color', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_selection',
		] ) );

		$wp_customize->add_setting( 'color__selection-text', [
			'default'           => $this->default['color__selection-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__selection-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text color', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_selection',
		] ) );

	}

	/**
	 * Text color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function text( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_text', [
			'title' 		=> esc_html__( 'Text', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__text-primary', [
			'default'           => $this->default['color__text-primary'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__text-primary', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Primary', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_text',
		] ) );

		$wp_customize->add_setting( 'color__text-secondary', [
			'default'           => $this->default['color__text-secondary'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__text-secondary', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Secondary', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_text',
		] ) );

	}

	/**
	 * HTML tag.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function tags( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_tags', [
			'title' 		=> esc_html__( 'HTML tags', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__code', [
			'default'           => $this->default['color__code'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__code', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'code, kbd, tt, var', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

		$wp_customize->add_setting( 'color__mark', [
			'default'           => $this->default['color__mark'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__mark', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'mark, ins', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

		$wp_customize->add_setting( 'color__mark-background', [
			'default'           => $this->default['color__mark-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__mark-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'mark, ins background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

		$wp_customize->add_setting( 'color__blockquote', [
			'default'           => $this->default['color__blockquote'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__blockquote', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Blockquote border', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

		$wp_customize->add_setting( 'color__pre', [
			'default'           => $this->default['color__pre'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__pre', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Pre text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

		$wp_customize->add_setting( 'color__pre-background', [
			'default'           => $this->default['color__pre-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__pre-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Pre background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

		$wp_customize->add_setting( 'color__hr', [
			'default'           => $this->default['color__hr'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__hr', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Horizontal line', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_tags',
		] ) );

	}

	/**
	 * Link color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function link( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_link', [
			'title' 		=> esc_html__( 'Link', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__link', [
			'default'           => $this->default['color__link'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__link', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Primary', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_link',
		] ) );

		$wp_customize->add_setting( 'color__link-hover', [
			'default'           => $this->default['color__link-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__link-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Hover', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_link',
		] ) );

	}

	/**
	 * Input color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function input( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_input', [
			'title' 		=> esc_html__( 'Input', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__input', [
			'default'           => $this->default['color__input'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

		$wp_customize->add_setting( 'color__input-border', [
			'default'           => $this->default['color__input-border'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input-border', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Border', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

		$wp_customize->add_setting( 'color__input-text', [
			'default'           => $this->default['color__input-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

		$wp_customize->add_setting( 'color__input-placeholder', [
			'default'           => $this->default['color__input-placeholder'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input-placeholder', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Input placeholder', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

		$wp_customize->add_setting( 'color__input-focus', [
			'default'           => $this->default['color__input-focus'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input-focus', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

		$wp_customize->add_setting( 'color__input-border-focus', [
			'default'           => $this->default['color__input-border-focus'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input-border-focus', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Border focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

		$wp_customize->add_setting( 'color__input-text-focus', [
			'default'           => $this->default['color__input-text-focus'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__input-text-focus', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_input',
		] ) );

	}

	/**
	 * Button color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function buttons( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_buttons', [
			'title' 		=> esc_html__( 'Buttons', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__button', [
			'default'           => $this->default['color__button'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__button', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_buttons',
		] ) );

		$wp_customize->add_setting( 'color__button-border', [
			'default'           => $this->default['color__button-border'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__button-border', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Border', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_buttons',
		] ) );

		$wp_customize->add_setting( 'color__button-text', [
			'default'           => $this->default['color__button-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__button-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_buttons',
		] ) );

		$wp_customize->add_setting( 'color__button-hover', [
			'default'           => $this->default['color__button-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__button-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background hover', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_buttons',
		] ) );

		$wp_customize->add_setting( 'color__button-border-hover', [
			'default'           => $this->default['color__button-border-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__button-border-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Border hover', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_buttons',
		] ) );

		$wp_customize->add_setting( 'color__button-text-hover', [
			'default'           => $this->default['color__button-text-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__button-text-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text hover', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_buttons',
		] ) );

	}

	/**
	 * Container color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function container( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_container', [
			'title' 		=> esc_html__( 'Container', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__container', [
			'default'           => $this->default['color__container'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__container', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Container', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_container',
		] ) );

		$wp_customize->add_setting( 'color__border', [
			'default'           => $this->default['color__border'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__border', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Border', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_container',
		] ) );

		$wp_customize->add_setting( 'color__sticky', [
			'default'           => $this->default['color__sticky'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__sticky', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Sticky', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_container',
		] ) );

	}

	/**
	 * Header color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function header( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_header', [
			'title' 		=> esc_html__( 'Header', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->remove_control('header_textcolor');

		$wp_customize->add_setting( 'color__header-background', [
			'default'           => $this->default['color__header-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-text', [
			'default'           => $this->default['color__header-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-input', [
			'default'           => $this->default['color__header-input'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-input', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header input', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-input-focus', [
			'default'           => $this->default['color__header-input-focus'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-input-focus', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header input focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-input-border', [
			'default'           => $this->default['color__header-input-border'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-input-border', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header input border', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-input-border-focus', [
			'default'           => $this->default['color__header-input-border-focus'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-input-border-focus', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header input border focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-textfield', [
			'default'           => $this->default['color__header-textfield'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-textfield', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header textfield', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-textfield-focus', [
			'default'           => $this->default['color__header-textfield-focus'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-textfield-focus', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header textfield focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-btn', [
			'default'           => $this->default['color__header-btn'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-btn', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header input button', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-btn-hover', [
			'default'           => $this->default['color__header-btn-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-btn-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header input button hover/focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-btn-icon', [
			'default'           => $this->default['color__header-btn-icon'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-btn-icon', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header button icon', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

		$wp_customize->add_setting( 'color__header-btn-icon-hover', [
			'default'           => $this->default['color__header-btn-icon-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__header-btn-icon-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Header button icon hover/focus', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_header',
		] ) );

	}

	/**
	 * Submenu color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function menu( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color__submenu', [
			'title' 		=> esc_html__( 'Menu', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__submenu-background', [
			'default'           => $this->default['color__submenu-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__submenu-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'SubMenu Background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color__submenu',
		] ) );

		$wp_customize->add_setting( 'color__submenu-text', [
			'default'           => $this->default['color__submenu-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__submenu-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'SubMenu text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color__submenu',
		] ) );

	}

	/**
	 * Footer color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function footer( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_footer', [
			'title' 		=> esc_html__( 'Footer', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__footer-background', [
			'default'           => $this->default['color__footer-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__footer-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_footer',
		] ) );

		$wp_customize->add_setting( 'color__footer-title', [
			'default'           => $this->default['color__footer-title'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__footer-title', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Widget title', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_footer',
		] ) );

		$wp_customize->add_setting( 'color__footer-text', [
			'default'           => $this->default['color__footer-text'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__footer-text', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Text', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_footer',
		] ) );

		$wp_customize->add_setting( 'color__footer-link', [
			'default'           => $this->default['color__footer-link'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__footer-link', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Link', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_footer',
		] ) );

		$wp_customize->add_setting( 'color__footer-link-hover', [
			'default'           => $this->default['color__footer-link-hover'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__footer-link-hover', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Link hover', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_footer',
		] ) );

	}

	/**
	 * Background color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function background( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_background', [
			'title' 		=> esc_html__( 'Background', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->get_control( 'background_color' )->section = BALTIC_DOMAIN . '-color_background';

	}

	/**
	 * Notification color.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function notice( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-color_notice', [
			'title' 		=> esc_html__( 'Notice', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-color',
		] );

		$wp_customize->add_setting( 'color__info', [
			'default'           => $this->default['color__info'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__info', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Info', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_notice',
		] ) );

		$wp_customize->add_setting( 'color__success', [
			'default'           => $this->default['color__success'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__success', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Success', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_notice',
		] ) );

		$wp_customize->add_setting( 'color__error', [
			'default'           => $this->default['color__error'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__error', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Error', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-color_notice',
		] ) );

	}

}
