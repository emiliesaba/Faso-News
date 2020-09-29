( function( api ) {

	// Extends our custom "tijarat-business" section.
	api.sectionConstructor['tijarat-business'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );