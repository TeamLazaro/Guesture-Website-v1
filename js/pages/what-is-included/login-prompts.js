
/*
 * ------------------------\
 *  The Login Prompts
 * ------------------------|
 */
var __ = window.__CUPID;
var loginPrompts = { };

/*
 * What's Included section
 */
// NOTE: This is referenced in `pricing.js`
loginPrompts.whatsIncluded = new __.LoginPrompt( "What's Included", $( ".js_section_what_is_included_and_booking .js_main_content .qpid_login_site" ) );
loginPrompts.whatsIncluded.triggerFlowOn( "click", ".js_book_a_unit" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.whatsIncluded.on( "requirePhone", function ( event ) {
	var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
	var $phoneForm = this.$site.find( ".js_phone_form" );
	$loginTrigger.slideUp( 500, function () {
		$phoneForm.slideDown();
	} );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.whatsIncluded.on( "phoneSubmit", function ( event ) {
	var loginPrompt = this;
	var $form = $( event.target ).closest( "form" );

	// Pull data from the form
	var formData;
	try {
		formData = getFormData( $form, {
			phoneNumber: { type: "phone number", $: ".js_phone_country_code, [ name = 'phone-number' ]" }
		} );
	}
	catch ( e ) {
		// Reflect back sanitized values to the form
		setFormData( $form, e );
		// Report the message
		alert( "Please provide a phone number." );
		return;
	}

	// Reflect back sanitized values to the form
	setFormData( $form, formData );

	// Get the relevant data
	var phoneNumber = formData[ 0 ].value.join( "" );

	// Create a new (but temporary) Person object
	__.tempUser = new __.Person( phoneNumber, "Pricing Section - " + loginPrompt.context );
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
					if ( person.verification && person.verification.isVerified ) {
						__.user = person;
						loginPrompt.$phoneForm.slideUp( 300, function () {
							$( loginPrompt.triggerElement ).closest( ".js_login_trigger_region" ).slideDown( 300, function () {
								loginPrompt.trigger( "login", person );
							} );
						} );
					}
					else
						throw person;
				} )
				// If the person don't exist, add the person, and send an OTP
				.catch( function ( person ) {
					if ( person instanceof Error || ! person )
						trackConversion( loginPrompt );
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
loginPrompts.whatsIncluded.on( "requireOTP", function ( event, phoneNumber ) {
	var loginPrompt = this;
	disableForm( loginPrompt.$phoneForm );
	__.tempUser.requestOTP( loginPrompt.context )
		.then( function ( otpSessionId ) {
			__.tempUser.otpSessionId = otpSessionId;
			// Show OTP form, after hiding the phone form
			loginPrompt.$phoneForm.slideUp( 500, function () {
				loginPrompt.$OTPForm.slideDown();
			} );
		} )
		.catch( function ( e ) {
			alert( e.message );
			enableForm( loginPrompt.$phoneForm );
		} )
} );
// When the OTP is required
loginPrompts.whatsIncluded.on( "OTPSubmit", onOTPSubmit );
loginPrompts.whatsIncluded.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.whatsIncluded.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.whatsIncluded.on( "login", onLogin );
