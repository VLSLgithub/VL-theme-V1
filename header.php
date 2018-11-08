<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( array(
		'offcanvas',
	)); ?>>

	<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
		
	<header class="site-header" role="banner">
		
		<div class="top-bar extra show-for-medium">

			<div class="top-bar-left">
				<?php _e( 'Welcome to Vibrant Life', 'vibrant-life-theme' ); ?>
			</div>

			<div class="top-bar-right social">

				<?php 
					$social_accounts = array(
						'vibrant_life_facebook' => array( 
							'label' => 'Facebook',
							'icon' => 'facebook-square',
						),
						'vibrant_life_twitter' => array( 
							'label' => 'Twitter',
							'icon' => 'twitter-square',
						),
						'vibrant_life_pinterest' => array( 
							'label' => 'Pinterest',
							'icon' => 'pinterest-square',
						),
						'vibrant_life_linkedin' => array( 
							'label' => 'LinkedIn',
							'icon' => 'linkedin-square',
						),
						'vibrant_life_instagram' => array( 
							'label' => 'Instagram',
							'icon' => 'instagram',
						),
					);

				foreach ( $social_accounts as $key => $social ) :
					if ( get_theme_mod( $key, '' ) !== '' ) : ?>
				
						<div>

							<a class="social-icon" href="<?php echo get_theme_mod( $key, '' ); ?>" target="_blank" title="<?php echo sprintf( __( 'Connect with us on %s', 'vibrant-life-theme' ), $social['label'] ); ?>">
								<span class="fab fa-fw fa-2x fa-<?php echo $social['icon']; ?>"></span>
							</a>
							
						</div>

					<?php endif;
				endforeach;

				if ( get_theme_mod( 'vibrant_life_rss_show', false ) === true ) : ?>

					<a class="social-icon" href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php _e( 'Get our RSS Feed', 'vibrant-life-theme' ); ?>">
						<span class="fas fa-fw fa-rss-square"></span>
					</a>

				<?php endif; ?>

			</div>

			<div class="top-bar-right phone">
				
				<div>

					<a href="tel:17349130000">(734) 913-0000</a>
					
				</div>

			</div>
			
			<div class="top-bar-right search">
				
				<div>

					<button data-open-search>
						<span class="fas fa-fw fa-search"></span>
					</button>
					
				</div>

			</div>

		</div>

		<div id="sticky-anchor">
			<?php // This allows the Sticky Menu Bar to only become stuck once it hits the top of the screen ?>
		</div>
		
		<div class="sticky-container" data-sticky-container>

			<div class="sticky-top-bar" data-sticky data-options="topAnchor: sticky-anchor; <?php echo ( is_admin_bar_showing() ) ? 'marginTop: 1;' : 'marginTop: 0;'; ?> stickyOn: small;">

				<div class="site-title-bar title-bar">
					<div class="title-bar-left">
						<span class="site-mobile-title title-bar-title show-for-small-only">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

								<div class="circle-backdrop"></div>

								<div class="svg-container">
									<?php // Because Gradients use IDs, we need a separate file with just the IDs changed to do this. Yeah, it is pretty dumb ?>
									<?php echo file_get_contents( THEME_DIR . '/dist/assets/images/logo-horizontal-mobile.svg' ); ?>
								</div>

							</a>
						</span>
						<button class="alignright menu-icon" type="button" data-toggle="off-canvas-menu"></button>
					</div>
				</div>

				<nav class="site-navigation top-bar hide-for-small-only" role="navigation">
					
					<div class="circle-backdrop-clip">
					
						<div class="site-desktop-title top-bar-title hide-for-small-only">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

								<div class="circle-backdrop"></div>

								<div class="svg-container">
									<?php echo file_get_contents( THEME_DIR . '/dist/assets/images/logo-horizontal.svg' ); ?>
								</div>

							</a>
						</div>
						
					</div>
					
					<div class="top-bar-right">
						<?php foundationpress_top_bar_r(); ?>
					</div>
					
				</nav>

			</div>
			
		</div>
		
	</header>

	<div class="container">