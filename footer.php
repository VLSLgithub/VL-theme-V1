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
<div class="footer-container">
	<footer class="footer">

		<div class="expanded row">
			<div class="small-12 medium-6 columns footer-menu">
				<?php
					wp_nav_menu( array(
						'container'      => false,
						'theme_location' => 'footer',
						'fallback_cb'    => false,
					));
				?>
			</div>
			<div class="small-12 medium-6 columns copyright text-right">
				<span class="svg-container">
					<?php //echo file_get_contents( THEME_DIR . '/.svg' ); ?>
				</span>
				<span class="text">
					<?php echo sprintf( __( '&copy; %s %s', 'vibrant-life-theme' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?>
				</span>
			</div>
		</div>

	</footer>
</div>

</div><!-- Close off-canvas content -->

<?php wp_footer(); ?>
</body>
</html>
