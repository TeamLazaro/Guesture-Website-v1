<?php





/*
 *
 * Pull in the WordPress files if possible
 *
 */
function initWordPress () {
	$configFile = __DIR__ . '/../cms/wp-config.php';
	$configFile__AlternateLocation = __DIR__ . '/../wp-config.php';
	if ( file_exists( $configFile ) || file_exists( $configFile__AlternateLocation ) ) {
		$includeStatus = include_once __DIR__ . '/../cms/index.php';
		if ( $includeStatus ) {
			global $cmsIsEnabled;
			$cmsIsEnabled = true;
			setupVars();
		}
	}
}


/*
 *
 * Is the CMS enabled?
 *
 */
function cmsIsEnabled () {
	global $cmsIsEnabled;
	return $cmsIsEnabled;
}


/*
 *
 * Set up global variables
 *
 */
$pageId = null;
$siteUrl = ( isOnHTTPS() ? 'https://' : 'http://' ) . $_SERVER[ 'HTTP_HOST' ];
$cmsIsEnabled = false;
$thePost = null;
$postId = null;
function setupVars () {
	global $pageId;
	global $siteUrl;
	$pageId = get_the_ID();
	// $siteUrl = preg_replace( '/\/[^\/.]*$/', '', site_url() );
}


/*
 *
 * Get all posts of a certain type
 *
 */
function getPostsOf ( $type, $options = [ ] ) {

	$limit = $options[ 'limit' ] ?? -1;
	$order = $options[ 'order' ] ?? 'DESC';
	$orderBy = $options[ 'orderBy' ] ?? 'date';

	$postStatus = null;
	if ( empty( $options[ 'postStatus' ] ) )
		$postStatus = $type === 'attachment' ? 'inherit' : 'publish';
	else
		$postStatus = $options[ 'postStatus' ];

	$exclude = $options[ 'exclude' ] ?? [ ];
	if ( ! is_array( $exclude ) )
		if ( is_int( $exclude ) )
			$exclude = [ $exclude ];

	$metaKey = $options[ 'metaKey' ] ?? '';

	$posts = get_posts( [
	    'post_type' => $type,
	    'post_status' => $postStatus,
	    'numberposts' => $limit,
	    'orderby' => $orderBy,
	    'meta_key' => $metaKey,
	    'order' => $order,
	    'exclude' => $exclude
	] );

	foreach ( $posts as &$post ) {
		$post = get_object_vars( $post );
	}
	unset( $post );

	return $posts;

}

/*
 *
 * Pull custom content from ACF fields and native post fields from WordPress
 *
 */
function getContent ( $fallback, $field, $context = null ) {

	if ( ! function_exists( 'get_field' ) )
		return $fallback;

	global $thePost;
	global $postType;

	// Setting this value here; used when searching for value recursively
	$contexts = $context ? [ ] : [ 'options' ];

	if ( empty( $context ) ) {
		// If the page is contextual to a post, then set that as the context
		$context = $thePost ? $thePost->ID : 'options';
	}
	else if ( is_string( $context ) ) {
		if ( $context === 'navigation' ) {
			$navigationItems = wp_get_nav_menu_items( $field );
			if ( is_array( $navigationItems ) ) {
				foreach ( $navigationItems as &$item )
					$item = get_object_vars( $item );
					// $item = (array) $item;
				return $navigationItems;
			}
			else
				return $fallback;
		}
		else {
			$page = get_page_by_path( $context, OBJECT, $postType ?: [ 'page', 'attachment' ] );
			if ( empty( $page ) or empty( $page->ID ) )
				$context = 'options';
			else
				$context = $page->ID;
		}
	}


	if ( $context !== 'options' )
		array_unshift( $contexts, $context );
	$fieldParts = preg_split( '/\s*->\s*/' , $field );
	foreach ( $contexts as $currentContext ) {
		$content = get_field( $fieldParts[ 0 ], $currentContext );
		// If no content was found, search in underlying native post object
		if ( empty( $content ) and ! empty( $thePost ) ) {
			if ( $currentContext and ( ! is_string( $currentContext ) ) )
				$content = $thePost->{$fieldParts[ 0 ]};
			if ( empty( $content ) )
				continue;
		}

		$remainderFieldParts = array_slice( $fieldParts, 1 );
		foreach ( $remainderFieldParts as $namespace )
			$content = $content[ $namespace ] ?? [ ];

		if ( ! empty( $content ) )
			break;
	}

	// $content = get_field( $fieldParts[ 0 ], $content );
	// if ( count( $fieldParts ) > 1 ) {
	// 	$content = get_field( $fieldParts[ 0 ], $content );
	// 	$remainderFieldParts = array_slice( $fieldParts, 1 );
	// 	foreach ( $remainderFieldParts as $namespace )
	// 		$content = $content[ $namespace ];
	// }

	if ( empty( $content ) )
		return $fallback;
	else
		return $content;

}


/*
 *
 * Attempts to determine if the site is running on HTTPS.
 *  Borrowed code from the WordPress's `is_ssl` function.
 *
 */
function isOnHTTPS () {

	if ( isset( $_SERVER[ 'HTTPS' ] ) ) {
		if ( strtolower( $_SERVER['HTTPS'] ) == 'on' )
			return true;
		if ( $_SERVER[ 'HTTPS' ] == '1' )
			return true;
	}

	if ( isset( $_SERVER[ 'SERVER_PORT' ] ) )
		if ( $_SERVER[ 'SERVER_PORT' ] == '443' )
			return true;

	if ( isset( $_SERVER[ 'REQUEST_SCHEME' ] ) )
		if ( $_SERVER[ 'REQUEST_SCHEME' ] == 'https' )
			return true;

	return false;

}


/*
 *
 * Figure out if the page being requested has a corresponding template or not
 *
 */
function pageIsStatic () {
	$_post_type = $_GET[ '_post_type' ] ?? null;
	$_slug = $_GET[ '_slug' ] ?? null;
	if ( empty( $_post_type ) )
		return true;
	else if ( empty( $_slug ) )
		return true;
	else
		return false;
	// return empty( $_post_type ) and empty( $_slug );
}



/*
 *
 * Get the current post that the url is refering to
 *
 */
function getCurrentPost ( $slug, $type = null ) {
	if ( cmsIsEnabled() )
		if ( ! empty( $type ) )
			return get_page_by_path( $slug, OBJECT, $type );
		else
			return get_page_by_path( $slug, OBJECT, 'post' ) ?: get_page_by_path( $slug, OBJECT, 'page' );
	else
		return [ ];
}



/*
 *
 * Get the title of the current page
 *
 */
function getCurrentPageTitle ( $siteLinks, $baseURL, $siteTitle ) {

	$currentPageSlug = strstr( $_SERVER[ 'REQUEST_URI' ], '?', true );
	if ( ! $currentPageSlug )
		$currentPageSlug = $_SERVER[ 'REQUEST_URI' ];
	if ( strlen( $currentPageSlug ) <= 1 )
		$currentPageSlug = '/';

		// in case, it is a relative path with dots
	$baseURL = preg_replace( '/\.+/', '', $baseURL );
	$partialPageTitle = 'Untitled';
	foreach ( $siteLinks as $link ) {
		$fullSlug = preg_replace( '/\/+/', '/', $baseURL . $link[ 'slug' ] );
		if ( $currentPageSlug == $fullSlug ) {
			$partialPageTitle = $link[ 'title' ];
			break;
		}
	}
	if ( $partialPageTitle == 'Untitled' and $currentPageSlug == '/' )
		$pageTitle = $siteTitle;
	else
		$pageTitle = $partialPageTitle . ' | ' . $siteTitle;

	return $pageTitle;

}



/*
 *
 * Get a formatted string of the time interval between two dates
 *
 */
function getIntervalString ( $endDateString, $startDateString = null ) {

	// Set default values and build the DateTime objects
	if ( empty( $startDateString ) )
		$dateStart = new DateTime();
	else if ( is_string( $startDateString ) )
		$dateStart = date_create( $startDateString );
	$dateEnd = date_create( $endDateString );

	// Subtract the two dates
	$interval = date_diff( $dateStart, $dateEnd );

	// Build the formatted string
	$stringComponents = [ ];
	if ( $interval->d ) {
		if ( $interval->d === 1 )
			$stringComponents[ ] = '%d day';
		else
			$stringComponents[ ] = '%d days';
	}
	if ( $interval->h ) {
		if ( $interval->h === 1 )
			$stringComponents[ ] = '%h hr';
		else
			$stringComponents[ ] = '%h hrs';
	}
	if ( $interval->i ) {
		if ( $interval->i === 1 )
			$stringComponents[ ] = '%i min';
		else
			$stringComponents[ ] = '%i mins';
	}
	$formattedIntervalString = $interval->format( implode( ', ', $stringComponents ) );

	return $formattedIntervalString;

}



/*
 *
 * Dump the values on the page and onto JavaScript memory, finally end the script
 *
 */
function dd ( $data ) {

	echo '<pre>';
		var_dump( [ 'memory usage' => memory_get_usage() ] );
	echo '</pre>';

	echo '<pre>';
		var_dump( $data );
	echo '</pre>';

	echo '<pre>';
		var_dump( [ 'memory usage' => memory_get_usage() ] );
	echo '</pre>';

	echo '<script>';
		echo '__data = ' . json_encode( $data ) . ';';
	echo '</script>';

	exit;

}
