<?php
/**
 * Localize TinyMCE Plugins
 *
 * @since   {{VERSION}}
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/admin/tinymce
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * wp_localize_script() doesn't work on non-enqueued scripts like TinyMCE Plugins
 * So we're going to fake it!
 *
 * @since       {{VERSION}}
 * @return      void
 */
add_action( 'before_wp_tiny_mce', 'vibrant_life_localize_tinymce' );
function vibrant_life_localize_tinymce() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) :
    
        $object_name = apply_filters( 'vibrant_life_tinymce_l10n_object_name', 'vibrant_life_tinymce_l10n' );

        $l10n = apply_filters( 'vibrant_life_tinymce_l10n', array() );

        foreach ( $l10n as $key => $value ) {

            if ( ! is_scalar( $value ) )
                continue;

            $l10n[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );

        }

        $script = "var $object_name = " . wp_json_encode( $l10n ) . ';';

        $script = "/* <![CDATA[ */\n" . $script . "\n/* ]]> */";

        ?>

        <script type="text/javascript"><?php echo $script; ?></script>

        <?php
    
    endif;

}

/**
 * Shorthand for grabbing our WYSIWYG Options
 * 
 * @param		string $context Context in which we are grabbing our options. Only important if you're filtering the value
 *                                                                                                              
 * @since		1.0.0
 * @return		array  WYSIWYG Options
 */
function vibrant_life_get_wysiwyg_options( $context = 'default' ) {
	
	return apply_filters( 'vibrant_life_get_wysiwyg_options', array(
		'mediaButtons' => true,
		'tinymce' => array(
			'content_css' => THEME_URL . '/dist/assets/css/app.css',
			'toolbar1' => 'styleselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,wp_adv' . _vibrant_life_get_wysiwyg_shortcode_buttons( $context ),
			'toolbar2' => 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
			'textcolor_map' => _vibrant_life_get_custom_tinymce_colors( $context ),
			'style_formats' => _vibrant_life_get_custom_text_styles( $context ),
			'external_plugins' => array(
				'vibrant_life_button_shortcode_script' => THEME_URL . '/dist/assets/js/tinymce/vibrant-life-button.js',
				'vibrant_life_image_mask_shortcode_script' => THEME_URL . '/dist/assets/js/tinymce/vibrant-life-image-mask.js',
				'vibrant_life_row_shortcode_script' => THEME_URL . '/dist/assets/js/tinymce/vibrant-life-row.js',
				'vibrant_life_column_shortcode_script' => THEME_URL . '/dist/assets/js/tinymce/vibrant-life-column.js',
				'vibrant_life_phone_number_shortcode_script' => THEME_URL . '/dist/assets/js/tinymce/vibrant-life-phone-number.js',
			),
		),
	), $context );
	
}

/**
 * Grab all custom TinyMCE Shortcode Buttons we should be adding to the WYSIWYG
 * 
 * @param		string $context Context in which we are grabbing our options. Only important if you're filtering the value
 *                                                                                                              
 * @access		private
 * @since		1.0.0
 * @return		string Comma Separated Shortcode Buttons, prefixed with a comma
 */
function _vibrant_life_get_wysiwyg_shortcode_buttons( $context = 'default' ) {
	
	$shortcode_buttons = apply_filters( 'vibrant_life_get_wysiwyg_shortcode_buttons', array(
		'vibrant_life_button_shortcode',
		'vibrant_life_image_mask_shortcode',
		'vibrant_life_row_shortcode',
		'vibrant_life_column_shortcode',
		'vibrant_life_phone_number_shortcode',
	), $context );
	
	if ( ! empty( $shortcode_buttons ) ) {
		
		return ',' . implode( ',', $shortcode_buttons );
		
	}
	
	return '';
	
}