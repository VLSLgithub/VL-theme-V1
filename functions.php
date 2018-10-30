<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

$theme_header = wp_get_theme();

define( 'THEME_VER', $theme_header->get( 'Version' ) );
define( 'THEME_URL', get_stylesheet_directory_uri() );
define( 'THEME_DIR', get_stylesheet_directory() );

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );

global $vibrant_life_field_helpers;

if ( class_exists( 'RBM_FieldHelpers' ) ) {

	$vibrant_life_field_helpers = new RBM_FieldHelpers( array(
		'ID'   => 'vibrant_life', // Your Theme/Plugin uses this to differentiate its instance of RBM FH from others when saving/grabbing data
		'l10n' => array(
			'field_table'    => array(
				'delete_row'    => __( 'Delete Row', 'vibrant-life-theme' ),
				'delete_column' => __( 'Delete Column', 'vibrant-life-theme' ),
			),
			'field_select'   => array(
				'no_options'       => __( 'No select options.', 'vibrant-life-theme' ),
				'error_loading'    => __( 'The results could not be loaded', 'vibrant-life-theme' ),
				/* translators: %d is number of characters over input limit */
				'input_too_long'   => __( 'Please delete %d character(s)', 'vibrant-life-theme' ),
				/* translators: %d is number of characters under input limit */
				'input_too_short'  => __( 'Please enter %d or more characters', 'vibrant-life-theme' ),
				'loading_more'     => __( 'Loading more results...', 'vibrant-life-theme' ),
				/* translators: %d is maximum number items selectable */
				'maximum_selected' => __( 'You can only select %d item(s)', 'vibrant-life-theme' ),
				'no_results'       => __( 'No results found', 'vibrant-life-theme' ),
				'searching'        => __( 'Searching...', 'vibrant-life-theme' ),
			),
			'field_repeater' => array(
				'collapsable_title' => __( 'New Row', 'vibrant-life-theme' ),
				'confirm_delete'    => __( 'Are you sure you want to delete this element?', 'vibrant-life-theme' ),
				'delete_item'       => __( 'Delete', 'vibrant-life-theme' ),
				'add_item'          => __( 'Add', 'vibrant-life-theme' ),
			),
			'field_media'    => array(
				'button_text'        => __( 'Upload / Choose Media', 'vibrant-life-theme' ),
				'button_remove_text' => __( 'Remove Media', 'vibrant-life-theme' ),
				'window_title'       => __( 'Choose Media', 'vibrant-life-theme' ),
			),
			'field_checkbox' => array(
				'no_options_text' => __( 'No options available.', 'vibrant-life-theme' ),
			),
		),
	) );

	require_once( 'library/rbm-field-helpers-functions.php' );
	
}
else {
	
	// Complain
	
}

// Customizer
require_once( 'library/customizer.php' );

// Extra Meta
require_once( 'library/admin/extra-meta/front-page.php' );
require_once( 'library/admin/extra-meta/page.php' );

// Shortcodes
require_once( 'library/shortcodes/vibrant-life-button.php' );

// Gutenberg functionality
require_once( 'library/admin/gutenberg/columns.php' );

// TinyMCE functionality
//require_once( 'library/admin/tinymce/localization.php' );
//require_once( 'library/admin/tinymce/vibrant-life-button.php' );