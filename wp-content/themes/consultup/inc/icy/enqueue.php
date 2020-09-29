<?php function consultup_scripts() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_style( 'consultup-style', get_stylesheet_uri() );
	wp_style_add_data( 'consultup-style', 'rtl', 'replace' );

	wp_enqueue_style('consultup-default', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');	

	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');

	/* Js script */

	wp_enqueue_script( 'consultup-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

	wp_enqueue_script('smartmenus-js', get_template_directory_uri() . '/js/jquery.smartmenus.js' , array('jquery'));

	wp_enqueue_script('bootstrap-smartmenus-js', get_template_directory_uri() . '/js/bootstrap-smartmenus.js' , array('jquery'));
	
	wp_enqueue_script('consultup-main-js', get_template_directory_uri() . '/js/main.js' , array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'consultup_scripts');

/**
 	* Added skip link focus
 	*/
	function consultup_skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
	}
add_action( 'wp_print_footer_scripts', 'consultup_skip_link_focus_fix' );

function consultup_customizer_selective_preview() {
	wp_enqueue_script(
		'consultup-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array(
			'jquery',
			'customize-preview',
		), 999, true
	);
}

add_action( 'customize_preview_init', 'consultup_customizer_selective_preview' );