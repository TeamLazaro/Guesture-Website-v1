
			<!-- ~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/ -->
			<!-- Page-specific content goes here. -->
			<!-- ~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/~/ -->

		</div> <!-- END : Page Content -->


		<!-- Lazaro Signature -->
		<?php lazaro_signature(); ?>
		<!-- END : Lazaro Signature -->

	</div><!-- END : Page Wrapper -->

	<?php require_once 'modals.php' ?>

	<!--  ☠  MARKUP ENDS HERE  ☠  -->

	<?php lazaro_disclaimer(); ?>









	<!-- JS Modules -->
	<script type="text/javascript" src="/js/modules/utils.js"></script>
	<!-- <script type="text/javascript" src="/js/modules/device-charge.js"></script> -->
	<script type="text/javascript" src="/js/modules/video_embed.js"></script>
	<script type="text/javascript" src="/js/modules/modal_box.js"></script>
	<script type="text/javascript" src="/js/modules/disclaimer.js"></script>
	<script type="text/javascript" src="/js/modules/sliding-gallery.js"></script>
	<script type="text/javascript" src="/js/modules/cupid/utils.js"></script>
	<script type="text/javascript" src="/js/modules/cupid/user.js"></script>
	<script type="text/javascript" src="/js/forms.js"></script>
	<script type="text/javascript" src="/js/login-prompts.js"></script>

	<script type="text/javascript">

		$( function () {
			//
		} );

	</script>

	<!-- Other Modules -->
	<?php // require __DIR__ . '/inc/can-user-hover.php' ?>


	<?php
		/*
		 * Arbitrary Code ( Bottom of Body )
		 */
		echo getContent( '', 'arbitrary_code_body_bottom' );
	?>

</body>

</html>
