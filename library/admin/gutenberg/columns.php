<?php 

defined( 'ABSPATH' ) || exit;
/**
 * Load all translations for our plugin from the MO file.
*/
//add_action( 'init', 'vibrant_life_load_textdomain' );
function vibrant_life_load_textdomain() {
	load_plugin_textdomain( 'vibrant-life-theme', false, basename( __DIR__ ) . '/languages' );
}
/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function vibrant_life_register_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}
	
	wp_register_script(
		'vibrant-life-columns',
		THEME_URL . '/dist/assets/js/gutenberg/columns.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore', 'wp-edit-post' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER
	);
	wp_register_style(
		'vibrant-life-columns',
		THEME_URL . '/dist/assets/css/gutenberg/editor/columns.css',
		array( ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER
	);
	register_block_type( 'vibrant-life/columns', array(
		'style' => 'vibrant-life-columns',
		'script' => 'vibrant-life-columns',
	) );
	
	wp_register_script(
		'vibrant-life-column',
		THEME_URL . '/dist/assets/js/gutenberg/column.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER
	);
	register_block_type( 'vibrant-life/column', array(
		'script' => 'vibrant-life-column',
	) );
	
	/*
	 * Pass already loaded translations to our JavaScript.
	 *
	 * This happens _before_ our JavaScript runs, afterwards it's too late.
	wp_add_inline_script(
		'vibrant-life-columns',
		sprintf( 
			'var vibrant_life = { localeData: %s };', 
			json_encode( gutenberg_get_jed_locale_data( 'vibrant-life' ) ) 
		),
		'before'
	);
	*/
} 
add_action( 'init', 'vibrant_life_register_block' );

add_filter( 'allowed_block_types', 'my_function' );

function my_function( $allowed_block_types ) {
	
	if ( isset( $allowed_block_types['core/columns'] ) ) {
		unset( $allowed_block_types['core/columns'] );
	}

    return $allowed_block_types;

}