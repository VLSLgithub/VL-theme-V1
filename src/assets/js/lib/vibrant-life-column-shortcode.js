( function( $ ) {
	
	$( '.vibrant-life-column-shortcode p' ).each( function() {
		$( this ).html( $( this ).html().trim() );
	} );
	
	$( '.vibrant-life-column-shortcode p:empty' ).css( 'display', 'none' );
	
} )( jQuery );