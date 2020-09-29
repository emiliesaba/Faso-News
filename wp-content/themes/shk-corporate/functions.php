<?php

// Global variables define
define('SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI', get_template_directory_uri());
define('SHK_CORPORATE_TEMPLATE_DIR_URI', get_stylesheet_directory_uri());
define('SHK_CORPORATE_TEMPLATE_DIR', trailingslashit(get_stylesheet_directory()));

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }

}

add_action('wp_enqueue_scripts', 'shk_corporate_theme_css', 999);

function shk_corporate_theme_css() {
    wp_enqueue_style('shk-corporate-parent-style', SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI . '/style.css');
    wp_enqueue_style('bootstrap-style', SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI . '/css/bootstrap.css');
    wp_enqueue_style('shk-corporate-theme-menu', SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI . '/css/theme-menu.css');
    wp_enqueue_style('shk-corporate-default-css', SHK_CORPORATE_TEMPLATE_DIR_URI . "/css/default.css");
    wp_enqueue_style('shk-corporate-element-style', SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI . '/css/element.css');
    wp_enqueue_style('shk-corporate-media-responsive', SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI . '/css/media-responsive.css');
    wp_dequeue_style('appointment-default', SHK_CORPORATE_PARENT_TEMPLATE_DIR_URI . '/css/default.css');
}

require( SHK_CORPORATE_TEMPLATE_DIR . '/header-widget.php' );
require( SHK_CORPORATE_TEMPLATE_DIR . '/functions/customizer/customizer-header-layout.php');

function shk_corporate_theme_setup() {
    load_theme_textdomain('shk-corporate', SHK_CORPORATE_TEMPLATE_DIR . '/languages');
    require( SHK_CORPORATE_TEMPLATE_DIR . '/functions/customizer/customizer-copyright.php' );

    //About Theme
    $theme = wp_get_theme(); // gets the current theme
    if ('Shk Corporate' == $theme->name) {
        if (is_admin()) {
            require SHK_CORPORATE_TEMPLATE_DIR . '/admin/admin-init.php';
        }
    }
}

add_action('after_setup_theme', 'shk_corporate_theme_setup');

/*
 * Let WordPress manage the document title.
 */

function shk_corporate_setup() {
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'shk_corporate_setup');

add_action('widgets_init', 'shk_corporate_widgets_init');

function shk_corporate_widgets_init() {

    register_sidebar(array(
        'name' => esc_html__('Sidebar widget area', 'shk-corporate'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Sidebar widget area', 'shk-corporate'),
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar-widget-title"><h3>',
        'after_title' => '</h3></div>',
    ));

//Header sidebar
    register_sidebar(array(
        'name' => esc_html__('Top header left area', 'shk-corporate'),
        'id' => 'home-header-sidebar_left',
        'description' => esc_html__('Top header left area', 'shk-corporate'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Top header center area', 'shk-corporate'),
        'id' => 'home-header-sidebar_center',
        'description' => esc_html__('Top header center area', 'shk-corporate'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Top header right area', 'shk-corporate'),
        'id' => 'home-header-sidebar_right',
        'description' => esc_html__('Top header right area', 'shk-corporate'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}

function shk_corporate_default_data() {
    $shk_corporate_header_setting = wp_parse_args(get_option('appointment_options', array()), appointment_theme_setup_data());
//print_r($shk_corporate_header_setting);

    if ((!has_custom_logo() && $shk_corporate_header_setting['enable_header_logo_text'] == 'nomorenow') || $shk_corporate_header_setting['enable_header_logo_text'] == 1 || $shk_corporate_header_setting['upload_image_logo'] != '') {

        $array_new = array(
            'header_classic_layout_setting' => 'default',
            'service_blink_layout_setting' => 'default',
        );
    } else {
        $array_new = array(
            'header_classic_layout_setting' => 'classic',
            'service_blink_layout_setting' => 'blink',
        );
    }
    $array_old = array(
        // general settings
        'footer_copyright_text' => '<p>' . __('<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="nofollow">Shk Corporate</a> by Webriti', 'shk-corporate') . '</p>',
        'footer_menu_bar_enabled' => '',
        'footer_social_media_enabled' => '',
        'footer_social_media_facebook_link' => '#',
        'footer_facebook_media_enabled' => 1,
        'footer_social_media_twitter_link' => '#',
        'footer_twitter_media_enabled' => 1,
        'footer_social_media_linkedin_link' => '#',
        'footer_linkedin_media_enabled' => 1,
        'footer_social_media_googleplus_link' => '#',
        'footer_googleplus_media_enabled' => 1,
        'footer_social_media_skype_link' => '#',
        'footer_skype_media_enabled' => 1,
    );
    return $result = array_merge($array_new, $array_old);
}
