<?php
/**
 * The default template for displaying page content
 *
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! has_post_thumbnail() ) : ?>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>
	<div class="entry-content">
		<?php add_filter('the_content', 'sfsi_social_buttons_below'); ?>
		<?php the_content(); ?>
		<?php remove_filter('the_content', 'sfsi_social_buttons_below'); ?>
		<?php edit_post_link( __( '(Edit)', 'vibrant-life-theme' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<footer>
		<?php
			wp_link_pages(
				array(
					'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'vibrant-life-theme' ),
					'after'  => '</p></nav>',
				)
			);
		?>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
</article>