<?php
/**
 * Customizer Additions
 *
 * @since   {{VERSION}}
 * @package VibrantLifeTheme2018
 * @subpackage VibrantLifeTheme2018/library
 */

add_action( 'customize_register', function( $wp_customize ) {
    
    // General Theme Options
    $wp_customize->add_section( 'vibrant_life_customizer_section' , array(
            'title'      => __( 'Greater Jackson Habitat for Humanity Settings', 'vibrant-life-theme' ),
            'priority'   => 30,
        ) 
    );
	
	$wp_customize->add_setting( 'vibrant_life_logo_image', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'vibrant_life_logo_image', array(
        'label'        => __( 'Interior Page Hero', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_logo_image',
        'mime_type'  => 'image',
    ) ) );
    
} );