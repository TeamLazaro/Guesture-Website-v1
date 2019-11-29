
function countdown ( date, domElement ) {

	function countdownUpdate () {

		var now = ( new Date() ).getTime();

		var distance = date - now;

		// Calculate the time components
		var days = Math.floor( distance / ( 1000 * 60 * 60 * 24 ) );
		var hours = Math.floor( ( distance % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 ) );
		var minutes = Math.floor( ( distance % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) );
		var seconds = Math.floor( ( distance % ( 1000 * 60 ) ) / 1000 );

		domElement.innerHTML = `<span class="h6 inline-middle">⚡</span>Flash Deal Ends: ${ days }ds ${ hours }h ${ minutes }m <span class="text-red">${ seconds }s</span>`
		// "<span class="h6 inline-middle">⚡</span>Flash Deal Ends: 2ds 16h 43m <span class="text-red">53s</span>"

		if ( distance > 0 )
			return setTimeout( countdownUpdate, 1000 );

		domElement.innerHTML = "EXPIRED";

	}

	countdownUpdate();

}
