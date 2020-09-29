<?php
/**
 * Nav secondary
 *
 * @package Baltic
 */

$menu_location = apply_filters( 'baltic_primary_menu', 'menu-2' );
?>
<?php if( has_nav_menu( $menu_location ) ) :?>
	<nav id="secondary-navigation" class="secondary-navigation column-item">
		<?php
			wp_nav_menu( array(
				'theme_location' 	=> $menu_location,
				'menu_id'        	=> 'secondary-menu',
				'container_class' 	=> 'menu',
				'depth' 			=> 1,
			) );
		?>
	</nav><!-- #site-navigation -->
<?php endif;?>
