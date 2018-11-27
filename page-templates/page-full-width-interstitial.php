<?php
/*
Template Name: Full Width with Interstitial
*/
get_header(); ?>

<div class="swirl-border">
	<div class="main-wrap full-width has-interstitial">	
		<main class="main-content">
			<?php while ( have_posts() ) : the_post(); ?>

				<section id="interstitial" class="row interstitial">

					<div class="small-12 medium-3 columns">

						<div class="image with-image-tag circle-mask">
							<?php echo wp_get_attachment_image( vibrant_life_get_field( 'interstitial_image' ), 'full' ); ?>
						</div>

					</div>

					<div class="small-12 medium-9 columns">

						<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'interstitial_content' ) ); ?>

					</div>

				</section>

				<section id="page-content">
					<?php get_template_part( 'template-parts/content', 'page' ); ?>
				</section>
				<?php comments_template(); ?>
			<?php endwhile;?>
		</main>
	</div>
</div>
<?php get_footer();
