<?php

require_once __DIR__ . '/guesture.php';

$type = $_POST[ 'type' ];
$location = $_POST[ 'location' ] ?? '';
$hasBalcony = strtolower( $_POST[ 'balcony' ] ) === 'attached' ? 1 : 0;
$hasBathRoom = strtolower( $_POST[ 'bathroom' ] ) === 'attached' ? 1 : 0;
$fromDateString = $_POST[ 'fromDateString' ];
$toDateString = $_POST[ 'toDateString' ];
$duration = $_POST[ 'duration' ];

if ( strtolower( $location ) === 'dwellington - blr' )
	$location = 'dw';
else if ( strtolower( $location ) === 'alta vista - blr' )
	$location = 'av';



$response = Guesture::getUnitAvailability( [
	'type' => $type,
	'location' => $location,
	'hasBalcony' => $hasBalcony,
	'hasBathroom' => $hasBathRoom,
	'fromDate' => $fromDateString,
	'toDate' => $toDateString,
	'duration' => $duration,
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
