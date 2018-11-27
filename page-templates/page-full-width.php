<?php
/*
Template Name: Full Width
*/
get_header(); ?>

<div class="swirl-border">
	<div class="main-wrap full-width">
		<main class="main-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
			<?php endwhile;?>
		</main>
	</div>
</div>
<?php get_footer();
