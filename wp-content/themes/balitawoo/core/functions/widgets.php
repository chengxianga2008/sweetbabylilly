<?php
/**
 * Sets up the core framework's custom widgets if the theme supports this feature.
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register custom Tokokoo widgets. */
add_action( 'widgets_init', 'tokokoo_register_widgets' );

/**
 * Registers the core frameworks custom widgets.
 * 
 * @since 1.0
 */
function tokokoo_register_widgets() {

	/* Load the Ads widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-ads.php' );
	register_widget( 'tokokoo_ads' );

	/* Load the Contact widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-contact.php' );
	register_widget( 'tokokoo_contact' );

	/* Load the Facebook fans widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-fbfans.php' );
	register_widget( 'tokokoo_facebook_fans' );

	/* Load the Flickr widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-flickr.php' );
	register_widget( 'tokokoo_flickr' );

	/* Load the Opening Hours widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-opening-hours.php' );
	register_widget( 'tokokoo_opening_hours' );

	/* Load the Google Maps widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-google-maps.php' );
	register_widget( 'tokokoo_google_maps' );

	/* Load the Post Types widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-post-type.php' );
	register_widget( 'tokokoo_post_type' );

	/* Load the Random Post Types widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-post-type-random.php' );
	register_widget( 'tokokoo_random_post_type' );

	/* Load the Social widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-social.php' );
	register_widget( 'tokokoo_social' );

	/* Load the Subscriber form widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-subscribe.php' );
	register_widget( 'tokokoo_subscribe' );

	/* Load the Testimonial widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-testimonials.php' );
	register_widget( 'tokokoo_testimonials' );

	/* Load the Video widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-video.php' );
	register_widget( 'tokokoo_video_widget' );

	/* Load the Twitter widget. */
	require_once( trailingslashit ( TOKOKOO_WIDGETS ) . 'widget-twitter.php' );
	register_widget( 'tokokoo_twitter' );

}
?>