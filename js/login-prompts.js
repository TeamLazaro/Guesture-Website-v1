
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
function onOTPVerified () {
	var loginPrompt = this;
	// Trigger the login event
	loginPrompt.trigger( "login" );
}
function trackConversion ( loginPrompt ) {
	// Track the conversion
	var conversionUrl = $( loginPrompt.triggerElement ).data( "c" );
	__.utils.trackPageVisit( conversionUrl );
}
function onLogin () {
	var loginPrompt = this;
	// Set cookie ( for a month )
	__.utils.setCookie( "cupid-user", __.user, 31 * 24 * 60 * 60 );
	// Hide the OTP form
	$( loginPrompt.$OTPForm ).slideUp( 500, function () {
		// Bring back the trigger element
		$( loginPrompt.triggerRegion ).slideDown( 500, function () {
			// Trigger the original event
			$( loginPrompt.triggerElement ).trigger( loginPrompt.triggerEvent );
		} );
	} );
	__.utils.getAnalyticsId()
		.then( function ( deviceId ) {
			__.user.hasDeviceId( deviceId );
			__.user.isOnWebsite();
		} )
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
					if ( person.verification && person.verification.isVerified ) {
						__.user = person;
						loginPrompt.trigger( "login", person );
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
loginPrompts.contactUs.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.contactUs.on( "login", onLogin );




/*
 * 2. Book a Trial section
 */
loginPrompts.bookTrial = new __.LoginPrompt( "Book 3-day Trial", $( ".qpid_login_site.js_trial_section" ) );
loginPrompts.bookTrial.triggerFlowOn( "click", ".js_book_trial" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.bookTrial.on( "requirePhone", function ( event ) {
	var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
	var $phoneForm = this.$site.find( ".js_phone_form" );
	$loginTrigger.slideUp( 500, function () {
		$phoneForm.slideDown();
	} );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.bookTrial.on( "phoneSubmit", function ( event ) {
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
loginPrompts.bookTrial.on( "requireOTP", function ( event, phoneNumber ) {
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
loginPrompts.bookTrial.on( "OTPSubmit", onOTPSubmit );
loginPrompts.bookTrial.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.bookTrial.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.bookTrial.on( "login", onLogin );
loginPrompts.bookTrial.on( "login", function () {
	__.user.isInterestedIn( "3-day Trial" );
	__.user.update();
	this.$site.find( ".js_book_trial" ).text( "Click here to book." );
} );
loginPrompts.bookTrial.on( "prepare", function ( person ) {
	var queryParameters = [ ];
	if ( person.name )
		queryParameters = queryParameters.concat( [
			"data_name=" + person.name,
			"data_readonly=" + "data_name"
		] );
	if ( person.phoneNumber )
		queryParameters = queryParameters.concat( [
			"data_phone=" + encodeURIComponent( person.phoneNumber ),
			"data_readonly=" + "data_phone"
		] );
	if ( person.emailAddress )
		queryParameters = queryParameters.concat( [
			"data_email=" + person.emailAddress,
			"data_readonly=" + "data_email"
		] );

	queryParameters = "?" + queryParameters.join( "&" );
	var baseURL = this.$site.find( ".js_book_trial" ).attr( "href" );
	var fullURL = baseURL + queryParameters;
	this.$site.find( ".js_book_trial" ).attr( "href", fullURL );
} );




/*
 * 3. Women's Block section
 */
loginPrompts.womensBlock = new __.LoginPrompt( "Womens Block", $( ".qpid_login_site.js_women_block_section" ) );
loginPrompts.womensBlock.triggerFlowOn( "click", ".js_book_womens_block" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.womensBlock.on( "requirePhone", function ( event ) {
	var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
	var $phoneForm = this.$site.find( ".js_phone_form" );
	$loginTrigger.slideUp( 500, function () {
		$phoneForm.slideDown();
	} );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.womensBlock.on( "phoneSubmit", function ( event ) {
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
loginPrompts.womensBlock.on( "requireOTP", function ( event, phoneNumber ) {
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
loginPrompts.womensBlock.on( "OTPSubmit", onOTPSubmit );
loginPrompts.womensBlock.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.womensBlock.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.womensBlock.on( "login", onLogin );




/*
 * 3. Pricing section
 */
// 3.1 Solo room
loginPrompts.soloRoom = new __.LoginPrompt( "Solo Room", $( ".qpid_login_site.js_solo_section" ) );
loginPrompts.soloRoom.triggerFlowOn( "click", ".js_book_solo" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.soloRoom.on( "requirePhone", function ( event ) {
	var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
	var $phoneForm = this.$site.find( ".js_phone_form" );
	$loginTrigger.slideUp( 500, function () {
		$phoneForm.slideDown();
	} );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.soloRoom.on( "phoneSubmit", function ( event ) {
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
loginPrompts.soloRoom.on( "requireOTP", function ( event, phoneNumber ) {
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
loginPrompts.soloRoom.on( "OTPSubmit", onOTPSubmit );
loginPrompts.soloRoom.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.soloRoom.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.soloRoom.on( "login", onLogin );



// 3.2 Buddy room
loginPrompts.buddyRoom = new __.LoginPrompt( "Buddy Room", $( ".qpid_login_site.js_buddy_section" ) );
loginPrompts.buddyRoom.triggerFlowOn( "click", ".js_book_buddy" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.buddyRoom.on( "requirePhone", function ( event ) {
	var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
	var $phoneForm = this.$site.find( ".js_phone_form" );
	$loginTrigger.slideUp( 500, function () {
		$phoneForm.slideDown();
	} );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.buddyRoom.on( "phoneSubmit", function ( event ) {
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
loginPrompts.buddyRoom.on( "requireOTP", function ( event, phoneNumber ) {
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
loginPrompts.buddyRoom.on( "OTPSubmit", onOTPSubmit );
loginPrompts.buddyRoom.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.buddyRoom.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.buddyRoom.on( "login", onLogin );



// 3.3 Trio room
loginPrompts.trioRoom = new __.LoginPrompt( "Trio Room", $( ".qpid_login_site.js_trio_section" ) );
loginPrompts.trioRoom.triggerFlowOn( "click", ".js_book_trio" );
// Skip the phone form because it is already integrated with the contact form
loginPrompts.trioRoom.on( "requirePhone", function ( event ) {
	var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
	var $phoneForm = this.$site.find( ".js_phone_form" );
	$loginTrigger.slideUp( 500, function () {
		$phoneForm.slideDown();
	} );
} );
// Since the phone number is already provided in the contact form, simply submit it programmatically
loginPrompts.trioRoom.on( "phoneSubmit", function ( event ) {
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
loginPrompts.trioRoom.on( "requireOTP", function ( event, phoneNumber ) {
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
loginPrompts.trioRoom.on( "OTPSubmit", onOTPSubmit );
loginPrompts.trioRoom.on( "OTPError", function ( e ) {
	alert( e.message );
} );
loginPrompts.trioRoom.on( "OTPVerified", onOTPVerified );
// When the user is logged in
loginPrompts.trioRoom.on( "login", onLogin );



// 3.4 "What's Included" modal
// NOTE: This is referenced in `pricing.js`
loginPrompts.whatsIncluded = new __.LoginPrompt( "What's Included", $( ".js_modal_box_content[ data-mod-id = 'what-is-included' ]" ).find( ".qpid_login_site" ) );
loginPrompts.whatsIncluded.triggerFlowOn( "click", ".js_book_from_modal" );
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





/*
 * 4. Deals
 */
$( ".qpid_login_site.js_deal" ).each( function ( _i, domEl ) {
	var dealId = $( domEl ).find( ".js_get_deal" ).attr( "id" );
	loginPrompts[ dealId ] = new __.LoginPrompt( "Deal", $( domEl ) );
	loginPrompts[ dealId ].triggerFlowOn( "click", "#" + dealId );
	// Skip the phone form because it is already integrated with the contact form
	loginPrompts[ dealId ].on( "requirePhone", function ( event ) {
		var $loginTrigger = this.$site.find( ".js_login_trigger_region" );
		var $phoneForm = this.$site.find( ".js_phone_form" );
		$loginTrigger.slideUp( 500, function () {
			$phoneForm.slideDown();
		} );
	} );
	// Since the phone number is already provided in the contact form, simply submit it programmatically
	loginPrompts[ dealId ].on( "phoneSubmit", function ( event ) {
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
		__.tempUser = new __.Person( phoneNumber, "Deal" );
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
	loginPrompts[ dealId ].on( "requireOTP", function ( event, phoneNumber ) {
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
	loginPrompts[ dealId ].on( "OTPSubmit", onOTPSubmit );
	loginPrompts[ dealId ].on( "OTPError", function ( e ) {
		alert( e.message );
	} );
	loginPrompts[ dealId ].on( "OTPVerified", onOTPVerified );
	// When the user is logged in
	loginPrompts[ dealId ].on( "login", onLogin );
} );









/*
 *
 * Wire in the phone country code UI
 *
 */
$( document ).on( "change", ".js_phone_country_code", function ( event ) {
	var $countryCode = $( event.target );
	var countryCode = $countryCode.val().replace( /[^\+\d]/g, "" );
	$countryCode
		.closest( "form" )
		.find( ".js_phone_country_code_label" )
		.val( countryCode );
} );
