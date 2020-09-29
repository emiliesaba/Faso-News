( function( $, api ) {

	$( function() {
		var $preloader = $('#customize-control-baltic-preloader'),
			$preloaderInput = $preloader.find('input');

		var showHidePreloader = function() {
			if( $preloaderInput.is(':checked') ) {
				$preloader.nextAll().show();
			} else {
				$preloader.nextAll().hide();
			}
		};

		var $postsNavSelect = $( '#customize-control-nav__posts' ).find('select'),
			$prevText = $('#customize-control-nav__posts-prev'),
			$nextText = $('#customize-control-nav__posts-next');

		var showHideNav = function() {
			if( $postsNavSelect.val() === 'posts_pagination' ) {
				$prevText.hide();
				$nextText.hide();
			} else if( $postsNavSelect.val() === 'posts_navigation' ) {
				$prevText.show();
				$nextText.show();
			}
		};

		var $productsNavSelect = $( '#customize-control-products__nav' ).find('select'),
			$productPrevText = $('#customize-control-products__nav-prev'),
			$productPextText = $('#customize-control-products__nav-next');

		var showHideProductsNav = function() {
			if( $productsNavSelect.val() === 'products_pagination' ) {
				$productPrevText.hide();
				$productPextText.hide();
			} else if( $productsNavSelect.val() === 'products_navigation' ) {
				$productPrevText.show();
				$productPextText.show();
			}
		};

		var $notice = $('#customize-control-woocommerce_demo_store'),
			$noticeInput = $notice.find('input');

		var noticeColor = function() {
			if( $noticeInput.is(':checked') ) {
				$notice.nextAll().show();
			} else {
				$notice.nextAll().hide();
			}
		};

		showHidePreloader();
		showHideNav();
		showHideProductsNav();
		noticeColor();

		$( $preloaderInput ).on( 'change', function() {
			showHidePreloader();
		});

		$( $postsNavSelect ).on( 'change', function() {
			showHideNav();
		});

		$( $productsNavSelect ).on( 'change', function() {
			showHideProductsNav();
		});

		$( $noticeInput ).on( 'change', function() {
			noticeColor();
		});

	});

})( jQuery, wp.customize );
