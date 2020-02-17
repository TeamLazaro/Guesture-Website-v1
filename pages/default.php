<?php
/*
 *
 * This is a template for default pages and posts
 *
 */
require_once __DIR__ . '/../inc/above.php';

if ( $postType === 'page' )
	require_once __DIR__ . '/default-page.php';
else
	require_once __DIR__ . '/default-post.php';

require_once __DIR__ . '/../inc/below.php';

?>
