jQuery(document).ready(function() {

/* Tabs in welcome page */
    function vice_welcome_page_tabs(event) {
        jQuery(event).parent().addClass("active");
       jQuery(event).parent().siblings().removeClass("active");
       var tab = jQuery(event).attr("href");
       jQuery(".vice-tab-pane").not(tab).css("display", "none");
       jQuery(tab).fadeIn();
    }
    
    jQuery(".vice-nav-tabs li").slice(0,1).addClass("active");

   jQuery(".vice-nav-tabs a").click(function(event) {
       event.preventDefault();
        vice_welcome_page_tabs(this);
   });

        /* Tab Content height matches admin menu height for scrolling purpouses */
     $tab = jQuery('.vice-tab-content > div');
     $admin_menu_height = jQuery('#adminmenu').height();
     if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
     {
         $newheight = $admin_menu_height - 180;
         $tab.css('min-height',$newheight);
     }

     jQuery(".vice-custom-class").click(function(event){
       event.preventDefault();
       jQuery('.vice-nav-tabs li a[href="#recommended_actions"]').click();
    });

     jQuery(".vice-changelog-class").click(function(event){
       event.preventDefault();
       jQuery('.vice-nav-tabs li a[href="#changelog"]').click();
    });

});
