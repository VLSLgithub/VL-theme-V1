<?php
/**
 * Blog extra meta.
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', 'vibrant_life_remove_blog_supports' );
add_action( 'do_meta_boxes', 'vibrant_life_remove_blog_metaboxes' );
add_action( 'add_meta_boxes', 'vibrant_life_add_blog_metaboxes' );

/**
 * Determine if we're editing the Blog Page
 * 
 * @since       1.0.0
 * @return      boolean Whether we're editing the Blog Page or not
 */
function vibrant_life_is_editing_blog() {
    
    if ( is_admin() && 
        isset( $_REQUEST['post'] ) && 
        $_REQUEST['post'] == get_option( 'page_for_posts' ) ) {
        return true;
    }
    
    return false;
    
}

/**
 * Remove Supports from the Blog Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_blog_supports() {
    
    if ( vibrant_life_is_editing_blog() ) {

        //remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_blog_metaboxes() {
    
    if ( vibrant_life_is_editing_blog() ) {
    
        // "Attributes" Meta Box
        remove_meta_box( 'pageparentdiv', 'page', 'side' );
        
    }
    
}

/**
 * Create Metaboxes for the Blog Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_blog_metaboxes() {
    
    if ( vibrant_life_is_editing_blog() ) {
		
		add_meta_box(
			'vibrant-life-interstitial',
			__( 'Interstitial', 'vibrant-life-theme' ),
			'vibrant_life_blog_interstitial_metabox_content',
			'page',
			'normal',
			'low'
		);
        
    }
    
}

function vibrant_life_blog_interstitial_metabox_content( $post_id ) {
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Main Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_content',
		'wysiwyg' => true,
		'group' => 'blog_interstitial',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_init_field_group( 'blog_interstitial' );
	
}