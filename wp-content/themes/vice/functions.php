<?php

// Global variables define
define('VICE_PARENT_TEMPLATE_DIR_URI',get_template_directory_uri());	
define('VICE_TEMPLATE_DIR_URI',get_stylesheet_directory_uri());
define('VICE_TEMPLATE_DIR',trailingslashit(get_stylesheet_directory()));

add_action( 'wp_enqueue_scripts', 'vice_theme_css',999);
function vice_theme_css() {
    wp_enqueue_style('vice-parent-style', VICE_PARENT_TEMPLATE_DIR_URI . '/style.css' );
    wp_enqueue_style('bootstrap-style', VICE_PARENT_TEMPLATE_DIR_URI . '/css/bootstrap.css' );
	wp_enqueue_style('vice-theme-menu', VICE_PARENT_TEMPLATE_DIR_URI . '/css/theme-menu.css' );
	wp_enqueue_style('vice-default-css', VICE_TEMPLATE_DIR_URI."/css/default.css" );
	wp_enqueue_style('vice-element-style', VICE_PARENT_TEMPLATE_DIR_URI . '/css/element.css' );
	wp_enqueue_style('vice-media-responsive', VICE_PARENT_TEMPLATE_DIR_URI. '/css/media-responsive.css');
	wp_dequeue_style('vice-default',VICE_PARENT_TEMPLATE_DIR_URI .'/css/default.css');
	wp_enqueue_script('vice-mp-masonry-js', VICE_TEMPLATE_DIR_URI . '/js/masonry/mp.mansory.js');
}


add_action('wp_enqueue_scripts', 'vice_update_theme');
function vice_update_theme()
{
update_option('template', 'appointment');
}

/*
	 * Let WordPress manage the document title.
	 */
function vice_setup() {
   require( VICE_TEMPLATE_DIR. '/functions/customizer/customizer-copyright.php' );
   load_theme_textdomain('vice', VICE_TEMPLATE_DIR . '/languages' );
   //About Theme
    $theme = wp_get_theme(); // gets the current theme
    if ('vice' == $theme->name) {
        if (is_admin()) {
            require VICE_TEMPLATE_DIR . '/admin/admin-init.php';
        }
    }
}
add_action( 'after_setup_theme', 'vice_setup' );

function vice_default_data(){
	return array(
	// general settings
	'footer_copyright_text' => '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="nofollow">Vice</a> by Webriti', 'vice' ).'</p>',
	'footer_menu_bar_enabled' => '',
	'footer_social_media_enabled' => '',
	'footer_social_media_facebook_link' => '#',
	'footer_facebook_media_enabled' => 1,
	'footer_social_media_twitter_link' => '#',
	'footer_twitter_media_enabled'=>1,
	'footer_social_media_linkedin_link' => '#',
	'footer_linkedin_media_enabled'=>1,
	'footer_social_media_googleplus_link' => '#',
	'footer_googleplus_media_enabled' => 1,
	'footer_social_media_skype_link' => '#',
	'footer_skype_media_enabled' => 1,
	
	);
}

// footer custom script
function vice_footer_custom_script()
{
    ?>
<script>
jQuery(document).ready(function ( jQuery ) {
	jQuery("#blog-masonry").mpmansory(
		{
			childrenClass: 'item', // default is a div
			columnClasses: 'padding', //add classes to items
			breakpoints:{
				lg: 3, //Change masonry column here like 2, 3, 4 column
				md: 6,
				sm: 6,
				xs: 12
			},
			distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
			onload: function (items) {
				//make somthing with items
			}
		}
	);
});
</script>
<?php
}
add_action('wp_footer', 'vice_footer_custom_script');