<?php
/**
 * Site branding
 *
 * @package Baltic
 */
?>
<div class="site-branding">
	<?php
	the_custom_logo();
	if ( is_front_page() && is_home() ) :
		?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
	else :
		?>
		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	endif;
	$baltic_description = get_bloginfo( 'description', 'display' );
	if ( $baltic_description || is_customize_preview() ) :
		?>
		<p class="site-description"><?php echo $baltic_description; /* WPCS: xss ok. */ ?></p>
	<?php endif; ?>
</div><!-- .site-branding -->
