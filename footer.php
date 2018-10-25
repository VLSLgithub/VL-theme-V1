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
		</div>
	
	</div>

</footer>

</div><!-- Close off-canvas content -->

<?php wp_footer(); ?>
</body>
</html>
