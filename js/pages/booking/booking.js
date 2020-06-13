
$( function () {
	window.__BFS.fetchPricingInformation.then( function () {


		var accomodationSelection = window.__BFS.accomodationSelection;
		var accomodationType = accomodationSelection.type.toLowerCase();
		var livingSituation = window.__BFS.livingSituations[ accomodationType ];


		/*
		 *
		 * Set up the details for the various payment options
		 *
		 */
		var monthlyExpenseAmount = parseInt( livingSituation.perDay.replace( /[^\d]/g, "" ), 10 );
		var securityDepositAmount = monthlyExpenseAmount * 2;
		var securityDepositAmountFormatted = formatNumberToIndianRupee( securityDepositAmount, { symbol: true } );
		$( ".js_price_options [ data-type = 'deposit' ] .js_amount" ).text( "(" + securityDepositAmountFormatted + ")" )
		$( ".js_price_options [ data-type = 'deposit' ] input" ).data( "amount", securityDepositAmount );
		$( ".js_price_options [ data-type = 'booking' ] input" ).trigger( "change" );


		var $fromDate = $( ".js_booking_from_date" );
		window.__BFS.fromDate__Previous = $fromDate.val();

		/*
		 *
		 * Form Date Picker
		 *
		 */
		var fromDatePicker = window.__BFS.fromDatePicker = datepicker( ".js_booking_from_date", {
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
				if ( ! ( date instanceof Date ) )
					instance.el.value = "";
			},
			onHide: function ( instance ) {
				if ( ! ( instance.dateSelected instanceof Date ) )
					return;
				if ( window.__BFS.fromDate__Previous === instance.el.value )
					return;
				checkAvailabilityHandler( livingSituation, instance.dateSelected );
				window.__BFS.fromDate__Previous = instance.el.value;
			}
		} );


		/*
		 *
		 * When the "From" date is selected (on the browser native date picker)
		 *
		 */
		$fromDate.on( "blur", function ( event ) {
			var dateString = event.target.value;
			if ( dateString.trim() === "" )
				return;
			if ( window.__BFS.fromDate__Previous === dateString )
				return;

			var dateParts = dateString.split( /\D/ );
			var date = new Date( dateParts[ 0 ], --dateParts[ 1 ], dateParts[ 2 ] );

			// Manually set the date on the date widget and initiate the selection flow
			fromDatePicker.setDate( date );
			fromDatePicker.hide();
			fromDatePicker.onHide( fromDatePicker );

			window.__BFS.fromDate__Previous = dateString;
		} );


	} );
} );


/*
 * When the payment option changes
 */
$( document ).on( "change", ".js_price_options input", function ( event ) {

	var $option = $( event.target );
	$option.attr( "checked", true );
	var amount = $option.data( "amount" );
	// var description;
	setPayment( amount );

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
	disableForm( $form );
	$submitButton.attr( "data-state", "processing" );


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
		enableForm( $form );
		$submitButton.attr( "data-state", "initial" );
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
		amount: window.__BFS.bookingAmount,
		fromDate: window.__BFS.bookingFromDate,
		toDate: window.__BFS.bookingToDate,
		unitInfoString: ( new URLSearchParams( location.search ) ).get( "q" )
	};
	getPaymentTransactionParameters( transactionData )
		.then( makeSynchronousPOSTRequest )

} );





/*
 *
 * - - - - - - - - - - - - - - - - - -
 * Helper Functions
 * - - - - - - - - - - - - - - - - - -
 *
 */


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

function formatNumberToIndianRupee ( number, options ) {

	options = options || { };
	var formattedNumber;

	var roundedNumber = number.toFixed( 0 );
	var integerAndFractionalParts = ( roundedNumber + "" ).split( "." );
	var integerPart = integerAndFractionalParts[ 0 ];
	var fractionalPart = integerAndFractionalParts[ 1 ];

	var lastThreeDigitsOfIntegerPart = integerPart.slice( -3 );
	var allButLastThreeDigitsOfIntegerPart = integerPart.slice( 0, -3 );

	formattedNumber = allButLastThreeDigitsOfIntegerPart.replace( /\B(?=(\d{2})+(?!\d))/g, "," );

	if ( allButLastThreeDigitsOfIntegerPart ) {
		formattedNumber += ",";
	}
	formattedNumber += lastThreeDigitsOfIntegerPart;

	if ( fractionalPart ) {
		formattedNumber += "." + fractionalPart;
	}

	var symbol = options.symbol === false ? "" : "₹";
	if ( /^-/.test( formattedNumber ) ) {
		formattedNumber = formattedNumber.replace( /^-/, "minus " + symbol );
	}
	else {
		formattedNumber = symbol + formattedNumber;
	}

	return formattedNumber;

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
	disableForm( $bookNowButton.closest( "form" ) );
	$bookNowButton.attr( "data-state", "checking" );

	return checkAvailability( unitDetails, date, durationInMonths )
		.then( function ( response ) {
			// Re-enable the form
			enableForm( $bookNowButton.closest( "form" ) );
			$bookNowButton.attr( "data-state", "initial" );
			// Disable / Enable the "Book Now" button
			if ( response.success ) {
				livingSituation.fromDateString = getDateString( date );
				window.__BFS.bookingFromDate = livingSituation.fromDateString;
				var toDate = new Date( date.getTime() + durationInMonths * 30 * 24 * 60 * 60 * 1000 );
				livingSituation.toDateString = getDateString( toDate );
				window.__BFS.bookingToDate = livingSituation.toDateString;
			}
			else {
				livingSituation.fromDateString = null;
				window.__BFS.bookingFromDate = null;
				livingSituation.toDateString = null;
				window.__BFS.bookingToDate = livingSituation.toDateString;
				alert( "The date " + getDateString( date ) + " is unavailable." );
				window.__BFS.fromDatePicker.setDate();
				window.__BFS.fromDatePicker.onHide( window.__BFS.fromDatePicker );
				window.__BFS.fromDate__Previous = "";
			}
		} )
		.catch( function () {
			// Re-enable the date picker
			$( ".js_booking_from_date" ).prop( "disabled", false );
		} )
}

function setPayment ( amount, description ) {

	window.__BFS.bookingAmount = amount;
	// window.__BFS.bookingDescription = description;
	$( ".js_booking_amount" ).text( amount );

}


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
