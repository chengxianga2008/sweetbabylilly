<article <?php hybrid_post_attributes(); ?>>

	<?php if ( is_singular( get_post_type() ) ) { ?>
		
		<h1 class="entry-title"><?php single_post_title(); ?></h1>

		<?php tokokoo_post_meta(); ?>
		
		<div class="entry-content">
			
			<?php get_template_part( 'author', 'meta' ); ?>
			<p>
            	
				<?php /*?><?php if ( has_post_thumbnail() ): ?>
                	
						<a href="<?php the_permalink()?>"><?php the_post_thumbnail( 'blog' )?> </a>
                    
				<?php endif; ?><?php */?>
					
				<?php the_content(); ?> 
                	
                
			<p><!-- .entry-content -->
		
		</div><!-- .entry-container -->

	<?php } else { ?>

		<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
		
		<div class="entry-content">
        	<div style="width:100%">
        		
            	<?php if ( has_post_thumbnail() ): ?>
            	     <div class="koo-one-third">	<a href="<?php the_permalink()?>"><?php the_post_thumbnail( 'blog' )?> </a>
                     </div>
			<?php else: ?>
					 <div class="koo-one-half"><a href="<?php the_permalink()?>"><img src="http://placehold.it/770x320" alt="Image is not available"></a>
             		 </div>
			<?php endif; ?>
            <div class="koo-two-half">
				<div class="entry-summary">
                	
            		<?php $content = get_the_content();
  						$content = strip_tags( strip_shortcodes( $content ) );
  						echo substr($content, 0, 620);
  					?>…<a href="<?php the_permalink() ?>" rel="bookmark" title="Read more <?php the_title_attribute(); ?>">Read more</a>
                </div><!-- .entry-summary -->
			</div>
			</div>
		</div><!-- .entry-container -->
	<?php } ?>

</article><!-- #article-->