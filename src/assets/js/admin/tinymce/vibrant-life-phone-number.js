( function( $ ) {
    
    /**
     * Take our Localized Choices and turn them into something TinyMCE Listbox understands
     * 
     * @param       {object} choices Choices Object from our Localized JSON
     *                               
     * @since       {{VERSION}}
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
        
        tinymce.PluginManager.add( 'vibrant_life_phone_number_shortcode_script', function( editor, url ) {
            editor.addButton( 'vibrant_life_phone_number_shortcode', {
                text: vibrant_life_tinymce_l10n.vibrant_life_phone_number_shortcode.tinymce_title,
                icon: false,
                onclick: function() {
                    editor.windowManager.open( {
                        title: vibrant_life_tinymce_l10n.vibrant_life_phone_number_shortcode.tinymce_title,
                        body: [
                            {
                                type: 'listbox',
                                name: 'location',
                                label: vibrant_life_tinymce_l10n.vibrant_life_phone_number_shortcode.location.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_phone_number_shortcode.location.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_phone_number_shortcode.location.default,
                            },
							{
                                type: 'textbox',
                                name: 'linkText',
                                label: vibrant_life_tinymce_l10n.vibrant_life_phone_number_shortcode.link_text.label,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[vibrant_life_phone_number' + 
                                                     ( e.data.location !== undefined ? ' location="' + e.data.location + '"' : '' ) + 
                                                 ']' + 
                                                     ( e.data.linkText !== undefined ? e.data.linkText : '' ) + 
                                                 '[/vibrant_life_phone_number]' );
                        }

                    } ); // Editor

                } // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );