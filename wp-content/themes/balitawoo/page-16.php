<?php get_header(); ?>
<?php global $woo_options; ?>
<div class="content-area no-sidebar no-sidebar2" id="primary">
<?php putRevSlider( "safesleep" ) ?>
    <?php woocommerce_breadcrumb(); ?>

        <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                            
                <div <?php post_class(); ?>>

        	       <h1 class="title"><?php the_title(); ?></h1>

                    <div class="entry">
                      	<?php the_content(); ?>

        				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'balitawoo' ), 'after' => '</div>' ) ); ?>
                    </div><!-- /.entry -->

        				<?php edit_post_link( __( '{ Edit }', 'balitawoo' ), '<span class="small">', '</span>' ); ?>
                        
                    </div><!-- /.post -->
                    
                        <?php $comm = $woo_options[ 'woo_comments' ]; if ( ($comm == "page" || $comm == "both") ) : ?>
                            <?php comments_template(); ?>
                        <?php endif; ?>
                                                    
    	   <?php endwhile; ?>
        <?php else: ?>

    		<div <?php post_class(); ?>>
               	<p><?php _e( 'Sorry, no posts matched your criteria.', 'balitawoo' ); ?></p>
			</div><!-- /.post -->
        
        <?php endif; ?>  
</div>
<?php get_footer(); ?>