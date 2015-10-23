<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Homepage
 *
 * Description: A Page Template for homepage
 *
 * @package balita
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */
get_header();


?>
	<?php get_template_part( 'contents', 'slider' ); ?>
    <?php putRevSlider( "home" ) ?>
	<div class="content-area no-sidebar no-sidebar2" id="primary">
    <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                            
                <div <?php post_class(); ?>>

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
		<div id="content" class="site-content">
			<?php
				$post_num = 15;
				$args = array( 'post_type' => 'product', 'posts_per_page' => $post_num, 'meta_key' => '_featured', 'meta_value' => 'yes' );
				$featured = new WP_Query( $args );
				if( $featured->post_count >= 5 ) {
					$slider = $featured;
				}
				else {
					$args = array( 'post_type' => 'product', 'posts_per_page' => $post_num);
					$slider = new WP_Query($args);
				}

				if ( $slider->have_posts() ):
					$counter = 1;
					echo '<div id="slides">';
					echo '	<div class="slides_container">';
					echo '		<div class="slide">';
					while ( $slider->have_posts() ): $slider->the_post(); ?>
						<div class="item">
							<a href="<?php the_permalink(); ?>"><img src="<?php balitawoo_get_thumbnail_src( 'secondary-slider' ); ?>"></a>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p><?php echo $product->get_price_html(); ?></p>
						</div>
						<?php if ( 0 == $counter%5 AND $post_num != $counter )
							echo '</div><div class="slide">';
						$counter++;
					endwhile;
					echo '		</div>';
					echo '	</div>';
					echo '</div>';
				endif;
			?>

			<div class="clear"></div>
			<?php
				for ($counter = 1; $counter <= 4; $counter++) :
					if ( of_get_option('balitawoo_banner'.$counter.'_image') != '' && of_get_option('balitawoo_banner'.$counter.'_text') != '' && of_get_option('balitawoo_banner'.$counter.'_text') != '' ) :
			?>
				<div class="feat-wrapper">
					<div class="feat">
						<img src="<?php echo of_get_option('balitawoo_banner'.$counter.'_image'); ?>"></a>
						<h3><a href="<?php echo of_get_option('balitawoo_banner'.$counter.'_link'); ?>"><?php echo of_get_option('balitawoo_banner'.$counter.'_title'); ?></a></h4>
						<p><?php echo of_get_option('balitawoo_banner'.$counter.'_text'); ?></p>
						<a class="brs" href="<?php echo of_get_option('balitawoo_banner'.$counter.'_link'); ?>">Browse</a>
					</div>
				</div>
			<?php 	endif;
				endfor; ?>
			<div class="clear"></div>
		</div><!-- #content .site-content -->
	</div>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>