<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baltic
 */

$sidebar = apply_filters( 'baltic_sidebar_tertiary', 'sidebar-2' );
$col = Baltic\Options::get_option( 'footer__widgets-col' );

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside id="tertiary" class="widget-area">
	<div class="container">
		<div class="columns columns-sm-<?php echo absint( $col['mobile'] );?> columns-md-<?php echo absint( $col['tablet'] );?> columns-lg-<?php echo absint( $col['desktop'] );?>">
		<?php dynamic_sidebar( $sidebar ); ?>
		</div><!-- .columns -->
	</div><!-- .container -->
</aside><!-- #tertiary -->
