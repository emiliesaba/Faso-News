<?php
/**
 * Tijarat Business: Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function tijarat_business_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'tijarat_business_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'tijarat-business' ),
	    'description' => __( 'Description of what this panel does.', 'tijarat-business' ),
	) );

	// font array
	$tijarat_business_font_array = array(
        '' => 'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' => 'Acme',
        'Anton' => 'Anton',
        'Architects Daughter' => 'Architects Daughter',
        'Arimo' => 'Arimo',
        'Arsenal' => 'Arsenal', 
        'Arvo' => 'Arvo',
        'Alegreya' => 'Alegreya',
        'Alfa Slab One' => 'Alfa Slab One',
        'Averia Serif Libre' => 'Averia Serif Libre',
        'Bangers' => 'Bangers', 
        'Boogaloo' => 'Boogaloo',
        'Bad Script' => 'Bad Script',
        'Bitter' => 'Bitter',
        'Bree Serif' => 'Bree Serif',
        'BenchNine' => 'BenchNine', 
        'Cabin' => 'Cabin', 
        'Cardo' => 'Cardo',
        'Courgette' => 'Courgette',
        'Cherry Swash' => 'Cherry Swash',
        'Cormorant Garamond' => 'Cormorant Garamond',
        'Crimson Text' => 'Crimson Text',
        'Cuprum' => 'Cuprum', 
        'Cookie' => 'Cookie', 
        'Chewy' => 'Chewy', 
        'Days One' => 'Days One', 
        'Dosis' => 'Dosis',
        'Droid Sans' => 'Droid Sans',
        'Economica' => 'Economica',
        'Fredoka One' => 'Fredoka One',
        'Fjalla One' => 'Fjalla One',
        'Francois One' => 'Francois One',
        'Frank Ruhl Libre' => 'Frank Ruhl Libre',
        'Gloria Hallelujah' => 'Gloria Hallelujah',
        'Great Vibes' => 'Great Vibes',
        'Handlee' => 'Handlee', 
        'Hammersmith One' => 'Hammersmith One',
        'Inconsolata' => 'Inconsolata', 
        'Indie Flower' => 'Indie Flower', 
        'IM Fell English SC' => 'IM Fell English SC', 
        'Julius Sans One' => 'Julius Sans One',
        'Josefin Slab' => 'Josefin Slab', 
        'Josefin Sans' => 'Josefin Sans', 
        'Kanit' => 'Kanit', 
        'Lobster' => 'Lobster', 
        'Lato' => 'Lato',
        'Lora' => 'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather', 
        'Monda' => 'Monda',
        'Montserrat' => 'Montserrat',
        'Muli' => 'Muli', 
        'Marck Script' => 'Marck Script',
        'Noto Serif' => 'Noto Serif',
        'Open Sans' => 'Open Sans', 
        'Overpass' => 'Overpass',
        'Overpass Mono' => 'Overpass Mono',
        'Oxygen' => 'Oxygen', 
        'Orbitron' => 'Orbitron', 
        'Patua One' => 'Patua One', 
        'Pacifico' => 'Pacifico',
        'Padauk' => 'Padauk', 
        'Playball' => 'Playball',
        'Playfair Display' => 'Playfair Display', 
        'PT Sans' => 'PT Sans',
        'Philosopher' => 'Philosopher',
        'Permanent Marker' => 'Permanent Marker',
        'Poiret One' => 'Poiret One', 
        'Quicksand' => 'Quicksand', 
        'Quattrocento Sans' => 'Quattrocento Sans', 
        'Raleway' => 'Raleway', 
        'Rubik' => 'Rubik', 
        'Rokkitt' => 'Rokkitt', 
        'Russo One' => 'Russo One', 
        'Righteous' => 'Righteous', 
        'Slabo' => 'Slabo', 
        'Source Sans Pro' => 'Source Sans Pro', 
        'Shadows Into Light Two' =>'Shadows Into Light Two', 
        'Shadows Into Light' => 'Shadows Into Light', 
        'Sacramento' => 'Sacramento', 
        'Shrikhand' => 'Shrikhand', 
        'Tangerine' => 'Tangerine',
        'Ubuntu' => 'Ubuntu', 
        'VT323' => 'VT323', 
        'Varela Round' => 'Varela Round', 
        'Vampiro One' => 'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' => 'Volkhov', 
        'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
    );
    
	//Typography
	$wp_customize->add_section( 'tijarat_business_typography', array(
    	'title'      => __( 'Color / Fonts Settings', 'tijarat-business' ),
		'panel' => 'tijarat_business_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'tijarat_business_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_paragraph_color', array(
		'label' => __('Paragraph Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_paragraph_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'Paragraph Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	$wp_customize->add_setting('tijarat_business_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'tijarat_business_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_atag_color', array(
		'label' => __('"a" Tag Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_atag_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( '"a" Tag Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'tijarat_business_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_li_color', array(
		'label' => __('"li" Tag Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_li_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( '"li" Tag Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'tijarat_business_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_h1_color', array(
		'label' => __('H1 Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_h1_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'H1 Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('tijarat_business_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_h1_font_size',array(
		'label'	=> __('H1 Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'tijarat_business_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_h2_color', array(
		'label' => __('h2 Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_h2_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'h2 Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('tijarat_business_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_h2_font_size',array(
		'label'	=> __('h2 Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'tijarat_business_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_h3_color', array(
		'label' => __('h3 Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_h3_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'h3 Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('tijarat_business_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_h3_font_size',array(
		'label'	=> __('h3 Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'tijarat_business_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_h4_color', array(
		'label' => __('h4 Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_h4_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'h4 Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('tijarat_business_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_h4_font_size',array(
		'label'	=> __('h4 Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'tijarat_business_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_h5_color', array(
		'label' => __('h5 Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_h5_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'h5 Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('tijarat_business_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_h5_font_size',array(
		'label'	=> __('h5 Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'tijarat_business_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_h6_color', array(
		'label' => __('h6 Color', 'tijarat-business'),
		'section' => 'tijarat_business_typography',
		'settings' => 'tijarat_business_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('tijarat_business_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control(
	    'tijarat_business_h6_font_family', array(
	    'section'  => 'tijarat_business_typography',
	    'label'    => __( 'h6 Fonts','tijarat-business'),
	    'type'     => 'select',
	    'choices'  => $tijarat_business_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('tijarat_business_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_h6_font_size',array(
		'label'	=> __('h6 Font Size','tijarat-business'),
		'section'	=> 'tijarat_business_typography',
		'setting'	=> 'tijarat_business_h6_font_size',
		'type'	=> 'text'
	));

	//Global Color Settings
	$wp_customize->add_section( 'tijarat_business_theme_color_option', array( 
		'panel' => 'tijarat_business_panel_id', 
		'title' => esc_html__( 'Theme Color Option', 'tijarat-business' )
	));

  	$wp_customize->add_setting( 'tijarat_business_theme_color', array(
	    'default' => '#5467ea',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_theme_color', array(
  		'label' => __( 'Color Option', 'tijarat-business' ),
	    'description' => __('One can change complete theme color on just one click.', 'tijarat-business'),
	    'section' => 'tijarat_business_theme_color_option',
	    'settings' => 'tijarat_business_theme_color',
  	)));

  	// woocommerce Options
	$wp_customize->add_section( 'tijarat_business_shop_page_options', array(
    	'title'      => __( 'Shop Page Settings', 'tijarat-business' ),
		'panel' => 'tijarat_business_panel_id'
	) );

	$wp_customize->add_setting('tijarat_business_display_related_products',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_display_related_products',array(
       'type' => 'checkbox',
       'label' => __('Related Product','tijarat-business'),
       'section' => 'tijarat_business_shop_page_options',
    ));

    $wp_customize->add_setting('tijarat_business_shop_products_border',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_shop_products_border',array(
       'type' => 'checkbox',
       'label' => __('Product Border','tijarat-business'),
       'section' => 'tijarat_business_shop_page_options',
    ));

	$wp_customize->add_setting( 'tijarat_business_woocommerce_product_per_columns' , array(
		'default'           => 3,
		'transport'         => 'refresh',
		'sanitize_callback' => 'tijarat_business_sanitize_choices',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tijarat_business_woocommerce_product_per_columns', array(
		'label'    => __( 'Total Products Per Columns', 'tijarat-business' ),
		'section'  => 'tijarat_business_shop_page_options',
		'type'     => 'radio',
		'choices'  => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
		),
	) ) );

	$wp_customize->add_setting('tijarat_business_woocommerce_product_per_page',array(
		'default'	=> 9,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));	
	$wp_customize->add_control('tijarat_business_woocommerce_product_per_page',array(
		'label'	=> __('Total Products Per Page','tijarat-business'),
		'section'	=> 'tijarat_business_shop_page_options',
		'type'		=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_shop_page_top_padding',array(
		'default' => 10,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control( 'tijarat_business_shop_page_top_padding',	array(
		'label' => esc_html__( 'Product Padding (Top Bottom)','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_shop_page_left_padding',array(
		'default' => 10,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control( 'tijarat_business_shop_page_left_padding',	array(
		'label' => esc_html__( 'Product Padding (Right Left)','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_shop_page_border_radius',array(
		'default' => 0,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_shop_page_border_radius',array(
		'label' => esc_html__( 'Product Border Radius','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_shop_page_box_shadow',array(
		'default' => 0,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_shop_page_box_shadow',array(
		'label' => esc_html__( 'Product Shadow','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_shop_button_padding_top',array(
		'default' => 9,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_shop_button_padding_top',	array(
		'label' => esc_html__( 'Button Padding (Top Bottom)','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type'		=> 'number',

	));

	$wp_customize->add_setting( 'tijarat_business_shop_button_padding_left',array(
		'default' => 16,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_shop_button_padding_left',array(
		'label' => esc_html__( 'Button Padding (Right Left)','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'type'		=> 'number',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'tijarat_business_shop_button_border_radius',array(
		'default' => 25,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_shop_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius','tijarat-business' ),
		'section' => 'tijarat_business_shop_page_options',
		'type'		=> 'number',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	//Layout Settings
	$wp_customize->add_section( 'tijarat_business_width_layout', array(
    	'title'      => __( 'Layout Settings', 'tijarat-business' ),
		'panel' => 'tijarat_business_panel_id'
	) );

	$wp_customize->add_setting( 'tijarat_business_fixed_header',array(
		'default' => false,
      	'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ) );
    $wp_customize->add_control('tijarat_business_fixed_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Enable / Disable Fixed Header','tijarat-business' ),
        'section' => 'tijarat_business_width_layout'
    ));

	$wp_customize->add_setting('tijarat_business_loader_setting',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_loader_setting',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Preloader','tijarat-business'),
       'section' => 'tijarat_business_width_layout'
    ));

    $wp_customize->add_setting('tijarat_business_preloader_types',array(
        'default' => __('Default','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control('tijarat_business_preloader_types',array(
        'type' => 'radio',
        'label' => __('Preloader Option','tijarat-business'),
        'section' => 'tijarat_business_width_layout',
        'choices' => array(
            'Default' => __('Default','tijarat-business'),
            'Circle' => __('Circle','tijarat-business'),
            'Two Circle' => __('Two Circle','tijarat-business')
        ),
	) );

    $wp_customize->add_setting( 'tijarat_business_loader_color_setting', array(
	    'default' => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_loader_color_setting', array(
  		'label' => __('Preloader Color Option', 'tijarat-business'),
	    'section' => 'tijarat_business_width_layout',
	    'settings' => 'tijarat_business_loader_color_setting',
  	)));

  	$wp_customize->add_setting( 'tijarat_business_loader_background_color', array(
	    'default' => '#000',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_loader_background_color', array(
  		'label' => __('Preloader Background Color Option', 'tijarat-business'),
	    'section' => 'tijarat_business_width_layout',
	    'settings' => 'tijarat_business_loader_background_color',
  	)));

	$wp_customize->add_setting('tijarat_business_theme_options',array(
    'default' => __('Default','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control('tijarat_business_theme_options',array(
        'type' => 'select',
        'label' => __('Container Box','tijarat-business'),
        'description' => __('Here you can change the Width layout. ','tijarat-business'),
        'section' => 'tijarat_business_width_layout',
        'choices' => array(
            'Default' => __('Default','tijarat-business'),
            'Wide Layout' => __('Wide Layout','tijarat-business'),
            'Box Layout' => __('Box Layout','tijarat-business'),
        ),
	) );

	// Button Settings
	$wp_customize->add_section( 'tijarat_business_button_option', array(
		'title' =>  __('Button', 'tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));

	$wp_customize->add_setting('tijarat_business_top_bottom_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_top_bottom_padding',array(
		'label'	=> __('Top and Bottom Padding ','tijarat-business'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 1,
			'max'              => 50,
        ),
		'section'=> 'tijarat_business_button_option',
		'type'=> 'number'
	));

	$wp_customize->add_setting('tijarat_business_left_right_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_left_right_padding',array(
		'label'	=> __('Left and Right Padding','tijarat-business'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 1,
			'max'              => 50,
        ),
		'section'=> 'tijarat_business_button_option',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_border_radius', array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	) );
	$wp_customize->add_control( 'tijarat_business_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','tijarat-business' ),
		'section'     => 'tijarat_business_button_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

  	//Sidebar Layout Settings
	$wp_customize->add_section( 'tijarat_business_general_option', array(
    	'title'      => __( 'Sidebar Settings', 'tijarat-business' ),
		'panel' => 'tijarat_business_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('tijarat_business_layout_settings',array(
        'default' => __('Right Sidebar','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'	        
	));
	$wp_customize->add_control('tijarat_business_layout_settings',array(
        'type' => 'radio',
        'label'     => __('Theme Sidebar Layouts', 'tijarat-business'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'tijarat-business'),
        'section' => 'tijarat_business_general_option',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','tijarat-business'),
            'Right Sidebar' => __('Right Sidebar','tijarat-business'),
            'One Column' => __('Full Width','tijarat-business'),
            'Grid Layout' => __('Grid Layout','tijarat-business')
        ),
	));

	//home page slider
	$wp_customize->add_section( 'tijarat_business_slider' , array(
    	'title'      => __( 'Slider Settings', 'tijarat-business' ),
		'priority'   => null,
		'panel' => 'tijarat_business_panel_id'
	) );

	$wp_customize->add_setting('tijarat_business_slider_arrows',array(
        'default' => false,
        'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
	));
	$wp_customize->add_control('tijarat_business_slider_arrows',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide slider','tijarat-business'),
      	'section' => 'tijarat_business_slider',
	));

	$wp_customize->add_setting('tijarat_business_slider_title',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_slider_title',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Slider Title','tijarat-business'),
       'section' => 'tijarat_business_slider'
    ));

    $wp_customize->add_setting('tijarat_business_slider_content',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_slider_content',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Slider Content','tijarat-business'),
       'section' => 'tijarat_business_slider'
    ));

    $wp_customize->add_setting('tijarat_business_slider_button',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_slider_button',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Slider Button','tijarat-business'),
       'section' => 'tijarat_business_slider'
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'tijarat_business_slide_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'tijarat_business_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'tijarat_business_slide_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'tijarat-business' ),
			'section'  => 'tijarat_business_slider',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting( 'tijarat_business_slider_speed',array(
		'default' => 3000,
		'sanitize_callback' => 'tijarat_business_sanitize_number_range',
	));
	$wp_customize->add_control( 'tijarat_business_slider_speed',array(
		'label' => esc_html__( 'Slider Speed','tijarat-business' ),
		'section' => 'tijarat_business_slider',
		'type'        => 'range',
		'input_attrs' => array(
			'min' => 1000,
			'max' => 5000,
			'step' => 500,
		),
	));

	$wp_customize->add_setting('tijarat_business_slider_height_option',array(
		'default'=> __('600','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_slider_height_option',array(
		'label'	=> __('Slider Height Option','tijarat-business'),
		'section'=> 'tijarat_business_slider',
		'type'=> 'text'
	));

    $wp_customize->add_setting('tijarat_business_slider_content_option',array(
    'default' => __('Left','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control('tijarat_business_slider_content_option',array(
        'type' => 'select',
        'label' => __('Slider Content Layout','tijarat-business'),
        'description' => __('Here you can change the Slider Content. ','tijarat-business'),
        'section' => 'tijarat_business_slider',
        'choices' => array(
            'Center' => __('Center','tijarat-business'),
            'Left' => __('Left','tijarat-business'),
            'Right' => __('Right','tijarat-business'),
        ),
	) );

	$wp_customize->add_setting('tijarat_business_slider_button_text',array(
		'default'=> __('READ MORE','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_slider_button_text',array(
		'label'	=> __('Slider Button Text','tijarat-business'),
		'section'=> 'tijarat_business_slider',
		'type'=> 'text'
	));

    //Slider excerpt
	$wp_customize->add_setting( 'tijarat_business_slider_excerpt_number', array(
		'default'              => 20,
		'sanitize_callback'    => 'tijarat_business_sanitize_number_range',
	) );
	$wp_customize->add_control( 'tijarat_business_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','tijarat-business' ),
		'section'     => 'tijarat_business_slider',
		'type'        => 'range',
		'settings'    => 'tijarat_business_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('tijarat_business_slider_opacity_color',array(
      'default'              => __('0.6','tijarat-business'),
      'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control( 'tijarat_business_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','tijarat-business' ),
	'section'     => 'tijarat_business_slider',
	'type'        => 'select',
	'settings'    => 'tijarat_business_slider_opacity_color',
	'choices' => array(
		'0' =>  esc_attr('0','tijarat-business'),
		'0.1' =>  esc_attr('0.1','tijarat-business'),
		'0.2' =>  esc_attr('0.2','tijarat-business'),
		'0.3' =>  esc_attr('0.3','tijarat-business'),
		'0.4' =>  esc_attr('0.4','tijarat-business'),
		'0.5' =>  esc_attr('0.5','tijarat-business'),
		'0.6' =>  esc_attr('0.6','tijarat-business'),
		'0.7' =>  esc_attr('0.7','tijarat-business'),
		'0.8' =>  esc_attr('0.8','tijarat-business'),
		'0.9' =>  esc_attr('0.9','tijarat-business')
	),
	));

	//About
	$wp_customize->add_section('tijarat_business_about',array(
		'title'	=> __('About','tijarat-business'),
		'description'	=> __('Add About Section below.','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));

	$wp_customize->add_setting( 'tijarat_business_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'tijarat_business_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'tijarat_business_about_page', array(
		'label'    => __( 'Select About Page', 'tijarat-business' ),
		'section'  => 'tijarat_business_about',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_section('tijarat_business_service',array(
		'title'	=> __('Our Services','tijarat-business'),
		'description'	=> __('Add Our Services sections below.','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));

	$wp_customize->add_setting('tijarat_business_service_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('tijarat_business_service_title',array(
		'label'	=> __('Section Title','tijarat-business'),
		'section'	=> 'tijarat_business_service',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('tijarat_business_service_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('tijarat_business_service_text',array(
		'label'	=> __('Add Text','tijarat-business'),
		'section'	=> 'tijarat_business_service',
		'type'		=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('tijarat_business_service_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'tijarat_business_sanitize_choices',
	));
	$wp_customize->add_control('tijarat_business_service_category',array(
		'type'    => 'select',
		'description' => __('Image Size (537 x 358)','tijarat-business'),
		'choices' => $cat_post,
		'label' => __('Select Category to display Latest Post','tijarat-business'),
		'section' => 'tijarat_business_service',
	));

	//no Result Setting
	$wp_customize->add_section('tijarat_business_no_result_setting',array(
		'title'	=> __('No Results Settings','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));	

	$wp_customize->add_setting('tijarat_business_no_search_result_title',array(
		'default'=> __('Nothing Found','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_no_search_result_title',array(
		'label'	=> __('No Search Results Title','tijarat-business'),
		'section'=> 'tijarat_business_no_result_setting',
		'type'=> 'text'
	));

	$wp_customize->add_setting('tijarat_business_no_search_result_content',array(
		'default'=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_no_search_result_content',array(
		'label'	=> __('No Search Results Content','tijarat-business'),
		'section'=> 'tijarat_business_no_result_setting',
		'type'=> 'text'
	));

	//404 Page Setting
	$wp_customize->add_section('tijarat_business_page_not_found_setting',array(
		'title'	=> __('Page Not Found Settings','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));	

	$wp_customize->add_setting('tijarat_business_page_not_found_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_page_not_found_title',array(
		'label'	=> __('Page Not Found Title','tijarat-business'),
		'section'=> 'tijarat_business_page_not_found_setting',
		'type'=> 'text'
	));

	$wp_customize->add_setting('tijarat_business_page_not_found_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_page_not_found_content',array(
		'label'	=> __('Page Not Found Content','tijarat-business'),
		'section'=> 'tijarat_business_page_not_found_setting',
		'type'=> 'text'
	));

	//Responsive Media Settings
	$wp_customize->add_section('tijarat_business_mobile_media',array(
		'title'	=> __('Mobile Media Settings','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));

	$wp_customize->add_setting('tijarat_business_enable_disable_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_enable_disable_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Sidebar','tijarat-business'),
       'section' => 'tijarat_business_mobile_media'
    ));

    $wp_customize->add_setting('tijarat_business_enable_disable_fixed_header',array(
       'default' => false,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_enable_disable_fixed_header',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Fixed Header','tijarat-business'),
       'section' => 'tijarat_business_mobile_media'
    ));

    $wp_customize->add_setting('tijarat_business_enable_disable_slider',array(
       'default' => false,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_enable_disable_slider',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Slider','tijarat-business'),
       'section' => 'tijarat_business_mobile_media'
    ));

    $wp_customize->add_setting('tijarat_business_show_hide_slider_button',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_show_hide_slider_button',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Slider Button','tijarat-business'),
       'section' => 'tijarat_business_mobile_media'
    ));

    $wp_customize->add_setting('tijarat_business_enable_disable_scrolltop',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_enable_disable_scrolltop',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Scroll To Top','tijarat-business'),
       'section' => 'tijarat_business_mobile_media'
    ));

	//Blog Post
	$wp_customize->add_section('tijarat_business_blog_post',array(
		'title'	=> __('Post Settings','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));	

	$wp_customize->add_setting('tijarat_business_date_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_date_hide',array(
       'type' => 'checkbox',
       'label' => __('Post Date','tijarat-business'),
       'section' => 'tijarat_business_blog_post'
    ));

    $wp_customize->add_setting('tijarat_business_comment_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_comment_hide',array(
       'type' => 'checkbox',
       'label' => __('Post Comments','tijarat-business'),
       'section' => 'tijarat_business_blog_post'
    ));

    $wp_customize->add_setting('tijarat_business_author_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_author_hide',array(
       'type' => 'checkbox',
       'label' => __('Post Author','tijarat-business'),
       'section' => 'tijarat_business_blog_post'
    ));

    $wp_customize->add_setting( 'tijarat_business_blog_post_metabox_seperator', array(
		'default'   => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'tijarat_business_blog_post_metabox_seperator', array(
		'label'       => esc_html__( 'Blog Post Meta Box Seperator','tijarat-business' ),
		'section'     => 'tijarat_business_blog_post',
		'description' => __('Add the seperator for meta box. Example: ",",  "|", "/", etc. ','tijarat-business'),
		'type'        => 'text',
		'settings'    => 'tijarat_business_blog_post_metabox_seperator',
	) );

    $wp_customize->add_setting('tijarat_business_blog_post_layout',array(
        'default' => __('Default','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'
    ));
    $wp_customize->add_control('tijarat_business_blog_post_layout',array(
        'type' => 'radio',
        'label' => __('Post Layout Option','tijarat-business'),
        'section' => 'tijarat_business_blog_post',
        'choices' => array(
            'Default' => __('Default','tijarat-business'),
            'Center' => __('Center','tijarat-business'),
            'Image and Content' => __('Image and Content','tijarat-business'),
        ),
	) );

	$wp_customize->add_setting('tijarat_business_blog_description',array(
    	'default'   => __('Post Excerpt','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control('tijarat_business_blog_description',array(
        'type' => 'select',
        'label' => __('Post Description','tijarat-business'),
        'section' => 'tijarat_business_blog_post',
        'choices' => array(
            'None' => __('None','tijarat-business'),
            'Post Excerpt' => __('Post Excerpt','tijarat-business'),
            'Post Content' => __('Post Content','tijarat-business'),
        ),
	) );

    $wp_customize->add_setting( 'tijarat_business_excerpt_number', array(
		'default'              => 20,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	) );
	$wp_customize->add_control( 'tijarat_business_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','tijarat-business' ),
		'section'     => 'tijarat_business_blog_post',
		'type'        => 'number',
		'settings'    => 'tijarat_business_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'tijarat_business_post_excerpt_suffix', array(
		'default'   => __('{...}','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'tijarat_business_post_excerpt_suffix', array(
		'label'       => esc_html__( 'Excerpt Indicator','tijarat-business' ),
		'section'     => 'tijarat_business_blog_post',
		'type'        => 'text',
		'settings'    => 'tijarat_business_post_excerpt_suffix',
	) );

	$wp_customize->add_setting('tijarat_business_button_text',array(
		'default'=> __('Continue Reading....','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_button_text',array(
		'label'	=> __('Add Button Text','tijarat-business'),
		'section'=> 'tijarat_business_blog_post',
		'type'=> 'text'
	));

	$wp_customize->add_setting('tijarat_business_show_post_pagination',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_show_post_pagination',array(
       'type' => 'checkbox',
       'label' => __('Post Pagination','tijarat-business'),
       'section' => 'tijarat_business_blog_post'
    ));

	$wp_customize->add_setting( 'tijarat_business_pagination_option', array(
        'default'			=> __('Default','tijarat-business'),
        'sanitize_callback'	=> 'tijarat_business_sanitize_choices'
    ));
    $wp_customize->add_control( 'tijarat_business_pagination_option', array(
        'section' => 'tijarat_business_blog_post',
        'type' => 'radio',
        'label' => __( 'Post Pagination', 'tijarat-business' ),
        'choices'		=> array(
            'Default'  => __( 'Default', 'tijarat-business' ),
            'next-prev' => __( 'Next / Previous', 'tijarat-business' ),
    )));

    // Single post setting
    $wp_customize->add_section('tijarat_business_single_post_section',array(
		'title'	=> __('Single Post Settings','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));	

	$wp_customize->add_setting('tijarat_business_tags_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_tags_hide',array(
       'type' => 'checkbox',
       'label' => __('Single Post Tags','tijarat-business'),
       'section' => 'tijarat_business_single_post_section'
    ));

    $wp_customize->add_setting('tijarat_business_single_post_image',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_single_post_image',array(
       'type' => 'checkbox',
       'label' => __('Single Post Featured Image','tijarat-business'),
       'section' => 'tijarat_business_single_post_section'
    ));

    $wp_customize->add_setting( 'tijarat_business_seperator_metabox', array(
		'default'   => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'tijarat_business_seperator_metabox', array(
		'label'       => esc_html__( 'Single Post Meta Box Seperator','tijarat-business' ),
		'section'     => 'tijarat_business_single_post_section',
		'description' => __('Add the seperator for meta box. Example: ",",  "|", "/", etc. ','tijarat-business'),
		'type'        => 'text',
		'settings'    => 'tijarat_business_seperator_metabox',
	) );

	$wp_customize->add_setting('tijarat_business_comment_form_heading',array(
       'default' => __('Leave a Reply','tijarat-business'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('tijarat_business_comment_form_heading',array(
       'type' => 'text',
       'label' => __('Comment Form Heading','tijarat-business'),
       'section' => 'tijarat_business_single_post_section'
    ));

    $wp_customize->add_setting('tijarat_business_comment_button_text',array(
       'default' => __('Post Comment','tijarat-business'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('tijarat_business_comment_button_text',array(
       'type' => 'text',
       'label' => __('Comment Submit Button Text','tijarat-business'),
       'section' => 'tijarat_business_single_post_section'
    ));

    $wp_customize->add_setting( 'tijarat_business_comment_form_size',array(
		'default' => 100,
		'sanitize_callback'    => 'tijarat_business_sanitize_number_range',
	));
	$wp_customize->add_control('tijarat_business_comment_form_size',	array(
		'label' => esc_html__( 'Comment Form Size','tijarat-business' ),
		'section' => 'tijarat_business_single_post_section',
		'type' => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
			'step' => 1,
		),
	));

    // related post setting
    $wp_customize->add_section('tijarat_business_related_post_section',array(
		'title'	=> __('Related Post Settings','tijarat-business'),
		'panel' => 'tijarat_business_panel_id',
	));	

	$wp_customize->add_setting('tijarat_business_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
    ));
    $wp_customize->add_control('tijarat_business_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Related Post','tijarat-business'),
       'section' => 'tijarat_business_related_post_section',
    ));

	$wp_customize->add_setting( 'tijarat_business_show_related_post', array(
        'default' => __(' By Categories', 'tijarat-business'),
        'sanitize_callback'	=> 'tijarat_business_sanitize_choices'
    ));
    $wp_customize->add_control( 'tijarat_business_show_related_post', array(
        'section' => 'tijarat_business_related_post_section',
        'type' => 'radio',
        'label' => __( 'Show Related Posts', 'tijarat-business' ),
        'choices' => array(
            'categories'  => __(' By Categories', 'tijarat-business'),
            'tags' => __( ' By Tags', 'tijarat-business' ),
    )));

    $wp_customize->add_setting('tijarat_business_change_related_post_title',array(
		'default'=> __('Related Posts','tijarat-business'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tijarat_business_change_related_post_title',array(
		'label'	=> __('Change Related Post Title','tijarat-business'),
		'section'=> 'tijarat_business_related_post_section',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('tijarat_business_change_related_posts_number',array(
		'default'=> 3,
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_change_related_posts_number',array(
		'label'	=> __('Change Related Post Number','tijarat-business'),
		'section'=> 'tijarat_business_related_post_section',
		'type'=> 'number',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	));

	//Footer
	$wp_customize->add_section( 'tijarat_business_footer' , array(
    	'title' => __( 'Footer Section', 'tijarat-business' ),
		'priority'   => null,
		'panel' => 'tijarat_business_panel_id'
	) );

	$wp_customize->add_setting('tijarat_business_footer_widget',array(
        'default'           => '4',
        'sanitize_callback' => 'tijarat_business_sanitize_choices',
    ));
    $wp_customize->add_control('tijarat_business_footer_widget',array(
        'type'        => 'radio',
        'label'       => __('No. of Footer widget area', 'tijarat-business'),
        'section'     => 'tijarat_business_footer',
        'description' => __('Select the number of footer widget areas and after that, go to Appearance > Widgets and add your widgets in the footer.', 'tijarat-business'),
        'choices' => array(
            '1'     => __('One', 'tijarat-business'),
            '2'     => __('Two', 'tijarat-business'),
            '3'     => __('Three', 'tijarat-business'),
            '4'     => __('Four', 'tijarat-business')
        ),
    ));

    $wp_customize->add_setting( 'tijarat_business_footer_widget_background', array(
	    'default' => '#303234',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tijarat_business_footer_widget_background', array(
  		'label' => __('Footer Widget Background','tijarat-business'),
	    'section' => 'tijarat_business_footer',
  	)));

  	$wp_customize->add_setting('tijarat_business_footer_widget_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'tijarat_business_footer_widget_image',array(
        'label' => __('Footer Widget Background Image','tijarat-business'),
        'section' => 'tijarat_business_footer'
	)));

	$wp_customize->add_setting('tijarat_business_hide_show_scroll',array(
        'default' => true,
        'sanitize_callback'	=> 'tijarat_business_sanitize_checkbox'
	));
	$wp_customize->add_control('tijarat_business_hide_show_scroll',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Scroll To Top','tijarat-business'),
      	'section' => 'tijarat_business_footer',
	));

	$wp_customize->add_setting('tijarat_business_footer_options',array(
        'default' => __('Right align','tijarat-business'),
        'sanitize_callback' => 'tijarat_business_sanitize_choices'
	));
	$wp_customize->add_control('tijarat_business_footer_options',array(
        'type' => 'select',
        'label' => __('Scroll To Top','tijarat-business'),
        'description' => __('Here you can change the Footer layout. ','tijarat-business'),
        'section' => 'tijarat_business_footer',
        'choices' => array(
            'Left align' => __('Left align','tijarat-business'),
            'Right align' => __('Right align','tijarat-business'),
            'Center align' => __('Center align','tijarat-business'),
        ),
	) );

	$wp_customize->add_setting('tijarat_business_scroll_top_fontsize',array(
		'default'=> '',
		'sanitize_callback'    => 'tijarat_business_sanitize_number_range',
	));
	$wp_customize->add_control('tijarat_business_scroll_top_fontsize',array(
		'label'	=> __('Scroll To Top Font Size','tijarat-business'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'tijarat_business_footer',
		'type'=> 'range'
	));

	$wp_customize->add_setting('tijarat_business_scroll_top_bottom_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_scroll_top_bottom_padding',array(
		'label'	=> __('Scroll Top Bottom Padding ','tijarat-business'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'tijarat_business_footer',
		'type'=> 'number'
	));

	$wp_customize->add_setting('tijarat_business_scroll_left_right_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_scroll_left_right_padding',array(
		'label'	=> __('Scroll Left Right Padding','tijarat-business'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'tijarat_business_footer',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'tijarat_business_scroll_border_radius', array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	) );
	$wp_customize->add_control( 'tijarat_business_scroll_border_radius', array(
		'label'       => esc_html__( 'Scroll To Top Border Radius','tijarat-business' ),
		'section'     => 'tijarat_business_footer',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('tijarat_business_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('tijarat_business_footer_text',array(
		'label'	=> __('Add Copyright Text','tijarat-business'),
		'section'	=> 'tijarat_business_footer',
		'setting'	=> 'tijarat_business_footer_text',
		'type'		=> 'text'
	));

    $wp_customize->add_setting('tijarat_business_copyright_top_bottom_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_copyright_top_bottom_padding',array(
		'label'	=> __('Copyright Top and Bottom Padding','tijarat-business'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'tijarat_business_footer',
		'type'=> 'number'
	));

	$wp_customize->add_setting('tijarat_business_footer_text_font_size',array(
		'default'=> 16,
		'sanitize_callback'    => 'tijarat_business_sanitize_float',
	));
	$wp_customize->add_control('tijarat_business_footer_text_font_size',array(
		'label'	=> __('Footer Text Font Size','tijarat-business'),
		'section'=> 'tijarat_business_footer',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'type'=> 'number'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'tijarat_business_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'tijarat_business_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'tijarat_business_customize_register' );

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Tijarat Business 1.0
 * @see tijarat-business_customize_register()
 *
 * @return void
 */
function tijarat_business_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Tijarat Business 1.0
 * @see tijarat-business_customize_register()
 *
 * @return void
 */
function tijarat_business_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function tijarat_business_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'footer-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Tijarat_Business_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Tijarat_Business_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Tijarat_Business_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Tijarat Business Pro', 'tijarat-business' ),
					'pro_text' => esc_html__( 'Go Pro', 'tijarat-business' ),
					'pro_url'  => esc_url('https://www.themeseye.com/wordpress/wordpress-themes-for-business/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'tijarat-business-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'tijarat-business-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Tijarat_Business_Customize::get_instance();