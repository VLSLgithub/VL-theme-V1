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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_single() ) : ?>
		<section class="interstitial row">
			<div class="small-12 columns">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
		</section>
	<?php else : ?>
		<section class="row narrow-title">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php foundationpress_entry_meta(); ?>
		</section>
	<?php endif; ?>
	
	<section class="entry-content row">
		<div class="small-12 columns">
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'vibrant-life-theme' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</section>
	
</article>
