<?php
/*
 *
 * This is a sample page you can copy and use as boilerplate for any new page.
 *
 */

// Page-specific preparatory code goes here.

?>

<?php require_once __DIR__ . '/../inc/above.php'; ?>





<!-- Sample Section -->
<section class="sample-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
			</div>
		</div>
	</div>
</section>
<!-- END: Sample Section -->


<!-- Intro Section -->
<section class="intro-section fill-green-1 space-150-top-bottom" style="background-image: linear-gradient(-135deg, transparent 60%, var(--yellow) 100%), url('../../../media/characters/intro-section/char-<?php echo rand( 1, 5 ) ?>.png?v=20181126'), url('../../../media/characters/intro-section/intro-section-bg-px.png?v=20181126');">
	<div class="container">
		<div class="intro row space-50-bottom">
			<div class="columns small-10 small-offset-1">
				<div class="logo h0 text-green-1 space-25-bottom"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350" style="-webkit-filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25)); filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25));"><text style="opacity: 0;">Guesture</text><g fill="#00A390"><path d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9zM189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></g></svg></div>
				<div class="h2">Just bring your bag.</div>
				<div class="h3">Say no to landlords, brokers and rent.</div>
				<div class="h3 strong">Try Coliving instead.</div>
			</div>
		</div>
		<div class="points row">
			<div class="columns small-10 small-offset-1 large-3">
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-clock.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">10 min <br>
					Check-in</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-work.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left text-light"><strong>STAY Packages</strong> for <br>
					1 day to 60 days</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-house.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left text-light"><strong>LIVE Packages</strong> for <br>
					2 months to 7 years</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-living.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Fully <br>
					Furnished</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-internet.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">High Speed <br>
					Internet</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-women.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Women's only <br>
					Block</div>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 large-3 xlarge-offset-0">
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-night.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">24x7 Lift and <br>
					Power Backup</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-housekeeping.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Hotel Style <br>
					Housekeeping</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-game.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Dedicated Gaming <br>
					and Chilling Areas</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-safe.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Round-the-clock <br>
					Security</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-meal.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Fully Stocked <br>
					Cafeteria</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Intro Section -->



<!-- Booking Section -->
<section class="booking-section space-150-top-bottom">
	<div class="container">
		<div class="row">
			<div class="intro columns small-10 small-offset-1 js_location_selector_container">
				<div class="label text-neutral-3 text-uppercase space-min-bottom">Location</div>
				<div class="h4 text-green-2 strong">Coliving with like-minded people</div>
				<div class="h2 text-green-2">Guesture <span class="no-wrap js_place" style="text-transform: capitalize;">@Alta Vista</span></div>
				<div class="h4 text-green-2 strong inline hide-for-small">in</div>
				<select class="inline minimal xl js_places_near_to"><option>BLR - Electronic City Phase 1</option></select>
				<div class="space-min-top">
					<a href="https://goo.gl/maps/awWKyDwRoEPzcg8t9" target="_blank" class="h6 text-dark strong inline-middle"><img class="inline-middle" src="media/glyph/24-maps.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Workplaces -->
	<div class="workplaces carousel block space-50-top-bottom js_workplaces js_carousel_container" data-name="alta vista">
		<div class="carousel-list js_carousel_content">
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-hcl.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">9min</div>
						<div class="h6 strong text-neutral-2">to HCL Technologies</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-infosys.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">12min</div>
						<div class="h6 strong text-neutral-2">to Infosys Campus</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-velankani.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">10min</div>
						<div class="h6 strong text-neutral-2">to Velankani Campus</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-wipro.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">13min</div>
						<div class="h6 strong text-neutral-2">to WIPRO</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-biocon.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">15min</div>
						<div class="h6 strong text-neutral-2">to BioCon</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-hp.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">9min</div>
						<div class="h6 strong text-neutral-2">to Hewlett Packard</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-siemens.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">15min</div>
						<div class="h6 strong text-neutral-2">to Siemens</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-tata.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">17min</div>
						<div class="h6 strong text-neutral-2">to Tata BP Solar</div>
					</div>
				</div>
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
	<div class="workplaces carousel block space-50-top-bottom hidden js_workplaces js_carousel_container" data-name="dwellington">
		<div class="carousel-list js_carousel_content">
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-siemens.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">20min</div>
						<div class="h6 strong text-neutral-2">to Siemens</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-tata.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">20min</div>
						<div class="h6 strong text-neutral-2">to Tata Consultancy Services</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-techmahindra.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">20min</div>
						<div class="h6 strong text-neutral-2">to Tech Mahindra</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-infosys.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">22min</div>
						<div class="h6 strong text-neutral-2">to Infosys Campus</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-biocon.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">29min</div>
						<div class="h6 strong text-neutral-2">to BioCon</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="media/icons/icon-ge.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">28min</div>
						<div class="h6 strong text-neutral-2">to GE Intelligent Platforms</div>
					</div>
				</div>
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
	<!-- End: Workplaces -->
	<!-- Pricing -->
	<div class="pricing js_carousel_container">
		<div class="pricing-list js_carousel_content">
			<div class="price fill-light js_carousel_item qpid_login_site js_solo_section">
				<div class="character"><img class="block" src="media/characters/pricing/solo-1.png<?php echo $ver ?>"></div>
				<div class="title block h3 strong text-light text-uppercase text-center">Solo</div>
				<div class="thumbnail"><img class="js_image" src="media/pricing/rooms/av-solo.jpg<?php echo $ver ?>"></div>
				<div class="intro space-min">
					<div class="heading h5 strong text-green-2 opacity-50 space-min-top">A Dedicated room in a 2 or 3 Bedroom Suite.</div>
					<div class="description h6 text-green-2">Preferred by Managers living alone in Bangalore, away from their family.</div>
				</div>
				<div class="config space-min">
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Balcony</div>
						<select class="minimal inline js_attribute js_balcony" data-name="balcony">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Bathroom</div>
						<select class="minimal inline js_attribute js_bathroom" data-name="bathroom">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Live</div>
						<select class="minimal inline js_attribute js_duration" data-name="duration">
							<option>3 Months</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline alt-font">@</div>
						<select class="minimal inline js_attribute js_location" data-name="location">
							<option>Alta Vista - BLR</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">View</div>
						<select class="minimal inline js_attribute js_view" data-name="view">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">A/C</div>
						<select class="minimal inline js_attribute js_ac" data-name="a/c">
							<option>Non A/C Room</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Smoking</div>
						<select class="minimal inline js_attribute js_smoking" data-name="smoking">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Diet</div>
						<select class="minimal inline js_attribute js_diet" data-name="diet">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="space-25-bottom">
						<!-- <a href="" class="included js_modal_trigger label strong text-uppercase float-right" data-mod-id="sample-video">What is included <img class="inline-top" width="14px" src="media/glyph/question-dark.svg<?php echo $ver ?>"></a> -->
					</div>
				</div>
				<div class="action text-center space-25-bottom">
					<div class="h4 data strong text-dark text-uppercase js_daily_expense">₹726 Per Day</div>
					<div class="h4 strong text-dark text-uppercase">Ooops!</div>
					<div class="label strong text-neutral-3 text-uppercase js_monthly_expense">₹21800 Per Month</div>
					<div class="h6 strong text-red text-uppercase">No Rooms Found</div>
				</div>
				<label class="block space-min-bottom js_login_trigger_region">
					<span class="label inline text-neutral-1 text-uppercase invisible">Book</span>
					<button class="button block fill-green-2 js_book_solo" data-product="Solo" data-c="pricing-book-solo">Book Now</button>
				</label>
				<!-- Phone Trap form -->
				<form class="js_phone_form" style="display: none">
					<div class="form-row columns small-12 _medium-6" style="position: relative">
						<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
						<div class="phone-trap minimal phone-number">
							<div class="block prefix-group" style="position: relative">
								<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
									<?php include __DIR__ . '/../inc/phone-country-codes.php' ?>
								</select>
								<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
							</div>
							<input class="phone block" type="text" name="phone-number">
							<label class="submit block">
								<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
								<button class="button block">→</button>
							</label>
						</div>
					</div>
				</form>
				<!-- OTP form -->
				<form class="js_otp_form" style="display: none;">
					<div class="form-row columns small-12 _medium-6">
						<div class="otp-trap minimal">
							<label class="block">
								<span class="label inline text-neutral-1 text-uppercase">Enter the OTP</span>
								<input class="otp block" type="text" name="otp">
							</label>
							<label class="submit block">
								<span class="invisible label inline text-neutral-1 text-uppercase">Submit</span>
								<button class="button block">→</button>
							</label>
						</div>
					</div>
					<br>
					<div class="form-row columns small-12 large-6 clearfix hidden">
						<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
						<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
					</div>
				</form>
			</div>
			<div class="price fill-green-2 js_carousel_item qpid_login_site js_buddy_section" style="background: linear-gradient(45deg, var(--green-2) 60%, var(--yellow) 100%);">
				<div class="character"><img class="block" src="media/characters/pricing/buddy-1.png<?php echo $ver ?>"></div>
				<div class="title block h3 strong text-light text-uppercase text-center">Buddy</div>
				<div class="thumbnail"><img class="js_image" src="media/pricing/rooms/av-buddy.jpg<?php echo $ver ?>"></div>
				<div class="intro space-min">
					<div class="heading h5 strong opacity-50 space-min-top">Twin Sharing room in a 2 or 3 Bedroom Suite.</div>
					<div class="description h6">Preferred by corporate professionals living alone in Bangalore.</div>
				</div>
				<div class="config space-min">
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Balcony</div>
						<select class="minimal dark inline js_attribute js_balcony" data-name="balcony">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Bathroom</div>
						<select class="minimal dark inline js_attribute js_bathroom" data-name="bathroom">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Live</div>
						<select class="minimal dark inline js_attribute js_duration" data-name="duration">
							<option>3 Months</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline alt-font">@</div>
						<select class="minimal dark inline js_attribute js_location" data-name="location">
							<option>Alta Vista - BLR</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">View</div>
						<select class="minimal dark inline js_attribute js_view" data-name="view">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">A/C</div>
						<select class="minimal dark inline js_attribute js_ac" data-name="a/c">
							<option>Non A/C Room</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Smoking</div>
						<select class="minimal dark inline js_attribute js_smoking" data-name="smoking">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Diet</div>
						<select class="minimal dark inline js_attribute js_diet" data-name="diet">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="space-25-bottom">
						<!-- <a href="" class="included js_modal_trigger label strong text-uppercase float-right" data-mod-id="sample-video">What is included <img class="inline-top" width="14px" src="media/glyph/question-light.svg<?php echo $ver ?>"></a> -->
					</div>
				</div>
				<div class="action text-center space-25-bottom">
					<div class="h4 sparkle title-2-left title-2-right data strong text-uppercase js_daily_expense">₹726 Per Day</div>
					<div class="h4 strong text-uppercase">Ooops!</div>
					<div class="label strong text-uppercase opacity-50 js_monthly_expense">₹21800 Per Month</div>
					<div class="h6 strong text-uppercase text-yellow">No Rooms Found</div>
				</div>
				<label class="block space-min-bottom js_login_trigger_region">
					<span class="label inline text-neutral-1 text-uppercase invisible">Book</span>
					<button class="button block js_book_buddy" data-product="Buddy" data-c="pricing-book-buddy">Book Now</button>
				</label>
				<!-- Phone Trap form -->
				<form class="js_phone_form" style="display: none">
					<div class="form-row columns small-12 _medium-6" style="position: relative">
						<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
						<div class="phone-trap minimal phone-number">
							<div class="block prefix-group" style="position: relative">
								<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
									<?php include __DIR__ . '/../inc/phone-country-codes.php' ?>
								</select>
								<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
							</div>
							<input class="phone block" type="text" name="phone-number">
							<label class="submit block">
								<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
								<button class="button block">→</button>
							</label>
						</div>
					</div>
				</form>
				<!-- OTP form -->
				<form class="js_otp_form" style="display: none;">
					<div class="form-row columns small-12 _medium-6">
						<div class="otp-trap minimal">
							<label class="block">
								<span class="label inline text-neutral-1 text-uppercase">Enter the OTP</span>
								<input class="otp block" type="text" name="otp">
							</label>
							<label class="submit block">
								<span class="invisible label inline text-neutral-1 text-uppercase">Submit</span>
								<button class="button block">→</button>
							</label>
						</div>
					</div>
					<br>
					<div class="form-row columns small-12 large-6 clearfix hidden">
						<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
						<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
					</div>
				</form>
			</div>
			<div class="price fill-light js_carousel_item qpid_login_site js_trio_section">
				<div class="character"><img class="block" src="media/characters/pricing/trio-1.png<?php echo $ver ?>"></div>
				<div class="title block h3 strong text-light text-uppercase text-center">Trio</div>
				<div class="thumbnail"><img class="js_image" src="media/pricing/rooms/av-trio.jpg<?php echo $ver ?>"></div>
				<div class="intro space-min">
					<div class="heading h5 strong text-green-2 opacity-50 space-min-top">Triple Sharing room in a 2 or 3 Bedroom Suite.</div>
					<div class="description h6 text-green-2">Preferred by Students, Interns and Trainees living alone in Bangalore.</div>
				</div>
				<div class="config space-min">
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Balcony</div>
						<select class="minimal inline js_attribute js_balcony" data-name="balcony">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Bathroom</div>
						<select class="minimal inline js_attribute js_bathroom" data-name="bathroom">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Live</div>
						<select class="minimal inline js_attribute js_duration" data-name="duration">
							<option>3 Months</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline alt-font">@</div>
						<select class="minimal inline js_attribute js_location" data-name="location">
							<option>Alta Vista - BLR</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">View</div>
						<select class="minimal inline js_attribute js_view" data-name="view">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">A/C</div>
						<select class="minimal inline js_attribute js_ac" data-name="a/c">
							<option>Non A/C Room</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Smoking</div>
						<select class="minimal inline js_attribute js_smoking" data-name="smoking">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Diet</div>
						<select class="minimal inline js_attribute js_diet" data-name="diet">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="space-25-bottom">
						<!-- <a href="" class="included js_modal_trigger label strong text-uppercase float-right" data-mod-id="sample-video">What is included <img class="inline-top" width="14px" src="media/glyph/question-dark.svg<?php echo $ver ?>"></a> -->
					</div>
				</div>
				<div class="action text-center space-25-bottom">
					<div class="h4 data strong text-uppercase js_daily_expense">₹726 Per Day</div>
					<div class="h4 strong text-uppercase">Ooops!</div>
					<div class="label strong text-uppercase text-neutral-3 js_monthly_expense">₹21800 Per Month</div>
					<div class="h6 strong text-uppercase text-red">No Rooms Found</div>
				</div>
				<label class="block space-min-bottom js_login_trigger_region">
					<span class="label inline text-neutral-1 text-uppercase invisible">Book</span>
					<button class="button block fill-green-2 js_book_trio" data-product="Trio" data-c="pricing-book-trio">Book Now</button>
				</label>
				<!-- Phone Trap form -->
				<form class="js_phone_form" style="display: none">
					<div class="form-row columns small-12 _medium-6" style="position: relative">
						<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
						<div class="phone-trap minimal phone-number">
							<div class="block prefix-group" style="position: relative">
								<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
									<?php include __DIR__ . '/../inc/phone-country-codes.php' ?>
								</select>
								<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
							</div>
							<input class="phone block" type="text" name="phone-number">
							<label class="submit block">
								<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
								<button class="button block">→</button>
							</label>
						</div>
					</div>
				</form>
				<!-- OTP form -->
				<form class="js_otp_form" style="display: none;">
					<div class="form-row columns small-12 _medium-6">
						<div class="otp-trap minimal">
							<label class="block">
								<span class="label inline text-neutral-1 text-uppercase">Enter the OTP</span>
								<input class="otp block" type="text" name="otp">
							</label>
							<label class="submit block">
								<span class="invisible label inline text-neutral-1 text-uppercase">Submit</span>
								<button class="button block">→</button>
							</label>
						</div>
					</div>
					<br>
					<div class="form-row columns small-12 large-6 clearfix hidden">
						<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
						<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
					</div>
				</form>
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
	<!-- End: Pricing -->
	<div class="container">
		<div class="row">
			<div class="checkin columns small-10 small-offset-1 space-100-top">
				<div class="label text-neutral-3 text-uppercase space-min-bottom">Check-in</div>
				<div class="h3 strong text-green-2 space-min-bottom">10 Minute Check-in</div>
				<div class="h4 text-neutral-3">Just carry <span class="strong text-green-2 sparkle title-3-left title-3-right">any one</span> of these KYC documents for a quick check-in.</div>
			</div>
			<div class="checkin columns small-10 small-offset-1 xlarge-9">
				<div class="row space-min-top-bottom">
					<div class="columns small-12 medium-6 large-3 space-min-bottom">
						<div class="icon inline-middle"><img src="media/icons/icon-aadhar.svg<?php echo $ver ?>"></div>
						<div class="h6 strong text-green-2 text-uppercase inline-middle">AADHAR Card</div>
					</div>
					<div class="columns small-12 medium-6 large-3 space-min-bottom">
						<div class="icon inline-middle"><img src="media/icons/icon-driverlicense.svg<?php echo $ver ?>"></div>
						<div class="h6 strong text-green-2 text-uppercase inline-middle">Driver’s License</div>
					</div>
					<div class="columns small-12 medium-6 large-3 space-min-bottom">
						<div class="icon inline-middle"><img src="media/icons/icon-voterid.svg<?php echo $ver ?>"></div>
						<div class="h6 strong text-green-2 text-uppercase inline-middle">Voter’s ID Card</div>
					</div>
					<div class="columns small-12 medium-6 large-3 space-min-bottom">
						<div class="icon inline-middle"><img src="media/icons/icon-passport.svg<?php echo $ver ?>"></div>
						<div class="h6 strong text-green-2 text-uppercase inline-middle">Passport</div>
					</div>
				</div>
				<div class="h6 strong text-uppercase">Full KYC Policy ›</div>
			</div>
			<div id="contact" class="contact columns small-10 small-offset-1 space-100-top space-25-bottom">
				<div class="label text-neutral-3 text-uppercase space-min-bottom">Contact-us</div>
				<div class="h2 text-green-2">Request a <span class="no-wrap">call-back</span></div>
			</div>
			<div class="contact columns small-10 small-offset-1 large-8">
				<div class="contact-form row space-100-bottom qpid_login_site js_contact_form_section" data-c="general-enquiry-form">
					<form class="js_contact_form">
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="label inline text-neutral-3 text-uppercase">Full Name</span>
								<input class="name block" type="text" name="name">
							</label>
						</div>
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="label inline text-neutral-3 text-uppercase">Email Id</span>
								<input class="email block" type="text" name="email-address">
							</label>
						</div>
						<div class="form-row columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-3 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap phone-number">
								<div class="inline prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __DIR__ . '/../inc/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block" type="text" name="phone-number">
							</div>
						</div>
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="invisible label inline text-neutral-3 text-uppercase">Submit</span>
								<button class="block" type="submit">Contact</button>
							</label>
						</div>
					</form>
					<!-- OTP form -->
					<form class="js_otp_form" style="display: none">
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="label inline text-neutral-3 text-uppercase">Enter the OTP</span>
								<input class="block" type="text" name="otp">
							</label>
						</div>
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="invisible label inline text-neutral-3 text-uppercase">Submit</span>
								<button class="block">Verify</button>
							</label>
						</div>
						<br>
						<div class="form-row columns small-12 large-6 clearfix hidden">
							<div class="label strong text-green-2 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
							<div class="label strong text-green-2 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
						</div>
					</form>
				</div>
				<a href="tel:+91-82877-70011" class="h3 strong inline"><span class="sparkle or-light h5 strong text-green-2 text-uppercase">or</span> Call us on <span class="sparkle or-number-light text-green-2 no-wrap">+91-828-7770011</span></a>
			</div>
		</div>
	</div>
</section>
<!-- END: Booking Section -->



<!-- Trial : Trap Section -->
<section class="trial--trap-section fill-green-2 js_trial_section qpid_login_site">
	<div class="container">
		<div class="character"><img src="media/characters/trial-trap/char-1.png<?php echo $ver ?>"></div>
		<div class="trap row space-150-top-bottom">
			<div class="columns small-10 small-offset-1 medium-6 large-10">
				<div class="h3 strong"><span class="opacity-50">Book a </span><span class="sparkle title-1-left title-1-right">3 Day Trial</span><span class="opacity-50"> online today</span></div>
				<div class="h4 space-25-bottom">Come experience <span class="no-wrap">like-minded</span> coliving.</div>
				<div class="points">
					<div class="point label text-uppercase space-min-bottom">3 days and 2 nights</div>
					<div class="point label text-uppercase space-min-bottom">Money back guarantee *</div>
				</div>
				<div class="small opacity-50">* If cancelled within 36 hours of check-in</div>
			</div>
			<div class="columns small-10 small-offset-1">
				<div class="h0 text-green-2 space-25-top">₹1199</div>
			</div>
			<div class="columns small-10 small-offset-1">
				<div class="action row">
					<!-- Phone Trap Trigger -->
					<label class="phone-trap-trigger form-row columns small-12 medium-6 large-4 js_login_trigger_region">
						<span class="invisible label inline text-neutral-1 text-uppercase">Book Now</span>
						<a class="button block js_book_trial" href="https://www.instamojo.com/guesture/3-day-trial-stay/" target="_blank" data-c="three-day-trial">Book Now</a>
					</label>
					<br>
					<!-- Phone Trap form -->
					<form class="js_phone_form" style="display: none">
						<div class="form-row columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap minimal phone-number">
								<div class="block prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __DIR__ . '/../inc/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block" type="text" name="phone-number">
								<label class="submit block">
									<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
									<button class="button block">→</button>
								</label>
							</div>
						</div>
					</form>
					<!-- OTP form -->
					<form class="js_otp_form" style="display: none">
						<div class="form-row columns small-12 medium-6">
							<div class="otp-trap minimal">
								<label class="block">
									<span class="label inline text-neutral-1 text-uppercase">Enter the OTP</span>
									<input class="otp block" type="text" name="otp">
								</label>
								<label class="submit block">
									<span class="invisible label inline text-neutral-1 text-uppercase">Submit</span>
									<button class="button block">→</button>
								</label>
							</div>
						</div>
						<br>
						<div class="form-row columns small-12 large-6 clearfix hidden">
							<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
							<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Trial : Trap Section -->



<!-- Live Section -->
<section class="live-section space-150-top-bottom">
	<div class="container">
		<div class="intro row">
			<div class="columns small-10 small-offset-1 large-6">
				<div class="h2 text-green-2 space-min-bottom">The Environment at Guesture</div>
				<div class="h3 text-neutral-5 space-min-bottom">we built cultural spaces into your environment.</div>
			</div>
			<div class="description columns small-10 small-offset-1 medium-8 large-7 xlarge-6 space-50-bottom">
				<div class="h5 text-green-2 strong space-min-bottom">Urban living often forces people to abandon their passions & interests.</div>
				<div class="h6 text-neutral-4">The environment at Guesture is designed and built to provide interaction spaces, spaces for yoga and meditation, studio and amphitheater spaces for cultural activities, coworking spaces for working, sports areas for pursuing fitness and sports interests, and an overall sustainable system which does not hurt nature or the environment.</div>
			</div>
		</div>
		<div class="amenities points row space-50-bottom">
			<div class="columns small-10 small-offset-1 medium-5 large-3">
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-pool.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Swimming Pool</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-gym.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Gymnasium</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-amphitheater.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Amphitheater</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-tabletennis.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Table Tennis</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-tennis.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Tennis Courts</div>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-5 medium-offset-0 large-3 large-offset-1 xlarge-offset-0">
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-yoga.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Yoga Hall</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-snooker.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Snooker Tables</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-laundry.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Laundry</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-meditation.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Meditation Hall</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-openairscreen.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Open Air Screen</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Sliding Gallery -->
	<div class="sliding-gallery block js_sliding_gallery">
		<div class="container-track">
			<div class="track js_track">
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7261.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7140.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6519.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6793.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6875.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7181.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7190.jpg' )">
				</div>
			</div>
		</div>
		<div class="container-track">
			<div class="track js_track">
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6686.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6988.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6647.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6541.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6968.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6595.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6703.jpg' )">
				</div>
			</div>
		</div>
		<div class="container-track">
			<div class="track js_track">
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6838.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6772.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7102.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7009.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7493.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A4978.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6581.jpg' )">
				</div>
			</div>
		</div>
	</div>
	<!-- END: Sliding Gallery -->
	<div class="container">
		<div class="amenities points row space-50-top">
			<div class="columns small-10 small-offset-1 medium-5 large-3">
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-basketball.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Basket Ball Court</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-bowling.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Outdoor Bowling Alley</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-football.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Mini Football Courts</div>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-5 medium-offset-0 large-3 large-offset-1 xlarge-offset-0">
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-doctor.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Doctor on-call</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-shuttle.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Shuttle Bus Service</div>
				</div>
				<div class="point">
					<div class="icon inline-middle"><img src="media/icons/icon-canteen.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Cafeteria</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Live Section -->


<!-- Womens Block : Trap Section -->
<section class="womens-block--trap-section fill-red js_women_block_section qpid_login_site">
	<div class="container">
		<div class="character"><img src="media/characters/women-trap/char-1.png<?php echo $ver ?>"></div>
		<div class="trap row space-150-top-bottom">
			<div class="columns small-10 small-offset-1 xlarge-9 space-50-top-bottom">
				<div class="h3 strong"><span class="opacity-50">Peace of mind for you and </span><span class="sparkle title-2-left title-2-right">your parents</span></div>
				<div class="h0 text-red space-25-bottom">womens only block</div>
				<div class="action row">
					<!-- Phone Trap Trigger -->
					<label class="phone-trap-trigger form-row columns small-12 medium-6 large-4 js_login_trigger_region">
						<span class="invisible label inline text-neutral-1 text-uppercase">Book Now</span>
						<button class="button block js_book_womens_block" data-c="block-women-room">Book Now</button>
					</label>
					<br>
					<!-- Phone Trap form -->
					<form class="js_phone_form" style="display: none">
						<div class="form-row columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap minimal phone-number">
								<div class="block prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __DIR__ . '/../inc/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block" type="text" name="phone-number">
								<label class="submit block">
									<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
									<button class="button block">→</button>
								</label>
							</div>
						</div>
					</form>
					<!-- OTP form -->
					<form class="js_otp_form" style="display: none">
						<div class="form-row columns small-12 medium-6">
							<div class="otp-trap minimal">
								<label class="block">
									<span class="label inline text-neutral-1 text-uppercase">Enter the OTP</span>
									<input class="otp block" type="text" name="otp">
								</label>
								<label class="submit block">
									<span class="invisible label inline text-neutral-1 text-uppercase">Submit</span>
									<button class="button block">→</button>
								</label>
							</div>
						</div>
						<br>
						<div class="form-row columns small-12 large-6 clearfix hidden">
							<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-left" tabindex="-1">Re-send OTP</div>
							<div class="label strong text-neutral-1 opacity-50 text-uppercase inline-middle cursor-pointer float-right" tabindex="-1">Enter different number</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Womens Block : Trap Section -->


<!-- Testimonial Section -->
<section class="testimonial-section space-150-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1 large-7">
				<div class="h2 text-green-2">Coliving with <br>like-minded people</div>
			</div>
			<div class="columns small-10 small-offset-1 large-6 xlarge-5">
				<div class="h3">CoLiving is more than just shared living spaces.</div>
			</div>
		</div>
	</div>
	<!-- Testimonials -->
	<div class="testimonials carousel block space-50-top-bottom js_carousel_container">
		<div class="carousel-list js_carousel_content">
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/vibha.jpg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Dr Vibha</div>
						<div class="designation label text-uppercase">MD Swajal Water</div>
						<div class="quote label text-neutral-4 space-min-top">We had a very nice stay here. The staff is quite courteous and room are quite neat and clean.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/saira.png<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Saira Philipose</div>
						<div class="designation label text-uppercase">Operations Senior Manager, Common Purpose Africa</div>
						<div class="quote label text-neutral-4 space-min-top">I have absolutely no words to express our gratitude and secondly the diligence, sincerity and commitment of the entire team of Ms.Radhika, Ms.Suryam, Aneetha and the warden, they were all fantastic! The room was well stocked, clean and new. Much thanks.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/nitin.jpeg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Nitin Gupta</div>
						<div class="designation label text-uppercase">Founder at Sickle Innovations</div>
						<div class="quote label text-neutral-4 space-min-top">The place is very nice and comfortable. I was given all the information prior with details. Reception table officials were very helpful. Enjoyed every minute here.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/elsbeth.jpeg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Elsbeth Dixon</div>
						<div class="designation label text-uppercase">Chief Executive, Common Purpose Africa</div>
						<div class="quote label text-neutral-4 space-min-top">What a wonderful home away from home. The Common Purpose Africa Venture participants deeply appreciate your flexibility in making accommodation available to us at such late notice and coping with our often midnight arrival. We are so grateful and admiring of your professionalism and helpfulness.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/sachin.jpg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Sachin Dubey</div>
						<div class="designation label text-uppercase">CEO and Cofounder, Module Innovation</div>
						<div class="quote label text-neutral-4 space-min-top">Wonderful Stay. Nice Hospitality. Would love to stay again.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/uttam.png<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Uttam Banerjee</div>
						<div class="designation label text-uppercase">CEO at Ekam Eco Solutions</div>
						<div class="quote label text-neutral-4 space-min-top">Great experience and awesome hospitality. Mr.Sharan and his team were always available for any kind of help. Wish you guys all the best. Thank you :)</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/ashutosh.png<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Ashutosh Joshi</div>
						<div class="designation label text-uppercase">Founder Member, JSR Innovative</div>
						<div class="quote label text-neutral-4 space-min-top">Good stay in a nice and clean apartment. Thank you.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/rocky.jpeg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Rocky Hatiskar</div>
						<div class="designation label text-uppercase">COO Greensole</div>
						<div class="quote label text-neutral-4 space-min-top">Amazing property. But the USP remains the staff. Very jovial, friendly and at your service always. I would specially like to thanks Mr.Sharan for his lovely hospitality. Cheers.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
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
	<!-- End: Testimonials -->
	<div class="container">
		<div class="row">
			<div class="description columns small-10 small-offset-1 medium-9 large-7 xlarge-6">
				<div class="h5 text-green-2 strong space-min-bottom">It is a combination of privacy, safety and opportunities for interaction and self-discovery.</div>
				<div class="h6">Guesture is a unique approach to solving the problem of the high cost of living in cities, without compromising on comfort and safety. Coliving at Guesture gives you shared living spaces with the same level of amenities as service apartments, but optimized resources, hence lower costs.</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Testimonial Section -->


<!-- Address Section -->
<section class="address-section fill-green-2 space-50-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1">
				<div class="h0 text-green-1">location</div>
				<div class="addresses row">
					<div class="address columns medium-6 large-4 space-50-top space-75-right">
						<div class="h3 name">Alta Vista</div>
						<div class="label strong text-uppercase opacity-50">BLR - Electronic City Phase 1</div>
						<div class="h6 space-min-top-bottom">Shanders Alta Vista, Veer Sandra, Electronic City, Bengaluru, Karnataka 560100</div>
						<div class="space-min-bottom">
							<a href="https://goo.gl/maps/awWKyDwRoEPzcg8t9" target="_blank" class="h6 text-light strong inline-middle"><img class="inline-middle" src="media/glyph/24-maps-light.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
						</div>
						<div class="points space-25-bottom opacity-50">
							<div class="point label strong text-uppercase">Solo Live Package</div>
							<div class="point label strong text-uppercase">Buddy Live Package</div>
							<div class="point label strong text-uppercase">Short Stay Package</div>
						</div>
						<a class="inline button" href="#contact">Enquire Now</a>
					</div>
					<div class="address columns medium-6 large-4 space-50-top space-75-right">
						<div class="h3 name">Dwellington</div>
						<div class="label strong text-uppercase opacity-50">BLR - Electronic City Phase 2</div>
						<div class="h6 space-min-top-bottom">Shanthi Pura, Electronic City Phase 2, Bhovi Palya, Bengaluru, Karnataka 560100</div>
						<div class="space-min-bottom">
							<a href="https://goo.gl/maps/bHF68rUPVkUBXcBa8" target="_blank" class="h6 text-light strong inline-middle"><img class="inline-middle" src="media/glyph/24-maps-light.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
						</div>
						<div class="points space-25-bottom opacity-50">
							<div class="point label strong text-uppercase">Trio Live Package</div>
							<div class="point label strong text-uppercase">Short Stay Package</div>
						</div>
						<a class="inline button" href="#contact">Enquire Now</a>
					</div>
					<div class="address columns medium-6 large-4 space-50-top space-75-right">
						<div class="h3 name">Enclave</div>
						<div class="label strong text-uppercase opacity-50">BLR - Electronic City Phase 2</div>
						<div class="h6 space-min-top-bottom">Electronic City Phase 2, Electronic City, Bhovi Palya, Bengaluru, Karnataka 560099</div>
						<div class="points space-25-bottom opacity-50">
						</div>
						<a class="inline button no-pointer fill-neutral-5" href="#contact">Coming Soon</a>
					</div>
				</div>
				<div class="space-100-top">
					<a href="tel:+91-82877-70011" class="h3 strong inline"><span class="sparkle or-dark h5 strong text-yellow text-uppercase">or</span> Call us on <span class="sparkle or-number-dark text-yellow no-wrap">+91-828-7770011</span></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Address Section -->


<!-- About Section -->
<section class="about-section space-150-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1">
				<div class="title h0 text-light space-50-bottom">the <svg class="inline-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350" style="-webkit-filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25)); filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25));"><text style="opacity: 0;">Guesture</text><path fill="#FFF" d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path fill="#FFF" d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9z"/><path fill="#65BB87" d="M189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></svg> story</div>
			</div>
			<div class="columns small-10 small-offset-1 large-7">
				<div class="description p text-neutral-4 space-50-bottom space-50-right">
					<p>Guesture believes that CoLiving is the answer to modern day challenges of urban living faced by the youth. It is a way of living in thoughtfully designed spaces meant for collaboration, community building, sustainability and a holistic approach to a good life.</p>
					<br><br>
					<p>Guesture provides coliving spaces with top tier amenities like high-speed Wifi, swimming pool, sports arena, coworking spaces, event spaces, laundry and cleaning services, meal services, shuttle services and more. Sign up is hassle free and quick. It is a plug and play approach to living in a city. You don’t need to bring anything other than your suitcase.</p>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 large-3 large-offset-0">
				<div class="h6 text-green-2 text-uppercase strong opacity-50 space-min-bottom">Corporate Address</div>
				<div class="p text-neutral-4">
					Irina Hospitality Pvt Ltd, No.58,
					18th B Main Road, 5th Block, Rajajinagar,<br>
					Bangalore — 560010.
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: About Section -->





<?php require_once __DIR__ . '/../inc/below.php'; ?>

