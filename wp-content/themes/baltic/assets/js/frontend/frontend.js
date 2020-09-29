/* global Balticl10n, smoothScroll, fitvids, cssVars, Cookies, ActiveXObject, JSON */
( function( $ ) {

	var baltic = baltic || {};

	baltic.init = function() {

	    this.document 		= window.document;
	    this.body 			= document.body;
	    this.rootElement 	= document.documentElement;
		this.isRtl 			= ( document.documentElement.dir === 'rtl' ) ? true : false ;

		this.inlineSVG();
		this.preloader();
		this.stickyHeader();
		this.headerExtra();
		this.pageHeader();
		this.icons();
		this.quickView();
		this.wishListLoader();
		this.skipTop();
	};

	baltic.supportInlineSVG = function() {

		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );

	};

	baltic.ajax = function ( url, success ) {
	    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    xhr.open('GET', url);
	    xhr.onreadystatechange = function() {
	        if (xhr.readyState > 3 && xhr.status === 200) {
	        	success(xhr.responseText);
	        }
	    };
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	    xhr.send();
	    return xhr;
	};

	baltic.inlineSVG = function() {

		if ( true === baltic.supportInlineSVG() ) {
			this.rootElement.className = this.rootElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

	};

	baltic.preloader = function() {

		var sitePreloader = document.getElementById('site-preloader');

		if( sitePreloader ) {
			window.addEventListener( 'load', function() {
				if ( baltic.body.classList.contains( 'preloader-enabled' ) ) {
					baltic.body.className = baltic.body.className.replace( ' preloader-enabled', '' );
					sitePreloader.className += ' hide';
					setTimeout( function(){
						sitePreloader.style.display = 'none';
					}, 500 );
				}
			}, false );
		}

	};

	baltic.stickyHeader = function() {

		var header, sticky, headerOffset;

		if ( false === baltic.body.classList.contains( 'sticky-header' ) ) {
			return;
		}

		header = document.getElementById('masthead');

		if( header ) {
			sticky 				= document.createElement('div');
			sticky.className 	= 'sticky-wrapper';
			sticky.style.height = header.offsetHeight + 'px';
			headerOffset 		= header.offsetTop + header.offsetHeight;

			header.parentNode.insertBefore( sticky, header.nextSibling );

			var applySticky = function() {
				if ( window.innerWidth > 768 && window.pageYOffset > headerOffset ) {
					header.classList.add( 'sticky' );
					header.nextSibling.style.display = 'block';
				} else {
					header.classList.remove( 'sticky' );
					header.nextSibling.style.display = 'none';
				}
			};

			applySticky();

			window.addEventListener( 'scroll', applySticky, false );
		}

	};

	baltic.headerExtra = function() {

		var cartLink = document.getElementById( 'site-header-extra-cart-link' );
		var extraToggle = document.getElementById( 'site-header-extra-toggle' );

		if( ! extraToggle || ! cartLink ) {
			return;
		}

		cartLink.addEventListener( 'click', function( e ) {

			e.stopPropagation();
			e.preventDefault();

			if ( this.classList.contains('toggled') ) {
				this.className = this.className.replace( ' toggled', '' );
				this.setAttribute( 'aria-expanded', 'false' );
				extraToggle.className = extraToggle.className.replace( ' show', '' );
			} else {
				this.className += ' toggled';
				this.setAttribute( 'aria-expanded', 'true' );
				extraToggle.className += ' show';
			}

		}, false );

		this.body.addEventListener( 'click', function( e ) {

			if( ! e.target.closest('.site-header-extra-toggle') && extraToggle.classList.contains('show') ) {
				cartLink.className = cartLink.className.replace( ' toggled', '' );
				cartLink.setAttribute( 'aria-expanded', 'false' );
				extraToggle.className = extraToggle.className.replace( ' show', '' );
			}

		}, false );

	};

	baltic.pageHeader = function() {

		var header, pageHeader, hasThumbnail;

		header 			= document.getElementById('masthead');
		pageHeader 		= document.getElementById('page-header');

		if( pageHeader ) {
			hasThumbnail 	= pageHeader.getElementsByClassName('page-header-thumbnail')[0];

			if( hasThumbnail ) {
				pageHeader.classList.add('page-header-has-thumbnail');
				if( window.innerWidth > 768 ) {
					pageHeader.style.minHeight = 'calc( 75vh - '+ header.offsetHeight +'px )';
				}
			}
		}

	};

	baltic.icons = function() {

		var widgetArcive, widgetCategories, widgetRecentComments, widgetRecentEntries, widgetPages, li, i, j;

		widgetArcive 			= document.getElementsByClassName('widget_archive'),
		widgetCategories 		= document.getElementsByClassName('widget_categories'),
		widgetRecentComments 	= document.getElementsByClassName('widget_recent_comments'),
		widgetRecentEntries 	= document.getElementsByClassName('widget_recent_entries'),
		widgetPages 			= document.getElementsByClassName('widget_pages');

		var svgIcon = function( svgIcon ) {
			var div = document.createElement('div');
			div.innerHTML = '<p>x</p>' + svgIcon;
			return div.childNodes[1];
		};


		if( widgetArcive ) {
			for ( i = 0; i < widgetArcive.length; i++ ) {
				li = widgetArcive[i].getElementsByTagName('LI');
				for ( j = 0; j < li.length; j++ ) {
					li[j].insertBefore( svgIcon( Balticl10n.icons.calendar ), li[j].childNodes[0] );
				}
			}
		}

		if( widgetCategories ) {
			for ( i = 0; i < widgetCategories.length; i++ ) {
				li = widgetCategories[i].getElementsByTagName('LI');
				for ( j = 0; j < li.length; j++ ) {
					li[j].insertBefore( svgIcon( Balticl10n.icons.folderOpen ), li[j].childNodes[0] );
				}
			}
		}

		if( widgetRecentComments ) {
			for ( i = 0; i < widgetRecentComments.length; i++ ) {
				li = widgetRecentComments[i].getElementsByTagName('LI');
				for ( j = 0; j < li.length; j++ ) {
					li[j].insertBefore( svgIcon( Balticl10n.icons.message ), li[j].childNodes[0] );
				}
			}
		}

		if( widgetRecentEntries ) {
			for ( i = 0; i < widgetRecentEntries.length; i++ ) {
				li = widgetRecentEntries[i].getElementsByTagName('LI');
				for ( j = 0; j < li.length; j++ ) {
					li[j].insertBefore( svgIcon( Balticl10n.icons.file ), li[j].childNodes[0] );
				}
			}
		}

		if( widgetPages ) {
			for ( i = 0; i < widgetPages.length; i++ ) {
				li = widgetPages[i].getElementsByTagName('LI');
				for ( j = 0; j < li.length; j++ ) {
					li[j].insertBefore( svgIcon( Balticl10n.icons.clipboard ), li[j].childNodes[0] );
				}
			}
		}

	};

	baltic.wishListCount = function() {

		var counter, span, data;

		counter = document.getElementById('site-header-extra-wishlist');

		if( counter ) {
			span 	= counter.getElementsByTagName('span');

			if ( 'function' === typeof Cookies && Cookies.get( 'yith_wcwl_products' ) ) {

				data = Cookies.get( 'yith_wcwl_products' );

				if( data ) {
					var product = JSON.parse( Cookies.get( 'yith_wcwl_products' ) );
					var total 	= Object.keys(product).length;

					if( total > 0 ) {
						span[0].innerHTML = total;
						span[0].classList.remove( 'hide' );
					} else {
						span[0].classList.add( 'hide' );
					}
				}

			} else {
				baltic.ajax( Balticl10n.ajaxUrl + '&action=wishlist_count', function( data ) {

					data = JSON.parse( data );

					if( data.total > 0 ) {
						span[0].innerHTML = data.total;
						span[0].classList.remove( 'hide' );
					} else {
						span[0].classList.add( 'hide' );
					}

				});
			}
		}

	};

	baltic.wishListLoader = function() {

		var main, button, i, self;

		main = document.getElementById('main');

		var loader = function( e ) {
			e.preventDefault();
			self = this;
			self.lastElementChild.classList.add('show');
			setTimeout( function() {
				self.lastElementChild.classList.remove('show');
			}, 500);
		};

		if( main ) {
			button 	= main.getElementsByClassName( 'add_to_wishlist' );

			for ( i = 0; i < button.length; i++ ) {

				button[i].addEventListener( 'click', loader, false );

			}
		}

	};

	baltic.wishListTable = function() {

		var table = document.getElementById('yith-wcwl-form'), i;

		if( table ) {

			table.getElementsByTagName('table')[0].classList.add( 'shop_table_responsive' );

			var productName = table.getElementsByClassName('product-name'),
				productPrice = table.getElementsByClassName('product-price'),
				stockStatus = table.getElementsByClassName('product-stock-status');

			if( productName || productPrice || stockStatus ) {
				for ( i = 0; i < productName.length; i++ ) {
					productName[i].setAttribute( 'data-title', Balticl10n.table.product );
				}
				for ( i = 0; i < productPrice.length; i++ ) {
					productPrice[i].setAttribute( 'data-title', Balticl10n.table.price );
				}
				for ( i = 0; i < stockStatus.length; i++ ) {
					stockStatus[i].setAttribute( 'data-title', Balticl10n.table.stockStatus );
				}
			}
		}

	};

	baltic.quickView = function() {

		var button, container, innerWrap, content, buttonClose, i, self;

		button 		= document.getElementsByClassName( 'baltic-quick-view-button' );
		container 	= document.getElementById( 'quick-view-container' );
		innerWrap	= document.getElementById( 'quick-view-inner' );
		content		= document.getElementById( 'quick-view-content' );
		buttonClose = document.getElementById( 'quick-view-close' );

		if( ! button || ! container ) {
			return;
		}

		var loader = function() {
			var div = document.createElement('div');
			div.innerHTML = '<p>x</p>' + Balticl10n.loader;
			return div.childNodes[1];
		};

		var quickViewEvent = function( e ) {

			e.preventDefault();

			var product_id = this.getAttribute( 'data-product_id' );

			content.innerHTML = '';

			baltic.body.classList.add( 'overflow-hidden' );
			container.classList.remove( 'hide' );
			container.classList.add( 'show' );
			container.setAttribute( 'tabindex', '-1' );
			container.focus();

			container.append( loader() );

			baltic.ajax( Balticl10n.ajaxUrl + '&action=quick_view_product&product_id=' + product_id, function( data ) {

				if( data ) {

					var spinner = container.getElementsByClassName('spinner')[0];
					spinner.parentNode.removeChild(spinner);

					innerWrap.classList.add('show');
					content.innerHTML = data;

					var $quickViewContent 	= $( '#quick-view-content'),
						form_variation 		= $quickViewContent.find( '.variations_form' ),
						product_gallery 	= $quickViewContent.find( '.woocommerce-product-gallery' );

					form_variation.wc_variation_form();
					form_variation.trigger( 'check_variations' );

					product_gallery.each( function() {
						self = $(this);
						self.wc_product_gallery();
						self.trigger( 'woocommerce_gallery_reset_slide_position' );
					});

				}

			});

		};

		for ( i = 0; i < button.length; i++ ) {
			button[i].addEventListener( 'click', quickViewEvent, false );
		}

		var closeQuickView = function() {
			baltic.body.classList.remove('overflow-hidden');
			container.classList.remove('show');
			container.classList.add('hide');
			innerWrap.classList.remove('show');
		};

		container.addEventListener( 'click', function( e ) {

			if( ! e.target.closest('#quick-view-content') ) {
				closeQuickView();
			}

		}, false );

		this.document.addEventListener( 'keyup', function( e ) {

		    if ( e.defaultPrevented ) {
		        return;
		    }

		    var key = e.key || e.keyCode;

		    if ( key === 'Escape' || key === 'Esc' || key === 27 ) {
		        closeQuickView();
		    }

		}, false );

	};

	baltic.skipTop = function() {

		var skipTopEl = document.getElementById('skip-to-top');

		if( skipTopEl ) {
			var applySkipTop = function() {
			    if ( window.pageYOffset > 142 ) {
			        skipTopEl.classList.add( 'on' );
			    } else {
			        skipTopEl.classList.remove( 'on' );
			    }
			};

			applySkipTop();

			window.addEventListener( 'scroll', applySkipTop, false );

		    skipTopEl.addEventListener( 'click', function( e ) {
		    	e.preventDefault();
		        smoothScroll.scrollTo( this.getAttribute('href'), 500 );
		    });
		}

	};

	document.addEventListener( 'DOMContentLoaded', function() {

		baltic.init();

		fitvids( '#page', {
			players: ['iframe[src*="https://videopress.com"]']
		});

		if ( typeof cssVars === 'function' ) {
			cssVars({
				include : 'link[rel=stylesheet],style',
				onlyVars : true
			});
		}


	});

	$( window ).on( 'load added_to_wishlist removed_from_wishlist added_to_cart', function() {
		baltic.wishListCount();
		baltic.wishListTable();
	});

	$( document.body ).on( 'post-load', function() {
		baltic.quickView();
		baltic.wishListLoader();
	});

})( jQuery );
