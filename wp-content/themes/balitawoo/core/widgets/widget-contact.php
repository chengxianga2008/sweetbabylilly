<?php
/**
 * Contact widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_contact extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'contact-detail', 
			'description' => __( 'A custom widget to display your contact details.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 350, 
			'height' => 350, 
			'id_base' => 'tokokoo_contact_widget' 
		);

		parent::__construct( 'tokokoo_contact_widget', __( 'Tokokoo - Contact Info', 'balitawoo' ), $widget_ops, $control_ops );
	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$summary = stripslashes( $instance['summary'] );
		$address = stripslashes( $instance['address'] );
		$email = antispambot( $instance['email'] );
		$phone = strip_tags( $instance['phone'] );
		$fax = strip_tags( $instance['fax'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );

		echo $before_widget;

	    if( $css )
		    echo '<style>' . $css . '</style>';
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

			if( $summary ) {
				echo wpautop( $summary );
			}
			if( $address ) {
				echo wpautop( $address );
			}
			if( $email ) {
				echo '<span class="contact-email">' . $email . '</span>';
			}
			if( $phone ) {
				echo '<span class="contact-phone">' . $phone . '</span>';
			}
			if( $fax ) {
				echo '<span class="contact-fax">' . $fax . '</span>';
			}

		echo $after_widget;

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['summary'] = stripslashes( $new_instance['summary'] );
		$instance['address'] = stripslashes( $new_instance['address'] );
		$instance['email'] = is_email( $new_instance['email'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
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
            'summary' => '',
            'address' => '',
            'email' => '',
            'phone' => '',
            'fax' => '',
            'css' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$summary = stripslashes( $instance['summary'] );
		$address = stripslashes( $instance['address'] );
		$email = is_email( $instance['email'] );
		$phone = strip_tags( $instance['phone'] );
		$fax = strip_tags( $instance['fax'] );
		$css = wp_filter_nohtml_kses( $instance['css'] );

	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'summary' ); ?>"><?php _e( 'Summary:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'summary' ); ?>" name="<?php echo $this->get_field_name( 'summary' ); ?>" style="height:100px;"><?php echo $summary; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" style="height:100px;"><?php echo $address; ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php _e( 'Email:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo $email; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php _e( 'Phone:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo $phone; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php _e( 'Fax:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>" type="text" value="<?php echo $fax; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>"><?php _e( 'Custom CSS:', 'balitawoo' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'css' ); ?>" name="<?php echo $this->get_field_name( 'css' ); ?>" style="height:100px;"><?php echo $css; ?></textarea>
		</p>

	<?php
	}

}