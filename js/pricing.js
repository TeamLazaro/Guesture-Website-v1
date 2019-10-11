
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
			_this[ name ] = value;
			_this.numbers.Sheets[ _this.type ][ _this.sheetCoordinates[ name ] ].v = value;
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
		this.renderComputedDetails();
	};
	LivingSituation.prototype.renderComputedDetails = function () {
		this.$el.find( ".js_daily_expense" ).text( this.perDay );
		this.$el.find( ".js_monthly_expense" ).text( this.monthlyFee );
		this.$el.find( ".js_image" ).attr( "src", "media/pricing/rooms/" + this.photo );
	};


	let costCalculators = {
		"solo": {},
		"buddy": {},
		"trio": {
			B2: { t: "n", v: 10 },
			B3: { t: "n", v: 1 },
			B4: { t: "n", v: 5 },
			B5: { t: "n", v: 25 },
			B6: { t: "n", v: 150, f: "B2 + B3 + B4 * B5" }
		},
		"premium": {}
	};

	function createSelectOption ( option ) {
		return "<option value=\"" + option + "\">" + option + "</option>";
	}

	/*
	 * Fetch and returns the spreadsheet data structure
	 */
	function getNumbers () {

		var url = "/data/numbers.json";

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

	function onNumbersReady ( numbers ) {
		var livingSituationsData = { solo: null };
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
			livingSituation.render();
		}
	}

	// Okay, now go fetch them numbers!
	getNumbers().then( onNumbersReady );

} );
