( function( $ ) {
    
    $( document ).ready( function() {
		
		$( 'body' ).addClass( 'off-canvas-closed' );
        
        $( '[data-off-canvas]' ).on( 'opened.zf.offcanvas', function() {
            
			$( 'body' ).removeClass( 'off-canvas-closed' );
            $( 'body' ).addClass( 'off-canvas-opened' );
            
        } );
		
		$( '[data-off-canvas]' ).on( 'closed.zf.offcanvas', function() {
            
            $( 'body' ).addClass( 'off-canvas-closed' );
			$( 'body' ).removeClass( 'off-canvas-opened' );
            
        } );
        
    } );
    
} )( jQuery );