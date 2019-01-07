<?php
/**
 * Frontpage Template
 * @since {{VERSION}}
 *
 * @package VibrantLifeTheme2018
 */

global $post;

get_header(); 

while ( have_posts() ) : the_post(); ?>

	<div class="main-content">

		<div class="swirl-border">

			<section id="interstitial" class="row interstitial">

				<div class="small-12 columns">

					<div class="row top">

						<div class="small-12 medium-3 columns">

							<div class="image with-image-tag circle-mask">
								<?php echo wp_get_attachment_image( vibrant_life_get_field( 'interstitial_image' ), 'full' ); ?>
							</div>

						</div>

						<div class="small-12 medium-9 columns">

							<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'interstitial_content' ) ); ?>

						</div>

					</div>

					<?php foreach ( $content_blocks = vibrant_life_get_field( 'interstitial_repeater' ) as $index => $row ) : ?>

						<div class="row block-<?php echo $index; ?>" data-equalizer>

							<?php 

								$left_class_name = 'small-12 medium-6 columns image-on-left';
								$right_class_name = 'small-12 medium-6 columns';

								// Odd
								if ( $index % 2 == 0 ) : 

									$left_class_name = 'small-12 medium-6 medium-push-6 columns image-on-right';
									$right_class_name = 'small-12 medium-6 medium-pull-6 columns';

								endif;

							?>

							<div class="<?php echo $left_class_name; ?>" data-equalizer-watch>
								
								<div class="image" style="background-image: url('<?php echo wp_get_attachment_image_src( $row['image'], 'full', false )[0]; ?>');">
								</div>

								<div class="show-for-medium">
									<div class="circle-button-container">
										<a href="<?php echo $row['circle_button_url']; ?>" title="<?php echo $row['circle_button_text']; ?>">
											<div class="circle-button animate-on-scroll scale-in-up">
												<div class="circle-button-text-container">
													<div class="circle-button-text">
														<?php echo $row['circle_button_text']; ?>
													</div>
												</div>
											</div>
										</a>
									</div>
								</div>

							</div>

							<div class="<?php echo $right_class_name; ?>" data-equalizer-watch>

								<?php echo apply_filters( 'the_content', $row['content'] ); ?>

								<div class="show-for-small-only text-center">
									<a class="button tertiary hollow" href="<?php echo $row['circle_button_url']; ?>" title="<?php echo $row['circle_button_text']; ?>">
										<?php echo $row['circle_button_text']; ?>
									</a>
								</div>

							</div>

						</div>

					<?php endforeach; ?>

				</div>

			</section>

			<section id="call-to-action" class="row expanded" data-equalizer data-equalize-on="large">

				<div class="small-12 medium-12 large-6 columns image-container" data-equalizer-watch>
					<div class="image" style="background-image: url('<?php echo wp_get_attachment_image_src( vibrant_life_get_field( 'call_to_action_image' ), 'full', false )[0]; ?>');">
					</div>
				</div>

				<div class="small-12 medium-12 large-6 columns text-container" data-equalizer-watch>
					<?php echo apply_filters( 'the_content', vibrant_life_get_field( 'call_to_action_content' ) ); ?>
				</div>

			</section>

		</div>

		<section id="video" class="row small-collapse">

			<div class="small-12 columns text-center">
				<h2><?php echo vibrant_life_get_field( 'video_header_text' ); ?></h2>
			</div>

			<div class="video-popover-container small-12 columns half-circle-top-and-bottom-container">

				<?php echo wp_oembed_get( vibrant_life_get_field( 'video_url' ) ); ?>

			</div>

		</section>

		<?php 

			global $post;

			$locations_query = new WP_Query( array(
				'post_type' => 'facility',
				'posts_per_page' => -1,
			) );

			if ( $locations_query->have_posts() ) : ?>

				<section id="locations" class="row expanded">

					<div class="small-12 columns text-center">
						<h2><?php echo vibrant_life_get_field( 'locations_header_text' ); ?></h2>
					</div>

					<div class="small-12 columns row expanded locations-container queue-on-scroll fade-in">

						<?php while( $locations_query->have_posts() ) : $locations_query->the_post(); ?>

							<article <?php post_class( array( 'small-6', 'columns', 'queued-item' ) ); ?> aria-labelledby="post-<?php the_ID(); ?>" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false )[0]; ?>');">

								<a href="<?php the_permalink(); ?>">

									<div class="color-overlay"></div>

									<?php $title = rbm_cpts_get_field( 'short_name' ); ?>

									<h2 id="post-<?php the_ID(); ?>"><?php echo ( $title ? $title : get_the_title() ); ?></h2>

								</a>

							</article>

						<?php endwhile; ?>

					</div>

				</section>

			<?php 

				wp_reset_postdata();

			endif; 

		?>

		<?php 

			global $post;

			$posts_query = new WP_Query( array(
				'post_type' => 'post',
				'posts_per_page' => vibrant_life_get_field( 'news_count', get_the_ID(), 2 ),
			) );

			$index = 0;

			if ( $posts_query->have_posts() ) : ?>

				<section id="news" class="row">

					<div class="small-12 columns text-center">
						<h2><?php echo vibrant_life_get_field( 'news_header_text' ); ?></h2>
					</div>

					<?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

						<article <?php post_class( array( 'small-12', 'columns' ) ); ?> aria-labelledby="post-<?php the_ID(); ?>">

							<div class="row">

								<?php 

									$left_class_name = 'small-12 medium-6 columns image-on-left';
									$right_class_name = 'small-12 medium-6 columns';

									// Even
									if ( $index % 2 !== 0 ) : 

										$left_class_name = 'small-12 medium-6 medium-push-6 columns image-on-right';
										$right_class_name = 'small-12 medium-6 medium-pull-6 columns';

									endif;

								?>

								<div class="<?php echo $left_class_name; ?>">

									<div class="image with-image-tag">
										<?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
									</div>

								</div>

								<div class="<?php echo $right_class_name; ?>">

									<h3 id="post-<?php the_ID(); ?>">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>

									<?php foundationpress_entry_meta(); ?>

									<?php the_excerpt(); ?>

									<a class="button primary medium" href="<?php the_permalink(); ?>" aria-labelledby="post-<?php the_ID(); ?>">
										<?php _e( 'Read More', 'vibrant-life-theme' ); ?>
									</a>

								</div>

							</div>

						</article>

					<?php 

						$index++;

					endwhile; ?>

				</section>

			<?php 

				wp_reset_postdata();

			endif; 

		?>
		
	</div>

	<div class="reveal large video-popover" data-reveal data-reset-on-close="true">
    
		<div class="row">
			<div class="small-12 columns video-container">
				<?php echo wp_oembed_get( vibrant_life_get_field( 'video_url' ) ); ?>
			</div>
		</div>

		<button class="close-button" data-close aria-label="<?php _e( 'Close modal', 'vibrant-life-theme' ); ?>" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

	</div>

<?php endwhile;

get_footer();