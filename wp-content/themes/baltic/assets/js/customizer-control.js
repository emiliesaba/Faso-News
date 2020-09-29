( function( $, api ) {

	$(window).on('load', function() {
	  	$('html').addClass('colorpicker-ready');
	});

	api.controlConstructor['baltic-color'] = api.Control.extend({

		ready: function() {

			var control = this,
				value,
				thisInput,
				inputDefault,
				changeAction;

			this.container.find('.baltic-color-picker-alpha' ).wpColorPicker({
				/**
			     * @param {Event} event - standard $ event, produced by whichever
			     * control was changed.
			     * @param {Object} ui - standard $ UI object, with a color member
			     * containing a Color.js object.
			     */
			    change: function (event, ui) {
			        var element = event.target;
			        var color = ui.color.toString();

			        if ( $('html').hasClass('colorpicker-ready') ) {
						control.setting.set( color );
			        }
			    },

			    /**
			     * @param {Event} event - standard $ event, produced by "Clear"
			     * button.
			     */
			    clear: function (event) {
			        var element = $(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
			        var color = '';

			        if (element) {
			            // Add your code here
			        	control.setting.set( color );
			        }
			    }
			});
		}
	});


})( jQuery, wp.customize );

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

( function( $, api ) {

	api.controlConstructor['baltic-responsive-slider'] = api.Control.extend({

		ready: function() {

			'use strict';

			var control = this,
				value,
				thisInput,
				inputDefault,
				changeAction;

			control.balticResponsiveInit();

			// Update the text value.
			this.container.on( 'input change', 'input[type=range]', function() {
				var value 		 = $( this ).val(),
					input_number = $( this ).closest( '.input-field-wrapper' ).find( '.baltic-responsive-range-value-input' );

				input_number.val( value );
				input_number.trigger( 'change' );
			});

			// Handle the reset button.
			this.container.on('click', '.baltic-responsive-slider-reset', function() {

				var wrapper 		= $( this ).parent().find('.input-field-wrapper.active'),
					input_range   	= wrapper.find( 'input[type=range]' ),
					input_number 	= wrapper.find( '.baltic-responsive-range-value-input' ),
					default_value	= input_range.data( 'reset_value' );

				input_range.val( default_value );
				input_number.val( default_value );
				input_number.trigger( 'change' );
			});

			// Save changes.
			this.container.on( 'input change', 'input[type=number]', function() {
				var value = $( this ).val();
				$( this ).closest( '.input-field-wrapper' ).find( 'input[type=range]' ).val( value );

				control.updateValue();
			});
		},

		/**
		 * Updates the sorting list
		 */
		updateValue: function() {

			'use strict';

			var control = this,
		    newValue = {};

		    // Set the spacing container.
			control.responsiveContainer = control.container.find( '.wrapper' ).first();

			control.responsiveContainer.find( '.baltic-responsive-range-value-input' ).each( function() {
				var responsive_input = $( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;

			});

			control.setting.set( newValue );
		},

		balticResponsiveInit : function() {

			this.container.on( 'click', '.baltic-responsive-slider-btns button', function( event ) {

				event.preventDefault();
				var device = $(this).attr('data-device');
				if( 'desktop' === device ) {
					device = 'tablet';
				} else if( 'tablet' === device ) {
					device = 'mobile';
				} else {
					device = 'desktop';
				}

				$( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
			});
		},
	});

	$(' .wp-full-overlay-footer .devices button ').on('click', function() {

		var device = $(this).attr('data-device');

		$( '.customize-control-baltic-responsive-slider .input-field-wrapper, .customize-control .baltic-responsive-slider-btns > li' ).removeClass( 'active' );
		$( '.customize-control-baltic-responsive-slider .input-field-wrapper.' + device + ', .customize-control .baltic-responsive-slider-btns > li.' + device ).addClass( 'active' );
	});


})( jQuery, wp.customize );

( function( $, api) {

	api.controlConstructor['baltic-responsive-spacing'] = api.Control.extend({

		ready: function() {

			var control = this, value;

		    control.balticResponsiveInit();

			// Set the spacing container.
			// this.container = control.container.find( 'ul.baltic-spacing-wrapper' ).first();

			// Save the value.
			this.container.on( 'change keyup paste', 'input.baltic-spacing-input', function() {

				value = $( this ).val();

				// Update value on change.
				control.updateValue();
			});
		},

		/**
		 * Updates the spacing values
		 */
		updateValue: function() {

			'use strict';

			var control = this,
				newValue = {
					'desktop' 		: {},
					'tablet'  		: {},
					'mobile'  		: {},
					'desktop-unit'	: 'px',
					'tablet-unit'	: 'px',
					'mobile-unit'	: 'px'
				};

			control.container.find( 'input.baltic-spacing-desktop' ).each( function() {
				var spacing_input = $( this ),
				item = spacing_input.data( 'id' ),
				item_value = spacing_input.val();

				newValue['desktop'][item] = item_value;
			});

			control.container.find( 'input.baltic-spacing-tablet' ).each( function() {
				var spacing_input = $( this ),
				item = spacing_input.data( 'id' ),
				item_value = spacing_input.val();

				newValue['tablet'][item] = item_value;
			});

			control.container.find( 'input.baltic-spacing-mobile' ).each( function() {
				var spacing_input = $( this ),
				item = spacing_input.data( 'id' ),
				item_value = spacing_input.val();

				newValue['mobile'][item] = item_value;
			});

			control.container.find('.baltic-spacing-unit-wrapper .baltic-spacing-unit-input').each( function() {
				var spacing_unit 	= $( this ),
					device 			= spacing_unit.attr('data-device'),
					device_val 		= spacing_unit.val(),
					name 			= device + '-unit';

				newValue[ name ] = device_val;
			});

			control.setting.set( newValue );
		},

		/**
		 * Set the responsive devices fields
		 */
		balticResponsiveInit : function() {

			'use strict';

			var control = this;

			control.container.find( '.baltic-spacing-responsive-buttons button' ).on( 'click', function( event ) {

				var device = $(this).attr('data-device');
				if( 'desktop' === device ) {
					device = 'tablet';
				} else if( 'tablet' === device ) {
					device = 'mobile';
				} else {
					device = 'desktop';
				}

				$( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
			});

			// Unit click
			control.container.on( 'click', '.baltic-spacing-responsive-units .single-unit', function() {

				var $this 		= $(this);

				if ( $this.hasClass('active') ) {
					return false;
				}

				var	unit_value 	= $this.attr('data-unit'),
					device 		= $('.wp-full-overlay-footer .devices button.active').attr('data-device');

				$this.siblings().removeClass('active');
				$this.addClass('active');

				control.container.find('.baltic-spacing-unit-wrapper .baltic-spacing-' + device + '-unit').val( unit_value );

				// Update value on change.
				control.updateValue();
			});
		},
	});

	$( document ).ready( function( ) {

		// Connected button
		$( '.baltic-spacing-connected' ).on( 'click', function() {

			// Remove connected class
			$(this).parent().parent( '.baltic-spacing-wrapper' ).find( 'input' ).removeClass( 'connected' ).attr( 'data-element-connect', '' );

			// Remove class
			$(this).parent( '.baltic-spacing-input-item-link' ).removeClass( 'disconnected' );

		} );

		// Disconnected button
		$( '.baltic-spacing-disconnected' ).on( 'click', function() {

			// Set up variables
			var elements 	= $(this).data( 'element-connect' );

			// Add connected class
			$(this).parent().parent( '.baltic-spacing-wrapper' ).find( 'input' ).addClass( 'connected' ).attr( 'data-element-connect', elements );

			// Add class
			$(this).parent( '.baltic-spacing-input-item-link' ).addClass( 'disconnected' );

		} );

		// Values connected inputs
		$( '.baltic-spacing-input-item' ).on( 'input', '.connected', function() {

			var dataElement 	  = $(this).attr( 'data-element-connect' ),
				currentFieldValue = $( this ).val();

			$(this).parent().parent( '.baltic-spacing-wrapper' ).find( '.connected[ data-element-connect="' + dataElement + '" ]' ).each( function( key, value ) {
				$(this).val( currentFieldValue ).change();
			} );

		} );
	});

	$('.wp-full-overlay-footer .devices button ').on('click', function() {

		var device = $(this).attr('data-device');
		$( '.customize-control-baltic-responsive-spacing .input-wrapper .baltic-spacing-wrapper, .customize-control .baltic-spacing-responsive-buttons > li' ).removeClass( 'active' );
		$( '.customize-control-baltic-responsive-spacing .input-wrapper .baltic-spacing-wrapper.' + device + ', .customize-control .baltic-spacing-responsive-buttons > li.' + device ).addClass( 'active' );

	});

})( jQuery, wp.customize );

( function( $, api ) {

	wp.customize.controlConstructor['baltic-responsive-units'] = wp.customize.Control.extend({

		// When we're finished loading continue processing.
		ready: function() {

			'use strict';

			var control = this,
		    value;

			control.balticResponsiveInit();

			/**
			 * Save on change / keyup / paste
			 */
			this.container.on( 'change keyup paste', 'input.baltic-responsive-input, select.baltic-responsive-select', function() {

				value = jQuery( this ).val();

				// Update value on change.
				control.updateValue();
			});

			/**
			 * Refresh preview frame on blur
			 */
			this.container.on( 'blur', 'input', function() {

				value = jQuery( this ).val() || '';

				if ( value == '' ) {
					wp.customize.previewer.refresh();
				}

			});

		},

		/**
		 * Updates the sorting list
		 */
		updateValue: function() {

			'use strict';

			var control = this,
		    newValue = {};

		    // Set the spacing container.
			control.responsiveContainer = control.container.find( '.baltic-responsive-wrapper' ).first();

			control.responsiveContainer.find( 'input.baltic-responsive-input' ).each( function() {
				var responsive_input = jQuery( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;

			});

			control.responsiveContainer.find( 'select.baltic-responsive-select' ).each( function() {
				var responsive_input = jQuery( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;
			});

			control.setting.set( newValue );
		},

		balticResponsiveInit : function() {

			'use strict';
			this.container.find( '.baltic-responsive-buttons button' ).on( 'click', function( event ) {

				var device = jQuery(this).attr('data-device');
				if( 'desktop' == device ) {
					device = 'tablet';
				} else if( 'tablet' == device ) {
					device = 'mobile';
				} else {
					device = 'desktop';
				}

				jQuery( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
			});
		},
	});

	jQuery(' .wp-full-overlay-footer .devices button ').on('click', function() {

		var device = jQuery(this).attr('data-device');

		jQuery( '.customize-control-baltic-responsive .input-wrapper input, .customize-control .baltic-responsive-btns > li' ).removeClass( 'active' );
		jQuery( '.customize-control-baltic-responsive .input-wrapper input.' + device + ', .customize-control .baltic-responsive-btns > li.' + device ).addClass( 'active' );
	});


})( jQuery, wp.customize );


( function( $, api) {

	api.controlConstructor['baltic-select'] = api.Control.extend({

		ready: function() {

			'use strict';

			var control  = this,
			    element  = this.container.find( 'select' ),
			    multiple = parseInt( element.data( 'multiple' ) ),
			    selectValue;

				$( element ).selectWoo();

			// Change value
			this.container.on( 'change', 'select', function() {

				selectValue = $( this ).val();

				// If this is a multi-select, then we need to convert the value to an object.
				if ( multiple > 1 ) {
					selectValue = _.extend( {}, $( this ).val() );
				}

				control.setting.set( selectValue );

			});

		}

	});

})( jQuery, wp.customize );

( function( $, api ) {

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since 1.0.0
	 * @class balticTypography
	 */
	balticTypography = {

		/**
		 * Initializes our custom logic for the Customizer.
		 *
		 * @since 1.0.0
		 * @method init
		 */
		init: function() {
			balticTypography._initFonts();
		},

		/**
		 * Initializes logic for font controls.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _initFonts
		 */
		_initFonts: function()
		{
			$( '.customize-control-baltic-font-family select' ).each( balticTypography._initFont );
		},

		/**
		 * Initializes logic for a single font control.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _initFont
		 */
		_initFont: function()
		{
			var select  = $( this ),
			link    = select.data( 'customize-setting-link' ),
			weight  = select.data( 'connected-control' );

			if ( 'undefined' != typeof weight ) {
				api( link ).bind( balticTypography._fontSelectChange );
				balticTypography._setFontWeightOptions.apply( api( link ), [ true ] );
			}

			select.selectWoo();
		},

		/**
		 * Callback for when a font control changes.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _fontSelectChange
		 */
		_fontSelectChange: function()
		{
			balticTypography._setFontWeightOptions.apply( this, [ false ] );
		},

		/**
		 * Clean font name.
		 *
		 * Google Fonts are saved as {'Font Name', Category}. This function cleanes this up to retreive only the {Font Name}.
		 *
		 * @since  1.3.0
		 * @param  {String} fontValue Name of the font.
		 *
		 * @return {String}  Font name where commas and inverted commas are removed if the font is a Google Font.
		 */
		_cleanGoogleFonts: function(fontValue)
		{
			// Bail if fontVAlue does not contain a comma.
			if ( ! fontValue.includes(',') ) return fontValue;

			var splitFont 	= fontValue.split(',');
			var pattern 	= new RegExp("'", 'gi');

			// Check if the cleaned font exists in the Google fonts array.
			var googleFontValue = splitFont[0].replace(pattern, '');
			if ( 'undefined' != typeof balticFontFamilies.google[ googleFontValue ] ) {
				fontValue = googleFontValue;
			}

			return fontValue;
		},

		/**
		 * Sets the options for a font weight control when a
		 * font family control changes.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _setFontWeightOptions
		 * @param {Boolean} init Whether or not we're initializing this font weight control.
		 */
		_setFontWeightOptions: function( init )
		{
			var i               = 0,
			fontSelect          = api.control( this.id ).container.find( 'select' ),
			fontValue           = this(),
			selected            = '',
			weightKey           = fontSelect.data( 'connected-control' ),
			inherit             = fontSelect.data( 'inherit' ),
			weightSelect        = api.control( weightKey ).container.find( 'select' ),
			currentWeightTitle  = weightSelect.data( 'inherit' ),
			weightValue         = init ? weightSelect.val() : '400',
			inheritWeightObject = [ 'inherit' ],
			weightObject        = [ '400', '600' ],
			weightOptions       = '',
			weightMap           = balticCustomize;
			if ( fontValue == 'inherit' ) {
				weightValue     = init ? weightSelect.val() : 'inherit';
			}

			var fontValue = balticTypography._cleanGoogleFonts(fontValue);

			if ( fontValue == 'inherit' ) {
				weightObject = [ '400','500','600','700' ];
			} else if ( 'undefined' != typeof balticFontFamilies.system[ fontValue ] ) {
				weightObject = balticFontFamilies.system[ fontValue ].weights;
			} else if ( 'undefined' != typeof balticFontFamilies.google[ fontValue ] ) {
				weightObject = balticFontFamilies.google[ fontValue ][0];
				weightObject = Object.keys(weightObject).map(function(k) {
				  return weightObject[k];
				});
			} else if ( 'undefined' != typeof balticFontFamilies.custom[ fontValue.split(',')[0] ] ) {
				weightObject = balticFontFamilies.custom[ fontValue.split(',')[0] ].weights;
			}

			weightObject = $.merge( inheritWeightObject, weightObject )
			weightMap[ 'inherit' ] = currentWeightTitle;
			for ( ; i < weightObject.length; i++ ) {

				if ( 0 === i && -1 === $.inArray( weightValue, weightObject ) ) {
					weightValue = weightObject[ 0 ];
					selected 	= ' selected="selected"';
				} else {
					selected = weightObject[ i ] == weightValue ? ' selected="selected"' : '';
				}

				weightOptions += '<option value="' + weightObject[ i ] + '"' + selected + '>' + weightMap[ weightObject[ i ] ] + '</option>';
			}

			weightSelect.html( weightOptions );

			if ( ! init ) {
				api( weightKey ).set( '' );
				api( weightKey ).set( weightValue );
			}
		},
	};

	$( function() { balticTypography.init(); } );

})( jQuery, wp.customize );
