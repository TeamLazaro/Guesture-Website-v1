<?php

require_once __DIR__ . '/../../conf.php';




class Guesture {

	public static $apiUrl = GUESTURE_API_ENDPOINT;



	public static function httpRequest ( $endpoint, $method = 'GET', $data = [ ] ) {

		$request = curl_init();
		curl_setopt( $request, CURLOPT_URL, $endpoint );
		curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $request, CURLOPT_USERAGENT, 'Guestur' );
		$headers = [
			'Authorization: Bearer ' . GUESTURE_OAUTH_BEARER_TOKEN,
			'Cache-Control: no-cache, no-store, must-revalidate'
		];
		if ( ! empty( $data ) and is_array( $data ) ) {
			$headers[ ] = 'Content-Type: application/json';
			$requestBody = json_encode( $data );
			curl_setopt( $request, CURLOPT_POSTFIELDS, $requestBody );
		}
		curl_setopt( $request, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $request, CURLOPT_CUSTOMREQUEST, $method );
		$response = curl_exec( $request );
		curl_close( $request );

		$body = json_decode( $response, true );

		if ( empty( $body ) )
			return [ ];

		return $body;

	}



	/*
	 *
	 * ----- Creates a customer record with the given data
	 *
	 */
	public static function getUnitAvailability ( $data ) {

		$endpoint = self::$apiUrl . 'guest-jini/inventory/get-suitable-inventory';

		$requestBody = [
			'orderId' => null,
			'stayPackage' => $data[ 'type' ],
			'property' => $data[ 'location' ],
			'hasBalcony' => $data[ 'hasBalcony' ],
			'hasBathRoom' => $data[ 'hasBathroom' ],	// Yes, the capital 'R' in the field name is important
			'mobileNumber' => '',
			'emailAddress' => '',
			'fullName' => '',
			'gender' => null,
			'selectedLocation' => null,
			'selectedPackage' => null,
			'selectedAmenities' => null,
			'checkInDate' => $data[ 'fromDate' ],
			'checkOutDate' => $data[ 'toDate' ],
			'stayDuration' => $data[ 'duration' ],
			'stayDurationUnit' => 1
		];

		$responseBody = self::httpRequest( $endpoint, 'POST', $requestBody );

		if ( empty( $responseBody ) )
			return [ 'success' => false ];

		return [
			'success' => $responseBody[ 'success' ],
			'inventoryId' => $responseBody[ 'inventory' ][ 'id' ]
		];

	}



	/*
	 *
	 * ----- Creates a customer record with the given data
	 *
	 */
	public static function makeBooking ( $data ) {

		$endpoint = self::$apiUrl . 'guest-jini/booking/create-booking';

		$requestBody = [
			'orderId' => $data[ 'orderId' ],
			'stayPackage' => $data[ 'type' ],
			'property' => $data[ 'location' ],
			'hasBalcony' => $data[ 'hasBalcony' ] ? 1 : 0,
			'hasBathRoom' => $data[ 'hasBathroom' ] ? 1 : 0,	// Yes, the capital 'R' in the field name is important
			'mobileNumber' => $data[ 'phoneNumber' ],
			'emailAddress' => $data[ 'emailAddress' ],
			'fullName' => $data[ 'name' ],
			'gender' => null,
			'selectedInventory' => $data[ 'unitId' ],
			'checkInDate' => $data[ 'fromDate' ],
			'checkOutDate' => $data[ 'toDate' ]
		];

		$responseBody = self::httpRequest( $endpoint, 'POST', $requestBody );

		if ( empty( $responseBody ) )
			return [ 'success' => false ];

		return $requestBody;

	}

}
