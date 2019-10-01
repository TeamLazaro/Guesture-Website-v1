<?php
/*
 *
 * This script sets up a global-level settings page.
 *
 */

/*
 *
 * Change the REST API base URL to match the WordPress URL instead of the Site URL
 * 	This is because things break on the admin dashboard; you can't create/edit posts.
 *
 */
add_filter( 'rest_url_prefix', function ( $prefix ) {
	return substr( site_url(), strlen( home_url() ) + 1 ) . '/' . $prefix;
} );



/*
 *
 * Prevent auto-"correction" of URLs
 * 	Based on `https://core.trac.wordpress.org/ticket/16557`
 *
 */
add_filter( 'redirect_canonical', function ( $redirectUrl ) {
	if ( is_404() && ! isset( $_GET[ 'p' ] ) )
		return false;
	else
		return $redirectUrl;
} );


/*
 *
 * Show the Meta-data page if it exists
 *
 */
if ( ! function_exists( 'acf_add_options_page' ) )
	return;

acf_add_options_page( [
	'page_title' => 'Metadata',
	'menu_title' => 'Metadata',
	'menu_slug' => 'metadata',
	'capability' => 'edit_posts',
	'parent_slug' => '',
	'position' => false,
	'icon_url' => 'dashicons-info'
] );
