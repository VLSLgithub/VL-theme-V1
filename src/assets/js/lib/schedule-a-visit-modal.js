( function( $ ) {
	
	function openScheduleAVisitModal() {
		
		var $modal = $( '#schedule-a-visit-modal' );
			
		$modal.foundation( 'open' );

		// Ensure we're looking at the top of the Modal
		$modal.closest( '.reveal-overlay' ).scrollTop( 0 );
		
	}
	
	$( document ).ready( function() {
		
		// Menu Items
		$( document ).on( 'click touch', '.menu-item.open-modal-schedule-a-visit > a', function( event ) {
			
			event.preventDefault();
			
			openScheduleAVisitModal();
			
			$( this ).parent().removeClass( 'clicked' );
			
		} );
		
		// Buttons
		$( document ).on( 'click touch', 'a.open-modal-schedule-a-visit', function( event ) {
			
			event.preventDefault();
			
			openScheduleAVisitModal();
			
		} );
		
	} );
	
} )( jQuery );