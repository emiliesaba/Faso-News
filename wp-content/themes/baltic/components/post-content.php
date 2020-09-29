<?php
/**
 * Post content
 *
 * @package Baltic
 */

$rtl_arrow = ( is_rtl() ) ? 'left' : 'right';
$num = Baltic\Options::get_option( 'excerpt_length' );
$more_link_text = Baltic\Options::get_option( 'more_link_text' );

if ( is_singular() || post_password_required() ) {

	the_content( sprintf(
		wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'baltic' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title()
	) );

	wp_link_pages( array(
		'before' 			=> '<div class="page-links"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'baltic' ) . '</span>',
		'after'  			=> '</div>',
		'pagelink' 			=> '<span class="page-number">%</span>'
	) );

} else {

	echo wp_kses_post( wpautop( strip_shortcodes( wp_trim_words( get_the_content(), absint( $num ), ' &hellip;' ) ) ) );

	echo sprintf( '<p><a href="%1$s" class="more-link">%2$s %3$s %4$s</a></p>', esc_url( get_the_permalink() ), '<span class="more-link-text">'. esc_html( $more_link_text ) .'</span>', '<span class="screen-reader-text">'. esc_html( get_the_title() ) .'</span>', Baltic\Icons::get_svg( [ 'class'=>'icon-stroke', 'icon' => 'arrow-'. esc_attr( $rtl_arrow ) ] ) ); // WPCS: XSS ok.

}
