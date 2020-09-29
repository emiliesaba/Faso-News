/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
/* global balticFontFamilies */
( function( $, api ) {

	var	html 	= document.getElementsByTagName('html')[0],
	 	$body 	= $( 'body' );

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

    api('header_image', function(value) {
        value.bind(function(to) {
            $('#masthead').css('background-image', 'url(' + to + ')');
        });
    });

	var colors = [
		'color__selection-background',
		'color__selection-text',
		'color__preloader',
		'color__preloader-background',
		'color__text-primary',
		'color__text-secondary',
		'color__code',
		'color__mark',
		'color__mark-background',
		'color__blockquote',
		'color__pre',
		'color__pre-background',
		'color__hr',
		'color__link',
		'color__link-hover',
		'color__input',
		'color__input-focus',
		'color__input-border',
		'color__input-border-focus',
		'color__input-text',
		'color__input-text-focus',
		'color__input-placeholder',
		'color__button',
		'color__button-hover',
		'color__button-border',
		'color__button-border-hover',
		'color__button-text',
		'color__button-text-hover',
		'color__container',
		'color__sticky',
		'color__border',
		'color__header-text',
		'color__header-background',
		'color__header-input',
		'color__header-input-focus',
		'color__header-input-border',
		'color__header-input-border-focus',
		'color__header-textfield',
		'color__header-textfield-focus',
		'color__header-btn',
		'color__header-btn-hover',
		'color__header-btn-icon',
		'color__header-btn-icon-hover',
		'color__footer-background',
		'color__footer-title',
		'color__footer-text',
		'color__footer-link',
		'color__footer-link-hover',
		'color__submenu-background',
		'color__submenu-text',
		'color__info',
		'color__success',
		'color__error',
		'color__price',
		'color__sale',
		'color__sale-text',
		'color__stars',
		'color__quick-view-overlay',
		'color__notice-background',
		'color__notice-text',
		'color__notice-link',
		'color__notice-link-hover'
	];

	$.each( colors, function( i, val ) {

		api( val, function( value ) {
			value.bind( function( to ) {
				if( to.length !== 0 ) {
					html.style.setProperty( '--'+ val , to );
				}
			} );
		} );

	});

	api( 'main__family', function( value ) {
		value.bind( function( to ) {

			var googleFonts 	= balticFontFamilies.google,
				standardFonts 	= balticFontFamilies.system;

			if( to.length !== 0 ) {

				if( typeof googleFonts[to] !== 'undefined' ) {
					var script 	= '<script>if(!_.isUndefined(WebFont)){WebFont.load({google:{families:["'+ to +':cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai"]}});}</script>';
					$(script).appendTo('head');
					html.style.setProperty('--main__family', to );
				} else if( typeof standardFonts[to] !== 'undefined' ) {
					if( 'System' === to ) {
						html.style.setProperty('--main__family', standardFonts[to].fallback );
					} else {
						html.style.setProperty('--main__family', to );
					}
				} else if( 'inherit' === to ) {
					html.style.setProperty('--main__family', 'inherit' );
				}

			}


		} );
	} );

	api( 'main__weight', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--main__weight' , to );
			}
		} );
	} );

	api( 'main__transform', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--main__transform' , to );
			}
		} );
	} );

	api( 'main__line-height', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--main__line-height' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

	api( 'main__size', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--main__size-px' , ( to.desktop * 16 ) * 1 + 'px' );
				html.style.setProperty( '--main__size' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

	api( 'heading__family', function( value ) {
		value.bind( function( to ) {

			var googleFonts 	= balticFontFamilies.google,
				standardFonts 	= balticFontFamilies.system;

				if( to.length !== 0 ) {

				if( typeof googleFonts.to !== 'undefined' ) {
					var script 	= '<script>if(!_.isUndefined(WebFont)){WebFont.load({google:{families:["'+ to +':cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai"]}});}</script>';
					$(script).appendTo('head');
					html.style.setProperty('--heading__family', to );
				} else if( typeof standardFonts[to] !== 'undefined' ) {
					if( 'System' === to ) {
						html.style.setProperty('--heading__family', standardFonts.to.fallback );
					} else {
						html.style.setProperty('--heading__family', to );
					}
				} else if( 'inherit' === to ) {
					html.style.setProperty('--heading__family', 'inherit' );
				}

			}

		} );
	} );

	api( 'heading__weight', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--heading__weight' , to );
			}
		} );
	} );

	api( 'heading__transform', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--heading__transform' , to );
			}
		} );
	} );

	api( 'heading__line-height', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--heading__line-height' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

	var headingSize = [
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6'
	];

	$.each( headingSize, function( i, val ) {

		api( val +'__size', function( value ) {
			value.bind( function( to ) {
				if( to.length !== 0 ) {
					html.style.setProperty( '--'+ val +'__size-px' , ( to.desktop * 16 ) * 1 + 'px' );
					html.style.setProperty( '--'+ val +'__size' , to.desktop + to['desktop-unit'] );
				}
			} );
		} );

	});

	api( 'blockquote__family', function( value ) {
		value.bind( function( to ) {

			var googleFonts 	= balticFontFamilies.google,
				standardFonts 	= balticFontFamilies.system;

			if( to.length !== 0 ) {

				if( typeof googleFonts[to] !== 'undefined' ) {
					var script 	= '<script>if(!_.isUndefined(WebFont)){WebFont.load({google:{families:["'+ to +':cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai"]}});}</script>';
					$(script).appendTo('head');
					html.style.setProperty('--blockquote__family', to );
				} else if( typeof standardFonts[to] !== 'undefined' ) {
					if( 'System' === to ) {
						html.style.setProperty('--blockquote__family', standardFonts[to].fallback );
					} else {
						html.style.setProperty('--blockquote__family', to );
					}
				} else if( 'inherit' === to ) {
					html.style.setProperty('--blockquote__family', 'inherit' );
				}

			}


		} );
	} );

	api( 'blockquote__weight', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--blockquote__weight' , to );
			}
		} );
	} );

	api( 'blockquote__transform', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--blockquote__transform' , to );
			}
		} );
	} );

	api( 'blockquote__line-height', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--blockquote__line-height' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

	api( 'blockquote__size', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--blockquote__size' , ( to.desktop * 16 ) * 1 + 'px' );
				html.style.setProperty( '--blockquote__size' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

	api( 'code__family', function( value ) {
		value.bind( function( to ) {

			var googleFonts 	= balticFontFamilies.google,
				standardFonts 	= balticFontFamilies.system;

			if( to.length !== 0 ) {

				if( typeof googleFonts[to] !== 'undefined' ) {
					var script 	= '<script>if(!_.isUndefined(WebFont)){WebFont.load({google:{families:["'+ to +':cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai"]}});}</script>';
					$(script).appendTo('head');
					html.style.setProperty('--code__family', to );
				} else if( typeof standardFonts[to] !== 'undefined' ) {
					if( 'System' === to ) {
						html.style.setProperty('--code__family', standardFonts[to].fallback );
					} else {
						html.style.setProperty('--code__family', to );
					}
				} else if( 'inherit' === to ) {
					html.style.setProperty('--code__family', 'inherit' );
				}

			}


		} );
	} );

	api( 'code__weight', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--code__weight' , to );
			}
		} );
	} );

	api( 'code__transform', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--code__transform' , to );
			}
		} );
	} );

	api( 'code__line-height', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--code__line-height' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

	api( 'code__size', function( value ) {
		value.bind( function( to ) {
			if( to.length !== 0 ) {
				html.style.setProperty( '--code__size' , ( to.desktop * 16 ) * 1 + 'px' );
				html.style.setProperty( '--code__size' , to.desktop + to['desktop-unit'] );
			}
		} );
	} );

    api('preloader_preview', function(value) {
        value.bind(function(to) {
        	var $preloader = $('#site-preloader');
            if (to === true) {
                $preloader.css({
                    'display': 'block'
                }).removeClass('hide');
                $('.js .preloader-enabled').css({
                    'overflow': 'hidden'
                });
            } else {
                $preloader.css({
                    'display': 'none'
                }).toggleClass('hide');
            }
        });
    });

	api( 'site__layout', function( value ) {
		value.bind( function( to ) {

			if( to === 'boxed-layout' ) {
				$body.toggleClass( 'boxed-layout' );
				$body.removeClass( 'full-layout' );
			} else if ( to === 'full-layout' ) {
				$body.toggleClass( 'full-layout' );
				$body.removeClass( 'boxed-layout' );
			}

		} );
	} );

	var layouts = [
		'layout__archive',
		'layout__attachment',
		'layout__page',
		'layout__single'
	];

	$.each( layouts, function( i, val ) {

        var selector 	= val.replace( 'layout__', '' ),
        	bodyEl 		= ( ( selector === 'archive') ? $('body.archive, body.blog' ) : $('body.' + selector ) ),
            secondaryEl = $('#secondary');

        var resetLayout = function( $layout ) {
            bodyEl.removeClass('content-sidebar');
            bodyEl.removeClass('sidebar-content');
            bodyEl.removeClass('full-width');
            bodyEl.removeClass('narrow');
            bodyEl.addClass($layout);
        };

        var showHideSidebar = function() {
            if( $body.hasClass('content-sidebar') || $body.hasClass('sidebar-content') ) {
            	secondaryEl.show();
            }
            if( $body.hasClass('full-width') || $body.hasClass('narrow') ) {
            	secondaryEl.hide();
            }
        };

		showHideSidebar();

	    api( val, function(value) {

	        value.bind(function(to) {

	            if ( to === 'content-sidebar' ) {
	            	resetLayout('content-sidebar');
	                showHideSidebar();
	            } else if ( to === 'sidebar-content' ) {
					resetLayout('sidebar-content');
	                showHideSidebar();
	            } else if ( to === 'full-width' ) {
	            	resetLayout('full-width');
	                showHideSidebar();
	            } else if ( to === 'narrow') {
					resetLayout('narrow');
	                showHideSidebar();
	            }

	        });
		});
	});

	var breadcrumbs = [
		'breadcrumb__archive',
		'breadcrumb__attachment',
		'breadcrumb__page',
		'breadcrumb__single'
	];

	$.each( breadcrumbs, function( i, val ) {

        var selector 	= val.replace( 'breadcrumb__', '' ),
        	bodyEl 		= ( ( selector === 'archive') ? $('body.archive, body.blog' ) : $('body.' + selector ) ),
	    	$breadcrumb = bodyEl.find( '.breadcrumb, .breadcrumbs' );

	    api( val, function(value) {

	        value.bind(function(to) {
	        	if( true === to ) {
	        		$breadcrumb.show();
	        	} else {
					$breadcrumb.hide();
	        	}
	        });
		});

	});

    api( 'breadcrumb__archive', function(value) {
        value.bind(function(to) {
        	var $metaAuthor = $('span.byline');
            if (true === to) {
                $metaAuthor.css({
                    'display': 'inline-block'
                });
            } else {
                $metaAuthor.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'meta__date', function(value) {
        value.bind(function(to) {
        	var $metaDate = $('span.posted-on');
            if (true === to) {
                $metaDate.css({
                    'display': 'inline-block'
                });
            } else {
                $metaDate.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'meta__author', function(value) {
        value.bind(function(to) {
        	var $metaAuthor = $('span.byline');
            if (true === to) {
                $metaAuthor.css({
                    'display': 'inline-block'
                });
            } else {
                $metaAuthor.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'meta__categories', function(value) {
        value.bind(function(to) {
        	var $metaCats = $('span.cat-links');
            if (true === to) {
                $metaCats.css({
                    'display': 'inline-block'
                });
            } else {
                $metaCats.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'meta__tags', function(value) {
        value.bind(function(to) {
        	var $metaTags = $('span.tags-links');
            if (true === to) {
                $metaTags.css({
                    'display': 'inline-block'
                });
            } else {
                $metaTags.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'meta__comment', function(value) {
        value.bind(function(to) {
        	var $commentsLink =  $('span.comments-link');
            if (true === to) {
                $commentsLink.css({
                    'display': 'inline-block'
                });
            } else {
                $commentsLink.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'author_profile', function(value) {
        value.bind(function(to) {
        	var $authorInfo = $('div.author-info');
            if (true === to) {
                $authorInfo.css({
                    'display': 'block'
                });
            } else {
                $authorInfo.css({
                    'display': 'none'
                });
            }
        });
    });

    api( 'more_link_text', function(value) {
        value.bind(function(to) {
        	if( to.length !== 0 ) {
        		var container 	= $('#content'),
        			moreLink 	= container.find('.more-link-text');

        		moreLink.text(to);
        	}
        });
    });

    api('footer__credits', function(value) {
        value.bind(function(to) {
        	var $siteDesigner = $('#site-designer');
            if (true === to) {
                $siteDesigner.css({
                    'display': 'block'
                });
            } else {
                $siteDesigner.css({
                    'display': 'none'
                });
            }
        });
    });

    api('return_top', function(value) {
        value.bind(function(to) {
            if (true === to) {
                $('#skip-to-top').css({
                    'display': 'block'
                });
            } else {
                $('#skip-to-top').css({
                    'display': 'none'
                });
            }
        });
    });

} )( jQuery, wp.customize );
