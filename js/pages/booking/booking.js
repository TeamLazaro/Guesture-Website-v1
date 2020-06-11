
function getDateComponents ( date ) {
	var year = date.getFullYear()
	var month = ( date.getMonth() + 1 ).toString().padStart( 2, "0" );
	var day = ( date.getDate() ).toString().padStart( 2, "0" );
	return {
		year: year,
		month: month,
		day: day
	}
}

function getDateString ( date ) {
	var dateComponents = getDateComponents( date );
	var dateString = dateComponents.day + "/" + dateComponents.month + "/" + dateComponents.year;
	return dateString;
}


/*
 *
 * Check availability for given unit and time frame
 *
 */
function checkAvailability ( unitDetails, fromDate, duration ) {

	var toDate = new Date( fromDate.getTime() + ( duration * 24 * 60 * 60 * 1000 ) );

	var fromDateString = getDateString( fromDate );
	var toDateString = getDateString( toDate );

	var apiEndpoint = "/server/api/unit-availability.php";

	var data = unitDetails;
	data.duration = duration;
	data.fromDateString = fromDateString;
	data.toDateString = toDateString;

	if ( fromDateString === "19/06/2020" )
		return Promise.resolve( { success: true } );
	else if ( fromDateString === "27/06/2020" )
		return Promise.resolve( { success: false } );

	// let unitIsAvailable = Math.round( Math.random() );
	// if ( unitIsAvailable )
	// 	return Promise.resolve( { success: true } );
	// else
	// 	return Promise.resolve( { success: false } );

	var ajaxRequest = $.ajax( {
		url: apiEndpoint,
		method: "POST",
		data: data
		// contentType: "application/json",
		// dataType: "json",
		// xhrFields: {
		// 	withCredentials: true
		// }
	} );

	return new Promise( function ( resolve, reject ) {
		ajaxRequest.done( function ( response ) {
			resolve( response );
		} );
		ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
			var errorResponse = utils.getErrorResponse( jqXHR, textStatus, e );
			reject( errorResponse );
		} );
	} );

}

function checkAvailabilityHandler ( livingSituation, date ) {

	var unitDetails = {
		type: livingSituation.type,
		location: livingSituation.location,
		balcony: livingSituation.balcony,
		bathroom: livingSituation.bathroom
	};

	var durationInMonths = parseInt( livingSituation.duration, 10 );

	// Disable the date picker
	$( ".js_booking_from_date" ).prop( "disabled", true );
	// Disable the "Book Now" button
	var $bookNowButton = $( ".js_booking_form [ type = 'submit' ]" );
	disableForm( $bookNowButton.closest( "form" ), $bookNowButton.data( "checkingText" ) );

	return checkAvailability( unitDetails, date, durationInMonths )
		.then( function ( response ) {
			// Re-enable the form
			enableForm( $bookNowButton.closest( "form" ) );
			// Disable / Enable the "Book Now" button
			if ( response.success ) {
				livingSituation.fromDateString = getDateString( date );
				window.__BFS.bookingFromDate = livingSituation.fromDateString;
				var toDate = new Date( date.getTime() + durationInMonths * 30 * 24 * 60 * 60 * 1000 );
				livingSituation.toDateString = getDateString( toDate );
				$bookNowButton
					.prop( "disabled", false )
					.text( $bookNowButton.data( "initialText" ) )
					// .css( { backgroundColor: "" } )
			}
			else {
				livingSituation.fromDateString = null;
				window.__BFS.bookingFromDate = null;
				livingSituation.toDateString = null;
				$bookNowButton
					.prop( "disabled", true )
					.text( $bookNowButton.data( "unavailableText" ) )
					// .css( { backgroundColor: "var(--neutral-5)" } )
			}
		} )
		.catch( function () {
			// Re-enable the date picker
			$( ".js_booking_from_date" ).prop( "disabled", false );
		} )
}


$( function () {
	window.__BFS.fetchPricingInformation.then( function () {


		var accomodationSelection = window.__BFS.accomodationSelection;
		var accomodationType = accomodationSelection.type.toLowerCase();
		var livingSituation = window.__BFS.livingSituations[ accomodationType ];

		/*
		 *
		 * Form Date Picker
		 *
		 */
		var fromDatePicker = datepicker( ".js_booking_from_date", {
			disableMobile: true,
			formatter: function ( input, date, instance ) {
				var dateComponents = getDateComponents( date );
				var year = dateComponents.year;
				var month = dateComponents.month;
				var day = dateComponents.day;
				var formattedDateString = year + "-" + month + "-" + day;
				input.value = formattedDateString;
			},
			onSelect: function ( instance, date ) {
				if ( ! ( date instanceof Date ) ) {
					instance.el.value = "";
					var $bookNowButton = $( ".js_booking_form [ type = 'submit' ]" );
					$bookNowButton
						.prop( "disabled", true )
						.text( $bookNowButton.data( "disabledText" ) )
						.css( { backgroundColor: "" } )
					return;
				}
				setTimeout( function () {
					instance.hide();
					instance.el.blur();
				}, 100 );
				checkAvailabilityHandler( livingSituation, date );
			},
		} );


		/*
		 *
		 * When the "From" date is selected (on the browser native date picker)
		 *
		 */
		$( document ).on( "input", ".js_booking_from_date", function ( event ) {
			var dateString = event.target.value;
			if ( dateString.trim() === "" )
				return;

			var dateParts = dateString.split( /\D/ );
			var date = new Date( dateParts[ 0 ], --dateParts[ 1 ], dateParts[ 2 ] );

			// Manually set the date on the date widget and initiate the selection flow
			fromDatePicker.setDate( date );
			fromDatePicker.hide();
			fromDatePicker.onSelect( fromDatePicker, date );
		} );


	} );
} );



/*
 *
 * Booking Form
 *
 */
// On submission of the form
$( document ).on( "submit", ".js_booking_form", function ( event ) {

	/* -----
	 * Prevent the default form submission behaviour
	 * 	which triggers the loading of a new page
	 ----- */
	event.preventDefault();

	var $form = $( event.target );


	// /* -----
	//  * Disable the form
	//  ----- */
	var $submitButton = $form.find( "[ type = 'submit' ]" );
	disableForm( $form, $submitButton.data( "processingText" ) );


	// /* -----
	//  * Pull the data from the form
	//  ----- */
	var formData;
	try {
		formData = getFormData( $form, {
			name: { type: "name", $: "[ name = 'name' ]" },
			emailAddress: { type: "email address", $: "[ name = 'email-address' ]" }
		} );
	}
	catch ( e ) {
		// Reflect back sanitized values to the form
		setFormData( $form, e );
		e.forEach( function ( issue ) {
			$( issue.$ ).addClass( "js_error" );
		} );
		// Report an error message
		var message = e.reduce( function ( message, issue ) {
			return message + "\n"
				+ ( issue.type[ 0 ].toUpperCase() + issue.type.slice( 1 ) );
		}, "" );
		message = "Please provide valid information for the following fields:" + message;
		alert( message );
		enableForm( $form, $submitButton.data( "initialText" ) );
		return;
	}
	// Reflect back sanitized values to the form
	setFormData( $form, formData );
	// Remove any prior error "markings"
	$form.find( ".js_error" ).removeClass( "js_error" );


	/* -----
	 * Process and Assemble the data
	 ----- */
	var __ = window.__CUPID;
	// Get the data in an key-value structure
	var data = formData.reduce( function ( acc, f ) {
		acc[ f.name ] = f.value;
		return acc;
	}, { } );
	__.user.name = data.name;
	__.user.emailAddress = data.emailAddress;


	// /* -----
	//  * Update the person's information
	//  ----- */
	// __.user.update();


	/*
	 * Initiate the payment flow
	 */
	var transactionData = {
		phoneNumber: __.user.phoneNumber,
		name: __.user.name,
		emailAddress: __.user.emailAddress,
		amount: 1199,
		fromDate: window.__BFS.bookingFromDate,
		unitInfoString: ( new URLSearchParams( location.search ) ).get( "q" )
	};
	getPaymentTransactionParameters( transactionData )
		.then( makeSynchronousPOSTRequest )

} );


function getPaymentTransactionParameters ( data ) {

	var url = "/server/get-paytm-transaction-params.php";

	var ajaxRequest = $.ajax( {
		url: url,
		method: "POST",
		data: data,
		dataType: "json",
		// xhrFields: {
		// 	withCredentials: true
		// }
	} );

	return new Promise( function ( resolve, reject ) {
		ajaxRequest.done( function ( response ) {
			resolve( response );
		} );
		ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
			var errorResponse = __.utils.getErrorResponse( jqXHR, textStatus, e );
			reject( errorResponse );
		} );
	} );

}

function makeSynchronousPOSTRequest ( parameters ) {
	var formMarkup = "<form method=\"POST\" action=\"https://securegw-stage.paytm.in/order/process\" name=\"post_form\">";
	var key;
	for ( key in parameters )
		formMarkup += "<input type=\"hidden\" name=\"" + key + "\" value=\"" + parameters[ key ] + "\">";
	formMarkup += "</form>";
	$form = $( formMarkup );
	$( document.body ).append( $form );
	$form.get( 0 ).submit();
}
