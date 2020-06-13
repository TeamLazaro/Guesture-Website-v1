<?php
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );



require_once __DIR__ . '/../conf.php';
// require_once __DIR__ . '/../utils.php';
/**
 *
 * Import checksum generation utility (https://developer.paytm.com/docs/checksum/)
 *
 */
require_once __DIR__ . '/paytm-checksum.php';





/*
 *
 * Extract data from input
 *
 */
$customerPhoneNumber = $_POST[ 'phoneNumber' ];
$customerEmail = $_POST[ 'emailAddress' ];
$fromDate = $_POST[ 'fromDate' ];
$toDate = $_POST[ 'toDate' ];
$unitInfoString = $_POST[ 'unitInfoString' ];
$transactionAmount = $_POST[ 'amount' ];



/*
 *
 * Derive computed data
 *
 */
function microtimeString () {
	list ( $sec, $usec ) = explode( '.', strval( microtime( true ) ) );
    return $sec . $usec;
}

$orderId = microtimeString();
$customerId = substr( preg_replace( '/[^a-zA-Z0-9]/', '', PaytmChecksum::generateSignature( [ 'phoneNumber' => $customerPhoneNumber ], PAYTM_MERCHANT_KEY ) ), 0, 9 );
// $callbackURL = $_POST[ 'callbackURL' ] . '?orderId=' . $orderId;
$hostName = $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ];
if ( HTTPS_SUPPORT )
	$httpProtocol = 'https';
else
	$httpProtocol = 'http';

// $_SERVER[ 'HTTP_REFERER' ]
$callbackURL = $httpProtocol . '://' . $hostName . '/payment-confirmation' . '?q=' . $unitInfoString;
// $callbackURL = $httpProtocol . '://' . $hostName . '/payment-confirmation' . '?q=' . $unitInfoString . '&fromDate=' . $fromDate . '&toDate=' . $toDate;



/*
 *
 * Collate all the information
 *
 */
$paytmParams = [

	/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	'MID' => PAYTM_MERCHANT_ID,

	/* Find your WEBSITE in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	'WEBSITE' => PAYTM_ENVIRONMENT,

	/* Find your INDUSTRY_TYPE_ID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	'INDUSTRY_TYPE_ID' => 'Retail',

	/* WEB for website and WAP for Mobile-websites or App */
	'CHANNEL_ID' => 'WEB',

	/* Enter your unique order id */
	'ORDER_ID' => $orderId,

	/* unique id that belongs to your customer */
	'CUST_ID' => $customerId,

	/* customer's mobile number */
	'MOBILE_NO' => $customerPhoneNumber,

	/* customer's email */
	'EMAIL' => $customerEmail,

	/**
	 * Amount in INR that is payble by customer
	 * this should be numeric with optionally having two decimal points
	 */
	'TXN_AMOUNT' => $transactionAmount,

	/* on completion of transaction, we will send you the response on this URL */
	'CALLBACK_URL' => $callbackURL

];



/*
 *
 * Generate checksum for parameters
 *
 */
$checksum = PaytmChecksum::generateSignature( $paytmParams, PAYTM_MERCHANT_KEY );




$allParameters = $paytmParams;
$allParameters[ 'CHECKSUMHASH' ] = $checksum;



/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );

echo json_encode( $allParameters );
