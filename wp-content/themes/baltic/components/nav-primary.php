<?php
/**
 * Nav primary
 *
 * @package Baltic
 */
$menu_location = apply_filters( 'baltic_menu_primary', 'menu-1' );

if( has_nav_menu( $menu_location ) ) :?>
	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			Baltic\Icons::svg( [
				'class' => 'icon-stroke',
				'icon' => 'menu'
			] );
			Baltic\Icons::svg( [
				'class' => 'icon-stroke',
				'icon' => 'close'
			] );
			esc_html_e( 'Menu', 'baltic' );
			?>
		</button>
		<?php
			wp_nav_menu( array(
				'theme_location' 	=> $menu_location,
				'menu_id'        	=> 'primary-menu',
				'container_class' 	=> 'wrap',
			) );
		?>
	</nav><!-- #site-navigation -->
<?php endif;?>
