<?php
/*
 *
 * The "What's Included" page
 *
 * This has been decommissioned in favor of the Bookings page.
 *
 */
$redirectTo = '/booking';
if ( ! empty( $_SERVER[ 'QUERY_STRING' ] ) )
	$redirectTo .= '?' . $_SERVER[ 'QUERY_STRING' ];

return header( 'Location: ' . $redirectTo, true, 302 );
