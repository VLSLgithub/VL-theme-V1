<?php
/**
 * Location extra meta.
 *
 * @since   1.0.3
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/extra-meta
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', 'vibrant_life_add_location_metaboxes' );

/**
 * Create Metaboxes for the About Page
 * 
 * @since       1.0.0
 * @return      void
 */
function vibrant_life_add_location_metaboxes() {
		
	add_meta_box(
		'vibrant-life-store-p2p',
		__( 'Attached Address', 'vibrant-life-theme' ),
		'vibrant_life_location_store_p2p',
		'facility',
		'side',
		'default'
	);
    
}

function vibrant_life_location_store_p2p( $post_id ) {
	
	$options = array();
	
	foreach ( vibrant_life_get_asl_store_locator_stores() as $store ) {
		
		$options[ $store->id ] = $store->title;
		
	}
	
	vibrant_life_do_field_select( array(
		'label' => '<strong>' . __( 'Address', 'vibrant-life-theme' ) . '</strong>',
		'name' => 'store',
		'group' => 'location_store_p2p',
		'placeholder' => __( 'Select an Address', 'vibrant-life-theme' ),
		'description' => sprintf( __( 'These are configured %shere%s', 'vibrant-life-theme' ), '<a href="' . admin_url( 'admin.php?page=manage-agile-store' ) . '">', '</a>' ),
		'description_tip' => false,
		'description_placement' => 'after_label',
		'options' => $options,
	) );
	
	vibrant_life_init_field_group( 'location_store_p2p' );
	
}