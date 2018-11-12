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

	<?php 

		global $post;

		$locations_query = new WP_Query( array(
			'post_type' => 'facility',
			'posts_per_page' => -1,
		) );

		if ( $locations_query->have_posts() ) : ?>

			<section id="locations" class="row">
				
				<div class="small-12 columns row expanded locations-container queue-on-scroll fade-in">
				
					<?php while( $locations_query->have_posts() ) : $locations_query->the_post(); ?>

						<article <?php post_class( array( 'small-12', 'medium-3', 'columns', 'queued-item' ) ); ?> aria-labelledby="post-<?php the_ID(); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>');">
							
							<a href="<?php the_permalink(); ?>">
								
								<div class="color-overlay"></div>
							
								<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
								
							</a>
							
						</article>

					<?php endwhile; ?>
					
				</div>

			</section>

		<?php 

			wp_reset_postdata();

		endif; 

	?>

	<section id="map" class="row">
		
		<div class="small-12 columns">
		
			<?php echo do_shortcode( '[ASL_STORELOCATOR]' ); ?>
			
		</div>
		
	</section>

<?php endwhile;

get_footer();