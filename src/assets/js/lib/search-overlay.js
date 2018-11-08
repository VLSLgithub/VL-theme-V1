( function( $ ) {

    $( document ).ready( function() {

        var $menu            = $( '.site-header .top-bar-right.search' );
        var $searchOverlay   = $('#site-search');
        var $searchField     = $searchOverlay.find('input[name="s"]');
        var searchOpen       = false;
        var searchSubmitting = false;

        // Search
		var searchOverlay = document.getElementById( 'site-search' );
		
		// The whole thing is an Overlay in our case
		searchOverlay = new Dialog( searchOverlay, searchOverlay );
		
		function submitSearch() {

            searchSubmitting = true;
            $searchOverlay.find('.search-submitting').show();
            $searchOverlay.find('label').hide();
        }
		
		$menu.find('[data-open-search]').click( function() {
			
			if ( searchSubmitting ) {

                return;
            }
			
			$( '.off-canvas' ).foundation( 'close' );
			
			$searchOverlay.show();
			
			searchOverlay.open();
			
		} );

        $searchOverlay.find( '.close-button' ).click( function() {
			
			if ( searchSubmitting ) {

                return;
            }
			
			searchOverlay.close();
			
			$searchOverlay.hide();
			
		} );
		
		$searchOverlay.find('form').submit(submitSearch);
		
    } );
	
	// https://github.com/ireade/accessible-modal-dialog/blob/gh-pages/Dialog.js

	function Dialog(dialogEl, overlayEl) {

		this.dialogEl = dialogEl;
		this.overlayEl = overlayEl;
		this.focusedElBeforeOpen;

		var focusableEls = this.dialogEl.querySelectorAll('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]');
		this.focusableEls = Array.prototype.slice.call(focusableEls);

		this.firstFocusableEl = this.focusableEls[0];
		this.lastFocusableEl = this.focusableEls[ this.focusableEls.length - 1 ];

		this.close(); // Reset
	}


	Dialog.prototype.open = function() {

		var Dialog = this;

		this.dialogEl.removeAttribute('aria-hidden');
		this.overlayEl.removeAttribute('aria-hidden');

		this.focusedElBeforeOpen = document.activeElement;

		this.dialogEl.addEventListener('keydown', function(e) {
			Dialog._handleKeyDown(e);
		});

		this.overlayEl.addEventListener('click', function() {
			Dialog.close();
		});

		this.firstFocusableEl.focus();
	};

	Dialog.prototype.close = function() {

		this.dialogEl.setAttribute('aria-hidden', true);
		this.overlayEl.setAttribute('aria-hidden', true);

		if ( this.focusedElBeforeOpen ) {
			this.focusedElBeforeOpen.focus();
		}
	};


	Dialog.prototype._handleKeyDown = function(e) {

		var Dialog = this;
		var KEY_TAB = 9;
		var KEY_ESC = 27;

		function handleBackwardTab() {
			if ( document.activeElement === Dialog.firstFocusableEl ) {
				e.preventDefault();
				Dialog.lastFocusableEl.focus();
			}
		}
		function handleForwardTab() {
			if ( document.activeElement === Dialog.lastFocusableEl ) {
				e.preventDefault();
				Dialog.firstFocusableEl.focus();
			}
		}

		switch(e.keyCode) {
			case KEY_TAB:
				if ( Dialog.focusableEls.length === 1 ) {
					e.preventDefault();
					break;
				} 
				if ( e.shiftKey ) {
					handleBackwardTab();
				} else {
					handleForwardTab();
				}
				break;
			case KEY_ESC:
				Dialog.close();
				$('#site-search').hide();
				break;
			default:
				break;
		}


	};


	Dialog.prototype.addEventListeners = function(openDialogSel, closeDialogSel) {

		var Dialog = this;

		var openDialogEls = document.querySelectorAll(openDialogSel);
		for ( var i = 0; i < openDialogEls.length; i++ ) {
			openDialogEls[i].addEventListener('click', function() { 
				Dialog.open();
				$('#site-search').show();
			});
		}

		var closeDialogEls = document.querySelectorAll(closeDialogSel);
		for ( var i = 0; i < closeDialogEls.length; i++ ) {
			closeDialogEls[i].addEventListener('click', function() {
				Dialog.close();
				$('#site-search').hide();
			});
		}

	};

} )( jQuery );