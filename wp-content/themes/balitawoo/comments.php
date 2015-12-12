<<<<<<< HEAD
<?php
	/* If a post password is required or no comments are given and comments/pings are closed, return. */
	if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
		return;
?>
	<?php if ( of_get_option('tokokoo_comment_form') ): ?>
	<div id ="comments" class="content-area comment-area">

		<ul class="tabs">
	        <li class="active" style=""><a href="#tab1"><?php comments_number( __( 'No REVIEWS', 'balitawoo' ), __( 'One REVIEWS', 'balitawoo' ), __( '% REVIEWS', 'balitawoo' ) ); ?></a></li>
	        <li class=""><a href="#tab2">WRITE A REVIEW</a></li>
	    </ul>

		<div class="tab_container">

			<div class="tab_content" id="tab1">

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

			</div><!-- #comments -->

			<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );

			$fields =  array(
				'author' => '<p><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'"'. $aria_req . ' placeholder="'. __( 'Name'. ( $req ? '*' : '' ), 'balitawoo' ) .'"/></p>',
				'email' => '<p><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'"'. $aria_req . ' placeholder="'. __( 'Email'. ( $req ? '*' : '' ), 'balitawoo' ) .'"/></p>',
				'url' => '<p><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'"'. $aria_req . ' placeholder="'. __( 'Website'. ( $req ? '*' : '' ), 'balitawoo' ) .'"/></p>'
			);

			$args = array(
				'id_submit' => 'button',
				'title_reply' => __('Leave a comment', 'balitawoo'),
				'label_submit' => __( 'Post Comment', 'balitawoo' ),
				'comment_field' => '<p class="wrap-textarea"><textarea id="comment" name="comment" aria-required="true" placeholder="'._x( 'Comment', 'noun', 'balitawoo' ).'" style="margin-top: 0px; margin-bottom: 10px; height: 110px;"></textarea></p>',
				'fields' => $fields,
				// 'fields' => apply_filters( 'balitawoo_comment_form_default_fields', $fields ),
			);
			?>
			<div id="tab2" class="tab_content" style="display: block;">
				<?php comment_form( $args ); // Loads the comment form. ?>
			</div>

		</div><!-- .comments-wrap -->

	</div><!-- #comments-template -->
	<?php endif; ?>
=======
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

	
>>>>>>> db3da62c79c7e608b1f4df137cfca12213bd77f8
