<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'small-12', $medium_class, 'columns' ) ); ?>>
	<section class="narrow-title">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<div class="half-circle-bottom">
				<div class="image with-image-tag">
					<?php the_post_thumbnail( 'medium' ); ?>
				</div>
			</div>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</a>
	</section>
	
	<?php edit_post_link( __( '(Edit)', 'vibrant-life-theme' ), '<span class="edit-link">', '</span>' ); ?>
	
</article>
