<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<section class="entry-content">
		<div class="row">
			<div class="small-12 medium-4 columns image-container">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
			<div class="small-12 medium-8 columns meta">

				<div class="row">
					<div class="small-12 columns">

						<h2 class="entry-title"><?php the_title(); ?><h2>
						<?php if ( has_term( '', 'position' ) ) : ?>
							<h3 class="subheader">
								
								<?php 

									$terms = wp_get_object_terms( get_the_ID(), 'position' );
									$terms = wp_list_pluck( $terms, 'name' );

									echo implode( ', ', $terms );

								?>
						
							</h3>
						<?php endif; ?>

					</div>

				</div>

				<div class="row">

					<div class="small-12 medium-6 columns">

						<?php if ( $phone_numbers = rbm_cpts_get_field( 'phone_numbers' ) ) : ?>

							<h5 class="subheader">
								<?php echo _n( 'Phone Number', 'Phone Numbers', count( $phone_numbers ), 'vibrant-life-theme' ); ?>
							</h5>

							<ul>
								<?php foreach ( $phone_numbers as $row ) : ?>
									<li>
										<?php echo vibrant_life_get_phone_number_link( $row['phone_number'], false, '', true ); ?>
									</li>
								<?php endforeach; ?>
							</ul>

						<?php endif; ?>

						<?php if ( $email_addresses = rbm_cpts_get_field( 'email_addresses' ) ) : ?>

							<h5 class="subheader">
								<?php echo _n( 'Email Address', 'Email Addresses', count( $email_addresses ), 'vibrant-life-theme' ); ?>
							</h5>

							<ul>
								<?php foreach ( $email_addresses as $row ) : ?>
									<li>
										<a href="mailto:<?php echo trim( $row['email_address'] ); ?>">
											<span class="fas fa-envelope-open-text"></span>
											<?php echo $row['email_address']; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>

						<?php endif; ?>

						<?php if ( $fax_numbers = rbm_cpts_get_field( 'fax_numbers' ) ) : ?>

							<h5 class="subheader">
								<?php echo _n( 'Fax Number', 'Fax Numbers', count( $fax_numbers ), 'vibrant-life-theme' ); ?>
							</h5>

							<ul>
								<?php foreach ( $fax_numbers as $row ) : ?>
									<li>
										<?php echo vibrant_life_get_phone_number_link( $row['fax_number'], false, '', 'fas fa-fax' ); ?>
									</li>
								<?php endforeach; ?>
							</ul>

						<?php endif; ?>

					</div>

					<div class="small-12 medium-6 columns">

						<?php if ( $certifications = rbm_cpts_get_field( 'certifications' ) ) : ?>

							<h5 class="subheader">
								<?php _e( 'Certifications', 'vibrant-life-theme' ); ?>
							</h5>

							<ul>
								<?php foreach ( $certifications as $row ) : ?>
									<li>
										<?php echo $row['certification']; ?>
									</li>
								<?php endforeach; ?>
							</ul>

						<?php endif; ?>

					</div>

				</div>

			</div>
		</div>
		<div class="row">
			<div class="small-12 columns content">
				<h3><?php _e( 'About Me:', 'vibrant-life-theme' ); ?></h3>
				<?php the_content(); ?>
				<?php edit_post_link( __( '(Edit)', 'vibrant-life-theme' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div>
	</section>
	
</article>
