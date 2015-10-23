<?php
/**
 * Opening hours widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_opening_hours extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'opening-hours', 
			'description' => __( 'A custom widget to display business hours.', 'balitawoo' )
		);

		$control_ops = array(
			'width' => 350, 
			'height' => 350,
		);

		parent::__construct( 'tokokoo_opening_hours_widget', __( 'Tokokoo - Business Hours', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$mon = strip_tags( $instance['mon'] );
		$tue = strip_tags( $instance['tue'] );
		$wed = strip_tags( $instance['wed'] );
		$thu = strip_tags( $instance['thu'] );
		$fri = strip_tags( $instance['fri'] );
		$sat = strip_tags( $instance['sat'] );
		$sun = strip_tags( $instance['sun'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

		if( $css )
		    echo '<style>' . $css . '</style>';
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
			echo '<ul class="no-list-style">';
				if( $mon ) {
					printf ( __( '<li><span class="day">Monday: </span>%s</li>', 'balitawoo' ), $mon );
				} 
				if( $tue ) {
					printf ( __( '<li><span class="day">Tuesday: </span>%s</li>', 'balitawoo' ), $tue );
				}
				if( $wed ) {
					printf ( __( '<li><span class="day">Wednesday: </span>%s</li>', 'balitawoo' ), $wed );
				}
				if( $thu ) {
					printf ( __( '<li><span class="day">Thursday: </span>%s</li>', 'balitawoo' ), $thu );
				}
				if( $fri ) {
					printf ( __( '<li><span class="day">Friday: </span>%s</li>', 'balitawoo' ), $fri );
				}
				if( $sat ) {
					printf ( __( '<li><span class="day">Saturday: </span>%s</li>', 'balitawoo' ), $sat );
				}
				if( $sun ) {
					printf ( __( '<li><span class="day">Sunday: </span>%s</li>', 'balitawoo' ), $sun );
				}
			echo '</ul>';

		echo $after_widget;

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['mon'] = strip_tags( $new_instance['mon'] );
		$instance['tue'] = strip_tags( $new_instance['tue'] );
		$instance['wed'] = strip_tags( $new_instance['wed'] );
		$instance['thu'] = strip_tags( $new_instance['thu'] );
		$instance['fri'] = strip_tags( $new_instance['fri'] );
		$instance['sat'] = strip_tags( $new_instance['sat'] );
		$instance['sun'] = strip_tags( $new_instance['sun'] );
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
            'mon' => '',
            'tue' => '',
            'wed' => '',
            'thu' => '',
            'fri' => '',
            'sat' => '',
            'sun' => '',
            'css' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$mon = strip_tags( $instance['mon'] );
		$tue = strip_tags( $instance['tue'] );
		$wed = strip_tags( $instance['wed'] );
		$thu = strip_tags( $instance['thu'] );
		$fri = strip_tags( $instance['fri'] );
		$sat = strip_tags( $instance['sat'] );
		$sun = strip_tags( $instance['sun'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );

	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mon' ) ); ?>"><?php _e( 'Monday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mon' ) ); ?>" type="text" value="<?php echo $mon; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tue' ) ); ?>"><?php _e( 'Tuesday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tue' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tue' ) ); ?>" type="text" value="<?php echo $tue; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'wed' ) ); ?>"><?php _e( 'Wednesday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wed' ) ); ?>" type="text" value="<?php echo $wed; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'thu' ) ); ?>"><?php _e( 'Thursday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thu' ) ); ?>" type="text" value="<?php echo $thu; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fri' ) ); ?>"><?php _e( 'Friday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fri' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fri' ) ); ?>" type="text" value="<?php echo $fri; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sat' ) ); ?>"><?php _e( 'Saturday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sat' ) ); ?>" type="text" value="<?php echo $sat; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sun' ) ); ?>"><?php _e( 'Sunday:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sun' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sun' ) ); ?>" type="text" value="<?php echo $sun; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
		</p>

	<?php
	}

}
?>