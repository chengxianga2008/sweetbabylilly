<?php
/**
 * Ads widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_ads extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'advertisement', 
			'description' => __( 'A custom widget to display any type of Ad as a widget.', 'balitawoo' )
		);

		$control_ops = array(
			'width' => 350, 
			'height' => 350,
		);

		parent::__construct( 'tokokoo_ads_widget', __( 'Tokokoo - Advertisement', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$adcode = stripslashes( $instance['adcode'] );
		$imgurl = esc_url( $instance['imgurl'] );
		$linkurl = esc_url( $instance['linkurl'] );
		$alttext = strip_tags( $instance['alttext'] );
		$target = $instance['target'];
		$css = wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

		if( $css )
		    echo '<style>' . $css . '</style>';
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
			if( ! empty( $adcode ) ) {
				echo $adcode;
			} else {
				echo '<a href="' . $linkurl . '" target="' . $target . '"><img src="' . $imgurl . '" alt="' . $alttext . '"></a>';
			}

		echo $after_widget;

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adcode'] = stripslashes( $new_instance['adcode'] );
		$instance['imgurl'] = esc_url_raw( $new_instance['imgurl'] );
		$instance['linkurl'] = esc_url_raw( $new_instance['linkurl'] );
		$instance['alttext'] = strip_tags( $new_instance['alttext'] );
		$instance['target'] = $new_instance['target'];
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
            'adcode' => '',
            'imgurl' => '',
            'linkurl' => '',
            'alttext' => '',
            'target' => '',
            'css' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$adcode = stripslashes( $instance['adcode'] );
		$imgurl = esc_url_raw( $instance['imgurl'] );
		$linkurl = esc_url_raw( $instance['linkurl'] );
		$alttext = strip_tags( $instance['alttext'] );
		$target = $instance['target'];
		$css = wp_filter_nohtml_kses( $instance['css'] );
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'adcode' ); ?>"><?php _e( 'Ad Code:', 'balitawoo' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'adcode' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'adcode' ); ?>" style="height: 100px;"><?php echo $adcode; ?></textarea>
		</p>
		<p><strong>or</strong></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imgurl' ) ); ?>"><?php _e( 'Image URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'imgurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'imgurl' ) ); ?>" type="text" value="<?php echo $imgurl; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkurl' ) ); ?>"><?php _e( 'Link:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkurl' ) ); ?>" type="text" value="<?php echo $linkurl; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'alttext' ) ); ?>"><?php _e( 'Alt Text:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alttext' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'alttext' ) ); ?>" type="text" value="<?php echo $alttext; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php _e( 'Link Target:', 'balitawoo' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
				<option value="_self" <?php selected( $target, '_self' ); ?>><?php _e( 'Open in the same window', 'balitawoo' ); ?></option>
				<option value="_blank" <?php selected( $target, '_blank' ); ?>><?php _e( 'Open in a new window', 'balitawoo' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
		</p>

	<?php
	}

}
?>