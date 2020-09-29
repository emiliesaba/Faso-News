<?php  
	$actions = $this->recommended_actions;
	$actions_todo = get_option( 'recommending_actions', false );
?>
<div id="recommended_actions" class="vice-tab-pane panel-close">
	<div class="action-list">
		<?php if($actions): foreach ($actions as $key => $actionValue): ?>
		<div class="action" id="<?php echo esc_attr($actionValue['id']); ?>">
			<div class="recommended_box col-md-6 col-sm-6 col-xs-12">
				<img width="772" height="180" src="<?php echo esc_url(VICE_PARENT_TEMPLATE_DIR_URI).'/images/'.str_replace(' ', '-', strtolower($actionValue['title'])).'.png';?>">
				<div class="action-inner">
					<h3 class="action-title"><?php echo esc_html($actionValue['title']); ?></h3>
					<div class="action-desc"><?php echo esc_html($actionValue['desc']); ?></div>
					<?php echo wp_kses_post($actionValue['link']); ?>
					<div class="action-watch">
						<?php if(!$actionValue['is_done']): ?>
							<?php if(!isset($actions_todo[$actionValue['id']]) || !$actions_todo[$actionValue['id']]): ?>
								<span class="dashicons dashicons-visibility"></span>
							<?php else: ?>
								<span class="dashicons dashicons-hidden"></span>
							<?php endif; ?>
						<?php else: ?>
							<span class="dashicons dashicons-yes"></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; endif; ?>
	</div>
</div>