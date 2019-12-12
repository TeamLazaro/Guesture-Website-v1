

/*
 * -/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
 *  Play the animations
 * -/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
 */
$( function () {

	// Build the animations
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

	$( ".js_no_to_landlords" ).on( "reveal/post", function () {
		waitFor( 1 )
			.then( function () {
				scoreOutAnimation.play();
			} )
			.then( function () {
				return waitFor( 1 );
			} )
			.then( function () {
				monthlyFeeAnimation.play();
			} )
	} );

} );
