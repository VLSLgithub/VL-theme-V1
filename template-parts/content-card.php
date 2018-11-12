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
		<cite>
			<?php foundationpress_entry_meta(); ?>
		</cite>

		<?php the_excerpt(); ?>

		<a href="<?php the_permalink(); ?>" class="primary button">
			<?php _e( 'Learn More', 'vibrant-life-theme' ); ?>
		</a>
		
	</div>
	
</div>