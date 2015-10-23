<?php
/**
 * Slides post type & shortcode function.
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Shortcode to display the slides. */
add_shortcode( 'koo-slides', 'tokokoo_slider_shortcode' );

/**
 * Slides shortcode.
 *
 * @since 1.0
 */
function tokokoo_slider_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
	
	ob_start();
	tokokoo_display_slides( $id );
	$output = ob_get_clean();

	return $output;
}

/**
 * Slides loop.
 *
 * @since 1.0
 */
function tokokoo_display_slides( $id ) {
	global $slides, $get_width, $get_height, $crop_img;

	$args = array(
		'post_type'			=> 'slides',
		'posts_per_page'	=> -1,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC'
	);

	$tax = array(
		array(
			'taxonomy' 	=> 'slide-group',
			'field'		=> 'id',
			'terms'		=>  $id,
			'operator'	=> 'IN'
		)
	);

	$get_width	= (int) get_field( 'tokokoo_slide_width', 'slide-group_' . $id ); // get the image width
	$get_height	= (int) get_field( 'tokokoo_slide_height', 'slide-group_' . $id ); // get the image height
	$crop_img	= get_field( 'tokokoo_slide_crop', 'slide-group_' . $id ); // crop

	if ( $id )
		$args['tax_query'] = $tax;
	
	$slides = get_posts( $args );

	if( $slides ) :

		if( of_get_option( 'tokokoo_slides_type' ) == 'flexslider' ) :
	
			tokokoo_flexslider_markup( $slides, $get_width, $get_height, $crop_img ); // load the flexslider slider markup

		elseif( of_get_option( 'tokokoo_slides_type' ) == 'camera' ) :

			tokokoo_camera_markup( $slides, $get_width, $get_height, $crop_img ); // load the camera slider markup

		endif;

	endif; wp_reset_postdata();

}

/**
 * Flixslider.
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_flexslider_markup' ) ):
function tokokoo_flexslider_markup( $slides, $get_width, $get_height, $crop_img ) {
	global $post, $wp_embed;

	echo '<div class="hero-slides">';
		echo '<div class="flexslider">';
          	echo '<ul class="slides">';

          		if ( is_array( $slides ) ) :

					foreach( $slides as $post ) : setup_postdata( $post );

					$get_url	= esc_url( get_field( 'tokokoo_slide_url', get_the_ID() ) ); // get the url 
					$get_video	= esc_url( get_field( 'tokokoo_slide_video', get_the_ID() ) ); // get the video url

					$img 		= wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
					$new_img 	= aq_resize( $img, $get_width, $get_height, $crop_img ); //resize & crop the image
					
						echo '<li>';

							// Check if there's a Slide URL
							if( $get_url ) { 
								echo '<a href="' . $get_url . '">';
							}

	  	    	   			if( $new_img )
								echo '<img src="' . esc_url( $new_img ) . '" alt="' . esc_attr( get_the_title() ) . '">';
							else
								echo $wp_embed->shortcode( array( 'width' => $get_width ), $get_video );

							the_title( '<h2 class="slide-title">', '</h2>' );

							the_content();

							// Close off the Slide's Link
							if( $get_url ) {
								echo '</a>';
							}

		  	    		echo '</li>';

					endforeach;

				endif;

          	echo '</ul><!-- .slides #slides -->';
		echo '</div><!-- .flexslider -->';
	echo '</div><!-- .hero-slides -->';

}
endif;

/**
 * Camera.
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_camera_markup' ) ):
function tokokoo_camera_markup( $slides, $get_width, $get_height, $crop_img ) {
	global $post, $wp_embed;

	echo '<div class="hero-slides">';
		echo '<div class="camera-slides">';

			echo '<div class="camera_wrap" id="camera_slider">';

				if ( is_array( $slides ) ) :

					foreach( $slides as $post ) : setup_postdata( $post );

						$img 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $get_width, $get_height ) );
						$thumb 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small' );
						$get_url	= esc_url( get_field( 'tokokoo_slide_url', get_the_ID() ) ); // get the url 
						$get_video	= esc_url( get_field( 'tokokoo_slide_video', get_the_ID() ) ); // get the video url

						echo '<div data-link="' . $get_url . '" data-thumb="' . $thumb[0] . '" data-src="' . $img[0] . '" data-video="hide">';
						    echo '<div class="camera_caption fadeFromBottom">';
						        if( $get_video ) echo $wp_embed->shortcode( array( 'width' => $get_width ), $get_video ); else the_content();
						    echo '</div>';
						echo '</div>';

					endforeach;

				endif;

			echo '</div><!-- .camera_wrap #camera_slider -->';

		echo '</div><!-- .camera-slides -->';
	echo '</div><!-- .hero-slides -->';

}
endif;
?>
