<?php
/**
 * Feedburner widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_subscribe extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'feedburner-form', 
			'description' => __( 'A custom widget to display the Feedburner subscription widget.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 300, 
			'height' => 350
		);

		parent::__construct( 'tokokoo_subscribe_widget', __( 'Tokokoo - Feedburner', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$feed_id = strip_tags( $instance['feed_id'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

		if( $css )
		    echo '<style>' . $css . '</style>';
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
			if( $feed_id ) { ?>
		
				<div class="subscribe">
					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="text" name="email" placeholder="<?php esc_attr_e( 'Email address &hellip;', 'balitawoo' ); ?>" />
						<input type="hidden" value="<?php echo $feed_id; ?>" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<input type="submit" class="btn" value="<?php esc_attr_e( 'Subscribe', 'balitawoo' ); ?>" />
					</form>
				</div>

			<?php }	

		echo $after_widget;

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['feed_id'] = strip_tags( $new_instance['feed_id'] );
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
            'feed_id' => '',
            'css' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$feed_id = strip_tags( $instance['feed_id'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'feed_id' ) ); ?>"><?php _e( 'Feedburner ID: (http://feeds.feedburner.com/<b>tokokoo</b>):', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'feed_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'feed_id' ) ); ?>" type="text" value="<?php echo $feed_id; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
		</p>

	<?php
	}


}
?>