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
        
        tinymce.PluginManager.add( 'vibrant_life_column_shortcode_script', function( editor, url ) {
            editor.addButton( 'vibrant_life_column_shortcode', {
                text: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.tinymce_title,
                icon: false,
                onclick: function() {
                    editor.windowManager.open( {
                        title: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.tinymce_title,
                        body: [
                            {
                                type: 'listbox',
                                name: 'small',
                                label: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.small.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.small.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.small.default,
                            },
							{
                                type: 'listbox',
                                name: 'medium',
                                label: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.medium.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.medium.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.medium.default,
                            },
							{
                                type: 'listbox',
                                name: 'large',
                                label: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.large.label,
                                values: vibrant_life_generate_tinymce_listbox( vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.large.choices ),
                                value: vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.large.default,
                            },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[vibrant_life_column' + 
                                                     ( e.data.small !== undefined ? ' small="' + e.data.small + '"' : '' ) + 
                                                     ( e.data.medium !== undefined ? ' medium="' + e.data.medium + '"' : '' ) + 
                                                     ( e.data.large !== undefined ? ' large="' + e.data.large + '"' : '' ) + 
                                                 ']' + 
                                                     vibrant_life_tinymce_l10n.vibrant_life_column_shortcode.placeholder_text + 
                                                 '[/vibrant_life_column]' );
                        }

                    } ); // Editor

                } // onclick

            } ); // addButton

        } ); // Plugin Manager

    } ); // Document Ready

} )( jQuery );