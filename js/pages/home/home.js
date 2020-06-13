
$( function () {

	/*
	 *
	 * The "What's Included" URL Share/Copy feature
	 *
	 */
	var $whatsIncludedURLInput = $( "input.js_what_is_included_copy_url" );
	var $whatsIncludedURLCopyButton = $( ".js_what_is_included_copy_url:not(input)" );
	var $whatsIncludedURLShareButton = $( ".js_what_is_included_url_share" );

	if ( window.__BFS.support.webShare )
		$whatsIncludedURLCopyButton.addClass( "hidden" );
	else
		$whatsIncludedURLShareButton.addClass( "hidden" );

	// If the "Share" button is clicked
	$whatsIncludedURLShareButton.on( "click", function ( event ) {

		navigator.share( {
			title: "What's Included | Guesture",
			text: $whatsIncludedURLInput.data( "text" ),
			url: $whatsIncludedURLInput.val()
		} )
		.catch( function () {
			$whatsIncludedURLInput.select();
			try {
				document.execCommand( "copy" );
			}
			catch ( e ) {}
		} );

	} );

	// If the "Copy" button or the URL input is clicked
	$( ".js_what_is_included_copy_url" ).on( "click", function ( event ) {
		$whatsIncludedURLInput.select();
		try {
			document.execCommand( "copy" );
			$whatsIncludedURLCopyButton.find( "span" ).text( "Copied" );
			waitFor( 1.5 ).then( function () {
				$whatsIncludedURLCopyButton.find( "span" ).text( "Copy" );
			} );
		}
		catch ( e ) {}
	} );






	/*
	 *
	 * When opening the "What's Included" modal, do the following,
	 * 	1. Populate the "What's Included" modal when it is opened
	 * 	2. Set the data-attributes for the "Book Now" button
	 *	3. Pause the **global** section-level engagement interval check
	 *	4. Check the engagement over here
	 *	5. Update the share URL
	 *
	 */
	var sectionEngagementTimer;
	$( document ).on( "modal/open/pre/what-is-included", function ( event, data ) {
		// Populate the "What's Included" modal when it is opened
		var packageName = $( data.trigger ).data( "package" );
		window.__BFS.setContentOnWhatIsIncludedSection( packageName );

		// Set the data-attributes for the "Book Now" button
		$( ".js_book_from_modal" )
			.data( "product", packageName )
			.data( "c", "pricing-book-" + packageName.toLowerCase() )

		// Pause the **global** section-level engagement interval check
		window.__BFS.engagementIntervalCheck.stop();

		// Check the engagement over here
		sectionEngagementTimer = setTimeout( function () {
			window.__BFS.gtmPushToDataLayer( {
				event: "section-view",
				currentSectionId: "what-is-included",
				currentSectionName: "What is Included"
			} );
		}, 4000 );

		// Update the share URL
		var package = window.__BFS.livingSituations[ packageName ];
		var url = window.__BFS.getUnitBookingURL( package );
		var linkText = "The " + ( packageName[ 0 ].toUpperCase() + packageName.slice( 1 ) ) + " Package";
		linkText += "\n@" + package.location;
		linkText += "\nFor a fee of " + package.perDay + " " + package.monthlyFee;
		$( ".js_what_is_included_copy_url" )
			.val( url )
			.data( "text", linkText )

	} );
	/*
	 *
	 * When opening the "What's Included" modal, do the following,
	 *	1. Re-start the section-level engagement interval check
	 *	2. Disable the section engagement timer
	 *
	 */
	$( document ).on( "modal/close/what-is-included", function () {
		// Re-start the section-level engagement interval check
		window.__BFS.engagementIntervalCheck.start();
		// Disable the section engagement timer
		clearTimeout( sectionEngagementTimer );
		sectionEngagementTimer = null;
	} );





	/*
	 * -/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
	 *  The animations
	 * -/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
	 */

	/*
	 * Construct the animations
	 */
	var scoreOutAnimation = lottie.loadAnimation( {
		container: $( ".js_score_out" ).get( 0 ),
		renderer: "svg",
		autoplay: false,
		animationData: scoreOut__AnimationData
	} );
	var monthlyFeeAnimation = lottie.loadAnimation( {
		container: $( ".js_monthly_fee" ).get( 0 ),
		renderer: "svg",
		autoplay: false,
		animationData: monthlyFee__AnimationData
	} );


	/*
	 * Sequence the animations
	 */
	// Set the "Monthly Fee" animation to play after the "Score out" one
	scoreOutAnimation.addEventListener( "complete", function () {
		monthlyFeeAnimation.play()
	} );
	// Make a function that sets the animation in motion
	function playAnimation () {
		// If either of the animations are already playing, do nothing
		if ( ! scoreOutAnimation.isPaused || ! monthlyFeeAnimation.isPaused )
			return;

		scoreOutAnimation.play();
	}
	function resetAnimation () {
		scoreOutAnimation.goToAndStop( 0 );
		monthlyFeeAnimation.goToAndStop( 0 );
	}


	/*
	 * Configure when the animation should be played
	 */
	// When the section is revealed
	$( ".js_no_to_landlords" ).one( "reveal/post", function () {
		waitFor( 0.5 ).then( playAnimation );
	} );

	// When the section is scrolled to
	var $noToLandlords = $( ".js_no_to_landlords" );
	onScroll( function () {
		var currentScrollTop = window.scrollY || document.body.scrollTop;
		var elementBottom = $noToLandlords.position().top
							+ $noToLandlords.height()
							// arbitrary number (to compensate for the transform)
							+ 150;
		if ( currentScrollTop < elementBottom ) {
			if ( scoreOutAnimation.currentFrame === 0 )
				playAnimation();
		}
		else
			resetAnimation();
	}, { behavior: "throttle", by: 0.5 } );

} );
