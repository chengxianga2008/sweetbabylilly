<?php
/**
 * Twitter widget
 * Display recent tweets for 1.1 Twitter API.
 * Based on Twitter-API-1.1-Client-for-Wordpress (https://github.com/micc83/Twitter-API-1.1-Client-for-Wordpress)
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
class tokokoo_twitter extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {
	
		$widget_ops = array( 
			'classname' => 'twitter-tweets', 
			'description' => __( 'A custom widget to display your recent tweets. Work with new Twitter API.', 'balitawoo' ) 
		);

		$control_ops = array( 
			'width' => 350, 
			'height' => 350,
			'id_base' => 'tokokoo_twitter_widget'
		);

		parent::__construct( 'tokokoo_twitter_widget', __( 'Tokokoo - Recent Tweets', 'balitawoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {

		extract( $args );
 
		$title = apply_filters( 'widget_title', $instance['title'] );
		$screen_name = $instance['screen_name'];
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$num_tweets = $instance['num_tweets'];
		$show_avatar = $instance['show_avatar'];
		$show_follow = $instance['show_follow'];
				
		echo $before_widget;
 
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		if( empty( $instance['consumer_key'] ) || empty( $instance['consumer_secret'] ) || empty( $instance['screen_name'] ) ){
			echo __( 'Please fill all widget settings.', 'balitawoo' ) . $after_widget;

			return;
		}

		if( ! require_once( trailingslashit( TOKOKOO_CLASS ) . 'class-wp-twitter-api.php' ) ) { 
			echo __( 'Couldn\'t find the required class.', 'balitawoo' ) . $after_widget;

			return;
		}

		$tweets = get_transient( 'twitter_widget_cache' );

		if ( $tweets === false || $tweets === '' ) {

			$twitter_api = new Wp_Twitter_Api( array(
					'consumer_key' => $consumer_key,
					'consumer_secret' => $consumer_secret
				) );

			$query = 'count=' . $num_tweets . '&include_entities=true&include_rts=true&screen_name=' . $screen_name;
			$tweets = $twitter_api->query( $query );

			set_transient( 'twitter_widget_cache', $tweets, 1800);
		}

		echo '<div class="twitter-tweets-inner">';
		echo '<ul class="twitter-tweets-list">';
		//print_r($tweets);

		foreach( $tweets as $tweet ) {
			$tweet_text = $this->linkify_tweet( $tweet->text );
			$tweet_time = $this->relative_time( $tweet->created_at );
			$tweet_url = 'http://twitter.com/' . $tweet->user->id . '/status/' . $tweet->id_str;
			$screen_name = $tweet->user->screen_name;
			$name = $tweet->user->name;
			$profile_image_url = $tweet->user->profile_image_url;
				
			echo '<li class="tweet">';

			if ( $show_avatar )
				echo '<div class="tweet-avatar"><img src="' . $profile_image_url . '" width="48px" height="48px"></div>';

			echo '<div class="tweet-content">
					<span class="tweet-user"><a href="https://twitter.com/' . $screen_name. '"><strong>' . $name . '</strong> @' . $screen_name . '</a></span>
					<span class="tweet-text">' . $tweet_text . '</span>
					<span class="tweet-time"><a href="' . $tweet_url . '">' . $tweet_time . '</a></span>
					</div>';
			echo '</li>';
		}

		echo '</ul><!-- .twitter-tweets-list -->';

		if( $show_follow )
			echo '<span class="follow-me">
                    <a href="https://twitter.com/' . $screen_name . '" class="twitter-follow-button" data-show-count="false">Follow @' . $screen_name . '</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </span>';

		echo '</div><!-- .twitter-tweets-inner -->';

		echo $after_widget;
	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['screen_name'] = strip_tags( $new_instance['screen_name']);
		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key']);
		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret']);
		$instance['num_tweets'] = (int)( $new_instance['num_tweets'] );
		$instance['show_avatar'] = isset( $new_instance['show_avatar'] );
		$instance['show_follow'] = isset( $new_instance['show_follow'] );

		delete_transient( 'twitter_widget_cache' );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Recent Tweets',
			'screen_name' => '',
			'consumer_key' => '',
			'consumer_secret' => '',
			'num_tweets' => 5,
			'show_avatar' => true,
			'show_follow' => false
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr( $instance['title'] );
		$screen_name = $instance['screen_name'];
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$num_tweets = $instance['num_tweets'];
		$show_avatar = $instance['show_avatar'];
		$show_follow = $instance['show_follow'];
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'balitawoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'screen_name' ); ?>"><?php _e( 'Screen Name:', 'balitawoo' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'screen_name' ); ?>" type="text" id="<?php echo $this->get_field_id( 'screen_name' ); ?>" value="<?php echo $screen_name; ?>" /><br />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e( 'Consumer Key:', 'balitawoo' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" value="<?php echo $consumer_key; ?>" /><br />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e( 'Consumer Secret:', 'balitawoo' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" value="<?php echo $consumer_secret; ?>" /><br />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_tweets' ); ?>"><?php _e( 'Number of Tweets:', 'balitawoo' ); ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'num_tweets' ); ?>" type="text" id="<?php echo $this->get_field_id( 'num_tweets' ); ?>" value="<?php echo $instance['num_tweets']; ?>" size="40" />
		</p>
		<p><label for="<?php echo $this->get_field_id('show_avatar') ?>">
			<input type="checkbox" name="<?php echo $this->get_field_name('show_avatar'); ?>" id="<?php echo $this->get_field_id('show_avatar'); ?>" <?php checked( isset( $show_avatar ) ? $show_avatar : 1 ) ?>>
			<?php _e('Show avatar image', 'balitawoo') ?></label>
		</p>
		<p><label for="<?php echo $this->get_field_id('show_follow') ?>">
			<input type="checkbox" name="<?php echo $this->get_field_name('show_follow'); ?>" id="<?php echo $this->get_field_id('show_follow'); ?>" <?php checked( isset( $show_follow ) ? $show_follow : 1 ) ?>>
			<?php _e('Show follow button', 'balitawoo') ?></label>
		</p>
		<?php
	}

	/**
	 * Makes links in a tweet clickable
	 */
	function linkify_tweet( $tweet ){
		$linkMaxLen = 250;

		// link to url
		$tweet = preg_replace("/((http:\/\/|https:\/\/)[^ )]+)/e", "'<a href=\"$1\" title=\"$1\" target=\"_blank\">'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $tweet);
		 
		// @ to follow
		$tweet = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" target=\"_blank\">$1</a>",$tweet);
		 
		// # to search
		$tweet = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" target=\"_blank\">$1</a>",$tweet);
		 
		return $tweet;
	}

	/**
	 * Beautiful and translatable relative time
	 */
	function relative_time( $time ) {
		// time difference
		$diff = strtotime( 'now' ) - strtotime( $time );

		// the time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;
			
		if( is_numeric( $diff ) && $diff > 0 ) {
			// if less than 3 seconds
			if($diff < 3) return __( 'right now', 'balitawoo' );
			// if less than 1 minute
			if($diff < $minute) return floor($diff) . __( ' seconds ago', 'balitawoo' );
			// if less than 2 minutes
			if($diff < $minute * 2) return __( 'about 1 minute ago', 'balitawoo' );
			// if less than 1 hour
			if($diff < $hour) return floor($diff / $minute) . __( ' minutes ago', 'balitawoo' );
			// if less than 2 hours
			if($diff < $hour * 2) return __( 'about 1 hour ago', 'balitawoo' );
			// if less than 1 day
			if($diff < $day) return floor($diff / $hour) . __( ' hours ago', 'balitawoo' );
			// if more then 1 day, but less then 2 days
			if($diff > $day && $diff < $day * 2) return __( 'yesterday', 'balitawoo' );
			// if less than 1 year
			if($diff < $day * 365) return floor($diff / $day) . __( ' days ago', 'balitawoo' );
			// else return over a year ago
			return __( 'over a year ago', 'balitawoo' );
		}
	}

}
?>