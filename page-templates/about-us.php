<?php
/*
Template Name: About Us
*/

global $post;

get_header(); 

while ( have_posts() ) : the_post(); ?>

<div class="swirl-border">

	<section id="interstitial" class="row interstitial">
		
		<div class="small-12 columns">
			
			<div class="row top">
				
				<div class="small-12 medium-3 columns">
					
					<div class="image with-image-tag circle-mask">
						<?php echo wp_get_attachment_image( vibrant_life_get_field( 'interstitial_image' ), 'full' ); ?>
					</div>
					
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
						
						<div class="image with-image-tag">
							<?php echo wp_get_attachment_image( $row['image'], 'full' ); ?>
						</div>
						
					</div>
					
					<div class="<?php echo $right_class_name; ?>">
						
						<?php echo apply_filters( 'the_content', $row['content'] ); ?>
					
					</div>
					
				</div>

			<?php endforeach; ?>
		
		</div>

	</section>

	<section id="call-to-action" class="row expanded" data-equalizer data-equalize-on="large">
		
		<div class="small-12 medium-12 large-6 columns image-container" data-equalizer-watch>
			<div class="image" style="background-image: url('<?php echo wp_get_attachment_image_src( vibrant_life_get_field( 'call_to_action_image' ), 'full', false )[0]; ?>');">
			</div>
		</div>
		
		<div class="small-12 medium-12 large-6 columns text-container" data-equalizer-watch>
			<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'call_to_action_content' ) ); ?>
		</div>
		
	</section>
	
</div>

<?php endwhile;

get_footer();