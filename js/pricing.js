
$( function () {

	/*
	 * Convert a number to it alphabetical reprentation
	 */
	var convertNumberToLetter = function () {
		var numberLetterMap = {
			"1": "A", "2": "B", "3": "C", "4": "D", "5": "E", "6": "F", "7": "G", "8": "H", "9": "I", "10": "J", "11": "K", "12": "L", "13": "M", "14": "N", "15": "O", "16": "P", "17": "Q", "18": "R", "19": "S", "20": "T", "21": "U", "22": "V", "23": "W", "24": "X", "25": "Y", "26": "Z"
		};
		return function convertNumberToLetter ( number ) {
			if ( number < 27 )
				return numberLetterMap[ number ];

			var quotient = Math.floor( number / 26 );
			var remainder = number % 26;
			if ( remainder === 0 ) {
				quotient -= 1;
				remainder = 26;
			}
			return convertNumberToLetter( quotient ) + numberLetterMap[ remainder ];
		};
	}();

	/*
	 * Returns a (stringified) <option> element
	 */
	function createSelectOption ( value, label ) {
		if ( typeof label != "string" )
			label = value;
		return "<option value=\"" + value + "\">" + label + "</option>";
	}

	// Four types of living setups
	function LivingSituation ( type ) {
		this.type = type;
		this.cost
		this.$el = $( ".js_" + type + "_section" );
		this.numbers
		this.sheetCoordinates
		// this.costCalculator = { Sheets: { numbers: costCalculators[ type ] } };
		var _this = this;
		this.$el.on( "change", ".js_attribute", function ( event ) {
			// Extract the key-value pair whose value changed
			var $attribute = $( event.target );
			var name = $attribute.data( "name" );
			var value = $attribute.val();
			// A change in location has to reflect everywhere on the page, not just on the pricing engine
			if ( name == "location" ) {
				event.preventDefault();
				_this.$el.trigger( "location/change", {
					location: value
				} );
				return;
			}
			// Reflect the new value in memory
			_this[ name ] = value;
			// Reflect the new value in the spreadsheet's in-memory representation
			_this.numbers.Sheets[ _this.type ][ _this.sheetCoordinates[ name ] ].v = value;
			// Re-compute the values
			_this.computeDetails();
		} );

		// A dedicated handler for when the location changes
		$( document ).on( "location/change", function ( event, data ) {
			var location = data.location;
			// Set the location value on the location input element
			_this.$el.find( ".js_location" ).val( location );
			// Reflect the new value in memory
			_this.location = location;
			// Reflect the new value in the spreadsheet's in-memory representation
			_this.numbers.Sheets[ _this.type ][ _this.sheetCoordinates.location ].v = location;
			// Re-compute the values
			_this.computeDetails();
		} );
	}

	LivingSituation.prototype.computeDetails = function ( ) {
		XLSX_CALC( this.numbers );
		var sheet = this.numbers.Sheets[ this.type ];
		// Pull out the values
		this.perDay = sheet[ this.sheetCoordinates.perDay ].v;
		this.monthlyFee = sheet[ this.sheetCoordinates.monthlyFee ].v;
		this.photo = sheet[ this.sheetCoordinates.photo ].v;
		this.panorama = sheet[ this.sheetCoordinates.panorama ].v;
		this.virtualTour = sheet[ this.sheetCoordinates.virtualTour ].v;
		this.summary = sheet[ this.sheetCoordinates.summary ].v;
		this.room = sheet[ this.sheetCoordinates.room ].v;
		this.suite = sheet[ this.sheetCoordinates.suite ].v;
		this.services = sheet[ this.sheetCoordinates.services ].v;
		this[ "add-ons" ] = sheet[ this.sheetCoordinates[ "add-ons" ] ].v;
		this.renderComputedDetails();
	};
	LivingSituation.prototype.render = function () {
		this.$el.find( ".js_image" ).attr( "media/pricing/rooms/" + this.photo );
		this.$el.find( ".js_panorama" ).attr( "src", this.panorama );
		this.$el.find( ".js_balcony" ).html(
			this.balconyOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_bathroom" ).html(
			this.bathroomOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_duration" ).html(
			this.durationOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_location" ).html(
			this.locationOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_view" ).html(
			this.viewOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_ac" ).html(
			this[ "a/cOptions" ].map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_smoking" ).html(
			this.smokingOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_diet" ).html(
			this.dietOptions.map( createSelectOption ).join( "" )
		);
		this.renderComputedDetails();
	};
	LivingSituation.prototype.renderComputedDetails = function () {
		this.$el.find( ".js_daily_expense" ).text( this.perDay );
		this.$el.find( ".js_monthly_expense" ).text( this.monthlyFee );
		this.$el.find( ".js_panorama" ).attr( "src", this.panorama );
		if ( this.perDay === "" || this.monthlyFee === "" )
			this.$el.addClass( "invalid" );
		else
			this.$el.removeClass( "invalid" );
		// this.$el.find( ".js_image" ).attr( "src", "media/pricing/rooms/" + this.photo );
		this.$el.find( ".js_image" ).attr( "src", "/user/media/photo/" + this.photo );
	};

	/*
	 * Fetch and returns the spreadsheet data structure
	 */
	function getNumbers () {

		var url = "/data/numbers.json" + "?t=" + ( new Date() ).getTime();

		var ajaxRequest = $.ajax( {
			url: url,
			method: "GET",
			dataType: "json"
		} );

		return new Promise( function ( resolve, reject ) {
			ajaxRequest.done( function ( response ) {
				resolve( response );
			} );
			ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
				var errorResponse = getErrorResponse( jqXHR, textStatus, e );
				reject( errorResponse );
			} );
		} );

	}

	function getData ( sheet ) {
		var rows = sheet._meta.rows;
		var columns = sheet._meta.columns;
		var data = { sheetCoordinates: { } };
		for ( var _r = 1; _r < rows; _r += 1 ) {
			var keyCell = sheet[ "A" + _r ];
			if ( ! keyCell )
				continue;
			// ignore fields beginning with an "_"
			// 	they are for internal use
			if ( keyCell.v.indexOf( "_" ) === 0 )
				continue;
			var keyName = keyCell.v.toLowerCase().split( /\s+/ ).map( function ( part ) {
				return part[ 0 ].toUpperCase() + part.slice( 1 );
			} ).join( "" );
			keyName = keyName[ 0 ].toLowerCase() + keyName.slice( 1 );
			var valueCell = sheet[ "B" + _r ];
			data[ keyName ] = valueCell.v;
			data.sheetCoordinates[ keyName ] = "B" + _r;
			if ( valueCell.pv )
				data[ keyName + "Options" ] = valueCell.pv;
		}
		return data;
	}

	function setupPricingSection ( numbers ) {
		var livingSituationsData = { solo: null, buddy: null, trio: null };
		for ( var type in livingSituationsData ) {
			livingSituationsData[ type ] = getData( numbers[ type ] );
		}

		// Set up the data
		livingSituations = { };
		for ( var type in livingSituationsData ) {
			var livingSituation = new LivingSituation( type );
			for ( var _k in livingSituationsData[ type ] )
				livingSituation[ _k ] = livingSituationsData[ type ][ _k ];

			// REDO: Optimization: Should probably remove this
			livingSituation.numbers = { Sheets: { SETTINGS: numbers.SETTINGS } };
			livingSituation.numbers.Sheets[ type ] = numbers[ type ];
			// Set the default values from the markup and then compute
			livingSituation.render();
			livingSituation.$el.find( ".js_attribute" ).each( function ( _i, el ) {
				var $attribute = $( el );
				var name = $attribute.data( "name" );
				// REDO: This is confusing. Are we pulling the initial value from the markup?
				// var value = $attribute.val();
				// var coordinateOnSheet = livingSituation.sheetCoordinates[ name ];
				// livingSituation[ name ] = value;
				// livingSituation.numbers.Sheets[ type ][ coordinateOnSheet ].v = value;

				var coordinateOnSheet = livingSituation.sheetCoordinates[ name ];
				var value = livingSituation.numbers.Sheets[ type ][ coordinateOnSheet ].v;
				livingSituation[ name ] = value;
				$attribute.val( value );
			} );
			// REDO: Have to relegate this bit to the spreadsheet somehow
			if ( type == "trio" ) {
				livingSituation.$el.find( ".js_location" ).val( "Dwellington - BLR" );
				livingSituation.location = "Dwellington - BLR";
				var location__SheetCoordinate = livingSituation.sheetCoordinates.location;
				livingSituation.numbers.Sheets.trio[ location__SheetCoordinate ].v = "Dwellington - BLR";
			}

			livingSituation.computeDetails();

			livingSituations[ type ] = livingSituation;
		}

		return livingSituations;

	}

	function setupNearbyPlaces ( numbers ) {

		// REDO: This bit needs to be done properly
		var locationOptions = Object.entries( numbers.SETTINGS.locations );

		// Initialize the locations in the Nearby Places section
		$( ".js_places_near_to" ).html( locationOptions.map( function ( location ) {
			return createSelectOption( location[ 1 ], location[ 0 ] );
		} ) );

		$placesNearTo = $( ".js_places_near_to" );
		var locations = [ ].slice.call( $( ".js_workplaces" ) ).map( function ( domLocation ) {
			return domLocation.dataset.name;
		} );

		$placesNearTo.on( "change", function ( event ) {
			// Get the location
			var location = $placesNearTo.val();
			// Broadcast the change of location
			$placesNearTo.trigger( "location/change", { location: location } );
		} );

		/*
		 * When a location is selected, update the carousel of places that nearby
		 * and update the Google Maps link as well
		 */
		$( document ).on( "location/change", function ( event, data ) {

			var selectedLocation = data.location;

			// Set the new value
			$placesNearTo.val( selectedLocation );
			var presentableLocationName = "@" + selectedLocation.replace( /\s+-\s+.+/, "" );
			$placesNearTo
				.closest( ".js_location_selector_container" )
				.find( ".js_place" )
				.text( presentableLocationName );

			// Get the workspaces to show
			var workplaceSection = locations.filter( function ( thisLocation ) {
				return selectedLocation.toLowerCase().indexOf( thisLocation ) !== -1;
			} );

			if ( ! workplaceSection.length )
				return;

			// Show the corresponding Google Map links
			$( ".js_location_selector_container .js_google_maps" ).addClass( "hidden" );
			$( ".js_location_selector_container .js_google_maps[ data-name = '" + workplaceSection[ 0 ] + "' ]" ).removeClass( "hidden" );

			// Show the corresponding workspaces
			$( ".js_workplaces" ).addClass( "hidden" );
			$( ".js_workplaces[ data-name = '" + workplaceSection[ 0 ] + "' ]" ).removeClass( "hidden" );

		} );

	}


	/*
	 *
	 * Populating the modal with information on the package that was clicked
	 *
	 */
	var $modal = $( ".js_modal_box_content[ data-mod-id = 'what-is-included' ]" );
	var modalFields = {
		$bookNow: $modal.find( ".js_book_from_modal" ),
		$name: $modal.find( ".js_name" ),
		$monthlyExpense: $modal.find( ".js_monthly_expense" ),
		$location: $modal.find( ".js_location" ),
		$summary: $modal.find( ".js_summary" ),
		$virtualTourContainer: $modal.find( ".js_virtual_tour_container" ),
		$virtualTour: $modal.find( ".js_virtual_tour" ),
		$room: $modal.find( ".js_room" ),
		$suite: $modal.find( ".js_suite" ),
		$services: $modal.find( ".js_services" ),
		$addOns: $modal.find( ".js_addons" ),
		$locationImagesContainer: $modal.find( ".js_location_images_container" ),
		$locationImages: $modal.find( ".js_location_images" ),
		$locationAddress: $modal.find( ".js_location_address" ),
		$locationGoogleMaps: $modal.find( ".js_location_google_maps" )
	};
	$( document ).on( "modal/open/pre/what-is-included", function ( event, data ) {
		var packageName = $( data.trigger ).data( "package" );
		var package = livingSituations[ packageName ];

		// Prepare the "Book Now" button
		modalFields.$bookNow.data( "product", packageName[ 0 ].toUpperCase() + packageName.slice( 1 ) );
		modalFields.$bookNow.data( "c", "pricing-modal-book-" + packageName );
		modalFields.$bookNow.text( modalFields.$bookNow.data( "initial-text" ) );
		modalFields.$bookNow.prop( "disabled", false );
		loginPrompts.whatsIncluded.$phoneForm.hide();
		loginPrompts.whatsIncluded.$OTPForm.hide();

		modalFields.$name.text( packageName[ 0 ].toUpperCase() + packageName.slice( 1 ) );
		modalFields.$monthlyExpense.text( package.perDay );
		modalFields.$location.text( package.location );
		modalFields.$summary.text( package.summary );
		modalFields.$virtualTour.attr( "src", package.virtualTour );
		if ( package.virtualTour )
			modalFields.$virtualTourContainer.removeClass( "hidden" );
		else
			modalFields.$virtualTourContainer.addClass( "hidden" );
		modalFields.$room.html( package.room.replace( /\n/g, "<br>" ) );
		modalFields.$suite.html( package.suite.replace( /\n/g, "<br>" ) );
		modalFields.$services.html( package.services.replace( /\n/g, "<br>" ) );
		modalFields.$addOns.html( package[ "add-ons" ].replace( /\n/g, "<br>" ) );
		var locationImagesMarkup = package.locationImages.trim()
			.split( "\n" )
			.filter( function ( image ) {
				return image;
			} )
			.map( function ( image ) {
				var parts = image.split( " ~ " );
				return {
					url: parts[ 1 ] || parts[ 0 ],
					caption: parts[ 1 ] ? parts[ 0 ] : ""
				}
			} )
			.reduce( function ( markup, image ) {
				return markup + `<div class="carousel-list-item js_carousel_item">
					<div class="image" style="background-image: url( '${ image.url }' )"><span class="label caption">${ image.caption }</span></div>
				</div>`
			}, "" )
		modalFields.$locationImages.html( locationImagesMarkup );
		if ( ! locationImagesMarkup )
			modalFields.$locationImagesContainer.addClass( "hidden" );
		else
			modalFields.$locationImagesContainer.removeClass( "hidden" );
		modalFields.$locationAddress.html( package.locationAddress.split( "\n" ).join( "<br>" ) );
		modalFields.$locationGoogleMaps.attr( "href", package.locationGoogleMaps );
	} );


	/*
	 *
	 * Main execution point
	 *
	 */
	// 1. Import custom spreadsheet functions
	XLSX_CALC.import_functions( window.spreadsheetFormulae );

	// Okay, now go fetch them numbers!
	var livingSituations;
	getNumbers()
		.then( function ( numbers ) {
			livingSituations = setupPricingSection( numbers );
			setupNearbyPlaces( numbers );
		} )

} );
