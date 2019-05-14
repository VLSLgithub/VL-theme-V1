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
	<section class="interstitial row">
		<div class="small-12 columns">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<hr />
			<?php foundationpress_entry_meta(); ?>
		</div>
	</section>
	
	<section class="entry-content row">
		<div class="small-12 columns">
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'vibrant-life-theme' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	</section>
	
</article>
