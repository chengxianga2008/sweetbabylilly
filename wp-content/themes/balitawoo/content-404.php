
<article id="post-0" class="<?php hybrid_entry_class(); ?>">

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-container">

		<div class="entry-content">
			
			<p><?php esc_html_e( 'The following is a list of the latest posts from the blog. Maybe it will help you find what you\'re looking for.', 'balitawoo' ); ?></p>

			<ul>
				<?php wp_get_archives( array( 'limit' => 10, 'type' => 'postbypost' ) ); ?>
			</ul>

		</div><!-- .entry-content -->

	</div><!-- .entry-container -->

</article><!-- #post-->