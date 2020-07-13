<?php

require_once __DIR__ . '/guesture.php';

$type = $_POST[ 'type' ];
$location = $_POST[ 'location' ] ?? '';
$hasBalcony = strtolower( $_POST[ 'balcony' ] ) === 'attached' ? 1 : 0;
$hasBathroom = strtolower( $_POST[ 'bathroom' ] ) === 'attached' ? 1 : 0;
$fromDateString = $_POST[ 'fromDateString' ];
$toDateString = $_POST[ 'toDateString' ];
$durationUnit = $_POST[ 'durationUnit' ];
$durationAmount = $_POST[ 'durationAmount' ];

if ( strtolower( $location ) === 'dwellington - blr' )
	$location = 'dw';
else if ( strtolower( $location ) === 'alta vista - blr' )
	$location = 'av';


$stayPackage = $location . '-' . $type;
if ( $type !== 'trio' ) {
	$stayPackage .= '-';
	$stayPackage .= $hasBalcony === 1 ? 'yesbal' : 'nobal';
	$stayPackage .= '-';
	$stayPackage .= $hasBathroom === 1 ? 'yesbath' : 'nobath';
}

$response = Guesture::getUnitAvailability( [
	'stayPackage' => $stayPackage,
	'location' => $location,
	'hasBalcony' => $hasBalcony,
	'hasBathroom' => $hasBathroom,
	'fromDate' => $fromDateString,
	'toDate' => $toDateString,
	'durationUnit' => $durationUnit,
	'durationAmount' => $durationAmount
] );


/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );

# Respond back to client
echo json_encode( $response );
exit;
