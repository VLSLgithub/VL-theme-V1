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
            'title'      => __( 'Vibrant Life Settings', 'vibrant-life-theme' ),
            'priority'   => 30,
        ) 
    );
	
	$wp_customize->add_setting( 'vibrant_life_404_hero', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'vibrant_life_404_hero', array(
        'label'      => __( '404 Hero Image', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_404_hero',
        'mime_type'  => 'image',
    ) ) );
	
	$wp_customize->add_setting( 'vibrant_life_facebook', array(
            'default'     => '//www.facebook.com/Vibrant-Life-Senior-Living-1387090288246432/',
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_facebook', array(
        'type' => 'url',
        'label'      => __( 'Facebook URL', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_facebook',
    ) ) );
    
    $wp_customize->add_setting( 'vibrant_life_twitter', array(
            'default'     => '',
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_twitter', array(
        'type' => 'url',
        'label'        => __( 'Twitter URL', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_twitter',
    ) ) );
    
    $wp_customize->add_setting( 'vibrant_life_pinterest', array(
            'default'     => '',
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_pinterest', array(
        'type' => 'url',
        'label'        => __( 'Pinterest URL', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_pinterest',
    ) ) );
    
    $wp_customize->add_setting( 'vibrant_life_linkedin', array(
            'default'     => '',
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_linkedin', array(
        'type' => 'url',
        'label'        => __( 'LinkedIn URL', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_linkedin',
    ) ) );
    
    $wp_customize->add_setting( 'vibrant_life_instagram', array(
            'default'     => '',
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_instagram', array(
        'type' => 'url',
        'label'        => __( 'Instagram URL', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_instagram',
    ) ) );
    
    $wp_customize->add_setting( 'vibrant_life_rss_show', array(
            'default'     => false,
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_rss_show', array(
        'type' => 'checkbox',
        'label'        => __( 'Show RSS Button', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_rss_show',
    ) ) );
    
} );