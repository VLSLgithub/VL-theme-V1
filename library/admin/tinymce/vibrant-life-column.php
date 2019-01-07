<?php
/**
 * Add a TinyMCE button to create [vibrant_life_column] Shortcodes
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
add_action( 'admin_init', 'add_vibrant_life_column_tinymce_filters' );
function add_vibrant_life_column_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'vibrant_life_column_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['vibrant_life_column_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/vibrant-life-column.js';
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
add_filter( 'vibrant_life_tinymce_l10n', 'vibrant_life_column_tinymce_l10n' );
function vibrant_life_column_tinymce_l10n( $l10n ) {
	
	$screen_sizes = array(
		'small',
		'medium',
		'large',
	);
	
	foreach ( $screen_sizes as $screen_size ) {
		
		${ $screen_size . '_options' } = array();
	
		for ( $index = 1; $index <= 12; $index++ ) {

			${ $screen_size . '_options' }[ $screen_size . '-' . $index ] = sprintf( 
				_x( '%s of the Row', 'Amount of space used in row', 'vibrant-life-theme' ),
				sprintf( "%s%%", round( ( $index / 12 ) * 100 ) )
			);

		}
		
	}
    
    $l10n['vibrant_life_column_shortcode'] = array(
        'tinymce_title' => __( 'Add Column', 'vibrant-life-theme' ),
		'small' => array(
            'label' => __( 'Small Screens (Below 640px wide)', 'vibrant-life-theme' ),
            'default' => 'small-12',
            'choices' => $small_options,
        ),
		'medium' => array(
            'label' => __( 'Medium Screens (Between 640px wide and 1024px wide)', 'vibrant-life-theme' ),
            'default' => 'medium-12',
            'choices' => $medium_options,
        ),
		'large' => array(
            'label' => __( 'Large Screens (Above 1024px wide)', 'vibrant-life-theme' ),
            'default' => 'large-12',
            'choices' => $large_options,
        ),
		'placeholder_text' => "<p>" . __( 'Place your Column content here', 'vibrant-life-theme' ) . "</p>",
    );
    
    return $l10n;
    
}