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

add_filter( 'mce_buttons', 'vibrant_life_tinymce_add_styleselect' );

add_filter( 'tiny_mce_before_init', 'vibrant_life_tinymce_text_styles' );

/**
 * The "Block Formats" text style selector built-in does not allow us to add complex Blocks to it, but the "styleselect" or "style_format" one does. So we're going to remove the old one and replace it with the new
 * 
 * @param		array $buttons TinyMCE Buttons in the first Row
 *                                                     
 * @since		1.0.0
 * @return		array TinyMCE Buttons in the first Row
 */
function vibrant_life_tinymce_add_styleselect( $buttons ) {
	
	// Add the Text Format selector to the first row
	// For some reason, this doesn't use the same TinyMCE element as the default one
	
	$index = array_search( 'block_formats', $buttons );
	
	unset( $buttons[ $index ] );
	
	$buttons = array_values( $buttons );
	
	array_unshift( $buttons, 'styleselect' );
	
	return $buttons;
}

/**
 * Customize the TinyMCE Text Styles to add things like Subheaders
 * 
 * @param		array $options TinyMCE Options
 *                                
 * @since		1.0.0
 * @return		array TinyMCE Options
 */
function vibrant_life_tinymce_text_styles( $options ) {
	
    $text_styles = _vibrant_life_get_custom_text_styles( 'content' );
	
    $options['style_formats'] = json_encode( $text_styles );
	
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
function _vibrant_life_get_custom_text_styles( $context = 'default' ) {
	
	$text_styles = array(
		array(
			'title' => __( 'Paragraph', 'vibrant-life-theme' ),
			'block' => 'p',
		),
		array(
			'title' => __( 'Heading 1', 'vibrant-life-theme' ),
			'block' => 'h1',
		),
		array(
			'title' => __( 'Subheader 1', 'vibrant-life-theme' ),
			'block' => 'h1',
			'classes' => 'subheader',
		),
		array(
			'title' => __( 'Heading 2', 'vibrant-life-theme' ),
			'block' => 'h2',
		),
		array(
			'title' => __( 'Subheader 2', 'vibrant-life-theme' ),
			'block' => 'h2',
			'classes' => 'subheader',
		),
		array(
			'title' => __( 'Heading 3', 'vibrant-life-theme' ),
			'block' => 'h3',
		),
		array(
			'title' => __( 'Subheader 3', 'vibrant-life-theme' ),
			'block' => 'h3',
			'classes' => 'subheader',
		),
		array(
			'title' => __( 'Heading 4', 'vibrant-life-theme' ),
			'block' => 'h4',
		),
		array(
			'title' => __( 'Subheader 4', 'vibrant-life-theme' ),
			'block' => 'h4',
			'classes' => 'subheader',
		),
		array(
			'title' => __( 'Heading 5', 'vibrant-life-theme' ),
			'block' => 'h5',
		),
		array(
			'title' => __( 'Subheader 5', 'vibrant-life-theme' ),
			'block' => 'h5',
			'classes' => 'subheader',
		),
		array(
			'title' => __( 'Heading 6', 'vibrant-life-theme' ),
			'block' => 'h6',
		),
		array(
			'title' => __( 'Subheader 6', 'vibrant-life-theme' ),
			'block' => 'h6',
			'classes' => 'subheader',
		),
		array(
			'title' => __( 'Preformatted', 'vibrant-life-theme' ),
			'block' => 'pre',
		),
	);
	
	return apply_filters( 'vibrant_life_get_custom_text_styles', $text_styles, $context );
	
}