
function displayErrorMessage () {
	$( ".js_error_content" ).fadeIn( 400, function () {
		$( ".js_loading_indicator" ).fadeOut();
	} );
}

/*
 *
 * Render the accommodation details
 *
 */
$( function () {

	// Once the pricing data has been fetched and prepped
	window.__BFS.fetchPricingInformation.then( function () {

		var accomodationSelection = window.__BFS.accomodationSelection;
		var accomodationType = accomodationSelection.type.toLowerCase();
		var livingSituation = window.__BFS.livingSituations[ accomodationType ];
		if ( ! livingSituation )
			throw new Error;
		// Set the accommodation settings
		for ( var key in accomodationSelection )
			livingSituation.setField( key, accomodationSelection[ key ] );

		// Compute the details
		livingSituation.computeDetails();
		// Render the content
		window.__BFS.setContentOnWhatIsIncludedSection( accomodationType );

		// Set the data-attributes for the "Book Now" button
		$( ".js_book" )
			.data( "product", accomodationSelection.type )
			.data( "c", "pricing-book-" + accomodationType )


		// Fade in the content
		setTimeout( function () {
			// If there's an error, show the error message
			if ( livingSituation.monthlyFee.trim() ) {
				$( ".js_main_content" ).fadeIn( 400, function () {
					$( ".js_loading_indicator" ).fadeOut();
				} );
			}
			// Else, show the main content
			else
				displayErrorMessage();
		}, 300 );
	} )
	.catch( displayErrorMessage )

} );
