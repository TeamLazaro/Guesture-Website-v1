<?php
/*
 *
 * This is a sample page you can copy and use as boilerplate for any new page.
 *
 */
$pageTitle = "Terms and Conditions";
require_once __DIR__ . '/../inc/above.php';

// Page-specific preparatory code goes here.

?>





<section class="document-navigation space-50-top space-25-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-6 medium-3 medium-offset-1 xlarge-2 xlarge-offset-2 space-min">
				<a href="/" class="block"><svg class="block no-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350"><text style="opacity: 0;">Guesture</text><path fill="#2E343D" d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path fill="#2E343D" d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9z"/><path fill="#65BB87" d="M189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></svg></a>
			</div>
		</div>
	</div>
</section>

<section class="document-section space-50-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1 xlarge-8 xlarge-offset-2 space-min">
				<p><strong>Disclaimer:</strong> Please read and edit the TERMS AND CONDITIONS Policy given below as per your /website’s requirement. Don’t use or apply these as is basis on your website.</p>

				<h3>Terms and Conditions</h3>

				<p><strong>Your website may use the Terms and Conditions given below.</strong></p>

				<p>The terms "We" / "Us" / "Our"/”Company” individually and collectively refer to ………………………..and the terms "Visitor” ”User” refer to the users.</p>

				 <p>This page states the Terms and Conditions under which you (Visitor) may visit this website (“Website”). Please read this page carefully. If you do not accept the Terms and Conditions stated here, we would request you to exit this site. The business, any of its business divisions and / or its subsidiaries, associate companies or subsidiaries to subsidiaries or such other investment companies (in India or abroad) reserve their respective rights to revise these Terms and Conditions at any time by updating this posting. You should visit this page periodically to re-appraise yourself of the Terms and Conditions, because they are binding on all users of this Website.  </p>

				<h5>USE OF CONTENT  </h5>
				<p>All logos, brands, marks headings, labels, names, signatures, numerals, shapes or any combinations thereof, appearing in this site, except as otherwise noted, are properties either owned, or used under licence, by the business and / or its associate entities who feature on this Website. The use of these properties or any other content on this site, except as provided in these terms and conditions or in the site content, is strictly prohibited.  </p>

				<p>You may not sell or modify the content of this Website  or reproduce, display, publicly perform, distribute, or otherwise use the materials in any way for any public or commercial purpose without the respective organisation’s or entity’s written permission.  </p>

				<h5>ACCEPTABLE WEBSITE USE  </h5>

				<p><strong>(A) Security Rules </strong></p>

				<p>Visitors are prohibited from violating or attempting to violate the security of the Web site, including, without limitation, (1) accessing data not intended for such user or logging into a server or account which the user is not authorised to access, (2) attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorisation, (3) attempting to interfere with service to any user, host or network, including, without limitation, via means of submitting a virus or "Trojan horse" to the Website, overloading, "flooding", "mail bombing" or "crashing", or (4) sending unsolicited electronic mail, including promotions and/or advertising of products or services. Violations of system or network security may result in civil or criminal liability. The business and / or its associate entities will have the right to investigate occurrences that they suspect as involving such violations and will have the right to involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations.</p>

				 <p><strong>(B) General Rules </strong></p>

				<p>Visitors may not use the Web Site in order to transmit, distribute, store or destroy material (a) that could constitute or encourage conduct that would be considered a criminal offence or violate any applicable law or regulation, (b) in a manner that will infringe the copyright, trademark, trade secret or other intellectual property rights of others or violate the privacy or publicity of other personal rights of others, or (c) that is libellous, defamatory, pornographic, profane, obscene, threatening, abusive or hateful.  </p>

				<h5>INDEMNITY  </h5>

				<p>The User unilaterally agree to indemnify and hold harmless, without objection, the Company, its officers, directors, employees and agents from and against any claims, actions and/or demands and/or liabilities and/or losses and/or damages whatsoever arising from or resulting from their use of …………………………..com or their breach of the terms.</p>

				<h5>LIABILITY</h5>

				 <p>User agrees that neither Company nor its group companies, directors, officers or employee shall be liable for any direct or/and indirect or/and incidental or/and special or/and consequential or/and exemplary damages, resulting from the use or/and the inability to use the service or/and for cost of procurement of substitute goods or/and services or resulting from any goods or/and data or/and information or/and services purchased or/and obtained or/and messages received or/and transactions entered into through or/and from the service or/and resulting from unauthorized access to or/and alteration of user's transmissions or/and data or/and arising from any other matter relating to the service, including but not limited to, damages for loss of profits or/and use or/and data or other intangible, even if Company has been advised of the possibility of such damages.</p>

				<p>User further agrees that Company shall not be liable for any damages arising from interruption, suspension or termination of service, including but not limited to direct or/and indirect or/and incidental or/and special consequential or/and exemplary damages, whether such interruption or/and suspension or/and termination was justified or not, negligent or intentional, inadvertent or advertent.</p>

				<p>User agrees that Company shall not be responsible or liable to user, or anyone, for the statements or conduct of any third party of the service. In sum, in no event shall Company's total liability to the User for all damages or/and losses or/and causes of action exceed the amount paid by the User to Company, if any, that is related to the cause of action.</p>
				 
				<h5>DISCLAIMER OF CONSEQUENTIAL DAMAGES  </h5>

				<p>In no event shall Company or any parties, organizations or entities associated with the corporate brand name us or otherwise, mentioned at this Website be liable for any damages whatsoever (including, without limitations, incidental and consequential damages, lost profits, or damage to computer hardware or loss of data information or business interruption) resulting from the use or inability to use the Website and the Website material, whether based on warranty, contract, tort, or any other legal theory, and whether or not, such organization or entities were advised of the possibility of such damages.</p>

			</div>
		</div>
	</div>
</section>


<?php require_once __DIR__ . '/../inc/below.php'; ?>