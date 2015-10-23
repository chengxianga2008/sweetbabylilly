<?php
/**
 * Video widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_video_widget extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'video-frame', 
			'description' => __( 'A custom widget to display video such as from youtube, vimeo and etc.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 300, 
			'height' => 350
		);

		parent::__construct( 'tokokoo_video_widget', __( 'Tokokoo - Video', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$video_url = esc_url( $instance['video_url'] );

		echo $before_widget;
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		$output = get_transient( 'videowidget_' . $widget_id );

		if ( $output === false ) {
		
			global $wp_embed;

			$output = '<div class="video-widget">';
			$output .= $wp_embed->shortcode( array( 'width' => 400 ), $video_url );
			$output .= '</div>';

			set_transient( 'videowidget_' . $widget_id, $output, 60*60*24 );

		}
			echo $output;

		echo $after_widget;
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_url'] = esc_url_raw( $new_instance['video_url'] );

		delete_transient( 'videowidget_' . $this->id );
		
		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'video_url' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$video_url = esc_url_raw( $instance['video_url'] );
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>"><?php _e( 'Video URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_url' ) ); ?>" type="text" value="<?php echo $video_url; ?>" />
		</p>

	<?php
	}

}
?>