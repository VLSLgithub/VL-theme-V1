<?php
/**
 * Staff extra meta.
 *
 * @since   1.0.3
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', 'vibrant_life_add_staff_metaboxes' );

/**
 * Create Metaboxes for the About Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_staff_metaboxes() {
		
	add_meta_box(
		'vibrant-life-staff-featured',
		__( 'Staff Theme Options', 'vibrant-life-theme' ),
		'vibrant_life_staff_featured',
		'staff',
		'side',
		'default'
	);
    
}

function vibrant_life_staff_featured( $post_id ) {
	
	vibrant_life_do_field_checkbox( array(
		'label' => '<strong>' . __( 'Featured?', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'featured',
		'group' => 'staff_featured',
		'description' =>  __( 'If selected, this staff member will show on the Location Page.', 'vibrant-life-theme' ),
		'description_tip' => false,
        'description_placement' => 'after_label',
        'options' => array(
            __( 'Featured', 'vibrant-life-theme' )
        )
	) );
	
	vibrant_life_init_field_group( 'staff_featured' );
	
}