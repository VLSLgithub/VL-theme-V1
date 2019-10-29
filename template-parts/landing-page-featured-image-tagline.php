<?php 

global $wp_query;

// We fake in-the-loop to ensure we only do THRIVE replacements at the right time
$wp_query->in_the_loop = true;

if ( has_post_thumbnail() ) : ?>

<header class="title-hero" role="banner">
		
	<div class="row expanded featured-hero landing-page-featured-hero title-hero">

		<div class="marketing">

			<div class="small-12 columns image" data-interchange="[<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, small], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, medium], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, large], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, xlarge]">
			</div>
			
			<div class="color-overlay"></div>
			
			<div class="expanded row flourishes small-collapse show-for-large">

				<div class="flourish flourish-left small-12 large-6 text-left columns">

					<?php include THEME_DIR . '/dist/assets/images/flourish.svg'; ?>

				</div>

				<div class="flourish flourish-right large-6 columns text-right">

					<?php include THEME_DIR . '/dist/assets/images/flourish.svg'; ?>

				</div>

			</div>

			<div class="small-12 columns tagline">
				<div class="row">
					<div class="small-12 medium-7 columns">
						
						<?php if ( apply_filters( 'vibrant_life_show_hero_title', true ) ) : ?>
						
							<h1 class="page-title small-text-center medium-text-left"><?php the_title(); ?></h1>
						
						<?php 
						
						endif;
						
						$tagline = vibrant_life_get_field( 'hero_tagline' );
						
						if ( ! $tagline ) {
							$tagline = rbm_cpts_get_field( 'hero_tagline' );
                        }
                        
                        ?>

                        <div class="small-text-center medium-text-left">
						
                            <?php echo apply_filters( 'the_content', $tagline ); ?>
                            
                        </div>
						
					</div>
					<div class="small-12 medium-5 columns">

						<?php $form_id = get_theme_mod( 'vibrant_life_schedule_a_visit_form', false ); 
			
							if ( $form_id ) { 
								
								echo do_shortcode( '[gravityform id="' . $form_id . '" title="true" description="false" ajax="false"]' );
								
							}
							else {
								_e( 'Please set a Form in the Customizer for the Schedule a Visit modal', 'vibrant-life-theme' );
							}
							
						?>

					</div>
				</div>
			</div>

		</div>

	</div>

</header>

<?php

endif;

$wp_query->in_the_loop = false;