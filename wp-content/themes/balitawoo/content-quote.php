<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class('blogpost format-quote'); ?>">

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<?php get_template_part( 'author', 'meta' ); ?>

		<?php the_content(); ?>
		<div class="entry-content">
		</div><!-- .entry-content -->

		<?php tokokoo_post_meta(); ?>

	<?php } else { ?>

		<?php the_content(); ?>
		<div class="entry-content">
		</div><!-- .entry-content -->

		<?php tokokoo_post_meta(); ?>


	<?php } ?>

</article><!-- #article-->