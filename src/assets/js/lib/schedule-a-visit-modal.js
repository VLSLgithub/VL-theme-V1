( function( $ ) {
	
	$( document ).ready( function() {
		
		$( document ).on( 'click touch', '.menu-item.open-modal-schedule-a-visit > a', function( event ) {
			
			event.preventDefault();
			
			var $modal = $( '#schedule-a-visit-modal' );
			
			$modal.foundation( 'open' );

			// Ensure we're looking at the top of the Modal
			$modal.closest( '.reveal-overlay' ).scrollTop( 0 );
			
			$( this ).parent().removeClass( 'clicked' );
			
		} );
		
	} );
	
} )( jQuery );