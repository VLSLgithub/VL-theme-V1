<header class="title-hero" role="banner">
		
	<div class="row expanded featured-hero title-hero">

		<div class="marketing">

			<div class="small-12 columns image" data-interchange="[<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, small], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, medium], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, large], [<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>, xlarge]">
				<div class="color-overlay"></div>
			</div>

			<div class="small-12 columns tagline">
				<div class="row">
					<div class="small-12 columns">
						<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'hero_tagline' ) ); ?>
					</div>
				</div>
			</div>

		</div>

	</div>

</header>