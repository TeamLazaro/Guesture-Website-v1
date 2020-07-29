<?php

require_once __DIR__ . '/../../conf.php';




class Guesture {

	public static $apiUrl = GUESTURE_API_ENDPOINT;



	public static function getAccessToken () {

		// Pull the token from the cache
		require_once __DIR__ . '/../../content/data/guesture-api-conf.php';
		$accessToken = GUESTURE_OAUTH_ACCESS_TOKEN;
		$expiresAt = GUESTURE_OAUTH_ACCESS_TOKEN_EXPIRES_AT;

		// If the token has not expired, simply return it
		if ( ! empty( $accessToken ) and ( $expiresAt + 1 ) > time() )
			return $accessToken;

		// If the token has expired, or will expire within the second, then get a new one
		while ( empty( $accessToken ) or ( $expiresAt + 1 ) < time() ) {
			sleep( 1 );
			$tokenResponse = self::requestAccessToken();
			$accessToken = $tokenResponse[ 'access_token' ];
			$expiresAt = time() + $tokenResponse[ 'expires_in' ];
		}

		self::cacheAccessToken( $accessToken, $expiresAt );

		return $accessToken;

	}

	public static function requestAccessToken () {

		$url = GUESTURE_OAUTH_SERVER;

		$request = curl_init();
		curl_setopt( $request, CURLOPT_URL, $url );
		curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $request, CURLOPT_USERAGENT, 'Guestur' );
		curl_setopt( $request, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt( $request, CURLOPT_HTTPHEADER, [
			'Authorization: Basic MjFlNDNjNTUtMjhlZi00NzhhLWFlNjUtZGM4OTZlNWVhYTM0OlBAc3N3MHJk',
			'Content-Type: application/x-www-form-urlencoded'
		] );
		curl_setopt( $request, CURLOPT_POSTFIELDS, 'grant_type=client_credentials' );

		$response = curl_exec( $request );
		curl_close( $request );

		$body = json_decode( $response, true );

		if ( empty( $body ) )
			return [ ];

		return $body;

	}

	public static function cacheAccessToken ( $accessToken, $expiresAt ) {
		$credentialsFileContent = '<?php'
						. PHP_EOL . PHP_EOL
						. 'const GUESTURE_OAUTH_ACCESS_TOKEN = \'' . $accessToken . '\';'
						. PHP_EOL
						. 'const GUESTURE_OAUTH_ACCESS_TOKEN_EXPIRES_AT = ' . $expiresAt . ';'
						. PHP_EOL;
		file_put_contents( __DIR__ . '/../../content/data/guesture-api-conf.php', $credentialsFileContent );
	}



	public static function httpRequest ( $endpoint, $method = 'GET', $data = [ ] ) {

		$accessToken = self::getAccessToken();

		$request = curl_init();
		curl_setopt( $request, CURLOPT_URL, $endpoint );
		curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $request, CURLOPT_USERAGENT, 'Guestur' );
		$headers = [
			'Authorization: Bearer ' . $accessToken,
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
			'stayPackage' => $data[ 'stayPackage' ],
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
			'stayDuration' => $data[ 'durationAmount' ],
			'stayDurationUnit' => $data[ 'durationUnit' ] === 'days' ? 2 : 1
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
