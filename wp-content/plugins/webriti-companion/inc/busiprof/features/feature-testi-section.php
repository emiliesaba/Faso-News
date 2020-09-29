<?php
function busiprof_theme_testi_section( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;
	//Testimonial Section
			
	$wp_customize->add_section( 'testimonial_settings' , array(
		'title'      => esc_html__('Testimonial settings', 'webriti-companion'),
		'panel'  => 'section_settings',
		'priority'   => 5,
   	) );
	
		
		$wp_customize->add_setting( 'busiprof_theme_options[home_testimonial_section_enabled]' , array( 'default' => 'on' , 'type' => 'option', 'sanitize_callback' => 'busiprof_sanitize_radio'  ) );
		$wp_customize->add_control(	'busiprof_theme_options[home_testimonial_section_enabled]' , array(
				'label'    => esc_html__( 'Enable Home Testimonial section', 'webriti-companion' ),
				'section'  => 'testimonial_settings',
				'type'     => 'radio',
				'choices' => array(
					'on'=>esc_html__('ON', 'webriti-companion'),
					'off'=>esc_html__('OFF', 'webriti-companion')
				)
		));
		
		// testmonial section title
		$wp_customize->add_setting( 'busiprof_theme_options[testimonials_title]', 
		array( 'default' => esc_html__('Our Testimonials', 'webriti-companion' ) , 'type'=>'option', 'sanitize_callback' => 'busiprof_input_field_sanitize_text'  ) );
		$wp_customize->add_control(	'busiprof_theme_options[testimonials_title]', 
			array(
				'label'    => esc_html__( 'Title', 'webriti-companion' ),
				'section'  => 'testimonial_settings',
				'type'     => 'text',
		));
		
		// testmonial section desc
		$wp_customize->add_setting( 'busiprof_theme_options[testimonials_text]', array( 'default' => esc_html__('We are a group of passionate designers and developers', 'webriti-companion' ) , 'type'=>'option', 'sanitize_callback' => 'sanitize_text_field'  ) );
		$wp_customize->add_control(	'busiprof_theme_options[testimonials_text]', 
			array(
				'label'    => esc_html__( 'Description', 'webriti-companion' ),
				'section'  => 'testimonial_settings',
				'type'     => 'textarea',
		));	
		
		if ( class_exists( 'Webriti_Companion_Repeater' ) ) {
			$wp_customize->add_setting( 'busiprof_testimonial_content', array(
			'sanitize_callback' => 'webriti_companion_repeater_sanitize',
			) );

			$wp_customize->add_control( new Webriti_Companion_Repeater( $wp_customize, 'busiprof_testimonial_content', array(
				'label'                             => esc_html__( 'Testimonial content', 'webriti-companion' ),
				'section'                           => 'testimonial_settings',
				'add_field_label'                   => esc_html__( 'Add new Testimonial', 'webriti-companion' ),
				'item_name'                         => esc_html__( 'Testimonial', 'webriti-companion' ),
				'customizer_repeater_title_control' => true,
				'customizer_repeater_text_control'  => true,
				'customizer_repeater_link_control'  => true,
				'customizer_repeater_image_control' => true,
				'customizer_repeater_designation_control' => true,
				'customizer_repeater_checkbox_control' => true,
				) ) );
		}
}

add_action( 'customize_register', 'busiprof_theme_testi_section' );

function busiprof_register_testi_section_partials( $wp_customize ){
	
$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[testimonials_title]', array(
		'selector'            => '.testimonial-scroll .section-heading',
		'settings'            => 'busiprof_theme_options[testimonials_title]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[testimonials_text]', array(
		'selector'            => '.testimonial-scroll .section-title p',
		'settings'            => 'busiprof_theme_options[testimonials_text]',
	
	) );
}
add_action( 'customize_register', 'busiprof_register_testi_section_partials' );	