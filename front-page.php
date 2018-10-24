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
		<div class="marketing main-wrap">
			
			<?php if ( has_post_thumbnail() ) : ?>

				<div class="image" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>')">
					<div class="color-overlay"></div>
				</div>
			
			<?php endif; ?>
			
			<div class="row tagline">
				<div class="small-12 columns">
					<?php the_content(); ?>
				</div>
			</div>

		</div>

	</header>

<?php endwhile;

get_footer();