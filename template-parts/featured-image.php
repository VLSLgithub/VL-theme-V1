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
		</div>
	</header>
<?php endif;