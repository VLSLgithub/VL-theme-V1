<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */
?>

</div><!-- Close container -->

<footer class="footer-container">
	
	<div class="footer-top">

		<div class="expanded row flourishes small-collapse">

			<div class="flourish flourish-left small-12 large-6 text-left columns">

				<?php include THEME_DIR . '/dist/assets/images/flourish.svg'; ?>

			</div>

			<div class="flourish flourish-right large-6 columns text-right show-for-large">

				<?php include THEME_DIR . '/dist/assets/images/flourish.svg'; ?>

			</div>

		</div>

		<div class="content">
			
			<div class="row">
				
				<div class="small-12 medium-6 columns footer-contact">
					<?php include THEME_DIR . '/dist/assets/images/logo-blank.svg'; ?>
					<?php dynamic_sidebar( 'footer-left' ); ?>
				</div>
			
				<div class="small-12 medium-3 columns footer-menu">
					<?php dynamic_sidebar( 'footer-center' ); ?>
				</div>
				
				<div class="small-12 medium-3 columns footer-menu">
					<?php dynamic_sidebar( 'footer-right' ); ?>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<div class="footer-bottom expanded row">
		
		<div class="small-12 columns copyright text-center">
			<?php echo sprintf( __( '&copy; %s %s', 'vibrant-life-theme' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?>
			<br />
			<a href="//realbigmarketing.com/" title="<?php _e( 'Site by Real Big Marketing', 'vibrant-life-theme' ); ?>" target="_blank">
				<?php _e( 'Site by Real Big Marketing', 'vibrant-life-theme' ); ?>
			</a>
			<?php include_once THEME_DIR . '/dist/assets/images/hero-mask.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/hero-mask-mobile.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/half-circle-left.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/half-circle-right.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/half-circle-top-and-bottom.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/half-circle-top-and-bottom-mobile.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/half-circle-top.svg'; ?>
			<?php include_once THEME_DIR . '/dist/assets/images/half-circle-bottom.svg'; ?>
		</div>
	
	</div>
	
	<div class="reveal" id="schedule-a-visit-modal" data-reveal>
		
		<?php $form_id = get_theme_mod( 'vibrant_life_schedule_a_visit_form', false ); 
		
		if ( $form_id ) { 
			
			echo do_shortcode( '[gravityform id="' . $form_id . '" title="true" description="false" ajax="true"]' );
			
		}
		else {
			_e( 'Please set a Form in the Customizer for the Schedule a Visit modal', 'vibrant-life-theme' );
		}
		
		?>

		<button class="close-button" data-close aria-label="<?php _e( 'Close modal', 'vibrant-life-theme' ); ?>" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

	</div>

</footer>

</div><!-- Close off-canvas content -->

<div id="site-search" tabindex="-1">
    <?php get_search_form(); ?>
	<button class="close-button" aria-label="<?php _e( 'Close', 'vibrant-life-theme' ); ?>" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<?php wp_footer(); ?>
</body>
</html>
