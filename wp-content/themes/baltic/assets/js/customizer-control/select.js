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
