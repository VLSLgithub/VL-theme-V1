<?php
/**
 * Register widget areas
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
function foundationpress_sidebar_widgets() {
	register_sidebar(array(
		'id' => 'sidebar-widgets',
		'name' => __( 'Sidebar widgets', 'vibrant-life-theme' ),
		'description' => __( 'Drag widgets to this sidebar container.', 'vibrant-life-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	));
	
	register_sidebar(array(
		'id' => 'footer-left',
		'name' => __( 'Footer - Left', 'vibrant-life-theme' ),
		'description' => __( 'Drag widgets to this footer container', 'vibrant-life-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'footer-center',
		'name' => __( 'Footer - Center', 'vibrant-life-theme' ),
		'description' => __( 'Drag widgets to this footer container', 'vibrant-life-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'id' => 'footer-right',
		'name' => __( 'Footer - Right', 'vibrant-life-theme' ),
		'description' => __( 'Drag widgets to this footer container', 'vibrant-life-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;
