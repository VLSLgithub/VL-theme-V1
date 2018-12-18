<?php
/**
 * Adds the [vibrant_life_address] shortcode
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
add_shortcode( 'vibrant_life_address', 'add_vibrant_life_address_shortcode' );
function add_vibrant_life_address_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
			'store_id' => 0,
        ),
        $atts,
        'vibrant_life_address'
    );
    
    ob_start();
	
	$store = vibrant_life_get_asl_store_locator_store( $atts['store_id'] );
	
	?>

	<div itemscope itemtype="http://data-vocabulary.org/Organization"> 
		<span itemprop="name"><?php esc_html_e( $store->title ); ?></span>

		<div itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
			<span itemprop="street-address"><?php esc_html_e( $store->street ); ?></span><br />
			<span itemprop="locality"><?php esc_html_e( $store->city ); ?></span>, 
			<span itemprop="region"><?php esc_html_e( $store->state ); ?></span> 
			<span itemprop="postal-code"><?php esc_html_e( $store->postal_code ); ?></span>
		</div>
		<span itemprop="geo" itemscope itemtype="http://www.data-vocabulary.org/Geo/" style="display:none">
			<span itemprop="latitude"><?php esc_html_e( $store->lat ); ?></span>  
			<span itemprop="longitude"><?php esc_html_e( $store->lng ); ?></span>  
		</span>
		<br />
		<?php _e( 'Phone:', 'vibrant-life-theme' ); ?> <span itemprop="tel"><?php esc_html_e( vibrant_life_get_phone_number_link( $store->phone ) ); ?></span>
		<?php if ( ! empty( $store->fax ) ) : ?>
		<br /><?php _e( 'Fax:', 'vibrant-life-theme' ); ?> <span itemprop="tel"><?php esc_html_e( vibrant_life_get_phone_number_link( $store->fax ) ); ?></span>
		<?php endif; ?>
		<?php if ( ! empty( $store->email ) ) : ?>
		<br /><?php _e( 'Email:', 'vibrant-life-theme' ); ?> <span itemprop="email"><a href="mailto:<?php esc_html_e( $store->email ); ?>"><?php esc_html_e( $store->email ); ?></a></span>
		<?php endif; ?>
		
	</div>

    <?php
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}