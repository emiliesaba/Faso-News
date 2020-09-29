<?php
/**
 * Email Course
 */
?>
<div id="emailcourse_themes" class="shk-corporate-tab-pane panel-close">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
                            <h1 class="shk-corporate-info-title text-center"><?php echo esc_html__('Trustworthy Websites Details','shk-corporate'); ?><?php if( !empty($shk_corporate['Version']) ): ?> <sup id="shk-corporate-theme-version"><?php echo esc_html( $shk_corporate['Version'] ); ?> </sup><?php endif; ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="shk-corporate-tab-pane-half shk-corporate-tab-pane-first-half">
					<p>
						<?php esc_html_e( 'A website exists for one and ONLY one reason:','shk-corporate');?>
						<b><?php esc_html_e('To bring you more business.','shk-corporate'); ?></b>
					</p>
					<p>
		   				<?php esc_html_e('Think of your website as a hardworking salesman who works 24/7 and never asks for a raise!','shk-corporate');?>
		   			</p>
					<p>
					<?php esc_html_e( 'In this email course I deliver 4 highly actionable tips on how you can build a website which is trustworthy and which, in turn, brings more business to you.', 'shk-corporate' ); ?>
					</p>
				</div>
			</div>	
			<div class="offer-content clearfix">
			<div class="media pricing-content text-center padding10">
				<div class="media-body">
					<a href="<?php echo esc_url('http://webriti.com/website-email-course/');?>" target="_blank" class="btn btn-info btn-lg" id="email_course"><?php esc_html_e('JOIN COURSE','shk-corporate' ); ?></a>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>