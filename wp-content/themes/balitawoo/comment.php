<?php
	global $post, $comment;
?>

	<div id="comment-<?php comment_ID(); ?>" class="<?php hybrid_comment_class('comment-content'); ?>">

		<?php echo hybrid_avatar(); ?>
		<div class="comment-wrap">
			
			<?php echo apply_atomic_shortcode( 'comment_meta', '<p class="name"><strong>[comment-author]</strong>  &bull; [comment-published]  &bull; [comment-permalink] &bull; [comment-edit-link] [comment-reply-link before="- "]</>' ); ?>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<?php echo apply_atomic_shortcode( 'comment_moderation', '<p class="alert moderation">' . __( 'Your comment is awaiting moderation.', 'balitawoo' ) . '</p>' ); ?>
			<?php endif; ?>

			<?php comment_text( $comment->comment_ID ); ?>
		</div><!-- .comment-content .comment-text -->
		<div class="clear"></div>

	</div>

	<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>