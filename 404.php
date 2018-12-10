<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="swirl-border">
	<div class="main-wrap full-width has-interstitial">	
		<main class="main-content">
			<article class="small-12 columns">

				<section class="entry-content interstitial row">

					<div class="page-title small-12 columns">
						<h1 class="entry-title"><?php _e( '404. Oh my, where did we put that?', 'vibrant-life-theme' ); ?></h1>
					</div>

					<div class="small-12 medium-6 columns">

						<blockquote>
							<p>
								<?php _e( 'First you forget names, then you forget faces… next you forget to pull your zipper up and finally, you forget to pull it down.', 'vibrant-life-theme' ); ?>
							</p>
							<footer>
								<?php _e( '~ George Burns', 'vibrant-life-theme' ); ?>
							</footer>
						</blockquote>

					</div>

					<div class="small-12 medium-6 columns">

						<p>
							<?php _e( 'Let’s get you back on track. Pick a link or search here:', 'vibrant-life-theme' ); ?>
						</p>

						<?php wp_nav_menu( array(
							'container'      => false,
							'menu_class'     => 'menu',
							'items_wrap'     => '<ul id="%1$s" class="%2$s 404-menu">%3$s</ul>',
							'theme_location' => 'four-oh-four',
							'depth'          => 1,
							'walker'         => new Foundationpress_Top_Bar_Walker(),
						) ); ?>

					</div>

				</div>

			</article>
		</main>
	</div>
</div>

<?php 

get_footer();