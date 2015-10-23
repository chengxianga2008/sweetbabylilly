<?php
/**
 * Social widget
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_social extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {

		$widget_ops = array( 
			'classname' => 'social-network', 
			'description' => __( 'A custom widget to display the social network icons.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 800, 
			'height' => 350 
		);

		parent::__construct( 'tokokoo_social_widget', __( 'Tokokoo - Social Connect', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$rss = esc_url( $instance['rss'] );
		$email_id = antispambot( $instance['email_id'] );
		$twitter_id = strip_tags( $instance['twitter_id'] );
		$fb_id = strip_tags( $instance['fb_id'] );
		$gplus_id = strip_tags( $instance['gplus_id'] );
		$ytube_id = strip_tags( $instance['ytube_id'] );
		$flickr_id = strip_tags( $instance['flickr_id'] );
		$linkedin_id = strip_tags( $instance['linkedin_id'] );
		$pinterest_id = strip_tags( $instance['pinterest_id'] );
		$dribbble_id = strip_tags( $instance['dribbble_id'] );
		$github_id = strip_tags( $instance['github_id'] );
		$lastfm_id = strip_tags( $instance['lastfm_id'] );
		$vimeo_id = strip_tags( $instance['vimeo_id'] );
		$tumblr_id = strip_tags( $instance['tumblr_id'] );
		$instagram_id = strip_tags( $instance['instagram_id'] );
		$soundcloud_id = strip_tags( $instance['soundcloud_id'] );
		$behance_id = strip_tags( $instance['behance_id'] );
		$deviantart_id = strip_tags( $instance['deviantart_id'] );
		
		echo $before_widget;
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>

		<ul class="social-buttons no-list-style cl">

			<?php if ( $rss ) { ?>
				<li><a class="rssfeed tip" href="<?php echo $rss; ?>" target="_blank">Rss Feed</a></li>
			<?php } if ( $email_id ) { ?>
				<li><a class="email tip" href="mailto:<?php echo $email_id; ?>" target="_blank">Email</a></li>
			<?php } if ( $twitter_id ) { ?>
				<li><a class="twitter tip" href="http://twitter.com/<?php echo $twitter_id; ?>" target="_blank">Twitter</a></li>
			<?php } if ( $fb_id ) { ?>
				<li><a class="fb" href="http://www.facebook.com/<?php echo $fb_id; ?>" target="_blank">Facebook</a></li>
			<?php } if ( $gplus_id ) { ?>
				<li><a class="gplus" href="https://plus.google.com/u/<?php echo $gplus_id; ?>" target="_blank">Google Plus</a></li>
			<?php } if ( $ytube_id ) { ?>
				<li><a class="ytube" href="http://www.youtube.com/user/<?php echo $ytube_id; ?>" target="_blank">Youtube</a></li>
			<?php } if ( $flickr_id ) { ?>
				<li><a class="flickr" href="http://www.flickr.com/photos/<?php echo $flickr_id; ?>" target="_blank">Flickr</a></li>
			<?php } if ( $linkedin_id ) { ?>
				<li><a class="linkedin" href="http://linkedin.com/in/<?php echo $linkedin_id; ?>" target="_blank">Linkedin</a></li>
			<?php } if ( $pinterest_id ) { ?>
				<li><a class="pinterest" href="http://pinterest.com/<?php echo $pinterest_id; ?>" target="_blank">Pinterest</a></li>
			<?php } if ( $dribbble_id ) { ?>
				<li><a class="dribbble" href="http://dribbble.com/<?php echo $dribbble_id; ?>" target="_blank">Dribbble</a></li>
			<?php } if ( $github_id ) { ?>
				<li><a class="github" href="https://github.com/<?php echo $github_id; ?>" target="_blank">Github</a></li>
			<?php } if ( $lastfm_id ) { ?>
				<li><a class="lastfm" href="http://www.last.fm/user/<?php echo $lastfm_id; ?>" target="_blank">Last FM</a></li>
			<?php } if ( $vimeo_id ) { ?>
				<li><a class="vimeo" href="http://vimeo.com/<?php echo $vimeo_id; ?>" target="_blank">Vimeo</a></li>
			<?php } if ( $tumblr_id ) { ?>
				<li><a class="tumblr" href="http://<?php echo $tumblr_id; ?>.tumblr.com" target="_blank">Tumblr</a></li>
			<?php } if ( $instagram_id ) { ?>
				<li><a class="instagram" href="http://instagram.com/<?php echo $instagram_id; ?>" target="_blank">Instagram</a></li>
			<?php } if ( $soundcloud_id ) { ?>
				<li><a class="soundcloud" href="https://soundcloud.com/<?php echo $soundcloud_id; ?>" target="_blank">Soundcloud</a></li>
			<?php } if ( $behance_id ) { ?>
				<li><a class="behance" href="http://www.behance.net/<?php echo $behance_id; ?>" target="_blank">Behance</a></li>
			<?php } if ( $deviantart_id ) { ?>
				<li><a class="deviantart" href="http://<?php echo $deviantart_id; ?>.deviantart.com/" target="_blank">Deviantart</a></li>
			<?php } ?>

		</ul>

		<?php
		echo $after_widget;

	}
 	
	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['rss'] = esc_url_raw( $new_instance['rss'] );
		$instance['email_id'] = is_email( $new_instance['email_id'] );
		$instance['twitter_id'] = strip_tags( $new_instance['twitter_id'] );
		$instance['fb_id'] = strip_tags( $new_instance['fb_id'] );
		$instance['gplus_id'] = strip_tags( $new_instance['gplus_id'] );
		$instance['ytube_id'] = strip_tags( $new_instance['ytube_id'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['linkedin_id'] = strip_tags( $new_instance['linkedin_id'] );
		$instance['pinterest_id'] = strip_tags( $new_instance['pinterest_id'] );
		$instance['dribbble_id'] = strip_tags( $new_instance['dribbble_id'] );
		$instance['github_id'] = strip_tags( $new_instance['github_id'] );
		$instance['lastfm_id'] = strip_tags( $new_instance['lastfm_id'] );
		$instance['vimeo_id'] = strip_tags( $new_instance['vimeo_id'] );
		$instance['tumblr_id'] = strip_tags( $new_instance['tumblr_id'] );
		$instance['instagram_id'] = strip_tags( $new_instance['instagram_id'] );
		$instance['soundcloud_id'] = strip_tags( $new_instance['soundcloud_id'] );
		$instance['behance_id'] = strip_tags( $new_instance['behance_id'] );
		$instance['deviantart_id'] = strip_tags( $new_instance['deviantart_id'] );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' => '',
            'rss' => '',
            'email_id' => '',
            'twitter_id' => '',
            'fb_id' => '',
            'gplus_id' => '',
            'ytube_id' => '',
            'flickr_id' => '',
            'linkedin_id' => '',
            'pinterest_id' => '',
            'dribbble_id' => '',
            'github_id' => '',
            'lastfm_id' => '',
            'vimeo_id' => '',
            'tumblr_id' => '',
            'instagram_id' => '',
            'soundcloud_id' => '',
            'behance_id' => '',
            'deviantart_id' => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags( $instance['title'] );
		$rss = esc_url_raw( $instance['rss'] );
		$email_id = is_email( $instance['email_id'] );
		$twitter_id = strip_tags( $instance['twitter_id'] );
		$fb_id = strip_tags( $instance['fb_id'] );
		$gplus_id = strip_tags( $instance['gplus_id'] );
		$ytube_id = strip_tags( $instance['ytube_id'] );
		$flickr_id = strip_tags( $instance['flickr_id'] );
		$linkedin_id = strip_tags( $instance['linkedin_id'] );
		$pinterest_id = strip_tags( $instance['pinterest_id'] );
		$dribbble_id = strip_tags( $instance['dribbble_id'] );
		$github_id = strip_tags( $instance['github_id'] );
		$lastfm_id = strip_tags( $instance['lastfm_id'] );
		$vimeo_id = strip_tags( $instance['vimeo_id'] );
		$tumblr_id = strip_tags( $instance['tumblr_id'] );
		$instagram_id = strip_tags( $instance['instagram_id'] );
		$soundcloud_id = strip_tags( $instance['soundcloud_id'] );
		$behance_id = strip_tags( $instance['behance_id'] );
		$deviantart_id = strip_tags( $instance['deviantart_id'] );

	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

	<div class="hybrid-widget-controls columns-3">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>"><?php _e( 'Rss URL:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" type="text" value="<?php echo $rss; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email_id' ) ); ?>"><?php _e( 'Email:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email_id' ) ); ?>" type="text" value="<?php echo $email_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>"><?php _e( 'Twitter Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_id' ) ); ?>" type="text" value="<?php echo $twitter_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb_id' ) ); ?>"><?php _e( 'Facebook Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb_id' ) ); ?>" type="text" value="<?php echo $fb_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'gplus_id' ) ); ?>"><?php _e( 'Google Plus Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gplus_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gplus_id' ) ); ?>" type="text" value="<?php echo $gplus_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ytube_id' ) ); ?>"><?php _e( 'Youtube Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ytube_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ytube_id' ) ); ?>" type="text" value="<?php echo $ytube_id; ?>" />
		</p>

	</div>

	<div class="hybrid-widget-controls columns-3">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>"><?php _e( 'Flickr Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_id' ) ); ?>" type="text" value="<?php echo $flickr_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin_id' ) ); ?>"><?php _e( 'Linkedin Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin_id' ) ); ?>" type="text" value="<?php echo $linkedin_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_id' ) ); ?>"><?php _e( 'Pinterest Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest_id' ) ); ?>" type="text" value="<?php echo $pinterest_id; ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble_id' ) ); ?>"><?php _e( 'Dribbble Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble_id' ) ); ?>" type="text" value="<?php echo $dribbble_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'github_id' ) ); ?>"><?php _e( 'Github Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github_id' ) ); ?>" type="text" value="<?php echo $github_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lastfm_id' ) ); ?>"><?php _e( 'Last FM Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'lastfm_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lastfm_id' ) ); ?>" type="text" value="<?php echo $lastfm_id; ?>" />
		</p>

	</div>

	<div class="hybrid-widget-controls columns-3 column-last">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo_id' ) ); ?>"><?php _e( 'Vimeo Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo_id' ) ); ?>" type="text" value="<?php echo $vimeo_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr_id' ) ); ?>"><?php _e( 'Tumblr Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr_id' ) ); ?>" type="text" value="<?php echo $tumblr_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_id' ) ); ?>"><?php _e( 'Instagram Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_id' ) ); ?>" type="text" value="<?php echo $instagram_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud_id' ) ); ?>"><?php _e( 'Soundcloud Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud_id' ) ); ?>" type="text" value="<?php echo $soundcloud_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance_id' ) ); ?>"><?php _e( 'Behance Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance_id' ) ); ?>" type="text" value="<?php echo $behance_id; ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'deviantart_id' ) ); ?>"><?php _e( 'Deviantart Username:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'deviantart_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deviantart_id' ) ); ?>" type="text" value="<?php echo $deviantart_id; ?>" />
		</p>

	</div>

	<?php
	}
 
}
?>