<?php
/**
 * Displays footer site info
 */

?>
<?php if( get_theme_mod( 'tijarat_business_hide_show_scroll',true) != '' || get_theme_mod( 'tijarat_business_enable_disable_scrolltop',true) != '') { ?>
    <?php $tijarat_business_theme_lay = get_theme_mod( 'tijarat_business_footer_options','Right');
        if($tijarat_business_theme_lay == 'Left align'){ ?>
            <a href="#" class="scrollup left"><i class="fas fa-long-arrow-alt-up"></i><span class="screen-reader-text"><?php esc_html_e( 'Scroll Up', 'tijarat-business' ); ?></span></a>
        <?php }else if($tijarat_business_theme_lay == 'Center align'){ ?>
            <a href="#" class="scrollup center"><i class="fas fa-long-arrow-alt-up"></i><span class="screen-reader-text"><?php esc_html_e( 'Scroll Up', 'tijarat-business' ); ?></span></a>
        <?php }else{ ?>
            <a href="#" class="scrollup"><i class="fas fa-long-arrow-alt-up"></i><span class="screen-reader-text"><?php esc_html_e( 'Scroll Up', 'tijarat-business' ); ?></span></a>
    <?php }?>
<?php }?>
<div class="site-info">
	<span><?php tijarat_business_credit(); ?> <?php echo esc_html(get_theme_mod('tijarat_business_footer_text',__('By ThemesEye','tijarat-business'))); ?> </span>
	<span class="footer_text"><?php echo esc_html_e('Powered By WordPress','tijarat-business') ?></span>
</div>