<?php
/**
 * Facebook widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_facebook_fans extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {

		$widget_ops = array( 
			'classname' => 'fb-fans-box', 
			'description' => __( 'A custom widget to display the Facebook fans page box.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 350, 
			'height' => 350 
		);

		parent::__construct( 'tokokoo_fb_widget', __( 'Tokokoo - Facebook Fans Widget', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$fb_url = urlencode( $instance['fb_url'] );
		$width = (int)( $instance['width'] );
		$height = (int)( $instance['height'] );
		$connections = (int)( $instance['connections'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

		if( $css )
		    echo '<style>' . $css . '</style>';
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>

			<div class="fb-like">
				<div class="fb-page" data-href="https://www.facebook.com/imdb" 
  data-width="<?php echo $width; ?>" data-hide-cover="false" data-show-facepile="<?php echo $height; ?>"
  data-show-posts="false"></div>
				<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $fb_url; ?>&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;connections=<?php echo $connections; ?>&amp;border_color&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
			</div>

		<?php
		echo $after_widget;
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fb_url'] = esc_url_raw( $new_instance['fb_url'] );
		$instance['width'] = (int)( $new_instance['width'] );
		$instance['height'] = (int)( $new_instance['height'] );
		$instance['connections'] = (int)( $new_instance['connections'] );
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
            'fb_url' => 'http://www.facebook.com/yourpage',
            'width' => 300,
            'height' => 280,
            'connections' => 10,
            'css' => ''
        );

		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$fb_url = esc_url_raw( $instance['fb_url'] );
		$width = (int)( $instance['width'] );
		$height = (int)( $instance['height'] );
		$connections = (int)( $instance['connections'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>"><?php _e( 'Facebook Page URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb_url' ) ); ?>" type="text" value="<?php echo $fb_url; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php _e( 'Width:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php _e( 'Height:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'connections' ) ); ?>"><?php _e( 'Connection:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'connections' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'connections' ) ); ?>" type="text" value="<?php echo $connections; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
		</p>

	<?php
	}

}
?>