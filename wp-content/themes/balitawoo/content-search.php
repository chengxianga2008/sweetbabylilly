<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
	
	<?php tokokoo_post_meta(); ?>
	
	<div class="entry-content">
		
		<div class="entry-summary">
		<?php the_excerpt(); ?>
		</div>

	</div><!-- .entry-container -->

</article><!-- #article-->