<?php
/*
 *
 * The Pricing page
 *
 */
require_once __DIR__ . '/../inc/above.php';



/*
 *
 * Decode the URL and extract the accommodation selection
 *
 */
// $configurationEncoded = $_GET[ 'q' ] ?? null;
// if ( ! $configurationEncoded ) {
// 	header( 'Location: /', true, 302 );
// 	exit;
// }
// try {
// 	$configurationJSON = base64_decode( $configurationEncoded );
// 	$configuration = json_decode( $configurationJSON, true );
// }
// catch ( \Exception $e ) {
// 	header( 'Location: /', true, 302 );
// 	exit;
// }
# for now
$configuration = $_GET;

?>



<!-- Modal Content : What is Included -->
<style type="text/css">
	.what-is-included {}
	@media( min-width: 1040px ) {
		.what-is-included .column-wrap {
			columns: 2;
			column-gap: var(--space-50);
		}
	}
</style>
<div class="js_section_what_is_included">
	<div class="container">
		<div class="row what-is-included">
			<div class="columns small-12 fill-light" style="border-radius: 10px; overflow: hidden;">
				<div class="row space-50-top space-25-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7 qpid_login_site">
						<div class="h3 strong">The <span class="text-green-2 js_name">Buddy</span> Package</div>
						<div class="h2 strong space-min-bottom text-green-2" style="margin-left: calc(var(--space-25) * -1); line-height: 1;">@<span class="js_location">Alta Vista BLR</span></div>
						<div class="h4 strong">For a fee of <span class="text-green-2 js_monthly_expense">₹11,200</span> <span class="js_monthly_fee"></span></div>

						<label class="js_login_trigger_region">
							<span class="label block invisible">Book Now</span>
							<button class="button fill-green js_book_from_modal" data-initial-text="Book Now" data-product="" data-c="">Book Now</button>
						</label>
						<div class="row">
							<div class="columns small-12 medium-6 large-4 xlarge-3"><?php require __DIR__ . '/../inc/login-prompt.php'; ?></div>
						</div>
						<div class="h4 strong space-25-top js_summary space-25-bottom">Gives you access to a Twin Sharing room in a furnished 3 Bedroom Suite. Your room has an attached bathroom and an attached Balcony.</div>
						<div class="virtual-tour-container fill-dark js_virtual_tour_container">
							<iframe class="virtual-tour js_virtual_tour" data-default-src="/media/favicon/favicon.ico" src="/media/favicon/favicon.ico" frameborder="0" data-hj-allow-iframe=""></iframe>
						</div>
					</div>
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-top-bottom text-green-2">What is in your room?</div>
					</div>
					<div class="p columns small-10 small-offset-1 large-8 xlarge-7 column-wrap js_room">
						<span class="p block space-min-bottom js_room">
							<!-- Inset Formated Text -->
						</span>
					</div>
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-top-bottom text-green-2">What is in your suite?</div>
					</div>
					<div class="p columns small-10 small-offset-1 large-8 xlarge-7 column-wrap js_suite">
						<span class="p block space-min-bottom js_suite">
							<!-- Inset Formated Text -->
						</span>
					</div>
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-top-bottom text-green-2">Services that are included?</div>
						<span class="p block space-min-bottom js_services">
							<!-- Inset Formated Text -->
						</span>
					</div>
				</div>
				<div class="row fill-dark space-25-top-bottom" style="background: linear-gradient(15deg, var(--dark) 20%, var(--neutral-4) 100%);">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-bottom">Optional Add-on Services</div>
						<span class="h5 block js_addons">
							<!-- Inset Formated Text -->
						</span>
					</div>
				</div>
				<div class="row space-25-top space-min-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong text-green-2">The <span class="text-dark no-wrap">@</span><span class="text-dark no-wrap js_location">Alta Vista - BLR</span> Campus.</div>
					</div>
				</div>
				<div class="row js_location_images_container">
					<div class="carousel modal-carousel js_carousel_container">
						<div class="carousel-list js_location_images js_carousel_content">
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( 'media/sliding-gallery/5K8A6686.jpg' )"><span class="label caption">Balcony</span></div>
							</div>
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( 'media/sliding-gallery/5K8A6988.jpg' )"><span class="label caption">Entrance</span></div>
							</div>
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( 'media/sliding-gallery/5K8A6647.jpg' )"><span class="label caption">Bedroom</span></div>
							</div>
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( 'media/sliding-gallery/5K8A6541.jpg' )"><span class="label caption">Living Room</span></div>
							</div>
						</div>
						<div class="scroll-controls">
							<div class="row">
								<div class="container">
									<div class="columns small-6">
										<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="media/glyph/32-leftarrow.svg?v=20190917"></div>
									</div>
									<div class="columns small-6 text-right">
										<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="media/glyph/32-rightarrow.svg?v=20190917"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row space-min-top space-50-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="p block space-min-bottom">
							<!-- Inset Formated Text -->
							<b>Address :</b>
							<span class="js_location_address">
								<br>
								Shanders Alta Vista, Veer Sandra, Electronic City,
								<br>
								Bengaluru, Karnataka 560100.
							</span>
						</div>
						<div class="space-25-top space-min-bottom">
							<a href="https://goo.gl/maps/awWKyDwRoEPzcg8t9" target="_blank" class="h6 strong inline-middle js_location_google_maps"><img class="inline-middle" src="media/glyph/24-maps.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- END : What is Included -->





<?php require_once __DIR__ . '/../inc/below.php'; ?>