<?php
/**
 * About Page extra meta.
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', 'vibrant_life_remove_about_supports' );
add_action( 'do_meta_boxes', 'vibrant_life_remove_about_metaboxes' );
add_action( 'add_meta_boxes', 'vibrant_life_add_about_metaboxes' );

/**
 * Determine if we're editing the About Page
 * 
 * @since       1.0.0
 * @return      boolean Whether we're editing the About Page or not
 */
function vibrant_life_is_editing_about() {
    
    if ( is_admin() && 
        isset( $_REQUEST['post'] ) && 
        get_post_meta( $_REQUEST['post'], '_wp_page_template', true ) == 'page-templates/about-us.php' ) {
        return true;
    }
    
    return false;
    
}

/**
 * Remove Supports from the About Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_about_supports() {
    
    if ( vibrant_life_is_editing_about() ) {

        remove_post_type_support( 'page', 'editor' );
        
    }
    
}

/**
 * Needs to be called at do_meta_boxes since it is created at a different time than Supports Metaboxes
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_remove_about_metaboxes() {
    
    if ( vibrant_life_is_editing_about() ) {
        
    }
    
}

/**
 * Create Metaboxes for the About Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_about_metaboxes() {
    
    if ( vibrant_life_is_editing_about() ) {
		
		add_meta_box(
			'vibrant-life-hero',
			__( 'Hero', 'vibrant-life-theme' ),
			'vibrant_life_about_hero_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-interstitial',
			__( 'Interstitial', 'vibrant-life-theme' ),
			'vibrant_life_about_interstitial_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-call-to-action',
			__( 'Call to Action Section', 'vibrant-life-theme' ),
			'vibrant_life_about_call_to_action_metabox_content',
			'page',
			'normal',
			'low'
		);
        
    }
    
}

function vibrant_life_about_hero_metabox_content( $post_id ) {
	
	?>

	<p class="description">
		<?php _e( 'The Hero Image is set using the Featured Image to the right', 'vibrant-life-theme' ); ?>
	</p>

	<?php 
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Tagline', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'hero_tagline',
		'wysiwyg' => true,
		'group' => 'about_hero',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
		'default' => '<h1><span style="color: #ffffff;">Senior Assisted Living &amp;  Memory Care in Michigan</span></h1>
<h2 class="p1"><span style="color: #F5A623;">people helping people thrive!</span></h2>',
		'description' => '<p class="description">' . __( 'For this field, you need to set the Text Color yourself', 'vibrant-life-theme' ) . '</p>',
		'description_tip' => false,
		'description_placement' => 'after_label',
	) );
	
	vibrant_life_init_field_group( 'about_hero' );
	
}

function vibrant_life_about_interstitial_metabox_content( $post_id ) {
	
	vibrant_life_do_field_media( array(
		'label' => '<strong>' . __( 'Main Image', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_image',
		'group' => 'about_interstitial',
	) );
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Main Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_content',
		'wysiwyg' => true,
		'group' => 'about_interstitial',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_do_field_repeater( array(
		'label' => '<strong>' . __( 'Content Blocks', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_repeater',
		'group' => 'about_interstitial',
		'fields' => array(
			'image' => array(
				'type' => 'media',
				'args' => array(
					'label' => __( 'Image', 'vibrant-life-theme' ),
				),
			),
			'content' => array(
				'type' => 'textarea',
				'args' => array(
					'label' => __( 'Content', 'vibrant-life-theme' ),
					'wysiwyg' => true,
					'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
				),
			),
		),
	) );
	
	vibrant_life_init_field_group( 'about_interstitial' );
	
}

function vibrant_life_about_call_to_action_metabox_content( $post_id ) {
	
	vibrant_life_do_field_media( array(
		'label' => '<strong>' . __( 'Image', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'call_to_action_image',
		'group' => 'about_call_to_action',
	) );
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'call_to_action_content',
		'group' => 'about_call_to_action',
		'wysiwyg' => true,
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_init_field_group( 'about_call_to_action' );
		
}