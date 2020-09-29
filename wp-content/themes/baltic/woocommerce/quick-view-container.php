<?php
/**
 * Quick view container
 *
 * @package Baltic
 */
?>
<div id="quick-view-container" class="quick-view__container hide" tabindex="-1" role="dialog">
	<div class="quick-view__wrap">
		<div id="quick-view-inner" class="quick-view__inner">
			<button id="quick-view-close" class="quick-view__close">
				<span class="screen-reader-text"><?php echo esc_html__( 'Close', 'baltic' ); ?></span>
				<?php Baltic\Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'close' ] ); ?>
			</button>
			<div id="quick-view-content" class="quick-view__content"></div>
		</div><!-- .quick-view__inner -->
	</div><!-- .quick-view__wrap -->
</div><!-- #quick-view__container -->
