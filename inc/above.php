<?php

// Get utility functions
require_once __DIR__ . '/utils.php';
// Include WordPress for Content Management
initWordPress();

/* -- Lazaro disclaimer and footer -- */
require_once __DIR__ . '/lazaro.php';

/*
 * A version number for versioning assets to invalidate the browser cache
 */
$ver = '?v=20181126';

// Pull some data from the request
$urlSlug = $_GET[ '_slug' ] ?? null;
$postType = $_GET[ '_post_type' ] ?? null;

$pageImage = getContent( '', 'page_image', $urlSlug ) ?: getContent( '', 'page_image' );
$pageImage = $pageImage[ 'sizes' ][ 'medium' ] ?: $pageImage[ 'sizes' ][ 'thumbnail' ] ?: $pageImage[ 'url' ];

// #fornow
// Just so that when some social media service (WhatsApp) try to ping URL,
//  	it should not get a 404. This because is setting the response header.
http_response_code( 200 );

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
	prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">

	<?php require_once 'head.php'; ?>

	<body id="body" class="body">

		<?php
			/*
			 * Arbitrary Code ( Top of Body )
			 */
			echo getContent( '', 'arbitrary_code_body_top' );
		?>

	<!--  ★  MARKUP GOES HERE  ★  -->

	<div id="page-wrapper"><!-- Page Wrapper -->

		<?php require_once 'navigation.php'; ?>

		<!-- Page Content -->
		<div id="page-content">
