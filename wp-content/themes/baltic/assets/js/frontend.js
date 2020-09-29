(function (window) {
    'use strict';

    var document = window.document;
    var body = document.body;
    var rootElement = document.documentElement;
    var requestAnimationFrame =
        window.requestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        function (func) {
            window.setTimeout(func, 15);
        };
    var clock = '';
    var time = 500;
    var context = window;
    var start = context.scrollTop || window.pageYOffset;
    var end = 0;

    /**
     * easeInOutCubic
     * @param {number} t
     * @return {number}
     */
    var easeInOutCubic = function(t) {
        return t < 0.5 ? 4 * t * t * t :
            (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
    };

    /**
     * getTargetTop
     * @param {number|string} target
     * @return {number|boolean}
     */
    var getTargetTop = function(target) {
        var targetElement = {};

        if (typeof target === 'number') {
            return target;
        } else if (typeof target === 'string') {
            targetElement = document.querySelector(target);

            if (!targetElement) {
                return false;
            }

            return targetElement.getBoundingClientRect().top + window.pageYOffset;
        }

        return false;
    };

    /**
     * getScrollTop
     * @param {number} startV
     * @param {number} endV
     * @param {number} elapsed
     * @param {number} duration
     * @return {number}
     */
    var getScrollTop = function(startV, endV, elapsed, duration) {
        if (elapsed > duration) {
            return endV;
        }

        return startV + (end - startV) * easeInOutCubic(elapsed / duration);
    };

    /**
     * getScrollPageBottom
     * @return {number}
     */
    var getScrollPageBottom = function() {
        var contentHeight = Math.max.apply(null, [body.clientHeight, body.scrollHeight, rootElement.scrollHeight, rootElement.clientHeight]);

        return contentHeight - window.innerHeight;
    };

    /**
     * scrollFrame
     * @return {number}
     */
    var scrollFrame = function() {
        var elapsed = Date.now() - clock;

        if (context === window) {
            window.scroll(0, getScrollTop(start, end, elapsed, time));
        } else {
            context.scrollTop = getScrollTop(start, end, elapsed, time);
        }

        if (elapsed <= time) {
            requestAnimationFrame(scrollFrame);
        }
    };

    var SmoothScroll = function SmoothScroll() {};

    SmoothScroll.prototype = {
        /**
         * scrollTo
         * @param {string|number} target
         * @param {number} duration
         * @param {object} root
         */
        scrollTo: function(target, duration, root) {
            clock = Date.now();
            time = duration || 500;
            context = root || window;
            start = context.scrollTop || window.pageYOffset;
            end = getTargetTop(target);

            scrollFrame();
        },

        /**
         * scrollTop
         * @param {number} duration
         * @param {object} root
         */
        scrollTop: function (duration, root) {
            this.scrollTo(0, duration, root);
        },

        /**
         * scrollBottom
         * @param {number} duration
         * @param {object} root
         */
        scrollBottom: function (duration, root) {
            this.scrollTo(getScrollPageBottom(), duration, root);
        }
    };

    window.smoothScroll = new SmoothScroll();
}(window));

(function(f){if(typeof exports==="object"&&typeof module!=="undefined"){module.exports=f()}else if(typeof define==="function"&&define.amd){define([],f)}else{var g;if(typeof window!=="undefined"){g=window}else if(typeof global!=="undefined"){g=global}else if(typeof self!=="undefined"){g=self}else{g=this}g.fitvids = f()}})(function(){var define,module,exports;return (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){

'use strict';

var selectors = [
	'iframe[src*="player.vimeo.com"]',
	'iframe[src*="youtube.com"]',
	'iframe[src*="youtube-nocookie.com"]',
	'iframe[src*="kickstarter.com"][src*="video.html"]',
	'object'
];

module.exports = function (parentSelector, opts) {
	parentSelector = parentSelector || 'body';
	opts = opts || {};

	if (isObject(parentSelector)) {
		opts = parentSelector;
		parentSelector = 'body';
	}

	opts.ignore = opts.ignore || '';
	opts.players = opts.players || '';

	var containers = queryAll(parentSelector);
	if (!hasLength(containers)) {
		return;
	}

	var custom = toSelectorArray(opts.players) || [];
	var ignored = toSelectorArray(opts.ignore) || [];
	var selector = selectors
		.filter(notIgnored(ignored))
		.concat(custom)
		.join();

	if (!hasLength(selector)) {
		return;
	}

	containers.forEach(function (container) {
		var videos = queryAll(container, selector);
		videos.forEach(function (video) {
			wrap(video);
		});
	});
};

function queryAll (el, selector) {
	if (typeof el === 'string') {
		selector = el;
		el = document;
	}
	return Array.prototype.slice.call(el.querySelectorAll(selector));
}

function toSelectorArray (input) {
	if (typeof input === 'string') {
		return input.split(',').map(trim).filter(hasLength);
	} else if (isArray(input)) {
		return flatten(input.map(toSelectorArray).filter(hasLength));
	}
	return input || [];
}

function wrap (el) {
	if (/fluid-width-video-wrapper/.test(el.parentNode.className)) {
		return;
	}

	var widthAttr = parseInt(el.getAttribute('width'), 10);
	var heightAttr = parseInt(el.getAttribute('height'), 10);

	var width = !isNaN(widthAttr) ? widthAttr : el.clientWidth;
	var height = !isNaN(heightAttr) ? heightAttr : el.clientHeight;
	var aspect = height / width;

	el.removeAttribute('width');
	el.removeAttribute('height');

	var wrapper = document.createElement('div');
	el.parentNode.insertBefore(wrapper, el);
	wrapper.className = 'fluid-width-video-wrapper';
	wrapper.style.paddingTop = (aspect * 100) + '%';
	wrapper.appendChild(el);
}

function notIgnored (ignored) {
	if (ignored.length < 1) {
		return function () {
			return true;
		};
	}
	return function (selector) {
		return ignored.indexOf(selector) === -1;
	};
}

function hasLength (input) {
	return input.length > 0;
}

function trim (str) {
	return str.replace(/^\s+|\s+$/g, '');
}

function flatten (input) {
	return [].concat.apply([], input);
}

function isObject (input) {
	return Object.prototype.toString.call(input) === '[object Object]';
}

function isArray (input) {
	return Object.prototype.toString.call(input) === '[object Array]';
}

},{}]},{},[1])(1);
});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window && window.innerWidth > 768 ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

	( function( container ) {

		var subMenuToggleEl = container.getElementsByClassName('sub-menu-toggle'), i;

		if( subMenuToggleEl ) {
			for ( i = 0; i < subMenuToggleEl.length; i++ ) {

				subMenuToggleEl[i].addEventListener( 'click', function( e ) {

					e.stopPropagation();
					e.preventDefault();

					var a 		= this.parentElement,
						subMenu = a.nextElementSibling;

					if ( this.classList.contains('toggled') ) {
						this.className = this.className.replace( ' toggled', '' );
						this.setAttribute( 'aria-expanded', 'false' );
						subMenu.style.display = 'none';
					} else {
						this.className += ' toggled';
						this.setAttribute( 'aria-expanded', 'true' );
						subMenu.style.display = 'block';
					}

				}, false );

			}
		}

	}( container ) );

	( function( container ) {

		var headerMenuToggleEl = document.getElementById('header-menu-toggle');

		if( headerMenuToggleEl ) {
			headerMenuToggleEl.addEventListener( 'click', function( e ) {

				e.preventDefault();

				if ( this.classList.contains('toggled') ) {
					this.className = this.className.replace( ' toggled', '' );
					this.setAttribute( 'aria-expanded', 'false' );
					container.className = container.className.replace( ' show', '' );
				} else {
					this.className += ' toggled';
					this.setAttribute( 'aria-expanded', 'true' );
					container.className += ' show';
				}

			}, false );
		}

	}( container ) );

} )();

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
