<?php
/**
 * Edit the Color Palette so only Theme Colors are available
 *
 * @since   1.0.0
 * @package GreaterJacksonHabitatTheme2018
 * @subpackage  GreaterJacksonHabitatTheme2018/library/admin/tinymce
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_filter( 'tiny_mce_before_init', 'vibrant_life_tinymce_color_palette' );

/**
 * Customize the TinyMCE Color Palette with brand colors
 * 
 * @param		array $options TinyMCE Options
 *                                
 * @since		1.0.0
 * @return		array TinyMCE Options
 */
function vibrant_life_tinymce_color_palette( $options ) {
	
    $custom_colors = _vibrant_life_get_custom_tinymce_colors( 'content' );
	
    $options['textcolor_map'] = json_encode( $custom_colors );
	
    return $options;
	
}

/**
 * Returns the colors for TinyMCE as an Array
 * 
 * @param		string $context Context in which we are grabbing our options. Only important if you're filtering the value
 *                                                                                                              
 * @access		private
 * @since		1.0.0
 * @return		array TinyMCE Colors
 */
function _vibrant_life_get_custom_tinymce_colors( $context = 'default' ) {
	
	$custom_colors = array(
		"02abd7", __( 'Bright Blue', 'vibrant-life-theme' ),
		"c3d500", __( 'Bright Green', 'vibrant-life-theme' ),
		"ffffff", __( 'White', 'vibrant-life-theme' ),
		"8a8a8d", __( 'Gray', 'vibrant-life-theme' ),
		"000000", __( 'Black', 'vibrant-life-theme' ),
		"385888", __( 'Habitat Blue', 'vibrant-life-theme' ),
		"3eae2a", __( 'Habitat Green', 'vibrant-life-theme' ),
		"ff7d3f", __( 'Orange', 'vibrant-life-theme' ),
		"a83338", __( 'Brick', 'vibrant-life-theme' ),
	);
	
	return apply_filters( 'vibrant_life_get_custom_tinymce_colors', $custom_colors, $context );
	
}