<?php
/**
 * Populates the Schedule a Visit Form based on the added Locations and the current Page
 */

// Populate Schedule a Visit Form
// Gravity Form ID is 2
add_filter( 'gform_pre_render_2', 'vibrant_life_populate_schedule_a_visit', 10, 3 );

/**
 * Pre-populate the Schedule a Visit Form
 * 
 * @param		array   $form         The current form to be filtered
 * @param		boolean $ajax         Is AJAX enabled
 * @param		array   $field_values An array of dynamic population parameter keys with their corresponding values to be populated
 *                                                                                                                   
 * @access		public
 * @since		1.0.1
 * @return		array   Modified Form
 */
function vibrant_life_populate_schedule_a_visit( $form, $ajax, $field_values ) {
	
	global $post;
	
	$locations = new WP_Query( array(
		'post_type' => 'facility',
		'posts_per_page' => -1,
		'meta_key' => 'rbm_cpts_short_name',
		'orderby' => 'meta_value',
		'order' => 'ASC',
	) );
	
	if ( ! $locations->have_posts() ) return $form;
	
	foreach ( $form['fields'] as &$field ) {
		
		if ( $field->id !== 3 ) continue; // Our Select is Field #3
		
		$location_id = false;
		
		if ( function_exists( 'rbm_cpts_get_field' ) && 
			  is_single() && 
			  get_post_type() == 'facility' ) {

			$location_id = get_the_ID();

		}
		elseif ( function_exists( 'rbm_cpts_get_p2p_parent' ) && 
			   is_page() ) {
			
			$location_id = rbm_cpts_get_p2p_parent( 'facility' );
			
		}
		
		// Remove all choices
		$field->choices = array();
		
		while ( $locations->have_posts() ) : $locations->the_post();
		
			$field->choices[] = array(
				'text' => rbm_cpts_get_field( 'short_name' ),
				'value' => rbm_cpts_get_field( 'short_name' ),
				'price' => '', // May as well send all the data
				'isSelected' => ( $location_id && rbm_cpts_get_field( 'short_name', $location_id ) == rbm_cpts_get_field( 'short_name' ) ) ? true : false,
			);
		
		endwhile;
		
		wp_reset_postdata();
		
	}
	
	return $form;
	
}