<?php
/**
 * Contact Page extra meta.
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', 'vibrant_life_remove_contact_supports' );
add_action( 'do_meta_boxes', 'vibrant_life_remove_contact_metaboxes' );
add_action( 'add_meta_boxes', 'vibrant_life_add_contact_metaboxes' );

/**
 * Determine if we're editing the Contact Page
 * 
 * @since       1.0.0
 * @return      boolean Whether we're editing the Contact Page or not
 */
function vibrant_life_is_editing_contact() {
    
    if ( is_admin() && 
        isset( $_REQUEST['post'] ) && 
        get_post_meta( $_REQUEST['post'], '_wp_page_template', true ) == 'page-templates/contact-us.php' ) {
        return true;
    }
    
    return false;
    
}

/**
 * Remove Supports from the Contact Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_contact_supports() {
    
    if ( vibrant_life_is_editing_contact() ) {

        remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_contact_metaboxes() {
    
    if ( vibrant_life_is_editing_contact() ) {
        
    }
    
}

/**
 * Create Metaboxes for the Contact Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_contact_metaboxes() {
    
    if ( vibrant_life_is_editing_contact() ) {
		
		add_meta_box(
			'vibrant-life-hero',
			__( 'Hero', 'vibrant-life-theme' ),
			'vibrant_life_contact_hero_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-interstitial',
			__( 'Interstitial', 'vibrant-life-theme' ),
			'vibrant_life_contact_interstitial_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-map',
			__( 'Map', 'vibrant-life-theme' ),
			'vibrant_life_contact_map_metabox_content',
			'page',
			'normal',
			'low'
		);
        
    }
    
}

function vibrant_life_contact_hero_metabox_content( $post_id ) {
	
	?>

	<p class="description">
		<?php _e( 'The Hero Image is set using the Featured Image to the right', 'vibrant-life-theme' ); ?>
	</p>

	<?php 
	
	vibrant_life_init_field_group( 'contact_hero' );
	
}

function vibrant_life_contact_interstitial_metabox_content( $post_id ) {
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Main Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_content',
		'wysiwyg' => true,
		'group' => 'contact_interstitial',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	// Add Form dropdown
	
	vibrant_life_init_field_group( 'contact_interstitial' );
	
}

function vibrant_life_contact_map_metabox_content( $post_id ) {
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'map_text',
		'group' => 'contact_map',
		'wysiwyg' => true,
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_init_field_group( 'contact_map' );
		
}