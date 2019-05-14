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

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'small-12', 'medium-3', 'columns' ) ); ?>>
	<section class="narrow-title">
		<?php the_post_thumbnail( 'medium' ); ?>
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</section>
	
	<?php edit_post_link( __( '(Edit)', 'vibrant-life-theme' ), '<span class="edit-link">', '</span>' ); ?>
	
</article>
