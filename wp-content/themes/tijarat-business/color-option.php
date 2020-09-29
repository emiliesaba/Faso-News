<?php
	
	/*--------------Theme color option-----------------*/

	$tijarat_business_theme_color = get_theme_mod('tijarat_business_theme_color');

	$tijarat_business_custom_css = '';

	if($tijarat_business_theme_color != false){
		$tijarat_business_custom_css .='span.carousel-control-prev-icon i:hover,span.carousel-control-next-icon i:hover, .readbutton a:hover, #about .about-text, .woocommerce span.onsale, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, nav.woocommerce-MyAccount-navigation ul li, .post-link a:hover, .post-info, #sidebox h2, button.search-submit:hover, .search-form button.search-submit, .copyright, .widget .tagcloud a:hover,.widget .tagcloud a:focus,.widget.widget_tag_cloud a:hover,.widget.widget_tag_cloud a:focus,.wp_widget_tag_cloud a:hover,.wp_widget_tag_cloud a:focus, button,input[type="button"],input[type="submit"], .logo, .box:before,#sidebox .search-form button.search-submit, .site-footer .search-form button.search-submit,.page-numbers,.scrollup i,.comment-reply-link,.tags p a, .post-navigation .nav-next a, .post-navigation .nav-previous a, #sidebox h3, #sidebox .widget_shopping_cart .buttons a:hover, #sidebox .widget_price_filter .price_slider_amount .button:hover, .site-footer .widget_shopping_cart .buttons a:hover, .site-footer .widget_price_filter .price_slider_amount .button:hover, .site-footer form.woocommerce-product-search button:hover, .site-footer form.woocommerce-product-search button:focus{';
			$tijarat_business_custom_css .='background-color: '.esc_html($tijarat_business_theme_color).';';
		$tijarat_business_custom_css .='}';
	}
	if($tijarat_business_theme_color != false){
		$tijarat_business_custom_css .=' .navigation-top a, .main-navigation a:hover, .site-footer ul li a:hover,.blogger h2 a,#sidebox ul li a:hover, .main-navigation li li:focus > a,
	.main-navigation li li:hover > a, #sidebox .textwidget p a, .main-navigation ul ul li a, #commentform p.logged-in-as a, .text a, .comment-body p a, .woocommerce-product-details__short-description p a, .woocommerce-tabs.wc-tabs-wrapper p a, .woocommerce .posted_in a, .woocommerce span.tagged_as a, .related-posts h3 a{';
			$tijarat_business_custom_css .='color: '.esc_html($tijarat_business_theme_color).';';
		$tijarat_business_custom_css .='}';
	}
	if($tijarat_business_theme_color != false){
		$tijarat_business_custom_css .='.main-navigation ul ul, span.carousel-control-prev-icon i:hover,span.carousel-control-next-icon i:hover, .readbutton a:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .post-link a:hover,.scrollup i{';
			$tijarat_business_custom_css .='border-color: '.esc_html($tijarat_business_theme_color).';';
		$tijarat_business_custom_css .='}';
	}
	if($tijarat_business_theme_color != false){
		$tijarat_business_custom_css .='.main-navigation ul ul li:hover{';
			$tijarat_business_custom_css .='border-left-color: '.esc_html($tijarat_business_theme_color).';';
		$tijarat_business_custom_css .='}';
	}
	if($tijarat_business_theme_color != false){
		$tijarat_business_custom_css .='.site-footer ul li a:hover{';
			$tijarat_business_custom_css .='color: '.esc_html($tijarat_business_theme_color).'!important;';
		$tijarat_business_custom_css .='}';
	}
	/*---------------------------Width Layout -------------------*/
	$tijarat_business_theme_lay = get_theme_mod( 'tijarat_business_theme_options','Default');
    if($tijarat_business_theme_lay == 'Default'){
		$tijarat_business_custom_css .='body{';
			$tijarat_business_custom_css .='max-width: 100%;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.page-template-custom-home-page .middle-header{';
			$tijarat_business_custom_css .='width: 97.3%';
		$tijarat_business_custom_css .='}';
	}else if($tijarat_business_theme_lay == 'Wide Layout'){
		$tijarat_business_custom_css .='body{';
			$tijarat_business_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.page-template-custom-home-page .middle-header{';
			$tijarat_business_custom_css .='width: 97.7%';
		$tijarat_business_custom_css .='}';
	}else if($tijarat_business_theme_lay == 'Box Layout'){
		$tijarat_business_custom_css .='body{';
			$tijarat_business_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$tijarat_business_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/
	$tijarat_business_theme_lay = get_theme_mod( 'tijarat_business_slider_opacity_color','0.6');
	if($tijarat_business_theme_lay == '0'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.1'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.1';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.2'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.2';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.3'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.3';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.4'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.4';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.5'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.5';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.6'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.6';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.7'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.7';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.8'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.8';
		$tijarat_business_custom_css .='}';
		}else if($tijarat_business_theme_lay == '0.9'){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='opacity:0.9';
		$tijarat_business_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/
	$tijarat_business_theme_lay = get_theme_mod( 'tijarat_business_slider_content_option','Left');
    if($tijarat_business_theme_lay == 'Left'){
		$tijarat_business_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .readbutton{';
			$tijarat_business_custom_css .='text-align:left; left:15%; right:45%;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='
		@media screen and (max-width: 767px){
		#slider .readbutton a{';
		$tijarat_business_custom_css .='font-size:12px;';
		$tijarat_business_custom_css .='} }';
	}else if($tijarat_business_theme_lay == 'Center'){
		$tijarat_business_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .readbutton{';
			$tijarat_business_custom_css .='text-align:center; left:20%; right:20%;';
		$tijarat_business_custom_css .='}';
	}else if($tijarat_business_theme_lay == 'Right'){
		$tijarat_business_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .readbutton{';
			$tijarat_business_custom_css .='text-align:right; left:45%; right:15%;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='
		@media screen and (max-width: 990px) and (min-width: 320px){
		#slider .carousel-caption{';
		$tijarat_business_custom_css .='top:37%;';
		$tijarat_business_custom_css .='} }';
		$tijarat_business_custom_css .='
		@media screen and (max-width: 767px){
		#slider .readbutton a{';
		$tijarat_business_custom_css .='font-size:12px;';
		$tijarat_business_custom_css .='} }';
	}

	/*--------------- Button Settings option----------------*/
	$tijarat_business_top_bottom_padding = get_theme_mod('tijarat_business_top_bottom_padding');
	$tijarat_business_left_right_padding = get_theme_mod('tijarat_business_left_right_padding');
	if($tijarat_business_top_bottom_padding != false || $tijarat_business_left_right_padding != false){
		$tijarat_business_custom_css .='.post-link a, #slider .readbutton a, .form-submit input[type="submit"],#about .aboutbtn a, #our-services .aboutbtn a{';
			$tijarat_business_custom_css .='padding-top: '.esc_html($tijarat_business_top_bottom_padding).'px; padding-bottom: '.esc_html($tijarat_business_top_bottom_padding).'px; padding-left: '.esc_html($tijarat_business_left_right_padding).'px; padding-right: '.esc_html($tijarat_business_left_right_padding).'px; display:inline-block;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_border_radius = get_theme_mod('tijarat_business_border_radius');
	if($tijarat_business_border_radius != false){
		$tijarat_business_custom_css .='.post-link a,#slider .readbutton, .form-submit input[type="submit"],#about .aboutbtn a, #our-services .aboutbtn a{';
			$tijarat_business_custom_css .='border-radius: '.esc_html($tijarat_business_border_radius).'px;';
		$tijarat_business_custom_css .='}';
	}

	/*--------- Preloader Color Option -------*/
	$tijarat_business_loader_color_setting = get_theme_mod('tijarat_business_loader_color_setting');
	if($tijarat_business_loader_color_setting != false){
		$tijarat_business_custom_css .=' .circle .inner{';
			$tijarat_business_custom_css .='border-color: '.esc_html($tijarat_business_loader_color_setting).';';
		$tijarat_business_custom_css .='} ';
	}

	$tijarat_business_loader_background_color = get_theme_mod('tijarat_business_loader_background_color');
	if($tijarat_business_loader_background_color != false){
		$tijarat_business_custom_css .=' #pre-loader{';
			$tijarat_business_custom_css .='background-color: '.esc_html($tijarat_business_loader_background_color).';';
		$tijarat_business_custom_css .='} ';
	}

	$tijarat_business_theme_lay = get_theme_mod( 'tijarat_business_preloader_types','Default');
    if($tijarat_business_theme_lay == 'Default'){
		$tijarat_business_custom_css .='{';
			$tijarat_business_custom_css .='';
		$tijarat_business_custom_css .='}';
	}elseif($tijarat_business_theme_lay == 'Circle'){
		$tijarat_business_custom_css .='.circle .inner{';
			$tijarat_business_custom_css .='width:unset;';
		$tijarat_business_custom_css .='}';
	}elseif($tijarat_business_theme_lay == 'Two Circle'){
		$tijarat_business_custom_css .='.circle .inner{';
			$tijarat_business_custom_css .='width:80%;
    border-right: 5px;';
		$tijarat_business_custom_css .='}';
	}

	/*------------------Blog Layout -------------------*/
	$tijarat_business_theme_lay = get_theme_mod( 'tijarat_business_blog_post_layout','Default');
    if($tijarat_business_theme_lay == 'Default'){
		$tijarat_business_custom_css .='.blogger{';
			$tijarat_business_custom_css .='';
		$tijarat_business_custom_css .='}';
	}else if($tijarat_business_theme_lay == 'Center'){
		$tijarat_business_custom_css .='.blogger, .blogger h2, .post-info, .text p, .blogger .post-link{';
			$tijarat_business_custom_css .='text-align:center;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.post-info{';
			$tijarat_business_custom_css .='margin-top:10px;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.blogger .post-link{';
			$tijarat_business_custom_css .='margin-top:25px;';
		$tijarat_business_custom_css .='}';
	}else if($tijarat_business_theme_lay == 'Image and Content'){
		$tijarat_business_custom_css .='.blogger, .blogger h2, .post-info, .text p, #our-services p{';
			$tijarat_business_custom_css .='text-align:Left;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.blogger .post-link{';
			$tijarat_business_custom_css .='text-align:right;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.post-info span{';
			$tijarat_business_custom_css .='font-size:14px;';
		$tijarat_business_custom_css .='}';
		$tijarat_business_custom_css .='.post-info i{';
			$tijarat_business_custom_css .='font-size:12px;';
		$tijarat_business_custom_css .='}';
	}

	// Responsive Media
	$tijarat_business_sidebar = get_theme_mod( 'tijarat_business_enable_disable_sidebar',true);
    if($tijarat_business_sidebar == true){
    	$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='#sidebox{';
			$tijarat_business_custom_css .='display:block;';
		$tijarat_business_custom_css .='} }';
	}else if($tijarat_business_sidebar == false){
		$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='#sidebox{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} }';
	}

	$tijarat_business_stickyheader = get_theme_mod( 'tijarat_business_enable_disable_fixed_header',false);
	if($tijarat_business_stickyheader == true && get_theme_mod( 'tijarat_business_fixed_header',false) != true){
    	$tijarat_business_custom_css .='.fixed-header{';
			$tijarat_business_custom_css .='position:static;';
		$tijarat_business_custom_css .='} ';
	}
    if($tijarat_business_stickyheader == true){
    	$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='.fixed-header{';
			$tijarat_business_custom_css .='position:fixed;';
		$tijarat_business_custom_css .='} }';
	}else if($tijarat_business_stickyheader == false){
		$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='.fixed-header{';
			$tijarat_business_custom_css .='position:static;';
		$tijarat_business_custom_css .='} }';
	}

	$tijarat_business_sliderbutton = get_theme_mod( 'tijarat_business_enable_disable_slider', false);
	if($tijarat_business_sliderbutton == true && get_theme_mod( 'tijarat_business_slider_arrows', false) == false){
    	$tijarat_business_custom_css .='#slider{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} ';
	}
    if($tijarat_business_sliderbutton == true){
    	$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='#slider{';
			$tijarat_business_custom_css .='display:block;';
		$tijarat_business_custom_css .='} }';
	}else if($tijarat_business_sliderbutton == false){
		$tijarat_business_custom_css .='@media screen and (max-width:575px){';
		$tijarat_business_custom_css .='#slider{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} }';
	}

	$tijarat_business_sliderbutton = get_theme_mod( 'tijarat_business_show_hide_slider_button',true);
	if($tijarat_business_sliderbutton == true && get_theme_mod( 'tijarat_business_slider_button',true) != true){
    	$tijarat_business_custom_css .='#slider .readbutton{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} ';
	}
    if($tijarat_business_sliderbutton == true){
    	$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='#slider .readbutton{';
			$tijarat_business_custom_css .='display:block;';
		$tijarat_business_custom_css .='} }';
	}else if($tijarat_business_sliderbutton == false){
		$tijarat_business_custom_css .='@media screen and (max-width:575px){';
		$tijarat_business_custom_css .='#slider .readbutton{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} }';
	}

	$tijarat_business_sliderbutton = get_theme_mod( 'tijarat_business_enable_disable_scrolltop',true);
	if(get_theme_mod( 'tijarat_business_hide_show_scroll',true) == false ){
    	$tijarat_business_custom_css .='.scrollup i{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} ';
	}
    if($tijarat_business_sliderbutton == true){
    	$tijarat_business_custom_css .='@media screen and (max-width:575px) {';
		$tijarat_business_custom_css .='.scrollup i{';
			$tijarat_business_custom_css .='display:block;';
		$tijarat_business_custom_css .='} }';
	}else if($tijarat_business_sliderbutton == false){
		$tijarat_business_custom_css .='@media screen and (max-width:575px){';
		$tijarat_business_custom_css .='.scrollup i{';
			$tijarat_business_custom_css .='display:none;';
		$tijarat_business_custom_css .='} }';
	}

	// css
	$tijarat_business_show_slider = get_theme_mod( 'tijarat_business_slider_arrows', false);
		if($tijarat_business_show_slider == false){
			$tijarat_business_custom_css .='.page-template-home-custom #masthead .main-header{';
				$tijarat_business_custom_css .='position:static;padding: 10px 0; background: rgba(84, 103, 234, 0.4);';
			$tijarat_business_custom_css .='}';
			$tijarat_business_custom_css .='#about{';
				$tijarat_business_custom_css .='margin-top: 1em;';
			$tijarat_business_custom_css .='}';
		}

	// Copyright top-bottom padding setting 
	$tijarat_business_copyright_top_bottom_padding = get_theme_mod('tijarat_business_copyright_top_bottom_padding');
	if($tijarat_business_copyright_top_bottom_padding != false){
		$tijarat_business_custom_css .='.site-info{';
			$tijarat_business_custom_css .='padding-top: '.esc_html($tijarat_business_copyright_top_bottom_padding).'px; padding-bottom: '.esc_html($tijarat_business_copyright_top_bottom_padding).'px;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_footer_text_font_size = get_theme_mod('tijarat_business_footer_text_font_size', 16);
	$tijarat_business_custom_css .='.site-info{';
		$tijarat_business_custom_css .='font-size: '.esc_html($tijarat_business_footer_text_font_size).'px;';
	$tijarat_business_custom_css .='}';

	// Slider Height 
	$tijarat_business_slider_height_option = get_theme_mod('tijarat_business_slider_height_option');
	if($tijarat_business_slider_height_option != false){
		$tijarat_business_custom_css .='#slider img{';
			$tijarat_business_custom_css .='height: '.esc_html($tijarat_business_slider_height_option).'px;';
		$tijarat_business_custom_css .='}';
	}

	// scroll to top setting
	$tijarat_business_scroll_border_radius = get_theme_mod('tijarat_business_scroll_border_radius');
	if($tijarat_business_scroll_border_radius != false){
		$tijarat_business_custom_css .='.scrollup i{';
			$tijarat_business_custom_css .='border-radius: '.esc_html($tijarat_business_scroll_border_radius).'px;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_scroll_top_fontsize = get_theme_mod('tijarat_business_scroll_top_fontsize');
	if($tijarat_business_scroll_top_fontsize != false){
		$tijarat_business_custom_css .='.scrollup i{';
			$tijarat_business_custom_css .='font-size: '.esc_html($tijarat_business_scroll_top_fontsize).'px;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_scroll_top_bottom_padding = get_theme_mod('tijarat_business_scroll_top_bottom_padding');
	$tijarat_business_scroll_left_right_padding = get_theme_mod('tijarat_business_scroll_left_right_padding');
	if($tijarat_business_scroll_top_bottom_padding != false || $tijarat_business_scroll_left_right_padding != false){
		$tijarat_business_custom_css .='.scrollup i{';
			$tijarat_business_custom_css .='padding-top: '.esc_html($tijarat_business_scroll_top_bottom_padding).'px; padding-bottom: '.esc_html($tijarat_business_scroll_top_bottom_padding).'px; padding-left: '.esc_html($tijarat_business_scroll_left_right_padding).'px; padding-right: '.esc_html($tijarat_business_scroll_left_right_padding).'px;';
		$tijarat_business_custom_css .='}';
	}

	// comment settings
	$tijarat_business_comment_button_text = get_theme_mod('tijarat_business_comment_button_text', 'Post Comment');
	if($tijarat_business_comment_button_text == ''){
		$tijarat_business_custom_css .='#comments p.form-submit {';
			$tijarat_business_custom_css .='display: none;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_comment_form_heading = get_theme_mod('tijarat_business_comment_form_heading', 'Leave a Reply');
	if($tijarat_business_comment_form_heading == ''){
		$tijarat_business_custom_css .='#comments h2#reply-title {';
			$tijarat_business_custom_css .='display: none;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_comment_form_size = get_theme_mod( 'tijarat_business_comment_form_size',100);
	$tijarat_business_custom_css .='#comments textarea{';
		$tijarat_business_custom_css .='width: '.esc_html($tijarat_business_comment_form_size).'%;';
	$tijarat_business_custom_css .='}';

	/*------------ Woocommerce Settings  --------------*/
	$tijarat_business_shop_button_padding_top = get_theme_mod('tijarat_business_shop_button_padding_top', 9);
	$tijarat_business_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled]{';
		$tijarat_business_custom_css .='padding-top: '.esc_html($tijarat_business_shop_button_padding_top).'px; padding-bottom: '.esc_html($tijarat_business_shop_button_padding_top).'px;';
	$tijarat_business_custom_css .='}';

	$tijarat_business_shop_button_padding_left = get_theme_mod('tijarat_business_shop_button_padding_left', 16);
	$tijarat_business_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled]{';
		$tijarat_business_custom_css .='padding-left: '.esc_html($tijarat_business_shop_button_padding_left).'px; padding-right: '.esc_html($tijarat_business_shop_button_padding_left).'px;';
	$tijarat_business_custom_css .='}';

	$tijarat_business_shop_button_border_radius = get_theme_mod('tijarat_business_shop_button_border_radius',25);
	$tijarat_business_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
		$tijarat_business_custom_css .='border-radius: '.esc_html($tijarat_business_shop_button_border_radius).'px;';
	$tijarat_business_custom_css .='}';

	$tijarat_business_display_related_products = get_theme_mod('tijarat_business_display_related_products',true);
	if($tijarat_business_display_related_products == false){
		$tijarat_business_custom_css .='.related.products{';
			$tijarat_business_custom_css .='display: none;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_shop_products_border = get_theme_mod('tijarat_business_shop_products_border', true);
	if($tijarat_business_shop_products_border == false){
		$tijarat_business_custom_css .='.woocommerce .products li{';
			$tijarat_business_custom_css .='border: none;';
		$tijarat_business_custom_css .='}';
	}

	$tijarat_business_shop_page_top_padding = get_theme_mod('tijarat_business_shop_page_top_padding',10);
	$tijarat_business_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$tijarat_business_custom_css .='padding-top: '.esc_html($tijarat_business_shop_page_top_padding).'px !important; padding-bottom: '.esc_html($tijarat_business_shop_page_top_padding).'px !important;';
	$tijarat_business_custom_css .='}';

	$tijarat_business_shop_page_left_padding = get_theme_mod('tijarat_business_shop_page_left_padding',10);
	$tijarat_business_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$tijarat_business_custom_css .='padding-left: '.esc_html($tijarat_business_shop_page_left_padding).'px !important; padding-right: '.esc_html($tijarat_business_shop_page_left_padding).'px !important;';
	$tijarat_business_custom_css .='}';

	$tijarat_business_shop_page_border_radius = get_theme_mod('tijarat_business_shop_page_border_radius',0);
	$tijarat_business_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$tijarat_business_custom_css .='border-radius: '.esc_html($tijarat_business_shop_page_border_radius).'px;';
	$tijarat_business_custom_css .='}';

	$tijarat_business_shop_page_box_shadow = get_theme_mod('tijarat_business_shop_page_box_shadow',0);
	$tijarat_business_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
		$tijarat_business_custom_css .='box-shadow: '.esc_html($tijarat_business_shop_page_box_shadow).'px '.esc_html($tijarat_business_shop_page_box_shadow).'px '.esc_html($tijarat_business_shop_page_box_shadow).'px #e4e4e4;';
	$tijarat_business_custom_css .='}';

	// footer widget background
	$tijarat_business_footer_widget_background = get_theme_mod('tijarat_business_footer_widget_background', '#303234');
	$tijarat_business_custom_css .='.site-footer{';
		$tijarat_business_custom_css .='background-color: '.esc_html($tijarat_business_footer_widget_background).';';
	$tijarat_business_custom_css .='}';

	$tijarat_business_footer_widget_image = get_theme_mod('tijarat_business_footer_widget_image');
	if($tijarat_business_footer_widget_image != false){
		$tijarat_business_custom_css .='.site-footer{';
			$tijarat_business_custom_css .='background: url('.esc_html($tijarat_business_footer_widget_image).');';
		$tijarat_business_custom_css .='}';
	}










