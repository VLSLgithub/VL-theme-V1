<?php
/*
Template Name: Thank You
*/

global $post;

// Grab the selected item from the Form
add_filter( 'vibrant_life_get_associated_location', function( $post_id ) {

    $location = new WP_Query( array(
		'post_type' => 'facility',
		'posts_per_page' => 1,
		'fields' => 'ids',
		'meta_query' => array(
			'relationship' => 'AND',
			array(
				'key' => 'rbm_cpts_short_name',
				'value' => ( isset( $_GET['community'] ) && $_GET['community'] ) ? $_GET['community'] : '',
				'compare' => '=',
			),
		),
	) );
	
    if ( ! $location->have_posts() ) return $post_id;
	
	return $location->posts[0];

} );

add_filter( 'vibrant_life_show_hero_title', '__return_false' ); 

get_header();

do_action( 'foundationpress_before_content' ); ?>

<div class="swirl-border">
	<div class="main-wrap full-width has-interstitial">	
		<main class="main-content">
			 <?php while ( have_posts() ) : the_post(); ?>
			
				<section class="interstitial row">

                    <div class="page-title small-12 columns">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
                    
                    <div class="small-12 medium-6 columns">

                        <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<div class="entry-content">
                            <?php add_filter('the_content', 'sfsi_social_buttons_below'); ?>
                            <?php the_content(); ?>
                            <?php remove_filter('the_content', 'sfsi_social_buttons_below'); ?>
						</div>

                    </div>

                    <div class="small-12 medium-6 columns">

                        <p>
                            <?php _e( 'Learn more about Vibrant Life Senior Living. Pick a link, search a topic of interest, or read one of our recent blog articles.', 'vibrant-life-theme' ); ?>
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

                </section>

                <?php 

                    global $post;

                    $posts_query = new WP_Query( array(
                        'post_type' => 'post',
                        'posts_per_page' => vibrant_life_get_field( 'news_count', get_option( 'page_on_front' ), 2 ),
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
                
			<?php endwhile;?>
		</main>
	</div>
</div>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php 

get_footer();