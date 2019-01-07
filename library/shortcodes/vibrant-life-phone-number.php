<?php
/**
 * Adds the [vibrant_life_phone_number] shortcode
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/shortcodes
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Phone Shortcode
 *
 * @since       1.0.0
 * @return      HTML
 */
add_shortcode( 'vibrant_life_phone_number', 'add_vibrant_life_phone_number_shortcode' );
function add_vibrant_life_phone_number_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
            'location' => get_the_ID(),
        ),
        $atts,
        'vibrant_life_phone_number'
    );
	
	$phone_number = rbm_cpts_get_field( 'phone_number', $atts['location'] );
	
	if ( empty( $phone_number ) ) {
		$phone_number = get_theme_mod( 'vibrant_life_phone_number', '(734) 913-0000' );
	}
    
    ob_start();
    
    echo vibrant_life_get_phone_number_link( $phone_number, '', $content );
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}