<?php
	/* If a post password is required or no comments are given and comments/pings are closed, return. */
	if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
		return;
	
	$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Reviews', 'woocommerce' ) );
?>

<?php if ( $heading ): ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>


<?php if ( of_get_option('tokokoo_comment_form') ): ?>
	
	<?php if ( have_comments() ) : ?>

		<?php if ( get_option( 'page_comments' ) ) : ?>
		<div class="comments-nav">
			<span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'balitawoo' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span>
			<?php previous_comments_link(); ?>
			<?php next_comments_link(); ?>
		</div><!-- .comments-nav -->
		<?php endif; ?>

		<?php do_action( 'tokokoo_comment_list_before' ); ?>

		<?php wp_list_comments( hybrid_list_comments_args() ); ?>

		<?php do_action( 'tokokoo_comment_list_after' ); ?>

	<?php endif; ?>

	<?php if ( pings_open() && !comments_open() ) : ?>

		<p class="comments-closed pings-open">
			<?php printf( __( 'Comments are closed, but <a href="%s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'balitawoo' ), esc_url( get_trackback_url() ) ); ?>
		</p><!-- .comments-closed .pings-open -->

	<?php elseif ( !comments_open() ) : ?>

		<p class="comments-closed">
			<?php _e( 'Comments are closed.', 'balitawoo' ); ?>
		</p><!-- .comments-closed -->

	<?php endif; ?>
<?php endif; ?>

	