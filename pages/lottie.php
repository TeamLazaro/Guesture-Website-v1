<!DOCTYPE html>
<html>
<head>

	<title></title>

	<style>

		body {
			background-color:#fff;
			margin: 0px;
			height: 100%;
			overflow: hidden;
		}

		.lottie-animation {
			display: block;
			width: 100%;
			height: 100%;
			background-color: transparent;
			overflow: hidden;
			transform: translate3d( 0, 0, 0 );
			text-align: center;
			opacity: 1;
		}

	</style>

</head>

<body>

	<!-- Score out -->
	<div class="lottie-animation scratch"></div>

	<!-- Monthly Fee -->
	<!-- <div class="lottie-animation monthly-fee"></div> -->

	<script type="text/javascript" src="plugins/jquery/jquery-3.0.0.min.js"></script>
	<script type="text/javascript" src="plugins/lottie/lottie-lite-v5.5.10.min.js"></script>

	<script type="text/javascript">

		/*
		 *
		 * Score out
		 *
		 */
		var scoreOut__AnimationData = <?php require __DIR__ . '/../media/sparkle/score-out/Score Out.json' ?>;

		$( ".scratch" ).each( function ( _i, domEl ) {

			var params = {
				container: domEl,
				renderer: "svg",
				autoplay: false,
				animationData: scoreOut__AnimationData
			};

			var animation = lottie.loadAnimation( params );
			animation.play();

		} );

		/*
		 *
		 * Monthly Fee
		 *
		 */
		var monthlyFee__AnimationData = <?php require __DIR__ . '/../media/sparkle/monthly-fee/Monthly Fee.json' ?>;

		$( ".monthly-fee" ).each( function ( _i, domEl ) {

			var params = {
				container: domEl,
				renderer: "svg",
				autoplay: false,
				animationData: monthlyFee__AnimationData
			};

			var animation = lottie.loadAnimation( params );
			animation.play();

		} );

	</script>

</body>
</html>
