<?php
/**
 * Card that displays within a Loop
 *
 * @package VibrantLifeTheme2018
 */

?>

<div class="card">
	
	<?php the_post_thumbnail( 'medium' ); ?>
	
	<div class="card-content">
		
		<h4><?php the_title(); ?></h4>

		<?php the_excerpt(); ?>

		<a href="<?php the_permalink(); ?>" class="secondary button" title="<?php _e( 'Learn More', 'vibrant-life-theme' ); ?>">
			<?php _e( 'Learn More', 'vibrant-life-theme' ); ?>
		</a>
		
	</div>
	
</div>