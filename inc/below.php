
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

	<?php // lazaro_disclaimer(); ?>









	<!-- JS Modules -->
	<script type="text/javascript">
		window.__BFS = window.__BFS || { };

		// Check and establish support for features
		window.__BFS.support = window.__BFS.support || { };
		window.__BFS.support.webShare = navigator.share ? true : false;

	</script>
	<script type="text/javascript" src="/js/modules/utils.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/navigation.js<?= $ver ?>"></script>
	<!-- <script type="text/javascript" src="/js/modules/device-charge.js"></script> -->
	<script type="text/javascript" src="/js/modules/video_embed.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/modal_box.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/sliding-gallery.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/cupid/utils.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/cupid/user.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/forms.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/login-prompts.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/carousel.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/plugins/lottie/lottie-lite-v5.5.10.min.js"></script>
	<script type="text/javascript" src="/js/modules/scroll-reveal.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/spreadsheet-formulae.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/plugins/xlsx-calc/xlsx-calc-v0.6.2.min.js"></script>
	<script type="text/javascript" src="/js/pricing.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/countdown.js<?= $ver ?>"></script>

	<?php if ( $urlSlug === 'what-is-included' ) : ?>
		<script type="text/javascript" src="/js/pages/what-is-included/login-prompts.js<?= $ver ?>"></script>
		<script type="text/javascript">
			window.__BFS.accomodationSelection = <?= json_encode( $configuration ) ?>;
		</script>
		<script type="text/javascript" src="/js/pages/what-is-included/what-is-included.js<?= $ver ?>"></script>
	<?php else : ?>
		<script type="text/javascript" src="/js/pages/home/login-prompts.js<?= $ver ?>"></script>
		<script type="text/javascript" src="/js/pages/home/home.js<?= $ver ?>"></script>
	<?php endif; ?>

	<!-- spirit web player -->
	<script src="https://unpkg.com/spiritjs/dist/spirit.min.js"></script>

	<!-- Countdown Timers -->
	<script type="text/javascript">

		$( function () {

			$( ".js_countdown" ).each( function ( _i, el ) {
				countdown( new Date( el.dataset.date ), el );
			} )

		} );

	</script>

	<!-- play animation -->
	<script>
	  // spirit.loadAnimation({
	  //   autoPlay: true,
	  //   path: './spirit-animation.json',
	  // })

	  // load GSAP Tween and Timeline from CDN
	  spirit.setup().then(() => {

	    // next, load the animation data
	    // exported with Spirit Studio
	    spirit.load('./lamp.json').then(groups => {

	      // our animation can have multiple animation groups
	      // lets get the first
	      const group = groups.at(0);

	      // construct it
	      // (this assembles a GSAP Timeline)
	      const timeline = group.construct();

	      // and finally play it
	      	timeline.play();
	    })
	  })
	</script>


	<script type="text/javascript">

		/*
		 *
		 * Tell to Cupid that the user dropped by
		 *
		 */
		$( function () {

			var user = __CUPID.utils.getUser();
			if ( user ) {
				setTimeout( function () {
					__CUPID.utils.getAnalyticsId()
						.then( function ( deviceId ) {
							user.hasDeviceId( deviceId );
							user.isOnWebsite();
						} )
				}, 1500 );
			}

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
