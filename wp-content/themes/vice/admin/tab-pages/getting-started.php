<?php
/**
 * Getting started template
 */
$vice_customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="vice-tab-pane active">

	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-12">
				<h1 class="vice-info-title text-center"><?php echo esc_html__('About the Vice theme','vice'); ?></h1>
		    </div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="vice-tab-pane-half vice-tab-pane-first-half">
					<div>
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'This theme is ideal for creating corporate and business websites. There is no separate premium version of it, as Vice is a child theme of the Appointment WordPress theme. The premium version, Appointment PRO has tons of features: a homepage with many sections where you can feature unlimited services, portfolios, user reviews, latest news, callout, custom widgets and much more.', 'vice' ); ?>
						</p>
					</div>
				</div>

				<div class="vice-tab-pane-half vice-tab-pane-first-half">
					<h3><?php esc_html_e( "Recommended Plugins", 'vice' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'To take full advanctage of the theme features you need to install recommended plugins.', 'vice' ); ?>
						
						</p>
						<p><a target="_self" href="#recommended_actions" class="vice-custom-class"><?php esc_html_e( 'Click here','vice');?></a></p>
					</div>
				</div>

				<div class="vice-tab-pane-half vice-tab-pane-first-half">
					<h3><?php esc_html_e( "Start Customizing", 'vice' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'After activating recommended plugins , now you can start customization.', 'vice' ); ?>
						
						</p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer','vice');?></a></p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="vice-tab-pane-half vice-tab-pane-first-half">
				<img src="<?php echo esc_url( VICE_TEMPLATE_DIR_URI. '/admin/img/vice.png'); ?>" alt="<?php esc_attr_e( 'vice Theme', 'vice' ); ?>" />
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="vice-tab-center">
				<h3><?php esc_html_e( "Useful Links", 'vice' ); ?></h3>
			</div>
			<div class=" useful_box">
                <div class="vice-tab-pane-half vice-tab-pane-first-half">
                    <a href="<?php echo esc_url('https://webriti.com/demo/wp/lite/vice/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-desktop info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Lite Demo','vice'); ?></p>
                	</a>
                    <a href="<?php echo esc_url('https://demo.webriti.com/?theme=vice%20Pro'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-book-alt info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('PRO Demo','vice'); ?></p>
                    </a>        
                </div>
                <div class="vice-tab-pane-half vice-tab-pane-first-half">
                    <a href="<?php echo esc_url('https://wordpress.org/support/view/theme-reviews/vice'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-smiley info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Your feedback is valuable to us','vice'); ?></p>
                    </a>
                    <a href="<?php echo esc_url('https://webriti.com/appointment/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-book-alt info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Premium Theme Details','vice'); ?></p>
                    </a>
                </div>
            </div>        
        </div>            
    </div>
</div>

