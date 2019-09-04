<?php
/**
 * Landing Page Template extra meta.
 *
 * @since   1.0.9
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', 'vibrant_life_remove_landing_page_supports' );
add_action( 'do_meta_boxes', 'vibrant_life_remove_landing_page_metaboxes' );
add_action( 'add_meta_boxes', 'vibrant_life_add_landing_page_metaboxes', 1 );

add_action( 'edit_form_after_title', 'vibrant_life_landing_page_above_editor' );

/**
 * Determine if we're editing the Landing Page Template
 * 
 * @since       1.0.9
 * @return      boolean Whether we're editing the Landing Page Template or not
 */
function vibrant_life_is_editing_landing_page() {
    
    if ( is_admin() && 
        isset( $_REQUEST['post'] ) && 
        vibrant_life_is_landing_page( $_REQUEST['post'] ) ) {
        return true;
    }
    
    return false;
    
}

/**
 * Remove Supports from the Landing Page Template
 * 
 * @since       1.0.9
 * @return      void
 */
function vibrant_life_remove_landing_page_supports() {
    
    if ( vibrant_life_is_editing_landing_page() ) {

        //remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.9
 * @return      void
 */
function vibrant_life_remove_landing_page_metaboxes() {
    
    if ( vibrant_life_is_editing_landing_page() ) {
        
    }
    
}

/**
 * Create Metaboxes for the Landing Page Template
 * 
 * @since       1.0.9
 * @return      void
 */
function vibrant_life_add_landing_page_metaboxes() {
    
    if ( vibrant_life_is_editing_landing_page() ) {
		
		add_meta_box(
			'vibrant-life-hero',
			__( 'Hero', 'vibrant-life-theme' ),
			'vibrant_life_landing_page_hero_metabox_content',
			'page',
			'above_editor',
			'high'
		);
		
		add_meta_box(
			'vibrant-life-interstitial',
			__( 'Interstitial', 'vibrant-life-theme' ),
			'vibrant_life_landing_page_interstitial_metabox_content',
			'page',
			'above_editor',
			'high'
        );
        
        add_meta_box(
			'vibrant-life-call-to-action',
			__( 'Call to Action', 'vibrant-life-theme' ),
			'vibrant_life_landing_page_call_to_action_metabox_content',
			'page',
			'normal',
			'default'
        );
        
        add_meta_box(
			'vibrant-life-video',
			__( 'Video Section', 'vibrant-life-theme' ),
			'vibrant_life_landing_page_video_metabox_content',
			'page',
			'normal',
			'high'
		);
        
    }
    
}

function vibrant_life_landing_page_above_editor() {
	
	// above_editor is a custom context
	
	global $post, $wp_meta_boxes;
    do_meta_boxes( get_current_screen(), 'above_editor', $post );
    unset( $wp_meta_boxes[ get_post_type( $post ) ][ 'above_editor' ] );
	
}

function vibrant_life_landing_page_hero_metabox_content( $post_id ) {
	
	?>

	<p class="description">
		<?php _e( 'The Hero Image is set using the Featured Image to the right', 'vibrant-life-theme' ); ?>
	</p>

	<?php 
	
	vibrant_life_init_field_group( 'landing_page_hero' );
	
}

function vibrant_life_landing_page_interstitial_metabox_content( $post_id ) {

    vibrant_life_do_field_checkbox( array(
        'label' => false,
		'name' => 'interstitial_disabled',
        'group' => 'landing_page_interstitial',
        'options' => array(
            '<strong>' . __( 'Disable Interstitial?', 'vibrant-life-theme' ) . '</strong>'
        ),
        'description_tip' => false,
        'description' => '<p class="description">' . __( 'If the Interstitial is disabled, the main Content Editor below will do nothing.', 'vibrant-life-theme' ) . '</p>',
    ) );
	
	vibrant_life_do_field_media( array(
		'label' => '<strong>' . __( 'Main Image', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_image',
		'group' => 'landing_page_interstitial',
    ) );
    
    ?>

    <p class="description">
		<?php _e( 'The Interstitial Content is set in the main Content Editor below.', 'vibrant-life-theme' ); ?>
    </p>
    
    <?php 
	
	vibrant_life_init_field_group( 'landing_page_interstitial' );
	
}

function vibrant_life_landing_page_call_to_action_metabox_content( $post_id ) {

    vibrant_life_do_field_repeater( array(
        'label' => '<strong>' . __( 'Call to Action sections', 'vibrant-life-theme' ) . '</strong>',
        'name' => 'call_to_action_sections',
        'fields' => array(
            'image' => array(
                'type' => 'media',
                'args' => array(
                    'label' => '<strong>' . __( 'Image', 'vibrant-life-theme' ) . '</strong>',
                ),
            ),
            'content' => array(
                'type' => 'textarea',
                'args' => array(
                    'label' => '<strong>' . __( 'Content', 'vibrant-life-theme' ) . '</strong>',
                    'wysiwyg' => true,
                    'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
                ),
            ),
        ),
        'group' => 'landing_page_call_to_action'
    ) );

    vibrant_life_init_field_group( 'landing_page_call_to_action' );

}

function vibrant_life_landing_page_video_metabox_content( $post_id ) {

    vibrant_life_do_field_text( array(
        'label' => '<strong>' . __( 'Video Section Header', 'vibrant-life-theme' ) . '</strong>',
        'name' => 'video_header_text',
        'group' => 'landing_page_video',
        'default' => 'What People Say About Vibrant Life',
    ) );

    vibrant_life_do_field_text( array(
        'label' => '<strong>' . __( 'Video URL', 'vibrant-life-theme' ) . '</strong>',
        'name' => 'video_url',
        'group' => 'landing_page_video',
        'description' => '<p class="description">' . __( 'Provide the Video URL, not the Embed Code.', 'vibrant-life-theme' ) . '</p>',
        'description_tip' => false,
        'description_placement' => 'after_label',
    ) );

    vibrant_life_init_field_group( 'landing_page_video' );

}