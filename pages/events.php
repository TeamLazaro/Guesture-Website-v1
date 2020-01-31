<?php
/*
 *
 * This is the template for the event pages
 *
 */
if ( empty( $urlSlug ) )
	return header( 'Location: /', true, 302 );

require_once __DIR__ . '/../inc/above.php';

?>





<!-- Post Content -->
<section class="sample-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
				<div class="title"><?= $thePost->post_title ?></div>
			</div>
			<div class="columns small-12">
				<div class="content"><?= getContent( '', 'content' ) ?></div>
			</div>
		</div>
	</div>
</section>
<!-- END: Post Content -->





<?php require_once __DIR__ . '/../inc/below.php'; ?>
