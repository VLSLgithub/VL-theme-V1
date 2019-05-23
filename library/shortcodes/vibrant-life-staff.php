<?php
/**
 * Adds the [vibrant_life_staff] shortcode
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
 * Add Row Shortcode
 *
 * @since       {{VERSION}}
 * @return      HTML
 */
add_shortcode( 'vibrant_life_staff', 'add_vibrant_life_staff_shortcode' );
function add_vibrant_life_staff_shortcode( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
            'location' => vibrant_life_get_associated_location(),
            'featured' => false,
            'columns' => 'medium-3',
        ),
        $atts,
        'vibrant_life_staff'
    );

    $medium_class = $atts['columns'];

    $meta_query = array(
        'relation' => 'AND',
        array(
            'key' => 'rbm_cpts_p2p_facility',
            'value' => $atts['location'],
            'compare' => 'LIKE',
        ),
    );

    if ( $atts['featured'] ) {

        $meta_query[] = array(
            'key' => 'vibrant_life_featured',
            'compare' => 'EXISTS',
        );

    }

    $staff = new WP_Query( array( 
        'post_type' => 'staff',
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
    ) );
	
	if ( $staff->have_posts() ) : ?>
    
        <div class="row vibrant-life-staff-shortcode">

            <?php while ( $staff->have_posts() ) : $staff->the_post(); ?>

                <?php include locate_template( 'template-parts/loop/loop-staff.php', false, false ); ?>

            <?php endwhile; wp_reset_postdata(); ?>
            
        </div>

    <?php endif;
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( $output );
    
}