<?php
/**
 * Adds the [vibrant_life_row] shortcode
 *
 * @since   {{VERSION}}
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/shortcodes
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Button Shortcode
 *
 * @since       {{VERSION}}
 * @return      HTML
 */
add_shortcode( 'vibrant_life_row', 'add_vibrant_life_row_shortcode' );
function add_vibrant_life_row_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
			'equalizer' => false,
        ),
        $atts,
        'vibrant_life_row'
    );
    
    ob_start();
	
	?>
    
    <div class="row expanded vibrant-life-row-shortcode<?php echo ( $atts['equalizer'] ) ? ' has-equalizer': ''; ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>

    <?php
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}