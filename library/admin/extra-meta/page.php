<?php
/**
 * Page extra meta.
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', 'vibrant_life_add_page_metaboxes' );

/**
 * Create Metaboxes for Pages
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_page_metaboxes() {
	
	global $post;
	
	// Each page except the Home Page
	if ( vibrant_life_is_editing_home() ) return;
	
	/*
	
	add_meta_box(
		'vibrant_life-extra-meta',
		__( 'Extra Section', 'vibrant-life-theme' ),
		'vibrant_life_extra_metabox_content',
		'page',
		'normal',
		'low'
	);
	
	*/
    
}/**
 * Adds Become a Volunteer Metabox
 * 
 * @since		1.0.0
 * @return		void
 */
function vibrant_life_extra_metabox_content() {
	
	vibrant_life_do_field_textarea( array(
		'name' => 'vibrant_life_extra',
		'group' => 'vibrant_life_extra',
		'wysiwyg' => true,
	) );
	
	vibrant_life_init_field_group( 'vibrant_life_extra' );
	
}