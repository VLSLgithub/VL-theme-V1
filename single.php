<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<main class="main-content">
	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php get_template_part( 'template-parts/content', '' ); ?>
	
		<section class="row navigation-container">
			<div class="small-12 columns">
				<?php the_post_navigation( array(
					'prev_text' => '<span class="fas fa-arrow-left" aria-hidden="true"></span> %title',
					'next_text' => '%title <span class="fas fa-arrow-right" aria-hidden="true"></span>',
				) ); ?>
			</div>
		</section>
	
		<?php
				
			$tags = wp_get_post_tags( get_the_ID() );

			if ( $tags ) {

				global $post;

				$tag_ids = array();
				foreach( $tags as $individual_tag ) {
					$tag_ids[] = $individual_tag->term_id;
				};

				$args = array(
					'tag__in' => $tag_ids,
					'post__not_in' => array( $post->ID ),
					'posts_per_page' => 3,
					'ignore_sticky_posts' => true,
				);

				$related_posts = new wp_query( $args );

				if ( $related_posts->have_posts() ) : 
				
					$class_name = 'medium-' . ( 12 / count( $related_posts->posts ) );

					// If there's only 1, center it at half-width
					if ( $class_name = 'medium-12' ) $class_name = 'medium-6 medium-pull-3';

					$class_names = array_merge( array(
						'small-12',
						'columns',
					), explode( ' ', $class_name ) );
	
					?>

					<section class="row related-posts">

						<div class="small-12 columns text-center">
							<h2><?php _e( 'You May Also Like...', 'vibrant-life-theme' ); ?></h2>
						</div>

						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>

						  <div <?php post_class( $class_names ); ?>>
							  
							  <a rel="external" href="<?php the_permalink()?>" class="text-center">
								
								  <div class="image with-image-tag">
								  	<?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'medium', false, array( 'class' => 'attachment-medium size-medium half-circle-bottom' ) ); ?>
								  </div>
								
								  <h2 id="post-title-<?php the_ID(); ?>"><?php the_title(); ?></h2>
									
							  </a>
							  
							  <cite class="text-center">
								  <?php foundationpress_entry_meta(); ?>
							  </cite>
							  
							  <?php the_excerpt(); ?>
							  
							  <div class="text-center">
								  <a rel="external" class="button primary small" href="<?php the_permalink()?>" aria-labelledby="post-title-<?php the_ID(); ?>">
									  <?php _e( 'Learn More', 'vibrant-life-theme' ); ?>
								  </a>
							  </div>
							  
						  </div>

						<?php endwhile; 

						wp_reset_postdata(); ?>

					</section>

				<?php endif;

		  }

		  ?>
	
		<?php comments_template(); ?>
	<?php endwhile;?>
</main>
<?php get_footer();
