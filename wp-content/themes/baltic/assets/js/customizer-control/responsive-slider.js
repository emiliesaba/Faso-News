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
