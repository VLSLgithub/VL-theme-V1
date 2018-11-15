( function( $ ) { 
	
	$( document ).ready( function() {
		
		$( document ).on( 'click touch', '.mobile-off-canvas-menu li.menu-item > a, .site-navigation li.menu-item > a', function( event ) {
			
			$( '.mobile-off-canvas-menu li.menu-item, .site-navigation li.menu-item' ).removeClass( 'clicked' ); // Remove class from all others if they click multiple at once
			
			$( this ).closest( 'li.menu-item' ).addClass( 'clicked' );
			
		} );
		
	} );
	
} )( jQuery );