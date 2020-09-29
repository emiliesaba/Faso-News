<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
	$shk_corporate_header_setting = wp_parse_args(  get_option( 'appointment_options', array() ), theme_setup_data());
	?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#wrap"><?php esc_html_e('Skip to content', 'shk-corporate'); ?></a> <!--Top Bar Section-->
<?php if( is_active_sidebar('home-header-sidebar_left') || is_active_sidebar('home-header-sidebar_center') || is_active_sidebar('home-header-sidebar_right') ) { ?>
<section class="top-header-widget">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<div id="top-header-sidebar-left">
			<?php if( is_active_sidebar('home-header-sidebar_left') ) { ?>
			<?php  dynamic_sidebar( 'home-header-sidebar_left' ); ?>
			<?php } ?>
			</div>
			</div>
			<div class="col-sm-4">
			<div id="top-header-sidebar-center">
			<?php if( is_active_sidebar('home-header-sidebar_center') ) { 
			 dynamic_sidebar( 'home-header-sidebar_center' );
			 } ?>
			</div>
			</div>
			<div class="col-sm-4">
			<div id="top-header-sidebar-right">
			<?php  if( is_active_sidebar('home-header-sidebar_right') ) { ?>
			<?php dynamic_sidebar( 'home-header-sidebar_right' ); ?>
			<?php } ?>
			</div>
			</div>
		</div>	
	</div>
</section>
<?php } ?>
<!--Logo & Menu Section-->	
<?php
$shk_corporate_header_options = shk_corporate_default_data();
$header_shk_corporate_setting = wp_parse_args(get_option('appointment_options', array()), $shk_corporate_header_options);
if ($header_shk_corporate_setting['header_classic_layout_setting']=='default'){
    $shk_corporate_navbarstyle='navbar navbar-default';
}elseif ($header_shk_corporate_setting['header_classic_layout_setting']=='classic'){
    $shk_corporate_navbarstyle='navbar navbar-default navbar5';
} ?>
<nav class="<?php echo esc_attr($shk_corporate_navbarstyle);?>">
	<div class="container">
		<div class="col-lg-5 col-md-12 col-sm-12">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
				<?php
			    if (!has_custom_logo() && $shk_corporate_header_setting['enable_header_logo_text'] != 'nomorenow') {
		            $shk_corporate_logo = $shk_corporate_header_setting['upload_image_logo'];
		            $shk_corporate_logo_id = attachment_url_to_postid($shk_corporate_logo);
		            $shk_corporate_logo_alt = get_post_meta($shk_corporate_logo_id, '_wp_attachment_image_alt', true);
		            $shk_corporate_logo_title = get_the_title($shk_corporate_logo_id);

		            if ($shk_corporate_header_setting['enable_header_logo_text'] == '' && $shk_corporate_logo != '') {
		                ?>
		                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home" >
                        <img class="img-responsive" src="<?php echo esc_url($shk_corporate_logo); ?>" style="height:50px; width:200px;" alt="<?php
                        if (!empty($shk_corporate_logo_alt)) {
                           echo esc_attr($shk_corporate_logo_alt);
                        } else {
                        echo esc_attr(get_bloginfo('name'));
                        }
                        ?>"/></a>
		                <?php
		                 }
		        } else {
			         if ($shk_corporate_header_setting['enable_header_logo_text'] != 'nomorenow') {
			             $shk_corporate_header_setting['enable_header_logo_text'] = 'nomorenow';
			             update_option('appointment_options', $shk_corporate_header_setting);
			         }
		            the_custom_logo();
		            } ?>
                <div class="site-branding-text logo-link-url">

                <h1 class="site-title" style="margin: 0px;" ><a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home" >

                        <div class=appointment_title_head>
                            <?php bloginfo('name'); ?>
                        </div>
                    </a>
                </h1>

                <?php
                $shk_corporate_description = get_bloginfo('description', 'display');
                if ($shk_corporate_description || is_customize_preview()) :
                    ?>
                    <p class="site-description"><?php echo $shk_corporate_description; ?></p>
                <?php endif; ?>
            </div>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only"><?php esc_html_e('Toggle navigation', 'shk-corporate'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		</div>
		<div class="col-lg-7 col-md-12 col-sm-12">
		<?php 
				$shk_corporate_facebook = $shk_corporate_header_setting['social_media_facebook_link'];
				$shk_corporate_twitter = $shk_corporate_header_setting['social_media_twitter_link'];
				$shk_corporate_linkdin = $shk_corporate_header_setting['social_media_linkedin_link'];
				
				$shk_corporate_social = '<ul id="%1$s" class="%2$s">%3$s';
				if($shk_corporate_header_setting['header_social_media_enabled'] == 0 )
				{
					$shk_corporate_social .= '<ul class="head-contact-social">';

					if($shk_corporate_header_setting['social_media_facebook_link'] != '') {
					$shk_corporate_social .= '<li class="facebook"><a href="'.esc_url($shk_corporate_facebook).'"';
						if($shk_corporate_header_setting['facebook_media_enabled']==1)
						{
						 $shk_corporate_social .= 'target="_blank"';
						}
					$shk_corporate_social .='><i class="fa fa-facebook"></i></a></li>';
					}
					if($shk_corporate_header_setting['social_media_twitter_link']!='') {
					$shk_corporate_social .= '<li class="twitter"><a href="'.esc_url($shk_corporate_twitter).'"';
						if($shk_corporate_header_setting['twitter_media_enabled']==1)
						{
						 $shk_corporate_social .= 'target="_blank"';
						}
					$shk_corporate_social .='><i class="fa fa-twitter"></i></a></li>';
					
					}
					if($shk_corporate_header_setting['social_media_linkedin_link']!='') {
					$shk_corporate_social .= '<li class="linkedin"><a href="'.esc_url($shk_corporate_linkdin).'"';
						if($shk_corporate_header_setting['linkedin_media_enabled']==1)
						{
						 $shk_corporate_social .= 'target="_blank"';
						}
					$shk_corporate_social .='><i class="fa fa-linkedin"></i></a></li>';
					}
					$shk_corporate_social .='</ul>'; 
					
			}
			$shk_corporate_social .='</ul>'; 
		
		?>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php wp_nav_menu( array(  
				'theme_location' => 'primary',
				'container'  => '',
				'menu_class' => 'nav navbar-nav navbar-right',
				'fallback_cb' => 'appointment_fallback_page_menu',
				'items_wrap'  => $shk_corporate_social,
				'walker' => new appointment_nav_walker()
				 ) );
				?>
		</div><!-- /.navbar-collapse -->
		</div>
	</div><!-- /.container-fluid -->
</nav>	
<!--/Logo & Menu Section-->	
<div class="clearfix"></div>