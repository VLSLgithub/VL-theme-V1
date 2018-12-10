<?php

$attachment_id = false;

// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail( get_the_ID() ) ) {
	$attachment_id = get_post_thumbnail_id( get_the_ID() );
}
elseif ( is_404() ) {
	$attachment_id = get_theme_mod( 'vibrant_life_404_hero', false );
}

if ( $attachment_id ) : ?>
	<header class="featured-hero" role="banner">
		
		<div class="image" data-interchange="[<?php echo wp_get_attachment_image_src( $attachment_id, 'full', false )[0]; ?>, small], [<?php echo wp_get_attachment_image_src( $attachment_id, 'full', false )[0]; ?>, medium], [<?php echo wp_get_attachment_image_src( $attachment_id, 'full', false )[0]; ?>, large], [<?php echo wp_get_attachment_image_src( $attachment_id, 'full', false )[0]; ?>, xlarge]">
			<div class="color-overlay"></div>
		</div>
		
		<div class="expanded row flourishes small-collapse show-for-large">

			<div class="flourish flourish-left small-12 large-6 text-left columns">

				<?php include THEME_DIR . '/dist/assets/images/flourish.svg'; ?>

			</div>

			<div class="flourish flourish-right large-6 columns text-right">

				<?php include THEME_DIR . '/dist/assets/images/flourish.svg'; ?>

			</div>

		</div>
		
	</header>
<?php endif;