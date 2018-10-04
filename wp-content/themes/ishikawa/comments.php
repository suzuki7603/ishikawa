<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to fsvgallery_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

?>

<?php 
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

		<div class="component-inner">

		<?php if ( have_comments() ) : ?>

			<h2 class="comments-title"><?php

				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'fsvgallery' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );

			?></h2>

			<ol class="commentlist">

				<?php wp_list_comments( array( 'callback' => 'fsvgallery_comment', 'style' => 'ol' ) ); ?>

			</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

			<nav id="comment-nav-below" class="navigation" role="navigation">

				<h3 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'fsvgallery' ); ?></h3>

				<?php $tmp_dir = get_template_directory_uri(); 

				$previous_comments_link = get_previous_comments_link( '<img src="' . $tmp_dir . '/images/arrow-pagenation-01l.png" alt="Previous" />' );
				$next_comments_link = get_next_comments_link( '<img src="' . $tmp_dir . '/images/arrow-pagenation-01r.png" alt="Next" />' ); ?>

				<div class="nav-previous">

				<?php if ( isset($previous_comments_link) ) : ?>

					<?php echo $previous_comments_link; ?>

				<?php else: ?>

					<a name="no-pager-links" class="no-pager-links"><img src="<?php echo $tmp_dir; ?>/images/arrow-pagenation-01l.png" alt="" /></a>

				<?php endif; ?>

				</div>

				<div class="nav-next">

				<?php if ( isset($next_comments_link) ) : ?>

					<?php echo $next_comments_link; ?>

				<?php else: ?>

					<a name="no-pager-links" class="no-pager-links"><img src="<?php echo $tmp_dir; ?>/images/arrow-pagenation-01r.png" alt="" /></a>

				<?php endif; ?>

				</div>

			</nav>

			<?php endif; // check for comment navigation ?>

			<?php

			if ( ! comments_open() && get_comments_number() ) : ?>

			<p class="nocomments"><?php _e( 'Comments are closed.' , 'fsvgallery' ); ?></p>

			<?php endif; ?>

		<?php else: // have_comments() ?>

			<?php if ( ! comments_open() ) : ?>

			<p class="nocomments"><?php _e( 'Comments are closed.' , 'fsvgallery' ); ?></p>

			<?php endif; ?>

		<?php endif; // have_comments() ?>

		<?php

			$comments_args = array(

				'fields' => array(

					'author' => "\n\n" . '<div class="comment-fields">' . "\n" . '<p class="comment-form-author"><span class="form_content">' . __( 'Name', 'fsvgallery' ) . ( $req ? ' *' : '' ) . '</span><input placeholder="' . __( 'Name', 'fsvgallery' ) . ( $req ? ' *' : '' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . ($req ? ' aria-required="true"' : '') . ' /></p>',

					'email'  => '<p class="comment-form-email"><span class="form_content">' . __( 'Email', 'fsvgallery' ) . ( $req ? ' *' : '' ) . '</span><input placeholder="' . __( 'Email', 'fsvgallery' ) . ( $req ? ' *' : '' ) . '" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ($req ? ' aria-required="true"' : '') . ' /></p>',

					'url'    => '<p class="comment-form-url"><span class="form_content">' . __( 'Website', 'fsvgallery' ) . '</span><input placeholder="' . __( 'Website', 'fsvgallery' ) . '" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'. "\n" . '</div>'. "\n",

				),

				'comment_field'		=> '<div class="comment-area">' . "\n" . '<p class="comment-form-comment"><span class="form_content">'. __( 'Comment', 'fsvgallery' ) . '</span><textarea placeholder="'. __( 'Comment', 'fsvgallery' ) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . "\n" . '</div>' . "\n",

				'must_log_in'		=> "\n\n" . '<div class="comment-m-login">' . "\n" . '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'fsvgallery' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>'. "\n" . '</div>'. "\n",

				'logged_in_as'		=> "\n\n" . '<div class="comment-login">' . "\n" . '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'fsvgallery' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>' . "\n" . '</div>' . "\n",

			);

			comment_form( $comments_args ); ?>

		</div>

	</div><!-- #comments .comments-area -->
