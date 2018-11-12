<?php
/**
 * Custom Template File for the Blog Page
 */

global $wp_query;
global $post;

// Use what we want for $post for building out our page
$post = get_post( $wp_query->queried_object->ID );

get_header(); ?>

<section id="interstitial" class="interstitial row">
			
	<div class="small-12 columns">
		<h1><?php _e( 'The V Word: Vibrant Life News', 'vibrant-life-theme' ); ?></h1>
		<?php echo apply_filters( 'the_content', __( 'The Vibrant Life Senior Living blog covers different topics related to senior living, memory care, healthy aging, and events around the Vibrant Life communities.', 'vibrant-life-theme' ) ); ?>
	</div>

</section>

<div class="main-wrap">
	<main class="main-content">
		
		<section id="blog-posts" class="row">
		
			<?php if ( have_posts() ) : 

				// Fix $post
				wp_reset_postdata(); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div <?php post_class( array( 'small-12', 'medium-6', 'columns', 'text-center' ) ); ?>>
						<?php get_template_part( 'template-parts/content', 'card' ); ?>
					</div>
				<?php endwhile; ?>

			<?php else : ?>
			
				<div class="small-12 columns">
			
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
					
				</div>

			<?php endif; // End have_posts() check. ?>
			
		</section>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
		?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'vibrant-life-theme' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'vibrant-life-theme' ) ); ?></div>
			</nav>
		<?php endif; ?>

	</main>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
