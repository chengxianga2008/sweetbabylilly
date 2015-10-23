<?php
/**
 * Standard/custom post type (random) widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_random_post_type extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'random-post-type', 
			'description' => __( 'A custom widget to display random data from any post type.', 'balitawoo' )
		);

		$control_ops = array(
			'width' => 300, 
			'height' => 350,
		);

		parent::__construct( 'tokokoo_random_post_type_widget', __( 'Tokokoo - Post Type Random', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$limit = (int)( $instance['limit'] );
		$excerpt = $instance['excerpt'];
		$length = (int)( $instance['length'] );
		$thumb = $instance['thumb'];
		$thumb_height = (int)($instance['thumb_height']);
		$thumb_width = (int)($instance['thumb_width']);
		$date = $instance['date'];
		$cat = $instance['cat'];
		$post_type = $instance['post_type'];
		$css = wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

		if( $css )
		    echo '<style>' . $css . '</style>';
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		global $post;

		$post_args = array( 
			'numberposts' => $limit,
			'orderby' => 'rand',
			'cat' => $cat,
			'post_type' => $post_type
		);

	    $post_query = get_posts( $post_args );

	    if( $post_query ) :
		?>
			
			<ul class="no-list-style">

				<?php foreach( $post_query as $post ) :	setup_postdata( $post ); ?>

					<li class="cl">
							
						<?php if ( current_theme_supports( 'get-the-image' ) && $thumb == true ) { ?>
							<?php get_the_image( array( 'meta_key' => 'Thumbnail', 'height' => $thumb_height, 'width' => $thumb_width, 'image_class' => 'alignleft' ) ); ?>
						<?php } ?>

						<?php the_title( '<h2 class="post-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>

						<?php if( $date == true ) { ?>
							<span class="post-time"><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . __( ' ago', 'balitawoo' ); ?></span>
						<?php } ?>

						<?php if( $excerpt == true ) {  ?>
							<div class="post-summary"><?php echo tokokoo_random_post_type_excerpt( $length ); ?></div>
						<?php } ?>

					</li>

				<?php endforeach; wp_reset_postdata(); ?>

			</ul>

		<?php
		endif;

		echo $after_widget;
		
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = (int)( $new_instance['limit'] );
		$instance['excerpt'] = $new_instance['excerpt'];
		$instance['length'] = (int)( $new_instance['length'] );
		$instance['thumb'] = $new_instance['thumb'];
		$instance['thumb_height'] = (int)($new_instance['thumb_height']);
		$instance['thumb_width'] = (int)($new_instance['thumb_width']);
		$instance['date'] = $new_instance['date'];
		$instance['cat'] = $new_instance['cat'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['css'] = wp_filter_nohtml_kses( $new_instance['css'] );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'limit' => 5,
            'excerpt' => '',
            'length' => 10,
            'thumb' => true,
            'thumb_height' => 45,
			'thumb_width' => 45,
            'date' => true,
            'cat' => '',
            'post_type' => 'post',
            'css' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$limit = (int)( $instance['limit'] );
		$excerpt = $instance['excerpt'];
		$length = (int)($instance['length']);
		$thumb = $instance['thumb'];
		$thumb_height = (int)($instance['thumb_height']);
		$thumb_width = (int)($instance['thumb_width']);
		$date = $instance['date'];
		$cat = $instance['cat'];
		$post_type = $instance['post_type'];
		$css = wp_filter_nohtml_kses( $instance['css'] );
	?>
	
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo $limit; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt' ) ); ?>"><?php _e( 'Display excerpt ?', 'balitawoo' ); ?></label>
	      	<input id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" type="checkbox" value="1" <?php checked( '1', $excerpt ); ?> />&nbsp;
        </p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>"><?php _e( 'Excerpt length:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'length' ) ); ?>" type="text" value="<?php echo $length; ?>" />
		</p>

		<?php if( current_theme_supports( 'post-thumbnails' ) && current_theme_supports( 'get-the-image' ) ) { ?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb' ) ); ?>"><?php _e( 'Display thumbnail ?', 'balitawoo' ); ?></label>
		      	<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" type="checkbox" value="1" <?php checked( '1', $thumb ); ?> />&nbsp;
	        </p>
	         <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>"><?php _e( 'Thumbnail Size (height x width):', 'balitawoo' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_height' ) ); ?>" type="text" value="<?php echo $thumb_height; ?>"/>
				<input id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="text" value="<?php echo $thumb_width; ?>"/>
			</p>

		<?php } ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php _e( 'Display date ?', 'balitawoo' ); ?></label>
	      	<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( '1', $date ); ?> />&nbsp;
        </p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) ); ?>"><?php _e( 'Limit to category: ' , 'balitawoo' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name( 'cat' ), 'show_option_all' => __( 'All categories' , 'balitawoo' ), 'hide_empty' => 1, 'hierarchical' => 1, 'selected' => $cat ) ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('post_type')); ?>"><?php _e( 'Choose the Post Type: ', 'balitawoo' ); ?></label>
			<?php /* pros Justin Tadlock - http://themehybrid.com/ */ ?>
			<select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
				<?php foreach ( get_post_types( '', 'objects' ) as $post_type ) { ?>
					<option value="<?php echo esc_attr( $post_type->name ); ?>" <?php selected( $instance['post_type'], $post_type->name ); ?>><?php echo esc_html( $post_type->labels->singular_name ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
		</p>

	<?php
	}

}

/**
 * Print a custom excerpt.
 * http://bavotasan.com/2009/limiting-the-number-of-words-in-your-excerpt-or-content-in-wordpress/
 *
 * @since 1.0
 */
function tokokoo_random_post_type_excerpt( $length ) {

	$excerpt = explode( ' ', get_the_excerpt(), $length );
	if ( count( $excerpt )>=$length ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '&hellip;';
	} else {
		$excerpt = implode( " ", $excerpt );
	} 
		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;

}
?>