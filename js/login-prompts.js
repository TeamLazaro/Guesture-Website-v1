
/*
 * ------------------------\
 *  Form helpers
 * ------------------------|
 */
// Disable the form
function disableForm ( $form, message ) {
	$form.find( "input, select, button" ).prop( "disabled", true );
	if ( message ) {
		var $feedback = $form.find( "[ type = 'submit' ]" );
		$feedback.data( "default", $feedback.text() );
		$feedback.text( message );
	}
}
// Enable the form
function enableForm ( $form, message ) {
	$form.find( "input, select, button" ).prop( "disabled", false );
	var $feedback = $form.find( "[ type = 'submit' ]" );
	if ( message )
		$feedback.text( message );
	else if ( $feedback.data( "default" ) )
		$feedback.text( $feedback.data( "default" ) );
}

/*
 * ------------------------\
 *  Common event handlers
 * ------------------------|
 */
function onOTPSubmit ( event ) {

	var loginPrompt = this;
	var $form = loginPrompt.$OTPForm;

	var formData;
	try {
		formData = getFormData( $form, {
			otp: { type: "OTP", $: "[ name = 'otp' ]" }
		} );
	}
	catch ( e ) {
		// Reflect back sanitized values to the form
		setFormData( $form, e );
		// Trigger the OTP Error event
		loginPrompt.trigger( "OTPError", {
			message: "Please provide a valid OTP."
		} );
		return;
	}

	// Reflect back sanitized values to the form
	setFormData( $form, formData );

	var data = formData.reduce( function ( acc, f ) {
		acc[ f.name ] = f.value;
		return acc;
	}, { } );

	__.tempUser.verifyOTP( data.otp )
		.then( function () {
			__.user = __.tempUser;
			loginPrompt.trigger( "OTPVerified" );
		} )
		.catch( function ( e ) {
			loginPrompt.trigger( "OTPError", e );
		} );

}

function onLogin ( person ) {
	var loginPrompt = this;
	// Set cookie ( for a month )
	__.utils.setCookie( "cupid-user", __.user, 31 * 24 * 60 * 60 );
	// Hide the OTP form
	$( loginPrompt.$OTPForm ).slideUp( 500, function () {
		// Bring back the trigger element
		$( loginPrompt.triggerElement ).slideDown( 500, function () {
			// Trigger the original event
			$( loginPrompt.triggerElement ).trigger( loginPrompt.triggerEvent );
		} );
	} );
}





/*
 * ------------------------\
 *  The Login Prompts
 * ------------------------|
 */
var __ = window.__CUPID;
var loginPrompts = { };

/*
 * 1. Contact Us section
 */
loginPrompts.contactUs = new __.LoginPrompt( "Contact Us", $( ".qpid_login_site.js_contact_form_section" ) );
loginPrompts.contactUs.triggerFlowOn( "submit", ".js_contact_form" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.contactUs.on( "requirePhone", function ( event ) {
	this.trigger( "phoneSubmit", event );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.contactUs.on( "phoneSubmit", function ( event ) {
	var loginPrompt = this;
	var $form = $( event.target ).closest( "form" );

	// Pull data from the form
	var formData;
	try {
		formData = getFormData( $form, {
			name: { type: "name", $: "[ name = 'name' ]" },
			emailAddress: { type: "email address", $: "[ name = 'email-address' ]" },
			phoneNumber: { type: "phone number", $: ".js_phone_country_code, [ name = 'phone-number' ]" }
		} );
	}
	catch ( e ) {
		// Reflect back sanitized values to the form
		setFormData( $form, e );
		// Prepare the error message
		var message = e.reduce( function ( message, issue ) {
			return message + "\n"
				+ ( issue.type[ 0 ].toUpperCase() + issue.type.slice( 1 ) );
		}, "" );
		message = "Please provide valid information for the following fields:" + message;
		// Report the message
		alert( message );
		return;
	}

	// Reflect back sanitized values to the form
	setFormData( $form, formData );

	// Get the relevant data
	var phoneNumber = formData[ 2 ].value.join( "" );

	// Create a new (but temporary) Person object
	__.tempUser = new __.Person( phoneNumber, loginPrompt.context );
		// Set the device id
	__.utils.getAnalyticsId()
		.then( function ( deviceId ) {
			__.tempUser.hasDeviceId( deviceId );
		} )
		// Attempt to find the person in the database
		.then( function () {
			return __.tempUser.getFromDB()
				// If the person exists, log in
				.then( function ( person ) {
					__.user = person;
					loginPrompt.trigger( "login", person );
				} )
				// If the person don't exist, add the person, and send an OTP
				.catch( function () {
					return __.tempUser.add()
						.then( function () {
							loginPrompt.trigger( "requireOTP" );
						} )
						.catch( function () {
							loginPrompt.trigger( "phoneError" );
						} );
				} )
		} );

} );
// When the phone number is to be submitted
loginPrompts.contactUs.on( "requireOTP", function ( event, phoneNumber ) {
	var loginPrompt = this;
	var $contactForm = loginPrompt.$site.find( "form" ).first();
	disableForm( $contactForm, "Sending....." );
	__.tempUser.requestOTP( loginPrompt.context )
		.then( function ( otpSessionId ) {
			__.tempUser.otpSessionId = otpSessionId;
			// Show OTP form, after hiding the Contact form
			var $otpForm = loginPrompt.$site.find( ".js_otp_form" );
			$contactForm.slideUp( 500, function () {
				$otpForm.slideDown();
			} );
		} )
		.catch( function ( e ) {
			alert( e.message );
			enableForm( $contactForm, "Contact" );
		} )
} );
// When the OTP is required
loginPrompts.contactUs.on( "OTPSubmit", onOTPSubmit );
loginPrompts.contactUs.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.contactUs.on( "OTPVerified", function ( event ) {
	// Track conversion
	this.trigger( "login" );
} );
// When the user is logged in
loginPrompts.contactUs.on( "login", onLogin );









/*
 *
 * Wire in the phone country code UI
 *
 */
$( document ).on( "change", ".js_phone_country_code", function ( event ) {
	var $countryCode = $( event.target );
	var countryCode = "(" + $countryCode.val().replace( /[^+0-9]/g, "" ) + ")";
	$countryCode
		.closest( "form" )
		.find( ".js_phone_country_code_label" )
		.val( countryCode );
} );
