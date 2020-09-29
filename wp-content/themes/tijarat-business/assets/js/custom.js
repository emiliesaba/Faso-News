// scroll
jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 100) {
	        jQuery('.scrollup').fadeIn();
	    } else {
	        jQuery('.scrollup').fadeOut();
	    }
	});
	jQuery('.scrollup').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});

jQuery(function($){
  $(window).load(function() {
    $("#pre-loader").delay(1000).fadeOut("slow");
      $(".circle").delay(1000).fadeOut("slow");
  })
});

(function( $ ) {

	$(window).scroll(function(){
	  var sticky = $('.sticky-header'),
	      scroll = $(window).scrollTop();

	  if (scroll >= 100) sticky.addClass('fixed-header');
	  else sticky.removeClass('fixed-header');
	});

})( jQuery );