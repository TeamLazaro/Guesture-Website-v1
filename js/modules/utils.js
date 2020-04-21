
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
 * Handle error / exception response helper
 *
 */
function getErrorResponse ( jqXHR, textStatus, e ) {
	var code = -1;
	var message;
	if ( jqXHR.responseJSON ) {
		code = jqXHR.responseJSON.code || jqXHR.responseJSON.statusCode;
		message = jqXHR.responseJSON.message;
	}
	else if ( typeof e == "object" ) {
		message = e.stack;
	}
	else {
		message = jqXHR.responseText;
	}
	var error = new Error( message );
	error.code = code;
	return error;
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





/*
 *
 * Recur a given function every given interval
 *
 */
function executeEvery ( interval, fn ) {

	interval = ( interval || 1 ) * 1000;

	var timeoutId;
	var running = false;

	return {
		_schedule: function () {
			var _this = this;
			timeoutId = setTimeout( function () {
				window.requestAnimationFrame( function () {
					fn();
					_this._schedule()
				} );
			}, interval );
		},
		start: function () {
			if ( running )
				return;
			running = true;
			this._schedule();
		},
		stop: function () {
			clearTimeout( timeoutId );
			timeoutId = null;
			running = false;
		}
	}

}
