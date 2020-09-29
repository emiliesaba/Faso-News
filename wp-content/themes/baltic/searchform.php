<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package Baltic
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<div itemscope itemtype="http://schema.org/WebSite">
	<meta itemprop="url" content="<?php echo esc_url( home_url( '/' ) ); ?>"/>
	<form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<meta itemprop="target" content="<?php echo esc_url( home_url( '/' ) ); ?>?s={s}"/>
		<label for="<?php echo esc_attr( $unique_id ); ?>">
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'baltic' ); ?></span>
		</label>
		<input itemprop="query-input" type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'baltic' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit">
			<?php Baltic\Icons::svg( [ 'class' => 'icon-stroke', 'icon' => 'search' ] ); ?>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'baltic' ); ?></span>
		</button>
	</form>
</div>
