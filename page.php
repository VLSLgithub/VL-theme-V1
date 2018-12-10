<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

get_header();

do_action( 'foundationpress_before_content' ); ?>

<div class="swirl-border">
	<div class="main-wrap full-width has-interstitial">	
		<main class="main-content">
			 <?php while ( have_posts() ) : the_post(); ?>
			
				<section class="interstitial row">
					<div class="small-12 columns">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
				</section>
			
				<div <?php post_class( array( 'expanded', 'row' ) ) ?> id="post-<?php the_ID(); ?>">
					<div class="small-12 columns content">
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>

				</div>
			<?php endwhile;?>
		</main>
	</div>
</div>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php 

get_footer();