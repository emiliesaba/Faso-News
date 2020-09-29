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
