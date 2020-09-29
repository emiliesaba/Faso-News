<?php
/**
 * Setup class
 *
 * @package Baltic
 */

namespace Baltic;

class Setup {

	use Instance;

	private $suffix;
	private $version;

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->suffix 	= Utils::get_min_suffix();
		$this->version 	= BALTIC_VERSION;

		// Setup
		add_action( 'after_setup_theme', 		[ $this, 'setup' ] );
		add_action( 'template_redirect', 		[ $this, 'content_width' ], 0 );

		// Scipts
		add_action( 'wp_head', 					[ $this, 'javascript_detection' ], 0 );
		add_action( 'wp_enqueue_scripts', 		[ $this, 'assets' ] );

		// Widgets
		add_action( 'widgets_init', 			[ $this, 'widgets_init' ] );
		add_filter( 'widget_tag_cloud_args', 	[ $this, 'widget_tag_cloud_args' ] );
		add_filter( 'woocommerce_product_tag_cloud_widget_args', [ $this, 'widget_tag_cloud_args' ] );

		// Classes
		add_filter( 'body_class', 				[ $this, 'body_classes' ] );
		add_filter( 'post_class', 				[ $this, 'post_classes' ] );

		// Pingback
		add_action( 'wp_head', 					[ $this, 'pingback_header' ] );

		// Setup Filters
		add_action( 'wp', 						[ $this, 'content_filters' ] );

		// Execute earlier
		add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
		add_filter( 'woocommerce_show_admin_notice', '__return_false' );
		add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_false' );

		add_filter( 'wpcf7_load_css', '__return_false' );

	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @return  void
	 */
	public function setup() {

		$rtl = ( is_rtl() ) ? '-rtl' : '';

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'baltic' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1620, 911, [ 'center', 'top' ] );

		// Set the default content width
		$GLOBALS['content_width'] = 810;

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( [
			'menu-1' => esc_html__( 'Primary', 'baltic' ),
			'menu-2' => esc_html__( 'Secondary', 'baltic' ),
			'menu-3' => esc_html__( 'Social Link', 'baltic' ),
		] );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		// Enable support for custom logo
		add_theme_support( 'custom-logo', [
			'width'       => 640,
			'height'      => 640,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => [ 'site-title', 'site-description' ],
		]);

		// Custom Header
		add_theme_support( 'custom-header', apply_filters( 'baltic_custom_header_args', array(
			'width'       			=> 1600,
			'height'      			=> 1600,
			'default-image'         => '',
			'flex-width'            => true,
			'flex-height'           => true,
			'default-text-color'	=> '505050',
			'wp-head-callback'      => [ 'Baltic\Customizer\Output', 'header_style' ],
		) ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'baltic_custom_background_args', array(
			'default-color' 		=> 'eceff1',
			'default-repeat'        => 'no-repeat',
			'default-attachment'    => 'scroll'
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( [
			"assets/css/editor-style{$rtl}{$this->suffix}.css"
		] );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

		// Gutenberg
		//add_theme_support( 'align-wide' );

	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function content_width(){

		$content_width = $GLOBALS['content_width'];

		//if ( Layout::get_layout() == 'full-width' ) {
		//	$content_width = 1120;
		//}

		$GLOBALS['content_width'] = apply_filters( 'baltic_content_width', $content_width );

	}

	/**
	 * Handles JavaScript detection.
	 *
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
	 */
	public function javascript_detection() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @return  void
	 */
	public function assets() {

		$rtl = ( is_rtl() ) ? '-rtl' : '';

		wp_enqueue_style( "baltic-style{$rtl}", BALTIC_URI . "/style{$rtl}{$this->suffix}.css" );

		// lt IE 9 script
		wp_enqueue_script( 'html5shiv',
			BALTIC_URI . "/assets/js/html5shiv/html5shiv{$this->suffix}.js",
			[],
			'3.7.3'
		);
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

		if ( ! wp_script_is( 'polyfill', 'enqueued' ) ) {
			wp_enqueue_script( 'polyfill',
				"https://cdn.polyfill.io/v2/polyfill.min.js",
				[],
				'2',
				false
			);
		}

		if ( ! wp_script_is( 'css-vars-ponyfill', 'enqueued' ) ) {
			wp_enqueue_script( 'css-vars-ponyfill',
				BALTIC_URI . "/assets/js/css-vars-ponyfill/css-vars-ponyfill{$this->suffix}.js",
				[],
				'1.8.0',
				false
			);
		}

		// Main script
		wp_enqueue_script( 'baltic-script',
			BALTIC_URI . "/assets/js/frontend{$this->suffix}.js",
			[ 'jquery' ],
			$this->version,
			true
		);

		$output = [
			'ajaxUrl'		=> add_query_arg( array( 'ajax-request' => 'baltic' ), home_url('/') ),
			'error_msg'		=> esc_html__( 'Request error.', 'baltic' ),
			'loader'		=> Components::preloader(),
			'icons'			=> [
				'calendar'		=> Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'calendar' ] ),
				'clipboard'		=> Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'clipboard' ] ),
				'folderOpen'	=> Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'folder-open' ] ),
				'message'		=> Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'message' ] ),
				'file'			=> Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'file' ] ),
			],
			'table'			=> [
				'product'		=> esc_html__( 'Product', 'baltic' ),
				'price'			=> esc_html__( 'Price', 'baltic' ),
				'stockStatus'	=> esc_html__( 'Stock Status', 'baltic' ),
			],
		];
		wp_localize_script( 'baltic-script', 'Balticl10n', $output );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'baltic' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baltic' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title h6">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Footer', 'baltic' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'baltic' ),
			'before_widget' => '<section id="%1$s" class="widget column-item %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title h6">',
			'after_title'   => '</h2>',
		) );
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar Shop', 'baltic' ),
				'id'            => 'sidebar-3',
				'description'   => esc_html__( 'Add widgets here.', 'baltic' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title h6">',
				'after_title'   => '</h2>',
			) );
		}

	}

	/**
	 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
	 *
	 * @param array $args Arguments for tag cloud widget.
	 * @return array A new modified arguments.
	 */
	public function widget_tag_cloud_args( $args ) {

		$args['largest'] = 0.875;
		$args['smallest'] = 0.875;
		$args['unit'] = 'rem';
		return $args;

	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public static function body_classes( $classes ) {

		if ( Options::get_option( 'preloader' )  === true ) {
			$classes[] = 'preloader-enabled';
		}

		if ( Options::get_option( 'sticky_header' )  === true ) {
			$classes[] = 'sticky-header';
		}

		$classes[]	= esc_attr( Layout::get_layout() );

		$classes[] = esc_attr( Options::get_option( 'site__layout' ) );

		return $classes;

	}

	/**
	 * Removes hentry class from the array of post classes.
	 * Currently, having the class on pages is not correct use of hentry.
	 * hentry requires more properties than pages typically have.
	 * Core is not likely to remove class because of backward compatibility.
	 * See: https://core.trac.wordpress.org/ticket/28482
	 *
	 * @param array $classes Classes for the post element.
	 * @return array
	 */
	public function post_classes( $classes ) {

		if ( 'page' === get_post_type() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}
		$classes[] = 'entry';

		return $classes;

	}

	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 * @return void
	 */
	public function pingback_header() {

		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}

	}

	/**
	 * [setup_action description]
	 *
	 * @return void
	 */
	public function content_filters() {

		if ( Utils::is_blog() || Utils::is_homepage_template() ) {
			add_filter( 'the_title', array( $this, 'untitled_post' ) );
			add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 999 );
			add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
			add_filter( 'the_content_more_link', array( $this, 'excerpt_more' ), 10, 2 );
		}

		if ( is_singular() ) {
			add_filter( 'the_title', array( $this, 'untitled_post' ) );
		}

	}

	/**
	 * Add (Untitled) for post who doesn't have title
	 *
	 * @param  string  $title
	 * @return string
	 */
	public function untitled_post( $title ) {

		// Translators: Used as a placeholder for untitled posts on non-singular views.
		if ( ! $title && ! is_singular() && in_the_loop() && ! is_admin() ){
			$title = esc_html__( '(Untitled)', 'baltic' );
		}

		return $title;

	}

	/**
	 * Filter the except length to 20 characters.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	public function excerpt_length( $length ) {

		$length = Options::get_option( 'excerpt_length' );
		if ( !empty( $length ) ) {
			return (int)$length;
		} else {
			return 20;
		}

	}

	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and * a 'Continue reading' link.
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	public function excerpt_more() {

		$text = Options::get_option( 'more_link_text' );
		$more_link_text = ( ! empty( $text ) ) ? $text : '';
		$rtl_arrow = ( is_rtl() ) ? 'left' : 'right';

		$link = sprintf( '<div><a href="%1$s" class="more-link">%2$s %3$s</a></div>',
			esc_url( get_permalink( get_the_ID() ) ),
			sprintf( '<span class="more-link-text">%1$s</span> <span class="screen-reader-text">%2$s</span>', esc_attr( $more_link_text ), get_the_title( get_the_ID() ) ),
			Icons::get_svg( array( 'class'=>'icon-stroke', 'icon' => 'arrow-'. esc_html( $rtl_arrow ) ) )
		);
		return ' &hellip;' . $link;

	}

	/**
	 * Fix embed height
	 *
	 * @return void
	 */
	public function default_embed_size() {
		return array( 'width' => 720, 'height' => 120 );
	}

	/**
	 * [mixcloud_oembed_parameter description]
	 *
	 * @param  [type] $html [description]
	 * @param  [type] $url  [description]
	 * @param  [type] $args [description]
	 * @return [type]       [description]
	 */
	public function mixcloud_oembed_parameter( $html, $url, $args ) {

		return str_replace( 'hide_cover=1', 'hide_cover=1&hide_tracklist=1&light=1', $html );

	}

}
