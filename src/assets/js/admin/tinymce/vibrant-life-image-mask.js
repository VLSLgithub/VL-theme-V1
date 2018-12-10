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
        
        tinymce.PluginManager.add( 'vibrant_life_image_mask_shortcode_script', function( editor, url ) {
            editor.addButton( 'vibrant_life_image_mask_shortcode', {
                text: vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.tinymce_title,
                icon: false,
                onclick: function() {
                    editor.windowManager.open( {
                        title: vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.tinymce_title,
                        body: [
                            {
                                type: 'listbox',
                                name: 'mask',
                                label: vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.mask.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.mask.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.mask.default,
                            },
							{
                                type: 'listbox',
                                name: 'align',
                                label: vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.align.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.align.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.align.default,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[vibrant_life_image_mask' + 
                                                     ( e.data.mask !== undefined ? ' mask="' + e.data.mask + '"' : '' ) + 
                                                     ( e.data.align !== undefined ? ' align="' + e.data.align + '"' : '' ) + 
                                                 ']' + 
                                                     vibrant_life_tinymce_l10n.vibrant_life_image_mask_shortcode.placeholder_text + 
                                                 '[/vibrant_life_image_mask]' );
                        }

                    } ); // Editor

                } // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );