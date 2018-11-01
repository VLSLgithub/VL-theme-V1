<?php
/**
 * Home extra meta.
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', 'vibrant_life_remove_home_supports' );
add_action( 'do_meta_boxes', 'vibrant_life_remove_home_metaboxes' );
add_action( 'add_meta_boxes', 'vibrant_life_add_home_metaboxes' );

/**
 * Determine if we're editing the Home Page
 * 
 * @since       1.0.0
 * @return      boolean Whether we're editing the Home Page or not
 */
function vibrant_life_is_editing_home() {
    
    if ( is_admin() && 
        isset( $_REQUEST['post'] ) && 
        $_REQUEST['post'] == get_option( 'page_on_front' ) ) {
        return true;
    }
    
    return false;
    
}

/**
 * Remove Supports from the Home Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_home_supports() {
    
    if ( vibrant_life_is_editing_home() ) {

        //remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_home_metaboxes() {
    
    if ( vibrant_life_is_editing_home() ) {
    
        // "Attributes" Meta Box
        remove_meta_box( 'pageparentdiv', 'page', 'side' );
        
    }
    
}

/**
 * Create Metaboxes for the Home Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_home_metaboxes() {
    
    if ( vibrant_life_is_editing_home() ) {
		
		add_meta_box(
			'vibrant_life-hero',
			__( 'Hero', 'vibrant-life-theme' ),
			'vibrant_life_home_hero_metabox_content',
			'page',
			'normal',
			'low'
		);
        
    }
    
}

function vibrant_life_home_hero_metabox_content( $post_id ) {
	
	vibrant_life_do_field_textarea( array(
		'label' => __( 'Tagline', 'vibrant-life-theme' ),
		'name' => 'hero_tagline',
		'wysiwyg' => true,
		'group' => 'home_hero',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_init_field_group( 'home_hero' );
	
}