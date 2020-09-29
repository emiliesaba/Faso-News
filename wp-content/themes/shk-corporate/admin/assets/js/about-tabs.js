jQuery(document).ready(function() {

/* Tabs in welcome page */
    function shk_corporate_welcome_page_tabs(event) {
        jQuery(event).parent().addClass("active");
       jQuery(event).parent().siblings().removeClass("active");
       var tab = jQuery(event).attr("href");
       jQuery(".shk-corporate-tab-pane").not(tab).css("display", "none");
       jQuery(tab).fadeIn();
    }
    
    jQuery(".shk-corporate-nav-tabs li").slice(0,1).addClass("active");

   jQuery(".shk-corporate-nav-tabs a").click(function(event) {
       event.preventDefault();
        shk_corporate_welcome_page_tabs(this);
   });

        /* Tab Content height matches admin menu height for scrolling purpouses */
     $tab = jQuery('.shk-corporate-tab-content > div');
     $admin_menu_height = jQuery('#adminmenu').height();
     if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
     {
         $newheight = $admin_menu_height - 180;
         $tab.css('min-height',$newheight);
     }

     jQuery(".shk-corporate-custom-class").click(function(event){
       event.preventDefault();
       jQuery('.shk-corporate-nav-tabs li a[href="#recommended_actions"]').click();
    });

     jQuery(".shk-corporate-changelog-class").click(function(event){
       event.preventDefault();
       jQuery('.shk-corporate-nav-tabs li a[href="#changelog"]').click();
    });

});
