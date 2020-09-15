
$( function () {






window.__BFS = window.__BFS || { };




/*
 *
 * ----- References and Constants
 *
 */
var SCROLL_THRESHOLD = 10;

var currentScrollTop;
var previousScrollTop = 0;
var $stickyCallButton = $( ".js_sticky_call" );







/*
 *
 * Add given data to the data layer variable established by GTM
 *
 */
function gtmPushToDataLayer ( data ) {
	if ( ! window.dataLayer )
		return;
	window.dataLayer.push( data );
}
window.__BFS.gtmPushToDataLayer = gtmPushToDataLayer;








/*
 *
 * When scrolling through the page,
 * 1. Change the URL fragment to match the section that is currently being viewed.
 * 2. Reflect the current section in the navigation menu ( if applicable ).
 *
 */
var intervalToCheckForEngagement = 250;
var thresholdTimeForEngagement = 2000;
var timeSpentOnASection = 0;
window.__BFS.engagementIntervalCheck = null;	// this is set later

var thingsToDoOnEveryInterval = function () {

	var $window = $( window );
	var currentScrollTop;
	var previousScrollTop;
	var $currentSection;
	var currentSectionName;
		var currentSectionId;
	var previousSectionName;
	var sectionScrollTop;
	var $currentNavItem;
	var lastRecordedSection;
	var $navigationItems = $( ".js_navigation_item" );
	var $currentNavigationItem;

	// Get all the sections in the reverse order
	var $sections = Array.prototype.slice.call( $( "[ data-section ]" ) )
					.filter( function ( domSection ) {
						return ! $( domSection ).hasClass( "hidden" );
					} )
					.reverse()
					.map( function ( el ) { return $( el ) } );

	return function thingsToDoOnEveryInterval () {

		var viewportHeight = $window.height();
		currentScrollTop = window.scrollY || document.body.scrollTop;
		$currentSection = null;
		currentSectionName = null;

		// Determine the section being viewed
		var _i
		for ( _i = 0; _i < $sections.length; _i += 1 ) {
			$currentSection = $sections[ _i ];
			sectionScrollTop = $currentSection.position().top;
			if (
				( currentScrollTop >= sectionScrollTop - viewportHeight / 2 )
				&&
				( currentScrollTop <= sectionScrollTop + $currentSection.height() + viewportHeight / 2 )
			) {
				currentSectionName = $currentSection.data( "section" );
				currentSectionId = $currentSection.data( "section-id" );
				break;
			}
		}

		/*
		 * If the previous and the current section are the same, then add time
		 * Else, reset the "time spent on a section" counter
		 */
		if ( currentSectionId && currentSectionName == previousSectionName ) {
			timeSpentOnASection += intervalToCheckForEngagement
			if ( timeSpentOnASection >= thresholdTimeForEngagement ) {
				if ( currentSectionName != lastRecordedSection ) {
					gtmPushToDataLayer( {
						event: "section-view",
						currentSectionId: currentSectionId,
						currentSectionName: currentSectionName
					} );
				    lastRecordedSection = currentSectionName;
				}
			}
		}
		else {
			timeSpentOnASection = 0
		}

		previousScrollTop = currentScrollTop;
		previousSectionName = currentSectionName;

	};

}();

window.__BFS.engagementIntervalCheck = executeEvery(
	intervalToCheckForEngagement / 1000,
	thingsToDoOnEveryInterval
);
window.__BFS.engagementIntervalCheck.start();





/*
 *
 * Phone Number Button Auto-Hide
 *
 */
function stickyCallButtonOnScroll () {

	currentScrollTop = window.scrollY || document.body.scrollTop;

	/*
	 * Stick-rolling the Primary Navigation
	 */
	if ( Math.abs( currentScrollTop - previousScrollTop ) < SCROLL_THRESHOLD ) {
		previousScrollTop = currentScrollTop;
		return;
	}

	// If scrolling ↓.....
	if ( currentScrollTop > previousScrollTop )
		$stickyCallButton.addClass( "hide" );
	else// if scrolling ↑.....
		$stickyCallButton.removeClass( "hide" );

	previousScrollTop = currentScrollTop;

}

$( window ).on( "scroll", stickyCallButtonOnScroll );






} );
