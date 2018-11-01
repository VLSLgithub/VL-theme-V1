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

<?php endwhile;

get_footer();