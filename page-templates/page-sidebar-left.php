<?php
/*
Template Name: Left Sidebar
*/
get_header(); ?>

<div class="swirl-border">
	<div class="main-wrap sidebar-left">
		<main class="main-content">
			<?php while ( have_posts() ) : the_post(); ?>	
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
			<?php endwhile;?>
		 </main>
	<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer();
