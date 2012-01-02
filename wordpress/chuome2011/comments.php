<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php $commenter = wp_get_current_commenter(); ?>
<div id="respond">
	<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="commentform">
	<p class="comment-form-comment">
		<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	</p>	
	<p class="comment-form-author">
		<input id="author" name="author" type="text" value="<?php esc_attr( $commenter['comment_author'] ) ?>" size="30">
		<label for="author">Name</label>
	</p>
	<p class="comment-form-email">
		<input id="email" name="email" type="text" value="<?php esc_attr( $commenter['comment_author_email'] ) ?>" size="30">
		<label for="email">Email</label> 
	</p>
	<p class="comment-form-url">
		<input id="url" name="url" type="text" value="<?php esc_attr( $commenter['comment_author_url'] ) ?>" size="30">
		<label for="url">Website</label>
	</p>					
	<p class="form-submit">
		<input name="submit" type="submit" id="submit" value="发表评论">
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" id="comment_post_ID">
		<input type="hidden" name="comment_parent" id="comment_parent" value="0">
	</p>
	</form>
</div>


<?php if ( have_comments() ) : ?>
	<h3 id="comments-title">看看其他人说些什么</h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'twentyten_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>


</div><!-- #comments -->
