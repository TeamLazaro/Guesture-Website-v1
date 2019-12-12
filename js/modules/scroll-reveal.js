
$( function ( $ ) {

	/*
	 *
	 * Store values for reference
	 *
	 */
	// DOM elements
	var $elementsToReveal = Array.prototype.slice.call( $( ".scroll-reveal" ) )
							.map( function ( el ) {
								return $( el )
							} );
	// User Coordinates
	var currentScrollTop;


	// Returns whether or not an element has **not** been "revealed",
	//  	i.e. does not have the `reveal` class
	function hasElementNotBeenRevealed ( $el ) {
		return ! $el.hasClass( "reveal" );
	}

	function layoutNavigation () {

		var viewportHeight = $( window ).height();
		currentScrollTop = window.scrollY || document.body.scrollTop;

		/*
		 * Reveal elements as they are scrolled to
		 */
		for ( let _i = 0; _i < $elementsToReveal.length; _i += 1 ) {
			if (
				$elementsToReveal[ _i ].offset().top
					<
				currentScrollTop + ( 0.85 * viewportHeight )
			) {
				$elementsToReveal[ _i ]
					.addClass( "reveal" )
					.trigger( "reveal/post" )
			}
		}
		$elementsToReveal = $elementsToReveal.filter( hasElementNotBeenRevealed );

	}

	layoutNavigation();
	$( window ).on( "scroll", layoutNavigation );

} );
