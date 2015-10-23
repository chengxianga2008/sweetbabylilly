<article id="post-0" class="<?php hybrid_entry_class(); ?>">

	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'balitawoo' ); ?></h1>
	</header><!-- .entry-header -->
	
	<div class="entry-container">

		<div class="entry-content">

			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'balitawoo' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php } elseif ( is_search() ) { ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'balitawoo' ); ?></p>
				<?php 
					// Loads the searchform.php template.
					get_search_form(); 
				?>

			<?php } else { ?>

				<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'balitawoo' ); ?></p>
				<?php 
					// Loads the searchform.php template.
					get_search_form(); 
				?>

			<?php } ?>

		</div><!-- .entry-content -->

	</div><!-- .entry-container -->
	<div class="clear"></div>

</article><!-- #post-0 -->