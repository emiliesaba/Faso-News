<?php
/**
 * Posts Navigation
 *
 * @package Baltic
 */

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
	return;
}

$prev_arrow = ( is_rtl() ) ? 'right' : 'left';
$next_arrow = ( is_rtl() ) ? 'left' : 'right';

if ( Baltic\Options::get_option( 'products__nav' ) === 'products_navigation' ) {
	the_posts_navigation( array(
        'prev_text'          => esc_html( Baltic\Options::get_option( 'products__nav-prev' ) ),
        'next_text'          => esc_html( Baltic\Options::get_option( 'products__nav-next' ) ),
	) );
} elseif( Baltic\Options::get_option( 'products__nav' ) == 'products_pagination' ) {
	the_posts_pagination( array(
		'prev_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic\Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'arrow-' . esc_html( $prev_arrow ) ] ), __( 'Previous Product', 'baltic' ) ),
		'next_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic\Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'arrow-' . esc_html( $next_arrow ) ] ), __( 'Next Product', 'baltic' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'baltic' ) . ' </span>',
	) );
}
