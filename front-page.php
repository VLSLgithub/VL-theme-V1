<?php
/**
 * Frontpage Template
 * @since {{VERSION}}
 *
 * @package RBMTheme
 */

global $post;

get_header(); 

while ( have_posts() ) : the_post(); ?>

	<header class="front-hero" role="banner">
		
		<div class="row expanded featured-hero front-hero">
				
			<div class="marketing">

				<div class="small-12 columns image" data-interchange="[<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, small], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, medium], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, large], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, xlarge]">
					<?php include_once THEME_DIR . '/dist/assets/images/hero-mask.svg'; ?>
					<div class="color-overlay"></div>
				</div>

				<div class="small-12 columns tagline">
					<div class="row">
						<div class="small-12 columns">
							<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'hero_tagline' ) ); ?>
						</div>
					</div>
				</div>

			</div>

		</div>

	</header>

	<section id="interstitial" class="row">
		
		<div class="small-12 columns">
			
			<div class="row top">
				
				<div class="small-12 medium-3 columns">
					
					<?php echo wp_get_attachment_image( vibrant_life_get_field( 'interstitial_image' ), 'full', false, array( 'class' => 'attachment-full size-full circle-mask' ) ); ?>
					
				</div>
				
				<div class="small-12 medium-9 columns">
					
					<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'interstitial_content' ) ); ?>
				
				</div>
			
			</div>
				
			<?php foreach ( $content_blocks = vibrant_life_get_field( 'interstitial_repeater' ) as $index => $row ) : ?>
			
				<div class="row block-<?php echo $index; ?>">
					
					<?php 
					
						$left_class_name = 'small-12 medium-6 columns image-on-left';
						$right_class_name = 'small-12 medium-6 columns';
					
						// Odd
						if ( $index % 2 == 0 ) : 
							
							$left_class_name = 'small-12 medium-6 medium-push-6 columns image-on-right';
							$right_class_name = 'small-12 medium-6 medium-pull-6 columns';
							
						endif;
						
					?>
					
					<div class="<?php echo $left_class_name; ?>">
						
						<?php echo wp_get_attachment_image( $row['image'], 'full' ); ?>
						
						<div class="show-for-medium">
							<div class="circle-button-container">
								<a href="<?php echo $row['circle_button_url']; ?>" title="<?php echo $row['circle_button_text']; ?>">
									<div class="circle-button">
										<span class="circle-button-text">
											<?php echo $row['circle_button_text']; ?>
										</span>
									</div>
								</a>
							</div>
						</div>
						
					</div>
					
					<div class="<?php echo $right_class_name; ?>">
						
						<?php echo apply_filters( 'the_content', $row['content'] ); ?>
						
						<div class="show-for-small-only text-center">
							<a class="button tertiary hollow" href="<?php echo $row['circle_button_url']; ?>" title="<?php echo $row['circle_button_text']; ?>">
								<?php echo $row['circle_button_text']; ?>
							</a>
						</div>
					
					</div>
					
				</div>

			<?php endforeach; ?>
		
		</div>

	</section>

	<section id="call-to-action" class="row expanded">
		
		<div class="small-12 medium-6 columns image-container" style="background-image: url('<?php echo wp_get_attachment_image_src( vibrant_life_get_field( 'call_to_action_image' ), 'full', false )[0]; ?>');">
		</div>
		
		<div class="small-12 medium-6 columns text-container">
			<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'call_to_action_content' ) ); ?>
		</div>
		
	</section>

	<section id="video" class="row expanded">
		
		<div class="video-popover-container small-12 columns half-circle-top-and-bottom">
                
			<?php echo wp_oembed_get( vibrant_life_get_field( 'video_url' ) ); ?>

		</div>

	</section>

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