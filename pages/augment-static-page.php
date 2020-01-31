<?php

$pagePath = $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $_GET[ 'path' ];
$augmentFilePath = __DIR__ . '/../inc/snippets/' . $_GET[ 'with' ] . '.php';

$pageCode = file_get_contents( $pagePath );
$augmentCode = file_get_contents( $augmentFilePath );
// Inject the snippet right before the closing body tag
echo preg_replace( '/<\/body>\s*<\/html>\s*$/', $augmentCode, $pageCode ) . '</body></html>';
