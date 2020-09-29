<?php
/**
 * Theme setup function and sidebars registering
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if ( ! function_exists( 'exs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function exs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this theme, use a find and replace
		 * to change 'exs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'exs', EXS_THEME_PATH . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		set_post_thumbnail_size( 1140, 855 );

		if ( ! isset( $content_width ) ) {
			$content_width = 1140;
		}

		//image sizes - cropped
		add_image_size( 'exs-square', 800, 800, true );
		add_image_size( 'exs-square-half', 800, 400, true );

		//Post formats
		add_theme_support( 'post-formats', array( 'video', 'audio', 'image', 'gallery', 'quote' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$exs_custom_header_logo = array(
			'height'      => 60,
			'width'       => 150,
			'flex-width'  => true,
			'flex-height' => true,
		);

		add_theme_support( 'custom-logo', $exs_custom_header_logo );

		//Background image for header and title sections
		$exs_custom_header_args = array(
			'width'       => 1920,
			'height'      => 800,
			'header-text' => false,
		);
		add_theme_support( 'custom-header', $exs_custom_header_args );

		add_theme_support( 'custom-background' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg block editor
		add_theme_support(
			'editor-color-palette',
			array(
				// colorLight
				// colorFont
				// colorFontMuted
				// colorBackground
				// colorBorder
				// colorDark
				// colorDarkMuted
				// colorMain
				// colorMain2
				array(
					'name'  => esc_html__( 'Light', 'exs' ),
					'slug'  => 'light',
					'color' => 'var(--colorLight)',
				),
				array(
					'name'  => esc_html__( 'Font', 'exs' ),
					'slug'  => 'font',
					'color' => 'var(--colorFont)',
				),
				array(
					'name'  => esc_html__( 'Muted', 'exs' ),
					'slug'  => 'font-muted',
					'color' => 'var(--colorFontMuted)',
				),
				array(
					'name'  => esc_html__( 'Background', 'exs' ),
					'slug'  => 'background',
					'color' => 'var(--colorBackground)',
				),
				array(
					'name'  => esc_html__( 'Border', 'exs' ),
					'slug'  => 'border',
					'color' => 'var(--colorBorder)',
				),
				array(
					'name'  => esc_html__( 'Dark', 'exs' ),
					'slug'  => 'dark',
					'color' => 'var(--colorDark)',
				),
				array(
					'name'  => esc_html__( 'Dark Muted', 'exs' ),
					'slug'  => 'dark-muted',
					'color' => 'var(--colorDarkMuted)',
				),
				array(
					'name'  => esc_html__( 'Accent', 'exs' ),
					'slug'  => 'main',
					'color' => 'var(--colorMain)',
				),
				array(
					'name'  => esc_html__( 'Accent 2', 'exs' ),
					'slug'  => 'main-2',
					'color' => 'var(--colorMain2)',
				),
			)
		);

		// Add support for Block Styles.
		// add_theme_support( 'wp-block-styles' );
		// 'wp-block-library-theme' - loads in the backend even if not defined here

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Enqueue editor styles.
		add_theme_support( 'editor-styles' );
		$min = get_theme_mod( 'assets_min' ) ? 'min/' : '';
		add_editor_style( 'assets/css/' . $min . 'editor-style.css' );

		// Add support for responsive embedded content.
		// It will add JS file to the footer
		// add_theme_support( 'responsive-embeds' );

		//Yoast breadcrumbs support
		add_theme_support( 'yoast-seo-breadcrumbs' );

		//WooCommerce
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		//starter content
		if ( is_customize_preview() && get_option( 'fresh_site' ) ) {
			require EXS_THEME_PATH . '/inc/starter-content.php';
			add_theme_support( 'starter-content', exs_get_starter_content() );
		}

		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus(
			array(
				'topline'   => esc_html__( 'Topline Menu', 'exs' ),
				'primary'   => esc_html__( 'Main Menu', 'exs' ),
				'copyright' => esc_html__( 'Copyright Menu', 'exs' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'exs_setup' );


if ( ! function_exists( 'exs_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function exs_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Main', 'exs' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'exs' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'exs' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'exs' ),
				'before_widget' => '<div id="%1$s" class="grid-item widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Home page above columns', 'exs' ),
				'id'            => 'sidebar-home-before-columns',
				'description'   => esc_html__( 'These widgets will appear on "Home" page above columns.', 'exs' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Home page above content', 'exs' ),
				'id'            => 'sidebar-home-before-content',
				'description'   => esc_html__( 'These widgets will appear on "Home" page above content', 'exs' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Home page main sidebar', 'exs' ),
				'id'            => 'sidebar-home-main',
				'description'   => esc_html__( 'These widgets will appear on "Home" page in main sidebar.', 'exs' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Home page below content', 'exs' ),
				'id'            => 'sidebar-home-after-content',
				'description'   => esc_html__( 'These widgets will appear on "Home" page below main content', 'exs' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Home page below columns', 'exs' ),
				'id'            => 'sidebar-home-after-columns',
				'description'   => esc_html__( 'These widgets will appear on "Home" page below columns', 'exs' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);


		//WooCommerce sidebar
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Shop', 'exs' ),
					'id'            => 'shop',
					'description'   => esc_html__( 'This sidebar will appear on shop pages', 'exs' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>',
				)
			);
		}
		//EDD single download sidebar
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Download Sidebar', 'exs' ),
					'id'            => 'sidebar-download',
					/* translators: %s: 'Download' post type label name. */
					'description'   => sprintf( __( 'Add widgets here to appear in your %s sidebar.', 'exs' ), edd_get_label_singular() ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>',
				)
			);
		}
	}
endif;
add_action( 'widgets_init', 'exs_widgets_init' );

//copy parent theme mods on first child theme activation
if ( ! function_exists( 'exs_switch_theme_update_mods' ) ) :
	function exs_switch_theme_update_mods( $exs_new_theme ) {

		if ( is_child_theme() ) {
			$exs_new_theme_mods = get_theme_mods();

			//if is child theme and current theme mods are empty - set theme mods from parent theme
			if ( empty( $exs_new_theme_mods ) || 1 === count( $exs_new_theme_mods ) || 2 === count( $exs_new_theme_mods ) ) {
				$exs_mods = get_option( 'theme_mods_' . get_template() );

				if ( ! empty( $exs_mods ) ) {
					foreach ( (array) $exs_mods as $exs_mod => $exs_mod_value ) {
						// if ( 'sidebars_widgets' !== $exs_mod )
						set_theme_mod( $exs_mod, $exs_mod_value );
					}
				}
			}
		}
	}
endif;
add_action( 'after_switch_theme', 'exs_switch_theme_update_mods' );

//theme page
if ( ! function_exists( 'exs_theme_options_page_menu_item' ) ) :
	function exs_theme_options_page_menu_item() {
		add_theme_page(
			esc_html__( 'ExS Theme', 'exs' ),
			esc_html__( 'ExS Theme', 'exs' ),
			'edit_theme_options',
			'exs-theme',
			'exs_theme_options_page'
		);
	}
endif;
add_action( 'admin_menu', 'exs_theme_options_page_menu_item' );

if ( ! function_exists( 'exs_theme_options_page' ) ) :
	function exs_theme_options_page() {
		$pro = false;
		if ( EXS_EXTRA ) :
			if ( function_exists( 'exs_fs' ) ) {
				if ( exs_fs()->is_plan( 'pro' ) ) {
					$pro = true;
				}
			}
		endif;
//		$pro = false;

		$current_tab = ! empty( $_GET['tab'] ) ? sanitize_title( $_REQUEST['tab'] ) : 'pro';
		$tabs        = array(
			'pro'     => esc_html__( 'Pro Features', 'exs' ),
		);
		if ( empty( $pro ) ) {
			$tabs['upgrade'] = esc_html__( 'Upgrade to Pro', 'exs' );
		}

		$tabs = apply_filters( 'exs_admin_theme_tabs', $tabs );
		?>
		<nav class="nav-tab-wrapper">
		<?php
		foreach ( $tabs as $name => $label ) :
			$tab_link =  add_query_arg( array( 'page' => 'exs-theme', 'tab' => $name ), admin_url( 'themes.php' ) );
			$tab_class = 'nav-tab';
			if ( $current_tab === $name ) {
				$tab_class .= ' nav-tab-active';
			}
			?>
		<a href="<?php echo esc_url( $tab_link ); ?>" class="<?php echo esc_attr( $tab_class ); ?>"><?php echo esc_html( $label ); ?></a>
		<?php endforeach; ?>
		</nav>
		<?php if ( 'upgrade' === $current_tab ) : ?>
			<div style="padding:60px 40px 0;"><span class="spinner" style="visibility:visible;float:none;"></span></div>
			<iframe src="https://checkout.freemius.com/mode/dialog/theme/6216/plan/10193/licenses/unlimited/" frameborder="0" scrolling="no" style="backgroundt:transparent;width:680px;height:1050px;margin-top:-82px;position:relative;"></iframe>
		<?php endif; // UPGRADE tab ?>
		<?php if ( 'pro' === $current_tab ) : ?>
			<h2>
				<?php echo esc_html__( 'Thanks for using ExS theme', 'exs' ); ?>
			</h2>
			<p>
				<?php echo esc_html__( 'ExS theme is a next generation theme and it holds its options in the customizer.', 'exs' ); ?>
			</p>
			<?php if ( ! empty( $pro ) ) : ?>
				<h4>
					<?php echo esc_html__( 'You have following PRO features:', 'exs' ); ?>
				</h4>
			<?php else : ?>
				<h4>
					<?php echo esc_html__( 'Unlock PRO features:', 'exs' ); ?>
				</h4>
			<?php endif; ?>
			<ul>
				<li>
					<strong><?php echo esc_html__( 'Site Skins', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Change your site look and feel without changing your theme with growing number of CSS skins in your Customizer', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Elements Animation', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Activate animation in your Customizer and set animation for your posts, widgets and any Gutenberg block', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Google Fonts', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Activate Google Fonts in your Customizer and set custom fonts for your body text and headings', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Pop-up Messages', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Add your top and bottom pop-up messages easily via Customizer', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Side panel (menu)', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Set your side menu, make it always visible for large screens and many more in your Customizer', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Demo contents', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Use growing number of built in demo contents for quick start of your new project', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Categories options', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Set a different display options for different post categories', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Special categories', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Set a post categories for your Portfolio, Services and Team members without using Custom Post Types', 'exs' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'WooCommerce extra options', 'exs' ); ?>:</strong>
					<?php echo esc_html__( 'Change your products list layout easily in your Customizer', 'exs' ); ?>
				</li>
			</ul>
			<p>
			<?php
			if ( ! empty( $pro ) ) :
				$panel_link = add_query_arg( array( 'autofocus[panel]' => 'panel_theme' ), admin_url( 'customize.php' ) );
				?>
				<a href="<?php echo esc_url( $panel_link ); ?>" class="button button-primary">
					<?php echo esc_html__( 'Go to Customizer', 'exs' ); ?>
				</a>
			<?php
			else :
				$panel_link =  add_query_arg( array( 'page' => 'exs-theme', 'tab' => 'upgrade' ), admin_url( 'themes.php' ) );
				?>
				<a href="<?php echo esc_url( $panel_link ); ?>" class="button button-primary">
					<?php echo esc_html__( 'Buy PRO features', 'exs' ); ?>
				</a>
			<?php endif; ?>
			</p>
		<?php
		//Extra features goes here
		endif; //PRO tab
	}
endif;
