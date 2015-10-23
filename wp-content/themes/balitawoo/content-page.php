<article <?php hybrid_post_attributes(); ?>>

	<div class="entry-container">

		<header class="entry-header">
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' );  ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'balitawoo' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

	</div><!-- .entry-container -->

</article><!-- #article-->