<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Construction_Company
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'construction-company' ); ?></a>
	
    <?php 
        $phonelabel   = get_theme_mod( 'construction_company_header_phone_label' );
        $phonenumber  = get_theme_mod( 'construction_landing_page_phone' ); 
        $emailaddress = get_theme_mod( 'construction_company_header_email' ); 
        $ed_social    = get_theme_mod( 'construction_company_ed_header_social_links' ); 
    ?>
    <div class="mobile-header">
        <div class="container">
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">             
                <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        the_custom_logo();
                    } 
                ?>
                <div class="text-logo">
                    <?php if ( is_front_page() ) : ?>
                        <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif;
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; ?>
                </div>
            </div><!-- .site-branding -->
            <div class="menu-opener">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="mobile-menu">
                <nav id="mobile-navigation" class="primary-navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '3', 'menu_id' => 'primary-menu' ) ); ?>
                </nav>
                <div class="contact-info">                
                <?php if ( ! empty( $phonenumber) || ! empty( $phonelabel ) ) { ?>                                    
                <span>
                    <i class="fa fa-phone" aria-hidden="true"></i>

                    <?php if( ! empty( $phonelabel ) )echo esc_html( $phonelabel ); ?>

                    <?php if( ! empty( $phonenumber ) ){ ?>
                        <a href="<?php echo esc_url( 'tel:'.preg_replace( '/[^\d+]/', '', $phonenumber ) ); ?>"><b><?php echo esc_html( $phonenumber ); ?></b></a>
                    <?php } ?>

                </span>
                <?php } ?>                                            
                <?php if ( ! empty( $emailaddress ) ) { ?>                                    
                <span>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a class="header-email" href="<?php echo esc_url( 'mailto:'.sanitize_email( $emailaddress ) ); ?>"><?php echo esc_html( $emailaddress ); ?></a>
                </span>
                <?php } ?>
                
                </div>
                <?php if( $ed_social ) do_action( 'construction_company_social_link' );  ?>
            </div>
        </div>
    </div>
    
    <header id="masthead" class="site-header header-3" role="banner" itemscope itemtype="https://schema.org/WPHeader">
	   <div class="top-bar">
            <div class="container">
                <div class="contact-info">                
                <?php if ( ! empty( $phonenumber) || ! empty( $phonelabel ) ) { ?>                                    
                <span>
                    <i class="fa fa-phone" aria-hidden="true"></i>

                    <?php if( ! empty( $phonelabel ) )echo esc_html( $phonelabel ); ?>

                    <?php if( ! empty( $phonenumber ) ){ ?>
                        <a href="<?php echo esc_url( 'tel:'.preg_replace( '/[^\d+]/s', '', $phonenumber ) ); ?>"><b><?php echo esc_html( $phonenumber ); ?></b></a>
                    <?php } ?>

                </span>
                <?php } ?>                                            
                <?php if ( ! empty( $emailaddress ) ) { ?>                                    
                <span>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a class="header-email" href="<?php echo esc_url( 'mailto:'.sanitize_email( $emailaddress ) ); ?>"><?php echo esc_html( $emailaddress ); ?></a>
                </span>
                <?php } ?>
                
                </div>
                <?php if( $ed_social ) do_action( 'construction_company_social_link' );  ?>                    
            </div>
        </div>
        
        <div class="sticky-holder"></div>
        <div class="header-t">
            <div class="container">
                    <div class="site-branding" itemscope itemtype="https://schema.org/Organization">             
                        <?php 
                            if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                                the_custom_logo();
                            } 
                        ?>
                        <div class="text-logo">
                            <?php if ( is_front_page() ) : ?>
                                <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                            <?php endif;
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                            <?php
                            endif; ?>
                        </div>
                    </div><!-- .site-branding -->               
                    <div class="right">
                    <div class="form-holder">
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                        <?php get_search_form();  ?>                                                                
                    </div>
                <div id="mobile-header">
                    <a id="responsive-menu-button" href="#sidr-main">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '3', 'menu_id' => 'primary-menu' ) ); ?>                                        
                </nav>
            </div>
            </div>
        </div>
    </header>    
    
    
	<?php 
        
        /**
         * Page Header
         * 
         * @hooked construction_landing_page_get_header
        */
        do_action( 'construction_landing_page_page_header' );

        echo '<div id="acc-content"><!-- done for accessibility reasons -->';

        $ed_section = construction_landing_page_home_section();
        
    	if( is_home() || ! $ed_section || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){
    		echo '<div id="content" class="site-content">';
    	    echo '<div class="container">';
    		echo '<div class="row">';
    	}
