<article <?php hybrid_post_attributes(); ?>>

	<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>

	<a href="<?php the_permalink(); ?>"><img src="<?php balitawoo_get_thumbnail_src( 'list-thumbnail' ); ?>" class="alignleft"></a>
	
	<?php tokokoo_post_meta(); ?>

	<div class="entry-content">

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	</div><!-- .entry-container -->

</article><!-- #article-->