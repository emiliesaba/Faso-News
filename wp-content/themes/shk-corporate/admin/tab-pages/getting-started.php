<?php
/**
 * Getting started template
 */
$shk_corporate_customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="shk-corporate-tab-pane active">

	<div class="container-fluid">
		<div class="row">
		    <div class="col-md-12">
				<h1 class="shk-corporate-info-title text-center"><?php echo esc_html__('About the Shk-Corporate theme','shk-corporate'); ?></h1>
		    </div>
		</div>
		<div class="row">
			<div class="col-md-6">

				<div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
					<div>
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'This theme is ideal for creating corporate and business websites. There is no separate premium version of it, as Shk-Corporate is a child theme of the Appointment WordPress theme. The premium version, Appointment PRO has tons of features: a homepage with many sections where you can feature unlimited services, portfolios, user reviews, latest news, callout, custom widgets and much more.', 'shk-corporate' ); ?>
						</p>
					</div>
				</div>

				<div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
					<h3><?php esc_html_e( "Recommended Plugins", 'shk-corporate' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'To take full advanctage of the theme features you need to install recommended plugins.', 'shk-corporate' ); ?>
						</p>
						<p><a target="_self" href="#recommended_actions" class="shk-corporate-custom-class"><?php esc_html_e( 'Click here','shk-corporate');?></a></p>
					</div>
				</div>

				<div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
					<h3><?php esc_html_e( "Start Customizing", 'shk-corporate' ); ?></h3>
					<div style="border-top: 1px solid #eaeaea;">
						<p style="margin-top: 16px;">
							<?php esc_html_e( 'After activating recommended plugins , now you can start customization.', 'shk-corporate' ); ?>
						
						</p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer','shk-corporate');?></a></p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
				<img src="<?php echo esc_url( SHK_CORPORATE_TEMPLATE_DIR_URI ) . '/admin/img/shk-corporate.png'; ?>" alt="<?php esc_attr_e( 'shk-corporate Theme', 'shk-corporate' ); ?>" />
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="shk-corporate-tab-center">
				<h3><?php esc_html_e( "Useful Links", 'shk-corporate' ); ?></h3>
			</div>
			<div class=" useful_box">
                <div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
                    <a href="<?php echo esc_url('https://webriti.com/demo/wp/lite/shk-corporate/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-desktop info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Lite Demo','shk-corporate'); ?></p>
                	</a>
                    <a href="<?php echo esc_url('https://demo.webriti.com/?theme=shk-corporate%20Pro'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-book-alt info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('PRO Demo','shk-corporate'); ?></p>
                    </a>        
                </div>
                <div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
                    <a href="<?php echo esc_url('https://wordpress.org/support/view/theme-reviews/shk-corporate'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-smiley info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Your feedback is valuable to us','shk-corporate'); ?></p>
                    </a>
                    <a href="<?php echo esc_url('https://webriti.com/appointment/'); ?>" target="_blank"  class="info-block">
                    	<div class="dashicons dashicons-book-alt info-icon"></div>
                    	<p class="info-text"><?php echo esc_html__('Premium Theme Details','shk-corporate'); ?></p>
                    </a>
                </div>
            </div>        
        </div>            
    </div>
</div>

