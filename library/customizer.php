<?php
/**
 * Customizer Additions
 *
 * @since   1.0.0
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

    // 404 Page options
    $wp_customize->add_section( 'vibrant_life_404_section' , array(
            'title'      => __( '404 Page Settings', 'vibrant-life-theme' ),
            'priority'   => 30,
        ) 
    );
	
	$forms = array( '' => __( 'Please activate Gravity Forms', 'vibrant-life-theme' ) );
	
	if ( class_exists( 'RGFormsModel' ) ) {
		
		$forms = wp_list_pluck( RGFormsModel::get_forms( null, 'title' ), 'title', 'id' );
		
	}
	
	$wp_customize->add_setting( 'vibrant_life_schedule_a_visit_form', array(
            'default'     => false,
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_schedule_a_visit_form', array(
        'type'       => 'select',
        'label'      => __( 'Schedule a Visit Form', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_schedule_a_visit_form',
		'choices' => array( '' => __( 'Choose a Form', 'vibrant-life-theme' ) ) + $forms,
    ) ) );
	
	$wp_customize->add_setting( 'vibrant_life_phone_number', array(
            'default'     => '(734) 913-0000',
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_phone_number', array(
        'type' => 'url',
        'label'      => __( 'Phone Number', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_customizer_section',
        'settings'   => 'vibrant_life_phone_number',
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

    $wp_customize->add_setting( 'vibrant_life_404_hero', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'vibrant_life_404_hero', array(
        'label'      => __( '404 Hero Image', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_404_section',
        'settings'   => 'vibrant_life_404_hero',
        'mime_type'  => 'image',
    ) ) );

    $wp_customize->add_setting( 'vibrant_life_404_quote_text', array(
            'default'     => __( 'First you forget names, then you forget faces… next you forget to pull your zipper up and finally, you forget to pull it down.', 'vibrant-life-theme' ),
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_404_quote_text', array(
        'type' => 'textarea',
        'label'        => __( 'Quote Text', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_404_section',
        'settings'   => 'vibrant_life_404_quote_text',
    ) ) );

    $wp_customize->add_setting( 'vibrant_life_404_quote_author', array(
            'default'     => __( 'George Burns', 'vibrant-life-theme' ),
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vibrant_life_404_quote_author', array(
        'type' => 'text',
        'label'        => __( 'Quote Author', 'vibrant-life-theme' ),
        'section'    => 'vibrant_life_404_section',
        'settings'   => 'vibrant_life_404_quote_author',
    ) ) );
    
} );