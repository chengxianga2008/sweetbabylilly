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


if(isset($_POST['submit']) && ($_POST['submit'] == "ebook-download")) {

	$widget_email = esc_attr(strip_tags($_POST['widget-email']));
	$widget_name = esc_attr(strip_tags($_POST['widget-name']));
	
	wp_redirect(get_stylesheet_directory_uri()."/resources/AUS-2015-Sweet-Baby-Lilly-Ebook-downsized.pdf"); exit;

}

get_header();


?>

    

	<section id="home_section_1" class="parallax_section"  data-speed="8" data-type="background">
	
	<div class="layer" data-depth="0.50">
		<div class="button-wrapper">
		<a href="<?php echo get_home_url(null, "shop"); ?>" class="button button--nanuk button--border-thin button--round-s">
											<span>G</span><span>o</span><span>&nbsp;</span><span>t</span><span>o</span><span>&nbsp;</span>
											<span>S</span><span>h</span><span>o</span><span>p</span>
										</a>
		</div>
	</div>
	
	</section>

	    <?php $query = new WP_Query( array( 'category_name' => 'home-post', "order" => 'ASC' ) );
	    
	    	if ($query->have_posts()) : $count = 0; ?>
	            <?php while ($query->have_posts()) : $query->the_post(); $count++; ?>
	                 <section data-speed="2" data-type="background">
						<div class="container mt40">                  
	                                                          
			                <div <?php post_class(); ?>>
			
			                    <div class="entry">
			                      	<?php the_content(); ?>
			
			        				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'balitawoo' ), 'after' => '</div>' ) ); ?>
			                    </div><!-- /.entry -->
			
			        				<?php edit_post_link( __( '{ Edit }', 'balitawoo' ), '<span class="small">', '</span>' ); ?>
			                        
			                </div><!-- /.post -->
	                    
	                        <?php $comm = $woo_options[ 'woo_comments' ]; 
	                              if ( ($comm == "page" || $comm == "both") ) : ?>
	                            		<?php comments_template(); ?>
	                        <?php endif; ?> 
	                        
	                    </div>
	                  </section>
	                        
	                  <?php if($count == 1){ ?>
	               <section id="home_section_2" data-speed="8" data-type="background">
	                  	<div class="container mt40"> 
	                  		<div class="row"> 
	                        	<div class="col-lg-4">
	                        		<img class="home-ebook-img" src="<?php echo get_stylesheet_directory_uri(); ?>/css/images/ebook.jpg">
	                        		
	                        	</div>
	                        	<div class="col-lg-8">
	                        		<div class="text-center">
	                        			<span class="home-ebook-txt1"> Grab your free copy of<br>"10 Must-Have Baby Gifts for 2015"</span>
	                        		</div>
	                        		
	                        	</div>
	                        	<div class="clearfix"></div>
	                        	<form class="form-horizontal form-style " action="" method="post">
		                        	<div class="col-lg-5 no-padding">
		                        		<span class="home-ebook-txt2">
		                        		Enter your details to download your copy
		                        	    </span>
		                        	</div>
		                    
						  	        <div class="col-lg-2">
						  	            <input class="form-control" name="widget-name" placeholder="Name" type="text">
						  	        </div>	       
	  	          				
						  	        <div class="col-lg-3">
						  	            <input class="form-control" name="widget-email" placeholder="Email" type="text">
						  	        </div>
						  	        
						  	        <div class="col-lg-2">
						  	            <button type="submit" name="submit" value="ebook-download" class="ebook-download-btn btn btn-primary"><span class="fa fa-lg fa-cloud-download" aria-hidden="true"></span> Download</button>
						  	        </div>	       

	                        	</form>
	                        	
	                        </div>
	                  	</div>
				   </section>
	                        
	            <?php }?>
	                                                    
	    	   <?php endwhile; ?>
	        <?php else: ?>
	
	    		<div <?php post_class(); ?>>
	               	<p><?php _e( 'Sorry, no posts matched your criteria.', 'balitawoo' ); ?></p>
				</div><!-- /.post -->
	        
	        <?php endif; ?>  
		
	
	<section id="home_section_4" data-speed="2" data-type="background">
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
	</section><!-- #content .site-content -->
	
<script type="text/javascript">

jQuery(document).ready(function($){
	   // cache the window object
	   $window = $(window);
	 
	   $('section[data-type="background"]').each(function(){
	     // declare the variable to affect the defined data-type
	     var $scroll = $(this);
	                     
	      $(window).scroll(function() {
	        // HTML5 proves useful for helping with creating JS functions!
	        // also, negative value because we're scrolling upwards                             
	        var yPos = -($window.scrollTop() / $scroll.data('speed')); 
	         
	        // background position
	        var coords = '50% '+ yPos + 'px';
	 
	        // move the background
	        $scroll.css({ backgroundPosition: coords });    
	      }); // end window scroll
	   });  // end section function
}); // close out script


</script>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>