
/*
 *
 * Wait for the specified number of seconds.
 * This facilitates a Promise or syncrhonous (i.e., using async/await ) style
 * 	of programming
 *
 */
function waitFor ( seconds ) {
	return new Promise( function ( resolve, reject ) {
		setTimeout( function () {
			resolve();
		}, seconds * 1000 );
	} );
}



/*
 *
 * Return a debounced version of a given function
 *
 */
function getDebouncedVersion ( fn, debounceBy ) {

	debounceBy = ( debounceBy || 1 ) * 1000;

	var timeoutId;
	var rafId;

	return function () {
		window.clearTimeout( timeoutId );
		timeoutId = window.setTimeout( function () {
			window.cancelAnimationFrame( rafId );
			rafId = window.requestAnimationFrame( fn );
		}, debounceBy );
	};

}


/*
 *
 * Return a throttled version of a given function
 *
 */

function getThrottledVersion ( fn, throttleBy ) {

	throttleBy = ( throttleBy || 1 ) * 1000;

	var timeoutId;

	function preparedFunction () {
		fn();
		timeoutId = null;
	}

	return function () {

		if ( timeoutId )
			return;

		timeoutId = window.setTimeout( function () {
			window.requestAnimationFrame( preparedFunction );
		}, throttleBy );

	};

}




/*
 *
 * Scroll Event Handling Hub
 *
 */
var registeredScrollHandlers = [ ];
function scrollHandler ( event ) {
	var _i, _len = registeredScrollHandlers.length;
	for ( _i = 0; _i < _len; _i += 1 ) {
		try {
			registeredScrollHandlers[ _i ]();
		}
		catch ( e ) {
			console.log( e.message );
			console.log( e.stack );
		}
	}
}
function onScroll ( handler, options ) {
	options = options || { };
	let preparedHandler = handler;
	if ( options.behavior == "debounce" )
		preparedHandler = getDebouncedVersion( handler, options.by );
	else if ( options.behavior == "throttle" )
		preparedHandler = getThrottledVersion( handler, options.by );

	registeredScrollHandlers = registeredScrollHandlers.concat( preparedHandler );
}
window.addEventListener( "scroll", scrollHandler );
