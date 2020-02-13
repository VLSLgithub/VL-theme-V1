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
require_once( 'library/admin/extra-meta/page.php' );
require_once( 'library/admin/extra-meta/front-page.php' );
require_once( 'library/admin/extra-meta/blog.php' );
require_once( 'library/admin/extra-meta/about-us.php' );
require_once( 'library/admin/extra-meta/contact-us.php' );
require_once( 'library/admin/extra-meta/template-full-width-interstitial.php' );
require_once( 'library/admin/extra-meta/location.php' );
require_once( 'library/admin/extra-meta/landing-page.php' );

// Shortcodes
require_once( 'library/shortcodes/vibrant-life-button.php' );
require_once( 'library/shortcodes/vibrant-life-image-mask.php' );
require_once( 'library/shortcodes/vibrant-life-row.php' );
require_once( 'library/shortcodes/vibrant-life-column.php' );
require_once( 'library/shortcodes/vibrant-life-phone-number.php' );
require_once( 'library/shortcodes/vibrant-life-address.php' );

// TinyMCE functionality
require_once( 'library/admin/tinymce/localization.php' );
require_once( 'library/admin/tinymce/color-palette.php' );
require_once( 'library/admin/tinymce/text-styles.php' );
require_once( 'library/admin/tinymce/vibrant-life-button.php' );
require_once( 'library/admin/tinymce/vibrant-life-image-mask.php' );
require_once( 'library/admin/tinymce/vibrant-life-row.php' );
require_once( 'library/admin/tinymce/vibrant-life-column.php' );
require_once( 'library/admin/tinymce/vibrant-life-phone-number.php' );
require_once( 'library/admin/tinymce/vibrant-life-address.php' );

// Schedule a Visit
require_once( 'library/gravity-forms.php' );

add_filter( 'template_include', 'vibrant_life_blog_template' );
function vibrant_life_blog_template( $template ) {
	
	global $wp_query;
	
	if ( isset( $wp_query ) && 
		(bool) $wp_query->is_posts_page ) {
		
		$new_template = locate_template( array( 'blog.php' ) );
		if ( ! empty( $new_template ) ) {
			return $new_template;
		}
		
	}
	
	return $template;
	
}

/**
 * Returns a tel: link formatted all nicely
 * 
 * @param		string  $phone_number Phone Number
 * @param		string  $extension    Optional Extension to auto-dial to
 * @param		string  $link_text    Text to use instead of the Phone Number
 * @param		boolean $phone_icon   Whether to auto-include a Font Awesome Phone Icon or not
 * @param		boolean $echo         Whether to echo out the HTML. False returns the Tel Link
 *                                                                                    
 * @return		string  tel: Link
 */
function vibrant_life_get_phone_number_link( $phone_number, $extension = false, $link_text = '', $phone_icon = false, $echo = true ) {
    
    $trimmed_phone_number = preg_replace( '/\D/', '', trim( $phone_number ) );
    
    if ( strlen( $trimmed_phone_number ) == 10 ) { // No Country Code
        $trimmed_phone_number = '1' . $trimmed_phone_number;
    }
    else if ( strlen( $trimmed_phone_number ) == 7 ) { // No Country or Area Code
        $trimmed_phone_number = '1734' . $trimmed_phone_number; // We'll assume 734
    }
    
    $tel_link = 'tel:' . $trimmed_phone_number;
    
    if ( $link_text == '' ) {
        
        $link_text = $phone_number;
        
        if ( ( $extension !== false ) && ( $extension !== '' ) ) {
            $link_text = $link_text . __( ' x ', 'vibrant-life-theme' ) . $extension;
        }
        
    }
    
    if ( ( $extension !== false ) && ( $extension !== '' ) ) {
        $tel_link = $tel_link . ',' . $extension;
    }
    
	if ( $phone_icon ) $phone_icon = '<span class="fas fa-phone"></span> ';
	
	if ( $echo ) {
    
		return "<a href='$tel_link' class='phone-number-link'>$phone_icon$link_text</a>";
		
	}

	return $tel_link;
    
}

/**
 * Forcefully removes all L-SEP characters from the content in Chrome in Windows 10
 * Yeah... it is that weird
 * 
 * @param  string $content The Content
 *                             
 * @since 1.0.0
 * @return string The Content
 */
add_filter( 'the_content', 'vibrant_life_fix_l_sep' );
add_filter( 'the_title', 'vibrant_life_fix_l_sep' );
function vibrant_life_fix_l_sep( $content ) {
	
	return str_replace( html_entity_decode( "&#8232;" ), '', $content );
	
}

/**
 * Replace THRIVE in Post Titles with the Remachine Script Font
 * 
 * @param		string $title Post Title
 *                            
 * @since		1.0.0
 * @return		string Post Title
 */
add_filter( 'the_title', 'vibrant_life_thrive_font_in_title' );
function vibrant_life_thrive_font_in_title( $title ) {
	
	if ( ! in_the_loop() ) return $title;
	
	return str_replace( 'THRIVE', '<span class="remachinescript">THRIVE</span>', $title );
	
}

/**
 * Get Data for a specific "Store"
 * 
 * @param		integer        $store_id Store ID
 *                                        
 * @since		1.0.0
 * @return 		boolean|Object False on failure, Store Data Object on success
 */
function vibrant_life_get_asl_store_locator_store( $store_id ) {
	
	if ( ! defined( 'AGILESTORELOCATOR_PREFIX' ) ) return false;
	
	global $wpdb;

	$AGILESTORELOCATOR_PREFIX = AGILESTORELOCATOR_PREFIX;

	$bound   = '';

	$extra_sql = '';
	$country_field = '';

	$query   = "SELECT s.`id`, `title`,  `description`, `street`,  `city`,  `state`, `postal_code`, {$country_field} `lat`,`lng`,`phone`,  `fax`,`email`,`website`,`logo_id`,{$AGILESTORELOCATOR_PREFIX}storelogos.`path`,`open_hours`, `description_2`, 
				group_concat(category_id) as categories FROM {$AGILESTORELOCATOR_PREFIX}stores as s 
				LEFT JOIN {$AGILESTORELOCATOR_PREFIX}storelogos ON logo_id = {$AGILESTORELOCATOR_PREFIX}storelogos.id
				LEFT JOIN {$AGILESTORELOCATOR_PREFIX}stores_categories ON s.`id` = {$AGILESTORELOCATOR_PREFIX}stores_categories.store_id
				$extra_sql
				WHERE '{$store_id}' = s.`id` AND (is_disabled is NULL || is_disabled = 0) 
				GROUP BY s.`id` ";

	$query .= "LIMIT 1000";

	$results = $wpdb->get_results($query);
	
	if ( isset( $results[0] ) ) {
		return $results[0];
	}
	
	return false;
	
}

/**
 * Get Data for all "Stores"
 * 
 * @access		1.0.0
 * @return  	boolean|Array False on failure, Array of Store Objects on Success
 */
function vibrant_life_get_asl_store_locator_stores() {
	
	if ( ! defined( 'AGILESTORELOCATOR_PREFIX' ) ) return false;
	
	global $wpdb;

	$AGILESTORELOCATOR_PREFIX = AGILESTORELOCATOR_PREFIX;

	$bound   = '';

	$extra_sql = '';
	$country_field = '';

	$query   = "SELECT s.`id`, `title`,  `description`, `street`,  `city`,  `state`, `postal_code`, {$country_field} `lat`,`lng`,`phone`,  `fax`,`email`,`website`,`logo_id`,{$AGILESTORELOCATOR_PREFIX}storelogos.`path`,`open_hours`, `description_2`, 
				group_concat(category_id) as categories FROM {$AGILESTORELOCATOR_PREFIX}stores as s 
				LEFT JOIN {$AGILESTORELOCATOR_PREFIX}storelogos ON logo_id = {$AGILESTORELOCATOR_PREFIX}storelogos.id
				LEFT JOIN {$AGILESTORELOCATOR_PREFIX}stores_categories ON s.`id` = {$AGILESTORELOCATOR_PREFIX}stores_categories.store_id
				$extra_sql
				WHERE (is_disabled is NULL || is_disabled = 0) 
				GROUP BY s.`id` ";

	$query .= "LIMIT 1000";

	$results = $wpdb->get_results($query);
	
	if ( empty( $results ) ) {
		return false;
	}
	
	return $results;
	
}

add_action( 'admin_menu', function() {
	
	if ( is_user_logged_in() ) {
		$current_user       = wp_get_current_user();
		$roles              = $current_user->roles;
		$current_role = array_shift( $roles );
	}

	// Staging for some reason always had NULL as the Role. This fixes it.
	// My Local environment worked just fine though, so maybe in most cases this won't be needed
	if ( $current_role === NULL ) {

		global $user_ID;

		$user_data = get_userdata( $user_ID );
		$user_role = array_shift( $user_data->roles );
		$current_role = $user_role;

	}
	
	if ( $current_role == 'contributor' ) {
	
		remove_menu_page( 'asl-plugin' );
		
	}
	
} );

add_action( 'wp_head', function() {
	
	?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PPMNQXN');</script>
<!-- End Google Tag Manager -->

<?php 
	
} );

add_action( 'vibrant_life_body_start', function() {
	
	?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPMNQXN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php 
	
} );

add_filter( 'p2p_relationships', function( $relationships ) {
	
	$relationships['page'] = 'facility';
	
	return $relationships;
	
} );

/**
 * Finds the associtaed Location for a particular Page
 * Returns the Post ID if it is already a Location
 * 
 * @param		integer         $post_id Post ID
 *                                       
 * @since		1.0.3
 * @return 		integer|boolean Post ID on success, false on failure
 */
function vibrant_life_get_associated_location( $post_id = null ) {
	
	if ( ! $post_id ) $post_id = get_the_ID();
	
	if ( function_exists( 'rbm_cpts_get_p2p_parent' ) && 
		is_page() ) {
		$post_id = (int) rbm_cpts_get_p2p_parent( 'facility' );
	}

	$post_id = apply_filters( 'vibrant_life_get_associated_location', $post_id );

	if ( get_post_type( $post_id ) !== 'facility' ) return false;
	
	return $post_id;
	
}

/**
 * Shorthand to determine if a Page is a Landing Page
 *
 * @param   interger  $post_id  WP_Post ID
 *
 * @since	1.0.10
 * @return  boolean             True/False
 */
function vibrant_life_is_landing_page( $post_id = null ) {

	if ( ! $post_id ) $post_id = get_the_ID();

	if ( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'page-templates/landing-page.php' ) {
		return true;
	}

	return false;

}

/**
 * Allow an easy way to grab the Schedule a Visit form to use, as well as a way to override it via a Filter if needed
 *
 * @param   integer  $post_id  WP_Post ID. Optional
 *
 * @since	{{VERSION}}
 * @return  integer            Gravity Forms Post ID
 */
function vibrant_life_get_schedule_a_visit_form( $post_id = null ) {

	if ( ! $post_id ) $post_id = get_the_ID();

	$form = get_theme_mod( 'vibrant_life_schedule_a_visit_form', false );

	if ( $override = vibrant_life_get_field( 'schedule_a_visit_form', $post_id ) ) {
		$form = $override;
	}

	return apply_filters( 'vibrant_life_get_schedule_a_visit_form', $form, $post_id );

}

// This breaks RBM FH, so we have to tell it to stop
add_action( 'wp_print_scripts', function() {
	if ( class_exists( 'Nelio_AB_Testing' ) ) {
		wp_dequeue_script( 'nab-post-experiment-management' );
	}
} );