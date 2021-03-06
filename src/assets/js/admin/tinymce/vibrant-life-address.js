( function( $ ) {
    
    /**
     * Take our Localized Choices and turn them into something TinyMCE Listbox understands
     * 
     * @param       {object} choices Choices Object from our Localized JSON
     *                               
     * @since       1.0.0
     * @returns     {Array}  Array of TinyMCE Listbox Choices
     */
    function vibrant_life_generate_tinymce_listbox( choices ) {

        var result = [];
        
        for ( var key in choices ) {
            
            result.push( {
                text: choices[key],
                value: key
            } );
            
        }
        
        return result;
        
    }

    $( document ).ready( function() {
        
        tinymce.PluginManager.add( 'vibrant_life_address_shortcode_script', function( editor, url ) {
            editor.addButton( 'vibrant_life_address_shortcode', {
                text: vibrant_life_tinymce_l10n.vibrant_life_address_shortcode.tinymce_title,
                icon: false,
                onclick: function() {
                    editor.windowManager.open( {
                        title: vibrant_life_tinymce_l10n.vibrant_life_address_shortcode.tinymce_title,
                        body: [
                            {
                                type: 'listbox',
                                name: 'store',
                                label: vibrant_life_tinymce_l10n.vibrant_life_address_shortcode.store.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_address_shortcode.store.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_address_shortcode.store.default,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[vibrant_life_address' + 
                                                     ( e.data.store !== undefined ? ' store_id="' + e.data.store + '"' : '' ) + 
                                                 ']' );
                        }

                    } ); // Editor

                } // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );