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
        
        tinymce.PluginManager.add( 'vibrant_life_button_shortcode_script', function( editor, url ) {
            editor.addButton( 'vibrant_life_button_shortcode', {
                text: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.tinymce_title,
                icon: false,
                onclick: function() {
                    editor.windowManager.open( {
                        title: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.tinymce_title,
                        body: [
                            {
                                type: 'textbox',
                                name: 'text',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.button_text.label
                            },
                            {
                                type: 'textbox',
                                name: 'url',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.button_url.label
                            },
                            {
                                type: 'listbox',
                                name: 'color',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.colors.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.colors.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.colors.default,
                            },
                            {
                                type: 'listbox',
                                name: 'size',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.size.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.size.choices ),
                            },
                            {
                                type: 'checkbox',
                                name: 'hollow',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.hollow.label,
                            },
                            {
                                type: 'checkbox',
                                name: 'expand',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.expand.label,
                            },
                            {
                                type: 'checkbox',
                                name: 'newTab',
                                label: vibrant_life_tinymce_l10n.vibrant_life_button_shortcode.new_tab.label,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[vibrant_life_button' + 
                                                     ( e.data.url !== undefined && e.data.url !== '' ? ' url="' + e.data.url + '"' : '' ) + 
                                                     ( e.data.color !== undefined ? ' color="' + e.data.color + '"' : '' ) + 
                                                     ( e.data.size !== undefined && e.data.size !== '' ? ' size="' + e.data.size + '"' : '' ) + 
                                                     ( e.data.hollow !== undefined && e.data.hollow !== false ? ' hollow="' + e.data.hollow + '"' : '' ) + 
                                                     ( e.data.expand !== undefined && e.data.expand !== false ? ' expand="' + e.data.expand + '"' : '' ) + 
                                                     ( e.data.newTab !== undefined && e.data.newTab !== false ? ' new_tab="' + e.data.newTab + '"' : '' ) + 
                                                 ']' + 
                                                     ( e.data.text !== undefined ? e.data.text : '' ) + 
                                                 '[/vibrant_life_button]' );
                        }

                    } ); // Editor

                } // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );