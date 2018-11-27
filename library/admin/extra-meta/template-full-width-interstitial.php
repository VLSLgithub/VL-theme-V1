<?php
/**
 * Full Width Interstitial Template extra meta.
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', 'vibrant_life_remove_full_width_interstitial_supports' );
add_action( 'do_meta_boxes', 'vibrant_life_remove_full_width_interstitial_metaboxes' );
add_action( 'add_meta_boxes', 'vibrant_life_add_full_width_interstitial_metaboxes', 1 );

add_action( 'edit_form_after_title', 'vibrant_life_full_width_interstitial_above_editor' );

/**
 * Determine if we're editing the Full Width Interstitial Template
 * 
 * @since       1.0.0
 * @return      boolean Whether we're editing the Full Width Interstitial Template or not
 */
function vibrant_life_is_editing_full_width_interstitial() {
    
    if ( is_admin() && 
        isset( $_REQUEST['post'] ) && 
        get_post_meta( $_REQUEST['post'], '_wp_page_template', true ) == 'page-templates/page-full-width-interstitial.php' ) {
        return true;
    }
    
    return false;
    
}

/**
 * Remove Supports from the Full Width Interstitial Template
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_full_width_interstitial_supports() {
    
    if ( vibrant_life_is_editing_full_width_interstitial() ) {

        //remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_full_width_interstitial_metaboxes() {
    
    if ( vibrant_life_is_editing_full_width_interstitial() ) {
        
    }
    
}

/**
 * Create Metaboxes for the Full Width Interstitial Template
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_full_width_interstitial_metaboxes() {
    
    if ( vibrant_life_is_editing_full_width_interstitial() ) {
		
		add_meta_box(
			'vibrant-life-hero',
			__( 'Hero', 'vibrant-life-theme' ),
			'vibrant_life_full_width_interstitial_hero_metabox_content',
			'page',
			'above_editor',
			'high'
		);
		
		add_meta_box(
			'vibrant-life-interstitial',
			__( 'Interstitial', 'vibrant-life-theme' ),
			'vibrant_life_full_width_interstitial_interstitial_metabox_content',
			'page',
			'above_editor',
			'high'
		);
        
    }
    
}

function vibrant_life_full_width_interstitial_above_editor() {
	
	// above_editor is a custom context
	
	global $post, $wp_meta_boxes;
    do_meta_boxes( get_current_screen(), 'above_editor', $post );
    unset( $wp_meta_boxes[ get_post_type( $post ) ][ 'above_editor' ] );
	
}

function vibrant_life_full_width_interstitial_hero_metabox_content( $post_id ) {
	
	?>

	<p class="description">
		<?php _e( 'The Hero Image is set using the Featured Image to the right', 'vibrant-life-theme' ); ?>
	</p>

	<?php 
	
	vibrant_life_init_field_group( 'full_width_interstitial_hero' );
	
}

function vibrant_life_full_width_interstitial_interstitial_metabox_content( $post_id ) {
	
	vibrant_life_do_field_media( array(
		'label' => '<strong>' . __( 'Main Image', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_image',
		'group' => 'full_width_interstitial_interstitial',
	) );

	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Main Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_content',
		'wysiwyg' => true,
		'group' => 'full_width_interstitial_interstitial',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_init_field_group( 'full_width_interstitial_interstitial' );
	
}