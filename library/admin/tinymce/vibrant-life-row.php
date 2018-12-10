<?php
/**
 * Add a TinyMCE button to create [vibrant_life_row] Shortcodes
 *
 * @since   {{VERSION}}
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/tinymce
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Button Shortcode to TinyMCE
 *
 * @since       {{VERSION}}
 * @return      void
 */
add_action( 'admin_init', 'add_vibrant_life_row_tinymce_filters' );
function add_vibrant_life_row_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'vibrant_life_row_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['vibrant_life_row_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/vibrant-life-row.js';
            return $plugin_array;
        } );
        
    }
    
}

/**
 * Add Localized Text for our TinyMCE Button
 *
 * @since       {{VERSION}}
 * @return      Array Localized Text
 */
add_filter( 'vibrant_life_tinymce_l10n', 'vibrant_life_row_tinymce_l10n' );
function vibrant_life_row_tinymce_l10n( $l10n ) {
    
    $l10n['vibrant_life_row_shortcode'] = array(
        'tinymce_title' => __( 'Add Row', 'vibrant-life-theme' ),
		'placeholder_text' => "<p>" . __( 'Place your Columns here', 'vibrant-life-theme' ) . "</p>",
    );
    
    return $l10n;
    
}