<?php
/**
 * Template Name: Landing Page
 * @since 1.0.9
 *
 * @package VibrantLifeTheme2018
 */

global $post;

add_filter( 'body_class', function( $body_classes ) {

	if ( vibrant_life_get_field( 'interstitial_disabled' ) ) {
		$body_classes[] = 'interstitial-disabled';
	}

	return $body_classes;

} );

add_filter( 'wp_get_nav_menu_items', 'vibrant_life_landing_page_menu_changes', 10, 3 );

/**
 * Only show the Schedule a Visit button in the Nav Menu on the Landing Page
 *
 * @param   array   $menu_items Array of Menu Item Objects
 * @param   object  $menu       Menu Object
 * @param   array   $args       Menu Item Args
 *
 * @since	1.0.9
 * @return  array               Menu Item Objects
 */
function vibrant_life_landing_page_menu_changes( $menu_items, $menu, $args ) {

	if ( ! vibrant_life_is_landing_page() ) return $menu_items;

	if ( $menu->slug !== 'primary-mobile-only' && $menu->slug !== 'primary' ) return $menu_items;

	$menu_items = array_filter( $menu_items, function( $menu_item ) {
		return in_array( 'open-modal-schedule-a-visit', $menu_item->classes );
	} );

	return $menu_items;

}

get_header(); 

while ( have_posts() ) : the_post(); ?>

	<div class="main-content">

		<div class="swirl-border">

			<?php if ( ! vibrant_life_get_field( 'interstitial_disabled' ) ) : ?>

				<section id="interstitial" class="row interstitial">

					<div data-equalizer data-equalize-on="medium">

						<div class="small-12 medium-3 columns" data-equalizer-watch>

							<div class="image with-image-tag circle-mask">
								<?php echo wp_get_attachment_image( vibrant_life_get_field( 'interstitial_image' ), 'full' ); ?>
							</div>

						</div>

						<div class="small-12 medium-9 columns" data-equalizer-watch>

							<div class="text">

								<?php the_content(); ?>

							</div>

						</div>

					</div>

				</section>

			<?php endif; ?>

			<?php if ( $call_to_action_sections = vibrant_life_get_field( 'call_to_action_sections' ) ) : ?>

				<section id="call-to-action">

					<?php foreach ( $call_to_action_sections as $index => $row ) : 

							$is_even = (bool) ( $index % 2 );
						
						?>
					
						<div class="row expanded" data-equalizer data-equalize-on="large">

							<div class="small-12 medium-12 large-6 <?php echo ( $is_even ) ? 'large-push-6 even ' : ''; ?>columns image-container" data-equalizer-watch>
								<div class="image" style="background-image: url('<?php echo wp_get_attachment_image_src( $row['image'], 'full', false )[0]; ?>');">
								</div>
							</div>

							<div class="small-12 medium-12 large-6 <?php echo ( $is_even ) ? 'large-pull-6 even ' : ''; ?>columns text-container" data-equalizer-watch>
								<?php echo apply_filters( 'the_content', $row['content'] ); ?>
							</div>

						</div>

					<?php endforeach; ?>

				</section>

			<?php endif; ?>

		</div>

		<?php if ( $video_url = vibrant_life_get_field( 'video_url' ) ) : ?>

			<section id="video" class="row small-collapse">

				<div class="small-12 columns text-center">
					<h2><?php echo vibrant_life_get_field( 'video_header_text' ); ?></h2>
				</div>

				<div class="video-popover-container small-12 columns half-circle-top">

					<?php echo wp_oembed_get( $video_url ); ?>

				</div>

			</section>

		<?php endif; ?>
		
	</div>

	<div class="reveal large video-popover" data-reveal data-reset-on-close="true">
    
		<div class="row">
			<div class="small-12 columns video-container">
				<?php echo wp_oembed_get( vibrant_life_get_field( 'video_url' ) ); ?>
			</div>
		</div>

		<button class="close-button" data-close aria-label="<?php _e( 'Close modal', 'vibrant-life-theme' ); ?>" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

	</div>

<?php endwhile;

get_footer();