<?php
/**
 * Add a TinyMCE button to create [vibrant_life_button] Shortcodes
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
add_action( 'admin_init', 'add_vibrant_life_button_tinymce_filters' );
function add_vibrant_life_button_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'vibrant_life_button_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['vibrant_life_button_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/vibrant-life-button.js';
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
add_filter( 'vibrant_life_tinymce_l10n', 'vibrant_life_button_tinymce_l10n' );
function vibrant_life_button_tinymce_l10n( $l10n ) {
    
    $l10n['vibrant_life_button_shortcode'] = array(
        'tinymce_title' => _x( 'Add Button', 'Button Shortcode TinyMCE Button Text', 'vibrant-life-theme' ),
        'button_text' => array(
            'label' => _x( 'Button Text', "Button's Text", 'vibrant-life-theme' ),
        ),
        'button_url' => array(
            'label' => _x( 'Button Link', 'Link for the Button', 'vibrant-life-theme' ),
        ),
        'colors' => array(
            'label' => _x( 'Color', 'Button Color Selection Label', 'vibrant-life-theme' ),
            'default' => 'secondary',
            'choices' => array(
                'primary' => _x( 'Blue', 'Primary Theme Color', 'vibrant-life-theme' ),
                'secondary' => _x( 'Orange', 'Secondary Theme Color', 'vibrant-life-theme' ),
                'tertiary' => _x( 'Yellow', 'Secondary Theme Color', 'vibrant-life-theme' ),
			),
        ),
        'size' => array(
            'label' => _x( 'Size', 'Button Size Selection Lable', 'vibrant-life-theme' ),
            'default' => '',
            'choices' => array(
				'' => _x( 'Default', 'Default Button Size', 'vibrant-life-theme' ),
                'tiny' => _x( 'Tiny', 'Tiny Button Size', 'vibrant-life-theme' ),
                'small' => _x( 'Small', 'Small Button Size', 'vibrant-life-theme' ),
                'medium' => _x( 'Medium', 'Medium Button Size', 'vibrant-life-theme' ),
                'large' => _x( 'Large', 'Large Button Size', 'vibrant-life-theme' ),
            ),
        ),
        'hollow' => array(
            'label' => _x( 'Hollow/"Ghost" Button?', 'Hollow Button Style', 'vibrant-life-theme' ),
        ),
        'expand' => array(
            'label' => _x( 'Full Width?', 'Full Width Button', 'vibrant-life-theme' ),
        ),
        'new_tab' => array(
            'label' => __( 'Open Link in a New Tab?', 'vibrant-life-theme' ),
        ),
    );
    
    return $l10n;
    
}