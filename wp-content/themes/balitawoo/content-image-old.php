<article <?php hybrid_post_attributes(); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>
		
		<h1 class="entry-title"><?php single_post_title(); ?></h1>

		<?php tokokoo_post_meta(); ?>
		
		<div class="entry-content">
			
			<?php get_template_part( 'author', 'meta' ); ?>
			<p>
				<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink()?>"><?php the_post_thumbnail( 'blog' )?> </a>
				<?php endif; ?>

				<?php the_content(); ?>
			<p><!-- .entry-content -->
		
		</div><!-- .entry-container -->

	<?php } else { ?>

		<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
		
		<div class="entry-content">
			<?php if ( has_post_thumbnail() ): ?>
				<a href="<?php the_permalink()?>"><?php the_post_thumbnail( 'blog' )?> </a>
			<?php else: ?>
				<a href="<?php the_permalink()?>"><img src="http://placehold.it/770x320" alt="Image is not available"></a>
			<?php endif; ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		</div><!-- .entry-container -->
	<?php } ?>

</article><!-- #article-->