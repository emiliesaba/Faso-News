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

class General {

	use Instance,
		Sanitize,
		Utils;

	public $default;

	public function __construct() {

		$this->default = Options::defaults();

		add_action( 'customize_register', [ $this, 'preloader' ] );
		add_action( 'customize_register', [ $this, 'header' ] );
		add_action( 'customize_register', [ $this, 'layout' ] );
		add_action( 'customize_register', [ $this, 'breadcrumb' ] );
		add_action( 'customize_register', [ $this, 'blog_post' ] );
		add_action( 'customize_register', [ $this, 'footer' ] );

	}

	/**
	 * Preloader settings.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return [type]               [description]
	 */
	public function preloader( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-preloader-section', [
			'title' 		=> esc_html__( 'Preloader', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-theme-settings',
			'priority' 		=> 1,
		] );

		$wp_customize->add_setting( 'preloader', [
			'default' 			=> $this->default['preloader'],
			'sanitize_callback' => [ __class__, 'sanitize_switch' ]
		] );
		$wp_customize->add_control( new Controls\Toggle_Switch( $wp_customize, 'preloader', [
			'label' 			=> esc_html__( 'Preloader', 'baltic' ),
			'section' 			=> BALTIC_DOMAIN . '-preloader-section'
		] ) );

		$wp_customize->add_setting( 'preloader_type', [
			'default'           => $this->default['preloader_type'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]);
		$wp_customize->add_control( 'preloader_type', [
			'label'    	=> esc_html__( 'Preloader style', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-preloader-section',
			'type'     	=> 'select',
			'choices'   => Utils::get_preloader_type()
		] );
		$wp_customize->selective_refresh->add_partial( 'preloader_type', [
			'selector' 				=> '.spinner',
			'settings' 				=> array( 'preloader_type' ),
			'render_callback' 		=> [ 'Baltic\Components', 'preloader' ],
			'container_inclusive'	=> true,
		] );

		$wp_customize->add_setting( 'color__preloader', [
			'default'           => $this->default['color__preloader'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__preloader', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Spinner color', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-preloader-section',
		] ) );

		$wp_customize->add_setting( 'color__preloader-background', [
			'default'           => $this->default['color__preloader-background'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_alpha_color' ],
		] );
		$wp_customize->add_control(	new Controls\Color_Alpha( $wp_customize, 'color__preloader-background', [
			'type'		=> 'baltic-color',
			'label'    	=> esc_html__( 'Background color', 'baltic' ),
			'section'  	=> BALTIC_DOMAIN . '-preloader-section',
		] ) );


		$wp_customize->add_setting( 'preloader_preview', [
			'default' 			=> '',
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_switch' ]
		] );
		$wp_customize->add_control( new Controls\Toggle_Switch( $wp_customize, 'preloader_preview', [
			'label' 			=> esc_html__( 'Preview preloader', 'baltic' ),
			'section' 			=> BALTIC_DOMAIN . '-preloader-section'
		] ) );

	}

	/**
	 * Header setting group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function header( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-header', [
			'title' 		=> esc_html__( 'Header', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-theme-settings',
			'priority' 		=> 2,
		] );

		$wp_customize->add_setting( 'sticky_header', [
			'default' 			=> $this->default['sticky_header'],
			'sanitize_callback' => [ __class__, 'sanitize_switch' ]
		] );
		$wp_customize->add_control( new Controls\Toggle_Switch( $wp_customize, 'sticky_header', [
			'label' 			=> esc_html__( 'Sticky Header', 'baltic' ),
			'section' 			=> BALTIC_DOMAIN . '-header'
		] ) );

	}

	/**
	 * Layout settings.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return [type]               [description]
	 */
	public function layout( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-layout', [
			'title' 		=> esc_html__( 'Layout', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-theme-settings',
		] );

		$wp_customize->add_setting( 'site__layout', [
			'default'           => $this->default['site__layout'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]);
		$wp_customize->add_control( 'site__layout', [
			'label'    => esc_html__( 'Site Layout', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-layout',
			'type'     => 'select',
			'choices'  => array(
				'boxed-layout' 	=> esc_attr__( 'Boxed', 'baltic' ),
				'full-layout' 	=> esc_attr__( 'Full', 'baltic' ),
			),
		]);

		$wp_customize->add_setting( 'layout__archive', [
			'default'           => $this->default['layout__archive'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]);
		$wp_customize->add_control( 'layout__archive', [
			'label'    => esc_html__( 'Archive Layout', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-layout',
			'type'     => 'select',
			'choices'  => Utils::get_main_layout(),
		]);

		$wp_customize->add_setting( 'layout__attachment', [
			'default'           => $this->default['layout__attachment'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]);
		$wp_customize->add_control( 'layout__attachment', [
			'label'    => esc_html__( 'Attachment Layout', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-layout',
			'type'     => 'select',
			'choices'  => Utils::get_main_layout(),
		]);

		$wp_customize->add_setting( 'layout__page', [
			'default'           => $this->default['layout__page'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]);
		$wp_customize->add_control( 'layout__page', [
			'label'    => esc_html__( 'Page Layout', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-layout',
			'type'     => 'select',
			'choices'  => Utils::get_main_layout(),
		]);

		$wp_customize->add_setting( 'layout__single', [
			'default'           => $this->default['layout__single'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		]);
		$wp_customize->add_control( 'layout__single', [
			'label'    => esc_html__( 'Post Layout', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-layout',
			'type'     => 'select',
			'choices'  => Utils::get_main_layout(),
		]);

	}

	/**
	 * Blog post setting group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function breadcrumb( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-breadcrumb', [
			'title' 		=> esc_html__( 'Breadcrumb', 'baltic' ),
			'description'	=> esc_html__( 'Show or hide breadcrumb at specific page.', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-theme-settings',
		] );

		$wp_customize->add_setting( 'breadcrumb__archive', [
		    'default' 			=> $this->default['breadcrumb__archive'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'breadcrumb__archive', [
			'label'    => esc_html__( 'Archive', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-breadcrumb',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'breadcrumb__attachment', [
		    'default' 			=> $this->default['breadcrumb__attachment'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'breadcrumb__attachment', [
			'label'    => esc_html__( 'Attachment', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-breadcrumb',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'breadcrumb__page', [
		    'default' 			=> $this->default['breadcrumb__page'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'breadcrumb__page', [
			'label'    => esc_html__( 'Page', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-breadcrumb',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'breadcrumb__single', [
		    'default' 			=> $this->default['breadcrumb__single'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'breadcrumb__single', [
			'label'    => esc_html__( 'Single post', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-breadcrumb',
			'type'     => 'checkbox'
		] );

	}

	/**
	 * Blog post setting group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function blog_post( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-blog_section', [
			'title' 		=> esc_html__( 'Blog post', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-theme-settings',
		] );

		$wp_customize->add_setting( 'meta__date', [
		    'default' 			=> $this->default['meta__date'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'meta__date', [
			'label'    => esc_html__( 'Display post date', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'meta__author', [
		    'default' 			=> $this->default['meta__author'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'meta__author', [
			'label'    => esc_html__( 'Display post author', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'meta__comment', [
		    'default' 			=> $this->default['meta__comment'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'meta__comment', [
			'label'    => esc_html__( 'Display post comments', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'meta__categories', [
		    'default' 			=> $this->default['meta__categories'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'meta__categories', [
			'label'    => esc_html__( 'Display post categories', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'meta__tags', [
		    'default' 			=> $this->default['meta__tags'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'meta__tags', [
			'label'    => esc_html__( 'Display post tags', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'author_profile', [
		    'default' 			=> $this->default['author_profile'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_checkbox' ],
		] );
		$wp_customize->add_control( 'author_profile', [
			'label'    => esc_html__( 'Display author profile', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'checkbox'
		] );

		$wp_customize->add_setting( 'excerpt_length', [
		    'default' 			=> $this->default['excerpt_length'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => [ __class__, 'sanitize_number' ],
		] );
		$wp_customize->add_control( 'excerpt_length', [
			'label'    => esc_html__( 'Excerpt length', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'number',
		    'input_attrs' => array(
		        'min'   => 1,
		        'max'   => 9999,
		    )
		] );
		$wp_customize->selective_refresh->add_partial( 'excerpt_length', [
			'selector' 				=> 'body.archive #main, body.blog #main',
			'settings' 				=> array( 'excerpt_length' ),
			'render_callback' 		=> [ 'Baltic\Structure\Content', 'do_loop' ],
			'container_inclusive'	=> false,
		] );

		$wp_customize->add_setting( 'more_link_text', [
		    'default' 			=> $this->default['more_link_text'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'more_link_text', [
			'label'    => esc_html__( 'More link text', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'text'
		] );

		$wp_customize->add_setting( 'nav__posts', [
		    'default' 			=> $this->default['nav__posts'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'nav__posts', [
			'label'    => esc_html__( 'Post navigation', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'select',
			'choices'	=> [
				'posts_navigation'	=> esc_html__( 'Prev / Next', 'baltic' ),
				'posts_pagination'	=> esc_html__( 'Pagination', 'baltic' ),
			]
		] );
		$wp_customize->selective_refresh->add_partial( 'nav__posts', [
			'selector' 				=> '#primary:not(.is-woocommerce) .navigation',
			'settings' 				=> array( 'nav__posts' ),
			'render_callback' 		=> [ 'Baltic\Structure\Content', 'do_posts_navigation' ],
			'container_inclusive'	=> true,
		] );

		$wp_customize->add_setting( 'nav__posts-prev', [
		    'default' 			=> $this->default['nav__posts-prev'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'nav__posts-prev', [
			'label'    => esc_html__( 'Previous post text', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'text'
		] );
		$wp_customize->selective_refresh->add_partial( 'nav__posts-prev', [
			'selector' 				=> '#primary:not(.is-woocommerce) .navigation',
			'settings' 				=> array( 'nav__posts-prev' ),
			'render_callback' 		=> [ 'Baltic\Structure\Content', 'do_posts_navigation' ],
			'container_inclusive'	=> true,
		] );

		$wp_customize->add_setting( 'nav__posts-next', [
		    'default' 			=> $this->default['nav__posts-next'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( 'nav__posts-next', [
			'label'    => esc_html__( 'Next post text', 'baltic' ),
			'section'  => BALTIC_DOMAIN . '-blog_section',
			'type'     => 'text'
		] );
		$wp_customize->selective_refresh->add_partial( 'nav__posts-next', [
			'selector' 				=> '#primary:not(.is-woocommerce) .navigation',
			'settings' 				=> array( 'nav__posts-next' ),
			'render_callback' 		=> [ 'Baltic\Structure\Content', 'do_posts_navigation' ],
			'container_inclusive'	=> true,
		] );

	}

	/**
	 * Footer settings group.
	 *
	 * @param  [type] $wp_customize [description]
	 * @return void
	 */
	public function footer( $wp_customize ) {

		$wp_customize->add_section( BALTIC_DOMAIN . '-footer', [
			'title' 		=> esc_html__( 'Footer', 'baltic' ),
			'panel'			=> BALTIC_DOMAIN . '-theme-settings',
		] );

		$wp_customize->add_setting( 'footer__widgets-col', [
			'default'           => $this->default['footer__widgets-col'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_responsive_slider' ],
		] );
		$wp_customize->add_control(	new Controls\Responsive_Slider(	$wp_customize, 'footer__widgets-col', [
			'type'        => 'baltic-responsive-slider',
			'section'     => BALTIC_DOMAIN . '-footer',
			'label'       => esc_html__( 'Footer widgets columns', 'baltic' ),
			'input_attrs' => array(
				'min'  => 1,
				'step' => 1,
				'max'  => 6,
			),
		] ) );
		$wp_customize->selective_refresh->add_partial( 'footer__widgets-col', [
			'selector' 				=> '#tertiary',
			'settings' 				=> array( 'footer__widgets-col' ),
			'render_callback' 		=> [ 'Baltic\Structure\Footer', 'do_footer_widgets' ],
			'container_inclusive'	=> false,
		] );

		$wp_customize->add_setting( 'payment_icons', [
			'default'           => $this->default['payment_icons'],
			'transport'         => 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_multi_choices' ],
		] );
		$wp_customize->add_control(	new Controls\Select( $wp_customize, 'payment_icons', [
			'type'      => 'baltic-select',
			'section'   => BALTIC_DOMAIN . '-footer',
			'label'     => esc_html__( 'Payment icons', 'baltic' ),
			'multiple'	=> 13,
			'choices' 	=> Utils::get_payment_icons(),
		] ) );
		$wp_customize->selective_refresh->add_partial( 'payment_icons', [
			'selector' 				=> '#footer-payments-card-wrap',
			'settings' 				=> array( 'payment_icons' ),
			'render_callback' 		=> [ 'Baltic\Structure\Footer', 'do_payment_icons' ],
			'container_inclusive'	=> false,
		] );

		$wp_customize->add_setting( 'footer__text', [
		    'default' 			=> $this->default['footer__text'],
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'wp_kses_post',
		] );
		$wp_customize->add_control( 'footer__text', [
			'label'    		=> esc_html__( 'Footer copyright', 'baltic' ),
			'description'	=> esc_html__( 'Use {{YEAR}} for dynamic current year. Use {{SITE}} for dynamic site link.', 'baltic' ),
			'section'  		=> BALTIC_DOMAIN . '-footer',
			'type'     		=> 'textarea'
		] );
		$wp_customize->selective_refresh->add_partial( 'footer__text', [
			'selector' 				=> '.site-info',
			'settings' 				=> array( 'footer__text' ),
			'render_callback' 		=> [ 'Baltic\Structure\Footer', 'do_site_info' ],
			'container_inclusive'	=> false,
		] );

		$wp_customize->add_setting( 'footer__credits', [
			'default' 			=> $this->default['footer__credits'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_switch' ]
		] );
		$wp_customize->add_control( new Controls\Toggle_Switch( $wp_customize, 'footer__credits', [
			'label' 			=> esc_html__( 'Display theme designer', 'baltic' ),
			'section' 			=> BALTIC_DOMAIN . '-footer',
		] ) );

		$wp_customize->add_setting( 'return_top', [
			'default' 			=> $this->default['return_top'],
			'transport'			=> 'postMessage',
			'sanitize_callback' => [ __class__, 'sanitize_switch' ]
		] );
		$wp_customize->add_control( new Controls\Toggle_Switch( $wp_customize, 'return_top', [
			'label' 			=> esc_html__( 'Return top link', 'baltic' ),
			'section' 			=> BALTIC_DOMAIN . '-footer',
		] ) );

	}

}
