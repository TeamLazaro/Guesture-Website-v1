<?php

// Get utility functions
require_once __DIR__ . '/utils.php';
// Include WordPress for Content Management
if ( CMS_ENABLED )
	initWordPress();

/* -- Lazaro disclaimer and footer -- */
require_once __DIR__ . '/lazaro.php';

/*
 * A version number for versioning assets to invalidate the browser cache
 */
$ver = '?v=20200103';

/*
 * Get all the links on the site
 */
$defaultLinks = require __DIR__ . '/default-nav-links.php';
$links = getContent( $defaultLinks, 'pages' );

/*
 * Figure out the base URL
 * 	We diff the document root and the directory of this file to determine it
 */
$pathFragments = array_values( array_filter( explode( '/', substr( __DIR__, strlen( $_SERVER[ 'DOCUMENT_ROOT' ] ) ) ) ) );
if ( count( $pathFragments ) > 1 )
	$baseURL = '/' . $pathFragments[ 0 ] . '/';
else
	$baseURL = '/';

/*
 * Get the title and URL of the website and current page
 */
if ( cmsIsEnabled() ) {
	$thePost = getCurrentPost( $urlSlug, $postType );
	if ( empty( $thePost ) and ! in_array( $postType, [ 'page', null ] ) ) {
		// echo 'Please create a corresponding page or post with the slug' . '"' . $urlSlug . '"' . 'in the CMS.';
		http_response_code( 404 );
		return header( 'Location: /', true, 302 );
		exit;
	}
	// If there is neither a corresponding post in the database nor a dedicated template for the given route, return a 404 and redirect
	else if ( empty( $thePost ) and ! $hasDedicatedTemplate ) {
		http_response_code( 404 );
		return header( 'Location: /', true, 302 );
		exit;
	}
	else if ( ! empty( $thePost ) ) {
		$postType = $thePost->post_type;
		$postId = $thePost->ID;
	}
}


// Construct the page's title ( for use in the title tag )
$siteTitle = getContent( 'Guesture', 'site_title' );
$pageUrl = $siteUrl . $requestPath;

// Build the Page Title ( if an explicit one is set, use that )
if ( cmsIsEnabled() and ! empty( $thePost ) )
	$pageTitle = ( $pageTitle ?? $thePost->post_title ) . ' | ' . $siteTitle;
else
	$pageTitle = empty( $pageTitle ) ? $siteTitle : ( $pageTitle . ' | ' . $siteTitle );


// Get the page's image for SEO and other related purposes
$pageImage = getContent( '', 'page_image', $urlSlug ) ?: getContent( '', 'page_image' );
if ( ! empty( $pageImage[ 'sizes' ] ) )
	$pageImage = $pageImage[ 'sizes' ][ 'medium' ] ?: $pageImage[ 'sizes' ][ 'thumbnail' ] ?: $pageImage[ 'url' ];
else
	$pageImage = $pageImage[ 'url' ] ?? null;

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

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WN3Z6CT" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<?php
			/*
			 * Arbitrary Code ( Top of Body )
			 */
			echo getContent( '', 'arbitrary_code_body_top' );
		?>

	<!--  ★  MARKUP GOES HERE  ★  -->

	<div id="page-wrapper"><!-- Page Wrapper -->

		<?php // require_once 'navigation.php'; ?>

		<!-- Page Content -->
		<div id="page-content">
