( function( $ ) {

    $( document ).ready( function() {
        
        tinymce.PluginManager.add( 'vibrant_life_row_shortcode_script', function( editor, url ) {
            editor.addButton( 'vibrant_life_row_shortcode', {
                text: vibrant_life_tinymce_l10n.vibrant_life_row_shortcode.tinymce_title,
                icon: false,
				onclick: function() {
                    editor.windowManager.open( {
                        title: vibrant_life_tinymce_l10n.vibrant_life_row_shortcode.tinymce_title,
                        body: [
                            {
                                type: 'checkbox',
                                name: 'equalizer',
                                label: vibrant_life_tinymce_l10n.vibrant_life_row_shortcode.equalizer.label,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[vibrant_life_row' + 
												 	( e.data.equalizer === true ? ' equalizer=1' : '' ) + 
												 ']' + 
										 		vibrant_life_tinymce_l10n.vibrant_life_row_shortcode.placeholder_text + 
										 '[/vibrant_life_row]' );
                        }

                    } ); // Editor

                }, // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );