<?php

add_action( 'admin_menu', 'tijarat_business_gettingstarted' );
function tijarat_business_gettingstarted() {
	add_theme_page( esc_html__('About Theme', 'tijarat-business'), esc_html__('About Theme', 'tijarat-business'), 'edit_theme_options', 'tijarat-business-guide-page', 'tijarat_business_guide');   
}

function tijarat_business_admin_theme_style() {
   wp_enqueue_style('tijarat-business-custom-admin-style', get_template_directory_uri() . '/inc/dashboard/get_started_info.css');
   wp_enqueue_script('tabs', get_template_directory_uri() . '/inc/dashboard/js/tab.js');
}
add_action('admin_enqueue_scripts', 'tijarat_business_admin_theme_style');

function tijarat_business_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {?>
    <div class="notice notice-success is-dismissible getting_started">
		<div class="notice-content">
			<h2><?php esc_html_e( 'Thanks for installing Tijarat Business Theme', 'tijarat-business' ) ?> </h2>
			<p><?php esc_html_e( "Please Click on the link below to know the theme setup information", 'tijarat-business' ) ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=tijarat-business-guide-page' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Get Started ', 'tijarat-business' ); ?></a></p>
		</div>
	</div>
	<?php }
}
add_action('admin_notices', 'tijarat_business_notice');


/**
 * Theme Info Page
 */
function tijarat_business_guide() {

	// Theme info
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'tijarat-business' ); ?>

	<div class="wrap getting-started">
		<div class="getting-started__header">
				<div class="intro">
					<div class="pad-box">
						<h2 align="center"><?php esc_html_e( 'Welcome to Tijarat Business Theme', 'tijarat-business' ); ?>
						<span class="version" align="center">Version: <?php echo esc_html($theme['Version']);?></span></h2>	
						</span>
						<div class="powered-by">
							<p align="center"><strong><?php esc_html_e( 'Theme created by ThemesEye', 'tijarat-business' ); ?></strong></p>
							<p align="center">
								<img role="img" class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/logo.png'); ?>"/>
							</p>
						</div>
					</div>
				</div>

			<div class="tab">
			  <button role="tab" class="tablinks" onclick="openCity(event, 'lite_theme')">Getting Started</button>		  
			  <button role="tab" class="tablinks" onclick="openCity(event, 'pro_theme')">Get Premium</button>
			</div>

			<!-- Tab content -->
			<div id="lite_theme" class="tabcontent open">
				<h2 class="tg-docs-section intruction-title" id="section-4" align="center"><?php esc_html_e( '1). Tijarat Business Lite Theme', 'tijarat-business' ); ?></h2>
				<div class="row">
					<div class="col-md-5">
						<div class="pad-box">
	              			<img role="img" class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/screenshot.png'); ?>"/>
	              		 </div> 
					</div>
					<div class="theme-instruction-block col-md-7">
						<div class="pad-box">
		                    <p><?php esc_html_e( 'Tijarat Business is a professionally developed, clean, elegant and feature-rich business WordPress theme to display your services in a sophisticated way to instil customers trust on you. It very well suits businesses of all sizes- from single person business to multinational corporate company and everything between. It is the best fit for corporates, entrepreneurs, joint ventures, e-Commerce sites, creative agencies, start-ups, web developing agencies, business development firm, digital marketing agencies, consultants, organizations, firms, sales and marketing companies, promotional and investment companies and all other businesses of diverse niche. It has smart use of call to action (CTA) buttons to lead customers to the right way. Tijarat Business is absolutely responsive, translation ready, cross-browser compatible and retina ready. It has all the necessary social media icons to adopt the right marketing strategy for your business. Its SEO is well working and it loads with super-fast speed. This business theme is compatible with the recently launched WordPress version and works smoothly with all plugins. ', 'tijarat-business' ); ?></p>
							<ol>
								<li><?php esc_html_e( 'Start','tijarat-business'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','tijarat-business'); ?></a> <?php esc_html_e( 'your website.','tijarat-business'); ?> </li>
								<li><?php esc_html_e( 'Tijarat Business','tijarat-business'); ?> <a target="_blank" href="<?php echo esc_url( TIJARAT_BUSINESS_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation','tijarat-business'); ?></a> </li>
							</ol>
	                    </div>
	                </div>
				</div><br><br>
				
	        </div>
	        <div id="pro_theme" class="tabcontent">
				<h2 class="dashboard-install-title" align="center"><?php esc_html_e( '2.) Premium Theme Information.','tijarat-business'); ?></h2>
            	<div class="row">
					<div class="col-md-7">
						<img role="img" src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/media/responsive.png'); ?>" alt="">
						<div class="pro-links" >
					    	<a href="<?php echo esc_url( TIJARAT_BUSINESS_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'tijarat-business'); ?></a>
							<a href="<?php echo esc_url( TIJARAT_BUSINESS_BUY_PRO ); ?>"><?php esc_html_e('Buy Pro', 'tijarat-business'); ?></a>
							<a href="<?php echo esc_url( TIJARAT_BUSINESS_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'tijarat-business'); ?></a>
						</div>
						<div class="pad-box">
							<h3><?php esc_html_e( 'Pro Theme Description','tijarat-business'); ?></h3>
                    		<p class="pad-box-p"><?php esc_html_e( 'This business WordPress theme is polished, bold, modern and well-coded to fulfil all the online needs of corporate houses, finance companies and businesses to lead them to the path of success. It is multipurpose and hence can become face of any website be it a start-up, small firm, entrepreneurship, joint venture, sales and marketing company, digital agency or any other business of a single person or thousands of employee. With this theme, show your professionalism with good ethics to make reliable customers with long lasting relationships. This business WordPress theme is highly responsive to changing layouts of screens and loads beautifully on all browsers. It will amaze you with its pixel perfect images and ability to adopt any global language. With its deep running customizability, you get to choose the colour scheme, background, menu style, font, logo, slider setting and so much more things in just a couple of clicks here and there.', 'tijarat-business' ); ?><p>
                    	</div>
					</div>
					<div class="col-md-5 install-plugin-right">
						<div class="pad-box">								
							<h3><?php esc_html_e( 'Pro Theme Features','tijarat-business'); ?></h3>
							<div class="dashboard-install-benefit">
								<ul>
									<li><?php esc_html_e( 'Easy install 10 minute setup Themes','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Multiplue Domain Usage','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Premium Technical Support','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'FREE Shortcodes','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Multiple page templates','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Google Font Integration','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Customizable Colors','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Theme customizer ','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Documention','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Unlimited Color Option','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Plugin Compatible','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Social Media Integration','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Incredible Support','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Eye Appealing Design','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Simple To Install','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Fully Responsive ','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Translation Ready','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'Custom Page Templates ','tijarat-business'); ?></li>
									<li><?php esc_html_e( 'WooCommerce Integration','tijarat-business'); ?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
          	<div class="dashboard__blocks">
				<div class="row">
					<div class="col-md-3">
						<h3><?php esc_html_e( 'Get Support','tijarat-business'); ?></h3>
						<ol>
							<li><a target="_blank" href="<?php echo esc_url( TIJARAT_BUSINESS_FREE_SUPPORT ); ?>"><?php esc_html_e( 'Free Theme Support','tijarat-business'); ?></a></li>
							<li><a target="_blank" href="<?php echo esc_url( TIJARAT_BUSINESS_PRO_SUPPORT ); ?>"><?php esc_html_e( 'Premium Theme Support','tijarat-business'); ?></a></li>
						</ol>
					</div>

					<div class="col-md-3">
						<h3><?php esc_html_e( 'Getting Started','tijarat-business'); ?></h3>
						<ol>
							<li><?php esc_html_e( 'Start','tijarat-business'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','tijarat-business'); ?></a> <?php esc_html_e( 'your website.','tijarat-business'); ?> </li>
						</ol>
					</div>
					<div class="col-md-3">
						<h3><?php esc_html_e( 'Help Docs','tijarat-business'); ?></h3>
						<ol>
							<li><a target="_blank" href="<?php echo esc_url( TIJARAT_BUSINESS_FREE_DOC ); ?>"><?php esc_html_e( 'Free Theme Documentation','tijarat-business'); ?></a></li>
							<li><a target="_blank" href="<?php echo esc_url( TIJARAT_BUSINESS_PRO_DOC ); ?>"><?php esc_html_e( 'Premium Theme Documentation','tijarat-business'); ?></a></li>
						</ol>
					</div>
					<div class="col-md-3">
						<h3><?php esc_html_e( 'Buy Premium','tijarat-business'); ?></h3>
						<ol>
							<a href="<?php echo esc_url( TIJARAT_BUSINESS_BUY_PRO ); ?>"><?php esc_html_e('Buy Pro', 'tijarat-business'); ?></a>
						</ol>
					</div>
				</div>
			</div>
		</div>
		
	</div>

<?php
}?>