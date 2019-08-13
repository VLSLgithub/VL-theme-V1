<?php
/**
 * Add a TinyMCE button to create [vibrant_life_staff] Shortcodes
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
add_action( 'admin_init', 'add_vibrant_life_staff_tinymce_filters' );
function add_vibrant_life_staff_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'vibrant_life_staff_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['vibrant_life_staff_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/vibrant-life-staff.js';
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
add_filter( 'vibrant_life_tinymce_l10n', 'vibrant_life_staff_tinymce_l10n' );
function vibrant_life_staff_tinymce_l10n( $l10n ) {
	
	$location_query = new WP_Query( array(
        'post_type' => 'facility',
        'posts_per_page' => -1,
    ) );

    $locations = array();

    if ( $location_query->have_posts() ) {

        foreach ( $location_query->posts as $location ) {
            $locations[ $location->ID ] = rbm_cpts_get_field( 'short_name', $location->ID );
        }

    }

    $screen_sizes = array(
		'medium',
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
    
    $l10n['vibrant_life_staff_shortcode'] = array(
        'tinymce_title' => __( 'Add Staff Listing', 'vibrant-life-theme' ),
		'location' => array(
            'label' => __( 'Select Location', 'vibrant-life-theme' ),
            'default' => '',
            'choices' => $locations,
        ),
        'columns' => array(
            'label' => __( 'Number of Columns to use on Tablets and Desktops', 'vibrant-life-theme' ),
            'default' => 'medium-3',
            'choices' => $medium_options,
        ),
        'featured' => array(
            'label' => __( 'Show only Featured Staff?', 'vibrant-life-theme' ),
            'default' => '',
        ),
    );
    
    return $l10n;
    
}