<?php if ( get_the_author_meta('description') && of_get_option( 'tokokoo_post_author' ) ) : // If a user has filled out their decscription show a bio on their entries ?>
    <div class="author">
		<!-- <img src="img/ava.jpg" width="40" height="40"> -->
		<?php echo get_avatar( get_the_author_meta('email'), '40' ); ?>
		<div>
			<h3><?php the_author_meta( 'nickname' ); ?></h3>
			<?php the_author_meta( 'description' ); ?>
		</div>
	</div>
<?php endif; ?>