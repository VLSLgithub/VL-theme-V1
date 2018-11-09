<?php
/**
 * Single Facility Template
 * @since {{VERSION}}
 *
 * @package VibrantLifeTheme2018
 */

global $post;

get_header(); 

while ( have_posts() ) : the_post(); ?>

	<section id="interstitial" class="row interstitial">
				
			<div class="small-12 medium-3 columns">

				<?php echo wp_get_attachment_image( rbm_cpts_get_field( 'interstitial_image' ), 'full', false, array( 'class' => 'attachment-full size-full circle-mask' ) ); ?>

			</div>

			<div class="small-12 medium-9 columns">

				<?php echo apply_filters( 'the_content', rbm_cpts_get_field( 'interstitial_content' ) ); ?>

			</div>
		
	</section>

	<section id="after-interstitial" class="row">
				
		<?php foreach ( $content_blocks = rbm_cpts_get_field( 'interstitial_repeater' ) as $index => $row ) : ?>

			<div class="small-12 medium-6 columns text-center">

				<?php echo wp_get_attachment_image( $row['image'], 'full' ); ?>

				<div class="show-for-medium">
					<div class="circle-button-container">
						<a href="<?php echo $row['circle_button_url']; ?>" title="<?php echo $row['circle_button_text']; ?>">
							<div class="circle-button animate-on-scroll scale-in-up">
								<span class="circle-button-text">
									<?php echo $row['circle_button_text']; ?>
								</span>
							</div>
						</a>
					</div>
				</div>

				<div class="show-for-small-only text-center">
					<a class="button tertiary hollow" href="<?php echo $row['circle_button_url']; ?>" title="<?php echo $row['circle_button_text']; ?>">
						<?php echo $row['circle_button_text']; ?>
					</a>
				</div>

			</div>

		<?php endforeach; ?>

	</section>

	<section id="call-to-action" class="row expanded" data-equalizer data-equalize-on="medium">
		
		<div class="small-12 medium-6 columns image-container" data-equalizer-watch>
			<div class="image" style="background-image: url('<?php echo wp_get_attachment_image_src( rbm_cpts_get_field( 'call_to_action_image' ), 'full', false )[0]; ?>');">
			</div>
		</div>
		
		<div class="small-12 medium-6 columns text-container" data-equalizer-watch>
			<?php echo apply_filters( 'the_content', rbm_cpts_get_field( 'call_to_action_content' ) ); ?>
		</div>
		
	</section>

	<section id="video" class="row expanded small-collapse">
		
		<div class="small-12 columns text-center">
			<h2><?php echo rbm_cpts_get_field( 'video_header_text' ); ?></h2>
		</div>
		
		<div class="video-popover-container small-12 columns half-circle-top">
                
			<?php echo wp_oembed_get( rbm_cpts_get_field( 'video_url' ) ); ?>

		</div>

	</section>

	<div class="reveal large video-popover" data-reveal data-reset-on-close="true">
    
		<div class="row">
			<div class="small-12 columns video-container">
				<?php echo wp_oembed_get( rbm_cpts_get_field( 'video_url' ) ); ?>
			</div>
		</div>

		<button class="close-button" data-close aria-label="<?php _e( 'Close modal', 'vibrant-life-theme' ); ?>" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

	</div>

<?php endwhile;

get_footer();