<?php
/**
 * Add a TinyMCE button to create [vibrant_life_address] Shortcodes
 *
 * @since   1.0.0
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
 * @since       1.0.0
 * @return      void
 */
add_action( 'admin_init', 'add_vibrant_life_address_tinymce_filters' );
function add_vibrant_life_address_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'vibrant_life_address_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['vibrant_life_address_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/vibrant-life-address.js';
            return $plugin_array;
        } );
        
    }
    
}

/**
 * Add Localized Text for our TinyMCE Button
 *
 * @since       1.0.0
 * @return      Array Localized Text
 */
add_filter( 'vibrant_life_tinymce_l10n', 'vibrant_life_address_tinymce_l10n' );
function vibrant_life_address_tinymce_l10n( $l10n ) {
	
	$stores = vibrant_life_get_asl_store_locator_stores();
	$store_options = array();
	
	foreach ( $stores as $store ) {
		$store_options[ $store->id ] = $store->title;
	}
    
    $l10n['vibrant_life_address_shortcode'] = array(
        'tinymce_title' => __( 'Add Address', 'vibrant-life-theme' ),
		'store' => array(
            'label' => __( 'Select Location', 'vibrant-life-theme' ),
            'default' => '',
            'choices' => $store_options,
        ),
    );
    
    return $l10n;
    
}