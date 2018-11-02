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

        remove_post_type_support( 'page', 'editor' );
        
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
			'vibrant-life-hero',
			__( 'Hero', 'vibrant-life-theme' ),
			'vibrant_life_home_hero_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-interstitial',
			__( 'Interstitial', 'vibrant-life-theme' ),
			'vibrant_life_home_interstitial_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-call-to-action',
			__( 'Call to Action Section', 'vibrant-life-theme' ),
			'vibrant_life_home_call_to_action_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-video',
			__( 'Video Section', 'vibrant-life-theme' ),
			'vibrant_life_home_video_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-locations',
			__( 'Locations Section', 'vibrant-life-theme' ),
			'vibrant_life_home_locations_metabox_content',
			'page',
			'normal',
			'low'
		);
		
		add_meta_box(
			'vibrant-life-news',
			__( 'News Section', 'vibrant-life-theme' ),
			'vibrant_life_home_news_metabox_content',
			'page',
			'normal',
			'low'
		);
        
    }
    
}

function vibrant_life_home_hero_metabox_content( $post_id ) {
	
	?>

	<p class="description">
		<?php _e( 'The Hero Image is set using the Featured Image to the right', 'vibrant-life-theme' ); ?>
	</p>

	<?php 
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Tagline', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'hero_tagline',
		'wysiwyg' => true,
		'group' => 'home_hero',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
		'default' => '<h1><span style="color: #ffffff;">Senior Assisted Living &amp;  Memory Care in Michigan</span></h1>
<h2 class="p1"><span style="color: #F5A623;">people helping people thrive!</span></h2>',
		'description' => '<p class="description">' . __( 'For this field, you need to set the Text Color yourself', 'vibrant-life-theme' ) . '</p>',
		'description_tip' => false,
		'description_placement' => 'after_label',
	) );
	
	vibrant_life_init_field_group( 'home_hero' );
	
}

function vibrant_life_home_interstitial_metabox_content( $post_id ) {
	
	vibrant_life_do_field_media( array(
		'label' => '<strong>' . __( 'Main Image', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_image',
		'group' => 'home_interstitial',
	) );
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Main Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_content',
		'wysiwyg' => true,
		'group' => 'home_interstitial',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_do_field_repeater( array(
		'label' => '<strong>' . __( 'Content Blocks', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'interstitial_repeater',
		'group' => 'home_interstitial',
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
			'circle_button_text' => array(
				'type' => 'text',
				'args' => array(
					'label' => __( 'Circle Button Text', 'vibrant-life-theme' ),
					'description' => '<p class="description">' . __( 'This button becomes a regular Button on Mobile.', 'vibrant-life-theme' ) . '</p>',
					'description_tip' => false,
					'description_placement' => 'after_label',
				),
			),
			'circle_button_url' => array(
				'type' => 'text',
				'args' => array(
					'label' => __( 'Circle Button URL', 'vibrant-life-theme' ),
					'description' => '<p class="description">' . __( 'This button becomes a regular Button on Mobile.', 'vibrant-life-theme' ) . '</p>',
					'description_tip' => false,
					'description_placement' => 'after_label',
					'input_atts' => array(
						'placeholder' => get_site_url(),
					),
				),
			),
		),
	) );
	
	vibrant_life_init_field_group( 'home_interstitial' );
	
}

function vibrant_life_home_call_to_action_metabox_content( $post_id ) {
	
	vibrant_life_do_field_media( array(
		'label' => '<strong>' . __( 'Image', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'call_to_action_image',
		'group' => 'home_call_to_action',
	) );
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Content', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'call_to_action_content',
		'group' => 'home_call_to_action',
		'wysiwyg' => true,
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
	) );
	
	vibrant_life_init_field_group( 'home_call_to_action' );
		
}

function vibrant_life_home_video_metabox_content( $post_id ) {
	
	vibrant_life_do_field_text( array(
		'label' => '<strong>' . __( 'Video URL', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'video_url',
		'group' => 'home_video',
		'description' => '<p class="description">' . __( 'Provide the Video URL, not the Embed Code.', 'vibrant-life-theme' ) . '</p>',
		'description_tip' => false,
		'description_placement' => 'after_label',
	) );
	
	vibrant_life_init_field_group( 'home_video' );
	
}

function vibrant_life_home_locations_metabox_content( $post_id ) {
	
	vibrant_life_do_field_text( array(
		'label' => '<strong>' . __( 'Locations Section Title', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'locations_title',
		'group' => 'home_locations',
	) );
	
	vibrant_life_init_field_group( 'home_locations' );
	
}

function vibrant_life_home_news_metabox_content( $post_id ) {
	
	vibrant_life_do_field_text( array(
		'label' => '<strong>' . __( 'News Section Title', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'news_title',
		'group' => 'home_news',
	) );
	
	vibrant_life_do_field_number( array(
		'label' => '<strong>' . __( 'Number of Blog Posts to show', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'news_count',
		'group' => 'home_news',
		'min' => -1,
		'description' => '<p class="description">' . __( 'Set to -1 to show all Blog Posts.', 'vibrant-life-theme' ) . '</p>',
		'description_tip' => false,
		'description_placement' => 'after_label',
	) );
	
	vibrant_life_init_field_group( 'home_news' );
	
}