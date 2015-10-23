<?php
/**
 * Google Maps Widget
 * Based off http://wordpress.org/plugins/simple-contact-info/
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_google_maps extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'google-maps', 
			'description' => __( 'A custom widget to display Google Maps based on your address.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 525, 
			'height' => 350, 
			'id_base' => 'tokokoo_google_maps' 
		);

		parent::__construct( 'tokokoo_google_maps', __( 'Tokokoo - Google Maps', 'balitawoo' ), $widget_ops, $control_ops );
	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$country = strip_tags( $instance['country'] );
		$state = strip_tags( $instance['state'] );
		$city = strip_tags( $instance['city'] );
		$street = strip_tags( $instance['street'] );
		$zip = strip_tags( $instance['zip'] );
		$type = $instance['type'];
		$width = (int)( $instance['width'] );
		$height = (int)( $instance['height'] );
		$zoom = (int)( $instance['zoom'] );

		$address = $country . ' ' . $state . ' ' . $city . ' ' . $street;

		if ( $type == 'dynamic' ) {
			wp_enqueue_style('tokokoo-google-style', 'http://code.google.com/apis/maps/documentation/javascript/examples/default.css'); 

			wp_register_script( 'tokokoo-googleapis', 'https://maps.googleapis.com/maps/api/js?sensor=false', true, '1.0' );
			wp_enqueue_script( 'tokokoo-googleapis' );

			wp_register_script( 'tokokoo-googlemap', trailingslashit( TOKOKOO_ASSETS ) . 'js/google-maps.js', true, '1.0' );
			wp_enqueue_script( 'tokokoo-googlemap' );
		} else {
			$address = str_replace( ' ', '+', $address );
		}

		echo $before_widget; 

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		?>

			<div class="tokokoo-google-widget">
				<?php if ( $type == 'dynamic' ) { ?>
					<script>
						var sci_google_zoom 	= "<?php echo $zoom; ?>";
						var sci_google_address 	= "<?php echo $address; ?>";
					</script>
					<div id="tokokoo-google-map" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
						<!-- map here -->
					</div>
				<?php } elseif( $type == 'static' ) { ?>
					<img src="http://maps.googleapis.com/maps/api/staticmap?
					center=<?php echo $address; ?>&
					zoom=<?php echo $zoom; ?>&
					size=<?php echo $width; ?>x<?php echo $height; ?>&
					maptype=roadmap&
					markers=color:red%7Clabel:S%7C<?php echo $address; ?>&
					sensor=false">
				<?php } ?>
			</div>

		<?php echo $after_widget;

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['country'] = strip_tags( $new_instance['country'] );
		$instance['state'] = strip_tags( $new_instance['state'] );
		$instance['city'] = strip_tags( $new_instance['city'] );
		$instance['street'] = strip_tags( $new_instance['street'] );
		$instance['zip'] = strip_tags( $new_instance['zip'] );
		$instance['type'] = $new_instance['type'];
		$instance['width'] = (int)( $new_instance['width'] );
		$instance['height'] = (int)( $new_instance['height'] );
		$instance['zoom'] = (int)( $new_instance['zoom'] );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'street' => '',
            'zip' => '',
            'type' => 'dynamic',
            'width' => 250,
            'height' => 250,
            'zoom' => 15
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$country = strip_tags( $instance['country'] );
		$state = strip_tags( $instance['state'] );
		$city = strip_tags( $instance['city'] );
		$street = strip_tags( $instance['street'] );
		$zip = strip_tags( $instance['zip'] );
		$type = $instance['type'];
		$width = (int)( $instance['width'] );
		$height = (int)( $instance['height'] );
		$zoom = (int)( $instance['zoom'] );
		$options = array( 'dynamic', 'static' );

	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

	<div class="hybrid-widget-controls columns-2">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'country' ) ); ?>"><?php _e( 'Country:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'country' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'country' ) ); ?>" type="text" value="<?php echo $country; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'state' ) ); ?>"><?php _e( 'State:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'state' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'state' ) ); ?>" type="text" value="<?php echo $state; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'city' ) ); ?>"><?php _e( 'City:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'city' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'city' ) ); ?>" type="text" value="<?php echo $city; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'street' ) ); ?>"><?php _e( 'Street:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'street' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'street' ) ); ?>" type="text" value="<?php echo $street; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'zip' ) ); ?>"><?php _e( 'Zip:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'zip' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'zip' ) ); ?>" type="text" value="<?php echo $zip; ?>" />
		</p>

	</div>

	<div class="hybrid-widget-controls columns-2 column-last">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php _e( 'Type', 'balitawoo' ); ?>:</label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>">
				<?php foreach( $options as $option ) : ?>
					<?php echo '<option value="' . esc_attr( $option ) . '" ' . ( $option == $type ? 'selected="Selected"' : '' ) .  '>'.  ucfirst( $option ) .'</option>'; ?>
				<?php endforeach; ?>
			</select>
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>"><?php _e( 'Zoom:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'zoom' ) ); ?>" type="text" value="<?php echo $zoom; ?>" />
		</p>

	</div>

	<div class="clear"></div>

	<?php
	}

}
?>