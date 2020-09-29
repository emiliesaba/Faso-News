<?php
/**
 * Displays top navigation
 */
?>

<div class="header-menu">
	<div class="row m-0">
		<div class="col-lg-11 col-md-11">
			<nav role="navigation" id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'tijarat-business' ); ?>">
				<button role="tab" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
					<?php
						esc_html_e( 'Menu', 'tijarat-business' );
					?>
				</button>
				<?php wp_nav_menu( array(
					'theme_location' => 'top',
					'menu_id'        => 'top-menu',
				) ); ?>				
			</nav>
		</div>
		<div class="col-lg-1 col-md-1">
			<div class="search-body">
				<button type="button" data-toggle="modal" data-target="#myModal"><i class="<?php echo esc_attr(get_theme_mod('tafri_travel_search_icon','fas fa-search')); ?>"></i></button>
			</div>
		</div>
	</div>
	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-body">
				<div class="searchform-inner">
					<?php get_search_form(); ?>
				</div>
			</div>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
		</div>
    </div>
</div>