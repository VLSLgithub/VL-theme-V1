<?php
/**
 * Adds the [vibrant_life_column] shortcode
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
add_shortcode( 'vibrant_life_column', 'add_vibrant_life_column_shortcode' );
function add_vibrant_life_column_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
			'small' => 'small-12',
			'medium' => 'medium-12',
			'large' => 'large-12',
        ),
        $atts,
        'vibrant_life_column'
    );
    
    ob_start();
	
	?>
    
    <div class="<?php echo $atts['small']; ?> <?php echo $atts['medium']; ?> <?php echo $atts['large']; ?> columns vibrant-life-column-shortcode">
		<?php echo do_shortcode( $content ); ?>
	</div>

    <?php
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}