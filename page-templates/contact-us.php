<?php
/*
Template Name: Contact Us
*/

global $post;

get_header(); 

while ( have_posts() ) : the_post(); ?>

	<section id="interstitial" class="row interstitial">
		
		<div class="small-12 columns">
			<h1><?php the_title(); ?></h1>
		</div>
		
		<div class="small-12 medium-6 columns">
					
			<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'interstitial_content' ) ); ?>
				
		</div>
		
		<div class="small-12 medium-6 columns">
		
			form goes here
			
		</div>
			
	</section>

	<section id="map" class="row">
		
		<div class="small-12 columns">
		
			<?php echo do_shortcode( '[ASL_STORELOCATOR]' ); ?>
			
		</div>
		
	</section>

<?php endwhile;

get_footer();