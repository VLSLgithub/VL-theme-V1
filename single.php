<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<main class="main-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/content', '' ); ?>
		<section class="row navigation-container">
			<div class="small-12 columns">
				<?php the_post_navigation( array(
					'prev_text' => '<span class="fas fa-arrow-left" aria-hidden="true"></span> %title',
					'next_text' => '%title <span class="fas fa-arrow-right" aria-hidden="true"></span>',
				) ); ?>
			</div>
		</section>
		<?php comments_template(); ?>
	<?php endwhile;?>
</main>
<?php get_footer();
