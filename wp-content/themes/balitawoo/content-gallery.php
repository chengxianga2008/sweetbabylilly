<article <?php hybrid_post_attributes(); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>	
	
		<h1 class="entry-title"><?php single_post_title(); ?></h1>
		
		<?php tokokoo_post_meta(); ?>

		<div class="entry-content">
			<?php get_template_part( 'author', 'meta' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'balitawoo' ), 'after' => '</p>' ) ); ?>
			</div><!-- .entry-content -->

		</div><!-- .entry-container -->

		<?php } else { ?>
			
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
			
			<?php tokokoo_post_meta(); ?>

			<div class="entry-content">
				<div class="framebox">
									
					<?php
						$args = array(
							'order'          => 'ASC',
							'post_type'      => 'attachment',
							'post_parent'    => get_the_ID(),
							'post_mime_type' => 'image',
							'post_status'    => null,
							'numberposts'    => -1,
						);
						$attachments = get_children( $args );

						if ( $attachments ) { ?>
							<ul>
								<?php foreach ( $attachments as $attachment ) { ?>
									<li>
										<?php echo wp_get_attachment_image( $attachment->ID, 'tokokoo_gallery', false, false ); ?>
									</li>
								<?php } ?>
						<?php }
					?>	

				</div><!-- .framebox -->
			
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				
			</div><!-- .entry-container -->

		<?php } ?>

	
</article><!-- #article-->