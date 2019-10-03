/*
 *	Sliding Gallery
 */

var $gallery = $( ".js_sliding_gallery" );
var $tracks = $gallery.find( ".js_track" );

$( window ).on( "scroll", function ( event ) {

	var galleryPositionY = $gallery.get( 0 ).offsetTop;
	var galleryHeight = $gallery.get( 0 ).offsetHeight;
	var scrollY = window.scrollY;
	if ( scrollY + window.innerHeight < galleryPositionY )
		return;
	if ( scrollY > galleryPositionY + galleryHeight )
		return;

	var imageWidth = $tracks.find( ".image" ).first().get( 0 ).offsetWidth;

	$tracks.each( function ( _i, el ) {
		var offsetDirection = 1;
		if ( _i % 2 === 1 )
			offsetDirection = -1;
		var offset = offsetDirection;
		offset = offset * ( scrollY - galleryPositionY ) * ( imageWidth / window.innerHeight );
		el.style.transform = "translateX( " + offset + "px )";
	} );

} );
