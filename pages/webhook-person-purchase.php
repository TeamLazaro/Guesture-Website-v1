<?php

/* ------------------------------- \
 * Script Bootstrapping
 \-------------------------------- */
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
# * - Request Permissions
header( 'Access-Control-Allow-Origin: *' );
# * - Date and Timezone
date_default_timezone_set( 'Asia/Kolkata' );
# * - Prevent Script Cancellation by Client
ignore_user_abort( true );
# * - Script Timeout
set_time_limit( 0 );



/* ------------------------------- \
 * Request Parsing
 \-------------------------------- */
# Get JSON as a string
$json = file_get_contents( 'php://input' );
# Convert the JSON string to an object
$error = null;
try {
	$input = json_decode( $json, true );
	$event = $input[ 'event' ];
	$input = $input[ 'data' ];
}
catch ( \Exception $e ) {
	$error = $e->getMessage();
}



/* ------------------------------------- \
 * Pull in the dependencies
 \-------------------------------------- */
require_once __DIR__ . '/../inc/datetime.php';
require_once __DIR__ . '/../inc/google-forms.php';



/* ------------------------------------- \
 * Ingest the data onto the Spreadsheet
 \-------------------------------------- */
# Interpret the data
if ( $event !== 'person/made/purchase' )
	exit;

$when = CFD\DateTime::getSpreadsheetDateFromISO8601( $input[ 'when' ] );
$personId = $input[ 'personId' ];
$personPhoneNumber = $input[ 'phoneNumber' ];
$personVerified = $input[ 'verified' ];

$description = $input[ 'description' ];
$amount = $input[ 'amount' ];
$stayFrom = $input[ 'transactionDetails' ][ 'fromDate' ];
$stayDuration = $input[ 'transactionDetails' ][ 'unit' ][ 'duration' ];
$unitLocation = $input[ 'transactionDetails' ][ 'unit' ][ 'location' ];
$unitType = $input[ 'transactionDetails' ][ 'unit' ][ 'type' ];
$unitHasBalcony = $input[ 'transactionDetails' ][ 'unit' ][ 'balcony' ];
$unitHasBathroom = $input[ 'transactionDetails' ][ 'unit' ][ 'bathroom' ];
$unitInventoryId = $input[ 'transactionDetails' ][ 'unit' ][ 'id' ];






# Shape the data
$data = [
	'when' => $when,
	'personId' => $personId,
	'personPhoneNumber' => $personPhoneNumber,
	'personVerified' => $personVerified,
	'description' => $description,
	'amount' => $amount,
	'stayFrom' => $stayFrom,
	'stayDuration' => $stayDuration,
	'unitLocation' => $unitLocation,
	'unitType' => $unitType,
	'unitHasBalcony' => $unitHasBalcony,
	'unitHasBathroom' => $unitHasBathroom,
	'unitInventoryId' => $unitInventoryId
];
GoogleForms\submitPersonPurchase( $data );



/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );

# Respond back to client
$output = $error ?: $data ?: [ ];
echo json_encode( $output, JSON_PRETTY_PRINT );
