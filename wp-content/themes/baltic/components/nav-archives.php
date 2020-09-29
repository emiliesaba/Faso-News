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

if ( Baltic\Options::get_option( 'nav__posts' ) == 'posts_navigation' ) {
	the_posts_navigation( array(
        'prev_text'          => esc_html( Baltic\Options::get_option( 'nav__posts-prev' ) ),
        'next_text'          => esc_html( Baltic\Options::get_option( 'nav__posts-next' ) ),
	) );
} elseif( Baltic\Options::get_option( 'nav__posts' ) == 'posts_pagination' ) {
	the_posts_pagination( array(
		'prev_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic\Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'arrow-' . esc_html( $prev_arrow ) ] ), esc_html__( 'Previous Page', 'baltic' ) ),
		'next_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', Baltic\Icons::get_svg( [ 'class' => 'icon-stroke', 'icon' => 'arrow-' . esc_html( $next_arrow ) ] ), esc_html__( 'Next Page', 'baltic' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'baltic' ) . ' </span>',
	) );
}
