<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

if ( have_comments() ) :
	if ( (is_page() || is_single()) && ( ! is_home() && ! is_front_page()) ) :
?>
	<section id="comments" class="row">
		
		<div class="small-12 columns">
		
			<?php


			wp_list_comments(
				array(
					'walker'            => new Foundationpress_Comments(),
					'max_depth'         => '',
					'style'             => 'div',
					'callback'          => null,
					'end-callback'      => null,
					'type'              => 'all',
					'reply_text'        => __( 'Reply', 'vibrant-life-theme' ),
					'page'              => '',
					'per_page'          => '',
					'avatar_size'       => 48,
					'reverse_top_level' => null,
					'reverse_children'  => '',
					'format'            => 'html5',
					'short_ping'        => false,
					'echo'              => true,
					'moderation'        => __( 'Your comment is awaiting moderation.', 'vibrant-life-theme' ),
				)
			);

			?>
			
		</div>

 	</section>
<?php
	endif;
endif;
?>

<?php

	/*
	Do not delete these lines.
	Prevent access to this file directly
	*/

	defined( 'ABSPATH' ) || die( __( 'Please do not load this page directly. Thanks!', 'vibrant-life-theme' ) );

	if ( post_password_required() ) { ?>
	<section id="comments" class="row">
		<div class="notice" class="small-12 columns">
			<p class="bottom"><?php _e( 'This post is password protected. Enter the password to view comments.', 'vibrant-life-theme' ); ?></p>
		</div>
	</section>
	<?php
		return;
	}
?>

<?php
if ( comments_open() ) :
	if ( (is_page() || is_single()) && ( ! is_home() && ! is_front_page()) ) :
?>
<section id="respond" class="row">
	<h3>
		<?php
			comment_form_title(
				__( 'Leave a Reply', 'vibrant-life-theme' ),
				/* translators: %s: author of comment being replied to */
				__( 'Leave a Reply to %s', 'vibrant-life-theme' )
			);
		?>
	</h3>
	<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
	<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
	<p>
		<?php
			/* translators: %s: login url */
			printf( __(
				'You must be <a href="%s">logged in</a> to post a comment.', 'vibrant-life-theme' ),
				wp_login_url( get_permalink() )
			);
		?>
	</p>
	<?php else : ?>
	<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform" class="row">
		<?php if ( is_user_logged_in() ) : ?>
		<div class="small-12 columns">
			<?php
				/* translators: %1$s: site url, %2$s: user identity  */
				printf( __(
					'Logged in as <a href="%1$s/wp-admin/profile.php">%2$s</a>.', 'vibrant-life-theme' ),
					get_option( 'siteurl' ),
					$user_identity
				);
			?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php __( 'Log out of this account', 'vibrant-life-theme' ); ?>"><?php _e( 'Log out &raquo;', 'vibrant-life-theme' ); ?></a>
		</div>
		<?php endif; ?>
		<div class="small-12 columns">
			<label for="comment">
					<?php
						_e( 'Comment', 'vibrant-life-theme' );
					?>
			</label>
			<textarea name="comment" id="comment" tabindex="4"></textarea>
		</div>
		<?php if ( ! is_user_logged_in() ) : ?>
		<div class="small-12 medium-4 columns">
			<label for="author">
				<?php
					_e( 'Name', 'vibrant-life-theme' ); if ( $req ) { _e( ' (required)', 'vibrant-life-theme' ); }
				?>
			</label>
			<input type="text" class="five" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" size="22" tabindex="1" <?php if ( $req ) { echo "aria-required='true'"; } ?>>
		</div>
		<div class="small-12 medium-4 columns">
			<label for="email">
				<?php
					_e( 'Email (will not be published)', 'vibrant-life-theme' ); if ( $req ) { _e( ' (required)', 'vibrant-life-theme' ); }
				?>
			</label>
			<input type="text" class="five" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" size="22" tabindex="2" <?php if ( $req ) { echo "aria-required='true'"; } ?>>
		</div>
		<div class="small-12 medium-4 columns">
			<label for="url">
				<?php
					_e( 'Website', 'vibrant-life-theme' );
				?>
			</label>
			<input type="text" class="five" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22" tabindex="3">
		</div>
		<?php endif; ?>
		<div class="small-12 columns">
			<input name="submit" class="button" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e( 'Submit Comment', 'vibrant-life-theme' ); ?>">
		</div>
		<?php comment_id_fields(); ?>
		<?php do_action( 'comment_form', $post->ID ); ?>
	</form>
	<?php endif; // If registration required and not logged in. ?>
</section>
<?php
	endif; // If you delete this the sky will fall on your head.
	endif; // If you delete this the sky will fall on your head.
