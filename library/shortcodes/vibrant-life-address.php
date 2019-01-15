<?php
/**
 * Adds the [vibrant_life_address] shortcode
 *
 * @since   1.0.0
 * @package VibrantLifeTheme2018
 * @subpackage  VibrantLifeTheme2018/library/shortcodes
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Address Shortcode
 * 
 * If no Store ID is provided, it will try to derive the correct one based on the current page
 * If no Store can be found, then no HTML will be returned
 *
 * @since       1.0.0
 * @return      HTML
 */
add_shortcode( 'vibrant_life_address', 'add_vibrant_life_address_shortcode' );
function add_vibrant_life_address_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
			'store_id' => get_the_ID(),
        ),
        $atts,
        'vibrant_life_address'
    );
    
    ob_start();
	
	$store = vibrant_life_get_asl_store_locator_store( (string) $atts['store_id'] );
	
	// Not a Store "Post", try to find one
	if ( ! $store ) {
		
		$location_id = vibrant_life_get_associated_location( $atts['store_id'] );
		
		$atts['store_id'] = vibrant_life_get_field( 'store', $location_id );
		
		$store = vibrant_life_get_asl_store_locator_store( (string) $atts['store_id'] );
		
	}
	
	if ( $store ) : ?>

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

    <?php endif; 
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}