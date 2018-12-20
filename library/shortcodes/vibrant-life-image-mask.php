<?php
/**
 * Adds the [vibrant_life_image_mask] shortcode
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
add_shortcode( 'vibrant_life_image_mask', 'add_vibrant_life_image_mask_shortcode' );
function add_vibrant_life_image_mask_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
            'mask' => 'half-circle-right',
			'align' => 'aligncenter',
			'equalizer' => false,
        ),
        $atts,
        'vibrant_life_image_mask'
    );
    
    ob_start();
	
	if ( ! $atts['equalizer'] ) : ?>
    
		<div class="vibrant-life-image-mask-shortcode image with-image-tag <?php echo $atts['mask']; ?> <?php echo $atts['align']; ?>">
			<?php echo $content; ?>
		</div>

	<?php else : 
				 
		$match = preg_match( '/wp-image-(\d+)/', $content, $matches );
				 
		$attachment_id = $matches[1];

		?>

		<div class="image <?php echo $atts['mask']; ?> <?php echo $atts['align']; ?>" style="background-image: url('<?php echo wp_get_attachment_image_src( $attachment_id, 'full', false )[0]; ?>');">
		</div>

    <?php endif;
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}