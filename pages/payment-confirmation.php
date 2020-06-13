<?php
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );



require_once __DIR__ . '/../conf.php';

/*
 *
 * If the $_GET[ 'referrer' ] is set, redirect to that page.
 * If the $_POST is not empty, verify transaction status and redirect back to booking page with transaction status message.
 *
 */

/*
 *
 * If this route is being navigated to post-transaction
 *
 */
if ( strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) === 'POST' and ! empty( $_POST ) ) {


	/*
	 *
	 * Sample callback request from PayTM
	 *
	 */
	// [
	//   'CURRENCY' => 'INR',
	//   'GATEWAYNAME' => 'WALLET',
	//   'RESPMSG' => 'Txn Success',
	//   'BANKNAME' => 'WALLET',
	//   'PAYMENTMODE' => 'PPI',
	//   'MID' => 'IrinaH93005971299457',
	//   'RESPCODE' => '01',
	//   'TXNID' => '20200605111212800110168668201607907',
	//   'TXNAMOUNT' => '500.00',
	//   'ORDERID' => '1003',
	//   'STATUS' => 'TXN_SUCCESS',
	//   'BANKTXNID' => '62574042',
	//   'TXNDATE' => '2020-06-05 15:26:36.0',
	//   'CHECKSUMHASH' => '5+s+z3fpoLkT1SN7FaE1kCQCxbagITrDl3g5YFrbAyvTrxmyQetsCkaCjUPi5VASbY0v3WJW1ptwwzS+6lrrXcUXHV7n5xrl0ikMX2gsvgI='
	// ]


	/**
	 *
	 * Import checksum generation utility (https://developer.paytm.com/docs/checksum/)
	 *
	 */
	require_once __DIR__ . '/../server/paytm-checksum.php';



	// TODO: Write out the whole thing
	function getOrder ( $id ) {
		return [
			'status' => 'pending'
		];
	}

	$paytmParams = [ ];
	$paytmChecksum = null;

	foreach ( $_POST as $key => $value ) {
		if ( $key === 'CHECKSUMHASH' )
			$paytmChecksum = $value;
		else
			$paytmParams[ $key ] = $value;
	}



	/*
	 *
	 * Data Validation
	 *
	 */
	$transaction = [
		'occurred' => true,
		'errors' => [ ]
	];

	// Is the request tampered with?
		// i.e. checksum hash does not match
	$verifySignature = PaytmChecksum::verifySignature( $paytmParams, PAYTM_MERCHANT_KEY, $paytmChecksum );
	if ( ! $verifySignature )
		$transactionErrors[ 'paymentTampered' ] = true;

	// Is the merchant id correct?
	if ( $paytmParams[ 'MID' ] !== PAYTM_MERCHANT_ID )
		$transactionErrors[ 'merchantIncorrect' ] = true;

	// Was the transaction successful?
		// Response code is not `01`
		// Status is not `TXN_SUCCESS`
	if ( $paytmParams[ 'RESPCODE' ] !== '01' or $paytmParams[ 'STATUS' ] !== 'TXN_SUCCESS' )
		$transactionErrors[ 'transactionUnsuccessful' ] = true;

	if ( ! empty( $transactionErrors ) ) {
		$bookingDetails = [
			'orderId' => '',
			'type' => '',
			'location' => '',
			'hasBalcony' => '',
			'hasBathroom' => '',
			'phoneNumber' => '',
			'emailAddress' => '',
			'name' => '',
			'unitId' => '',
			'fromDate' => '',
			'toDate' => ''
		];
		// Guesture::makeBooking( $bookingDetails );
	}

	$transactionString = base64_encode( json_encode( $transaction ) );
	$redirectURL = '/payment-confirmation' . '?q=' . $_GET[ 'q' ] . '&t=' . $transactionString;
	return header( 'Location: ' . $redirectURL, true, 302 );

}
else if ( strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) === 'GET' ) {
	$transaction = json_decode( base64_decode( $_GET[ 't' ] ), true );
	$transactionOccurred = $transaction[ 'occurred' ];
	$transactionErrors = $transaction[ 'errors' ];
	require_once __DIR__ . '/booking.php';
}
