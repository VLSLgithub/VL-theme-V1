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
	
	add_meta_box(
		'vibrant-life-hero',
		__( 'Hero', 'vibrant-life-theme' ),
		'vibrant_life_hero_metabox_content',
		'page',
		'normal',
		'high'
	);

	add_meta_box(
		'vibrant-life-schedule-a-visit-form',
		__( 'Schedule a Visit Form Override', 'vibrant-life-theme' ),
		'vibrant_life_schedule_a_visit_form_override',
		'page',
		'side'
	);
	
	// Each page except the Home Page
	if ( vibrant_life_is_editing_home() ) return;
    
}

function vibrant_life_hero_metabox_content( $post_id ) {
	
	?>

	<p class="description">
		<?php _e( 'The Hero Image is set using the Featured Image to the right', 'vibrant-life-theme' ); ?>
	</p>

	<?php 
	
	vibrant_life_do_field_textarea( array(
		'label' => '<strong>' . __( 'Tagline', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'hero_tagline',
		'wysiwyg' => true,
		'group' => 'hero',
		'wysiwyg_options' => vibrant_life_get_wysiwyg_options(),
		'default' => '',
		'description_tip' => false,
		'description_placement' => 'after_label',
	) );
	
	vibrant_life_init_field_group( 'hero' );
	
}

function vibrant_life_schedule_a_visit_form_override( $post_id ) {

	$forms = array( '' => __( 'Please activate Gravity Forms', 'vibrant-life-theme' ) );
	
	if ( class_exists( 'RGFormsModel' ) ) {
		
		$forms = wp_list_pluck( RGFormsModel::get_forms( null, 'title' ), 'title', 'id' );
		
	}

	vibrant_life_do_field_select( array(
		'label' => '<strong>' . __( 'Form to use instead of the one defined in the Customizer', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'schedule_a_visit_form',
		'group' => 'schedule_a_visit_form',
		'default' => get_theme_mod( 'vibrant_life_schedule_a_visit_form', false ),
		'description_tip' => false,
		'description_placement' => 'after_label',
		'options' => $forms,
	) );
	
	vibrant_life_init_field_group( 'schedule_a_visit_form' );

}