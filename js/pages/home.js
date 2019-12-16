

/*
 * -/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
 *  The animations
 * -/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
 */
$( function () {

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
