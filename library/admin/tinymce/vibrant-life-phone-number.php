<?php
/**
 * Add a TinyMCE button to create [vibrant_life_phone_number] Shortcodes
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
add_action( 'admin_init', 'add_vibrant_life_phone_number_tinymce_filters' );
function add_vibrant_life_phone_number_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'vibrant_life_phone_number_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['vibrant_life_phone_number_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/vibrant-life-phone-number.js';
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
add_filter( 'vibrant_life_tinymce_l10n', 'vibrant_life_phone_number_tinymce_l10n' );
function vibrant_life_phone_number_tinymce_l10n( $l10n ) {
	
	$location_query = new WP_Query( array(
		'post_type' => 'facility',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'DESC',
	) );

	$locations = wp_list_pluck( $location_query->posts, 'post_title', 'ID' );
    
    $l10n['vibrant_life_phone_number_shortcode'] = array(
        'tinymce_title' => __( 'Add Phone Number', 'vibrant-life-theme' ),
        'location' => array(
            'label' => __( 'Phone Number for Location', 'vibrant-life-theme' ),
            'default' => '',
            'choices' => array( '' => __( 'Main Phone Number', 'vibrant-life-theme' ) ) + $locations,
        ),
		'link_text' => array(
            'label' => __( 'Link Text (Leave blank to use the Phone Number itself)', 'vibrant-life-theme' ),
            'default' => '',
        ),
    );
    
    return $l10n;
    
}