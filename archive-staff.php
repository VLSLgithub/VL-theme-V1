<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

global $wp_query;

get_header(); ?>

<div class="swirl-border">
	<div class="main-wrap full-width">
		<main class="main-content">
		<?php if ( have_posts() ) : ?>

			<h1 class="page-title">
				<?php if ( $location_slug = $wp_query->get( 'vibrant_life_location' ) ) : 

					$location_id = get_posts( array(
						'post_type' => 'facility',
						'name' => $location_slug,
						'posts_per_page' => 1,
						'fields' => 'ids',
					) );

					if ( ! empty( $location_id ) ) {

						$location_id = $location_id[0];

					}
					else { 
						$location_id = false;
					}

					_e( 'Our Staff', 'vibrant-life-theme' );

					if ( $location_id ) :

						_e( ' at ', 'vibrant-life-theme' );
						echo get_the_title( $location_id );

					endif;

				endif; ?>
			</h1>

			<div class="row">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/loop/loop', 'staff' ); ?>
				<?php endwhile; ?>

			</div>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; // End have_posts() check. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
			if ( function_exists( 'foundationpress_pagination' ) ) :
				foundationpress_pagination();
			elseif ( is_paged() ) :
			?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Previous Staff', 'vibrant-life-theme' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Next Staff &rarr;', 'vibrant-life-theme' ) ); ?></div>
				</nav>
			<?php endif; ?>

		</main>

	</div>
</div>

<?php get_footer();
