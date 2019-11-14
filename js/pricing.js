
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

	XLSX_CALC.import_functions( window.spreadsheetFormulae );

	// Four types of living setups
	function LivingSituation ( type ) {
		this.type = type;
		this.cost
		this.$el = $( ".js_" + type + "_section" );
		// this.costCalculator = { Sheets: { numbers: costCalculators[ type ] } };
		var _this = this;
		this.$el.on( "change", ".js_attribute", function ( event ) {
			var $attribute = $( event.target );
			var name = $attribute.data( "name" );
			var value = $attribute.val();
			if ( name == "location" ) {
				event.preventDefault();
				_this.$el.trigger( "location/change", {
					location: value
				} );
				return;
			}
			_this[ name ] = value;
			_this.numbers.Sheets[ _this.type ][ _this.sheetCoordinates[ name ] ].v = value;
			_this.computeDetails();
		} );

		$( document ).on( "location/change", function ( event, data ) {
			var location = data.location;
			_this.$el.find( ".js_location" ).val( location );
			_this.location = location;
			_this.numbers.Sheets[ _this.type ][ _this.sheetCoordinates.location ].v = location;
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
		this.renderComputedDetails();
	};
	LivingSituation.prototype.render = function () {
		this.$el.find( ".js_image" ).attr( "media/pricing/rooms/" + this.photo );
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
		this.$el.find( ".js_image" ).attr( "src", "media/pricing/rooms/" + this.photo );
	};

	function createSelectOption ( value, label ) {
		if ( typeof label != "string" )
			label = value;
		return "<option value=\"" + value + "\">" + label + "</option>";
	}

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
				var errorResponse = __CUPID.utils.getErrorResponse( jqXHR, textStatus, e );
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
			if ( keyCell.v.indexOf( "_" ) === 0 )	// internal field
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

			livingSituation.numbers = { Sheets: { SETTINGS: numbers.SETTINGS } };
			livingSituation.numbers.Sheets[ type ] = numbers[ type ];
			// Set the default values from the markup and then compute
			livingSituation.render();
			livingSituation.$el.find( ".js_attribute" ).each( function ( _i, el ) {
				var $attribute = $( el );
				var name = $attribute.data( "name" );
				var value = $attribute.val();
				var coordinateOnSheet = livingSituation.sheetCoordinates[ name ];
				livingSituation[ name ] = value;
				livingSituation.numbers.Sheets[ type ][ coordinateOnSheet ].v = value;
			} );
			if ( type == "trio" ) {
				livingSituation.$el.find( ".js_location" ).val( "Dwellington - BLR" );
				livingSituation.location = "Dwellington - BLR";
				var location__SheetCoordinate = livingSituation.sheetCoordinates.location;
				livingSituation.numbers.Sheets.trio[ location__SheetCoordinate ].v = "Dwellington - BLR";
			}

			livingSituation.computeDetails();
		}

		return numbers;

	}

	function setupNearbyPlaces ( numbers ) {

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
			var _location = $placesNearTo.find( ":selected" ).text();
			console.log( _location )

			// Broadcast the change of location
			$placesNearTo.trigger( "location/change", { location: location } );
		} );

		/*
		 * When a location is selected, update the carousel of places that nearby
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
			if ( workplaceSection.length ) {
				// Show the corresponding workspaces
				$( ".js_workplaces" ).addClass( "hidden" );
				$( ".js_workplaces[ data-name = '" + workplaceSection[ 0 ] + "' ]" ).removeClass( "hidden" );
			}

		} );

		// $( document ).trigger( "location/change", {
		// 	location: locationOptions[ 0 ][ 1 ]
		// } );

	}

	// Okay, now go fetch them numbers!
	getNumbers()
		.then( setupPricingSection )
		.then( setupNearbyPlaces );

} );

