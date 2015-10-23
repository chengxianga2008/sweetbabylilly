<article <?php hybrid_post_attributes(); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<h1 class="entry-title"><?php single_post_title(); ?></h1>
			
		<?php tokokoo_post_meta(); ?>

		<div class="entry-content">
			<?php get_template_part( 'author', 'meta' ); ?>

			<div class="framebox">
				<?php echo hybrid_media_grabber( array( 'type' => 'audio' ) ); ?>
			</div><!-- .framebox -->
			
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</div>

	<?php } else { ?>

		<div class="entry-content">
			
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>

			<?php tokokoo_post_meta(); ?>

			<div class="framebox">
				<?php echo hybrid_media_grabber( array( 'type' => 'audio' ) ); ?>
			</div><!-- .framebox -->
		
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php } ?>

	</div><!-- .entry-container -->
	
</article><!-- #article-->