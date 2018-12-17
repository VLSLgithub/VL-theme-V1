<?php
/*
Template Name: Contact Us
*/

global $post;

get_header(); 

while ( have_posts() ) : the_post(); ?>

<div class="main-content">

	<div class="swirl-border">

		<section id="interstitial" class="row interstitial">

			<div class="small-12 columns">
				<h1><?php the_title(); ?></h1>
			</div>

			<div class="small-12 medium-6 columns">

				<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'interstitial_content' ) ); ?>

			</div>

			<div class="small-12 medium-6 columns">

				<?php echo do_shortcode( '[gravityform id="' . vibrant_life_get_field( 'interstitial_form' ) .'" title="false" description="false" ajax="true"]' ); ?>

			</div>

		</section>

		<section id="map" class="row">

			<div class="small-12 columns">

				<?php echo do_shortcode( '[ASL_STORELOCATOR]' ); ?>

			</div>

		</section>

	</div>
	
</div>

<?php endwhile;

get_footer();