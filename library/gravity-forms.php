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
		
			if ( function_exists( 'rbm_cpts_get_field' ) ) {
		
				$field->choices[] = array(
					'text' => rbm_cpts_get_field( 'short_name' ),
					'value' => rbm_cpts_get_field( 'short_name' ),
					'price' => '', // May as well send all the data
					'isSelected' => ( $location_id && rbm_cpts_get_field( 'short_name', $location_id ) == rbm_cpts_get_field( 'short_name' ) ) ? true : false,
				);
				
			}
		
		endwhile;
		
		wp_reset_postdata();
		
	}
	
	return $form;
	
}

add_filter( 'gform_notification_2', 'vibrant_life_route_schedule_a_visit_emails', 10, 3 );

/**
 * Send Email Notifications to the correct person based on the selected Location
 * 
 * @param		array $notification The Current Notification to be filtered
 * @param		array $form         The form that was submitted
 * @param		array $entry        The entry data that was submitted
 * 
 * @since		1.0.2
 * @return		array The filtered Notification
 */
function vibrant_life_route_schedule_a_visit_emails( $notification, $form, $entry ) {
	
	if ( ! function_exists( 'rbm_cpts_get_field' ) ) return $notification;
	
	if ( $notification['to'] !== 'do.not.change@fake.com' ) return $notification;
	
	if ( ! isset( $entry[3] ) ) return $notification; // Nothing for Field #3
	
	$location = new WP_Query( array(
		'post_type' => 'facility',
		'posts_per_page' => 1,
		'fields' => 'ids',
		'meta_query' => array(
			'relationship' => 'AND',
			array(
				'key' => 'rbm_cpts_short_name',
				'value' => $entry[3],
				'compare' => '=',
			),
		),
	) );
	
	if ( ! $location->have_posts() ) return $notification;
	
	$location_id = $location->posts[0];
	
	$notification['to'] = rbm_cpts_get_field( 'form_email', $location_id );
	
	return $notification;
	
}