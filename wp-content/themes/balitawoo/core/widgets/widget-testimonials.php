<?php
/**
 * Testimonial widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_testimonials extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'user-testimonials', 
			'description' => __( 'A custom widget that display three testimonials.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 800, 
			'height' => 350
		);

		parent::__construct( 'tokokoo_testimonials_widget', __( 'Tokokoo - Testimonials', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$link = esc_url( $instance['link'] );
		$name = strip_tags( $instance['name'] );
		$desc = stripslashes( $instance['desc'] );

		$link2 = esc_url( $instance['link2'] );
		$name2 = strip_tags( $instance['name2'] );
		$desc2 = stripslashes( $instance['desc2'] );

		$link3 = esc_url( $instance['link3'] );
		$name3 = strip_tags( $instance['name3'] );
		$desc3 = stripslashes( $instance['desc3'] );

		echo $before_widget;
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>
		
		<div class="testimonial-wrap">
		
			<ul id="testimonial" class="testimonial-widget no-list-style cl rslides">
				
				<li class="testimonial-item">

					<div class="inside">
						<p><?php echo $desc; ?></p>

						<div class="user-meta">
						    <span class="name"><?php echo $name; ?></span>
						    <span class="site"><a href="<?php echo $link; ?>"><?php echo $link; ?></a></span>
						</div>
					</div>
					
				</li>
				
				<li class="testimonial-item">
					
					<div class="inside">
						<p><?php echo $desc2; ?></p>
						
						<div class="user-meta">
						    <span class="name"><?php echo $name2; ?></span>
						    <span class="site"><a href="<?php echo $link2; ?>"><?php echo $link2; ?></a></span>
						</div>
					</div>
					
				</li>

				<li class="testimonial-item">
					
					<div class="inside">
						<p><?php echo $desc3; ?></p>
						
						<div class="user-meta">
						    <span class="name"><?php echo $name3; ?></span>
						    <span class="site"><a href="<?php echo $link3; ?>"><?php echo $link3; ?></a></span>
						</div>
					</div>
					
				</li>

			</ul><!-- .testimonial-widget -->
			
		</div><!-- .testimonial-wrap -->

		<?php
		echo $after_widget;
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = esc_url_raw( $new_instance['link'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );

		$instance['link2'] = esc_url_raw( $new_instance['link2'] );
		$instance['name2'] = strip_tags( $new_instance['name2'] );
		$instance['desc2'] = stripslashes( $new_instance['desc2'] );

		$instance['link3'] = esc_url_raw( $new_instance['link3'] );
		$instance['name3'] = strip_tags( $new_instance['name3'] );
		$instance['desc3'] = stripslashes( $new_instance['desc3'] );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'link' => '',
            'name' => '',
            'desc' => '',
            'link2' => '',
            'name2' => '',
            'desc2' => '',
            'link3' => '',
            'name3' => '',
            'desc3' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$link = esc_url_raw( $instance['link'] );
		$name = strip_tags( $instance['name'] );
		$desc = stripslashes( $instance['desc'] );

		$link2 = esc_url_raw( $instance['link2'] );
		$name2 = strip_tags( $instance['name2'] );
		$desc2 = stripslashes( $instance['desc2'] );

		$link3 = esc_url_raw( $instance['link3'] );
		$name3 = strip_tags( $instance['name3'] );
		$desc3 = stripslashes( $instance['desc3'] );
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

	<div class="hybrid-widget-controls columns-3">
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php _e( 'URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php _e( 'Name:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo $name; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Testimonial:', 'balitawoo' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'desc' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" style="height: 100px;"><?php echo $desc; ?></textarea>
		</p>
		
	</div>

	<div class="hybrid-widget-controls columns-3">
			
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link2' ) ); ?>"><?php _e( 'URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link2' ) ); ?>" type="text" value="<?php echo $link2; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name2' ) ); ?>"><?php _e( 'Name:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name2' ) ); ?>" type="text" value="<?php echo $name2; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc2' ); ?>"><?php _e( 'Testimonial:', 'balitawoo' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'desc2' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'desc2' ); ?>" style="height: 100px;"><?php echo $desc2; ?></textarea>
		</p>

	</div>

	<div class="hybrid-widget-controls columns-3 column-last">
			
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link3' ) ); ?>"><?php _e( 'URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link3' ) ); ?>" type="text" value="<?php echo $link3; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name3' ) ); ?>"><?php _e( 'Name:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name3' ) ); ?>" type="text" value="<?php echo $name3; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc3' ); ?>"><?php _e( 'Testimonial:', 'balitawoo' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'desc3' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'desc3' ); ?>" style="height: 100px;"><?php echo $desc3; ?></textarea>
		</p>

	</div>

	<?php
	}

}
?>