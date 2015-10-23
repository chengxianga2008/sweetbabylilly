<?php
/**
 * Functions for handling basic enqueue for the Theme.
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Basic enqueue scripts. */
add_action( 'wp_enqueue_scripts', 'tokokoo_enqueue_scripts', 1 );

/* Loads HTML5 Shiv. */
add_action( 'wp_head', 'tokokoo_html5_script', 10 );

/* Loads the Flexslider script. */
add_action( 'wp_head', 'tokokoo_flexslider_script', 11 );

/* Loads the Camera script. */
add_action( 'wp_head', 'tokokoo_camera_script', 11 );

/**
 * Load the basic scripts.
 *
 * @since 1.0
 */
function tokokoo_enqueue_scripts() {

	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Enqueue styles. */
	wp_enqueue_style( 'tokokoo-custom-widgets', trailingslashit ( TOKOKOO_ASSETS ) . 'css/widgets.css', false, $theme->Version );
	
	/* Enqueue scripts. */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tokokoo-custom-widgets-js', trailingslashit ( TOKOKOO_ASSETS ) . 'js/widgets.js', array( 'jquery' ), $theme->Version, true );
	
	/* Registered scripts. */
	wp_register_script( 'tokokoo-plugins', trailingslashit ( THEME_URI ) . 'js/plugins.js', array( 'jquery' ), $theme->Version, true );
	wp_register_script( 'tokokoo-methods', trailingslashit ( THEME_URI ) . 'js/methods.js', array( 'jquery' ), $theme->Version, true );
	wp_register_script( 'fitvids-js', trailingslashit ( TOKOKOO_ASSETS ) . 'js/fitvids.js', array( 'jquery' ), $theme->Version, true );
	wp_register_script( 'easing-js', trailingslashit ( TOKOKOO_ASSETS ) . 'js/easing.js', array( 'jquery' ), $theme->Version, true );

	/* Flexslider scripts. */
	if ( current_theme_supports( 'tokokoo-theme-settings' ) && ( of_get_option( 'tokokoo_slides_type' ) == 'flexslider' ) ) {
		wp_enqueue_style( 'flexslider-css', trailingslashit ( TOKOKOO_ASSETS ) . 'css/flexslider.css', false, $theme->Version );
		wp_enqueue_script( 'flexslider-js', trailingslashit ( TOKOKOO_ASSETS ) . 'js/flexslider.js', array( 'jquery' ), $theme->Version, true );
		wp_enqueue_script( 'fitvids-js' );
		wp_enqueue_script( 'easing-js' );
	}

	/* Camera scripts. */
	if ( current_theme_supports( 'tokokoo-theme-settings' ) && ( of_get_option( 'tokokoo_slides_type' ) == 'camera' ) ) {
		wp_enqueue_style( 'camera-css', trailingslashit ( TOKOKOO_ASSETS ) . 'css/camera.css', false, $theme->Version );
		wp_enqueue_script( 'camera-js', trailingslashit ( TOKOKOO_ASSETS ) . 'js/camera.js', array( 'jquery' ), $theme->Version, true );
		wp_enqueue_script( 'camera-mobile-js', trailingslashit ( TOKOKOO_ASSETS ) . 'js/jquery.mobile.customized.min.js', array( 'jquery' ), $theme->Version, true );
		wp_enqueue_script( 'easing-js' );
	}
	
}

/**
 * Loads HTML5 script.
 * 
 * @since 1.0
 */
function tokokoo_html5_script() {
?>
	<!--[if lt IE 9]>
	<script src="<?php echo trailingslashit ( THEME_URI ) . 'js/html5.js'; ?>"></script>
	<![endif]-->
<?php
}

/**
 * Flexslider script, retrieve data from theme Settings.
 * 
 * @since 1.0
 */
function tokokoo_flexslider_script() {

if ( current_theme_supports( 'tokokoo-theme-settings' ) && post_type_exists( 'slides' ) && ( of_get_option( 'tokokoo_slides_type' ) == 'flexslider' ) ) {

	$automatic 	= of_get_option( 'tokokoo_slide_flex_auto_play', 1 );
	$effect 	= of_get_option( 'tokokoo_slide_flex_effect', 'fade' );
	$animate 	= of_get_option( 'tokokoo_slide_flex_easing', 'swing' );
	$animation 	= (int) of_get_option( 'tokokoo_slide_flex_animation_speed', 600 );
	$slideshow 	= (int) of_get_option( 'tokokoo_slide_flex_speed', 7000 );
	$action 	= of_get_option( 'tokokoo_slide_flex_pause_action', 1 );
	$hover 		= of_get_option( 'tokokoo_slide_flex_pause_hover', 0 );
	$video 		= of_get_option( 'tokokoo_slide_flex_video', 0 );
	$control 	= of_get_option( 'tokokoo_slide_flex_control_nav', 1 );
	$direction_nav 	= of_get_option( 'tokokoo_slide_flex_direction_nav', 1 );
	$direction 	= of_get_option( 'tokokoo_slide_flex_direction', 'horizontal' );
?>
<script type="text/javascript">

var $ = jQuery.noConflict();

$(window).load(function() {
	$(".flexslider").fitVids().flexslider({
		slideshow: <?php if ( 1 == $automatic ) { echo 'true'; } else { echo 'false'; } ?>,
		animation: '<?php echo $effect; ?>',
		easing: '<?php echo $animate; ?>',
		animationSpeed: '<?php echo $animation; ?>',
		slideshowSpeed: '<?php echo $slideshow; ?>',
		pauseOnAction: <?php if ( 1 == $action ) { echo 'true'; } else { echo 'false'; } ?>,
		pauseOnHover: <?php if ( 1 == $hover ) { echo 'true'; } else { echo 'false'; } ?>,
		video: <?php if ( 1 == $video ) { echo 'true'; } else { echo 'false'; } ?>,
		useCSS: <?php if ( 1 == $video || $animate != 'swing' ) { echo 'false'; } else { echo 'true'; } ?>,
		controlNav: <?php if ( 1 == $control ) { echo 'true'; } else { echo 'false'; } ?>,
		directionNav: <?php if ( 1 == $direction_nav ) { echo 'true'; } else { echo 'false'; } ?>,
		<?php if( 'slide' == $effect ) { echo "direction: '" . $direction . "'" . "\n"; } ?>
	});
});

</script>

<?php }
}

/**
 * Camera script, retrieve data from theme Settings.
 * 
 * @since 1.0
 */
function tokokoo_camera_script() {

if ( current_theme_supports( 'tokokoo-theme-settings' ) && post_type_exists( 'slides' ) && ( of_get_option( 'tokokoo_slides_type' ) == 'camera' ) ) {

	$automatic 		= of_get_option( 'tokokoo_slide_camera_auto_play', 1 );
	$thumbnail 		= of_get_option( 'tokokoo_slide_camera_thumbnail', 1 );
	$fx 			= of_get_option( 'tokokoo_slide_camera_effect', 'random' );
	$animate 		= of_get_option( 'tokokoo_slide_camera_animation_speed', 1500 );
	$slide 			= of_get_option( 'tokokoo_slide_camera_speed', 7000 );
	$hover 			= of_get_option( 'tokokoo_slide_camera_pause_hover', 1 );
	$click 			= of_get_option( 'tokokoo_slide_camera_pause_click', 1 );
	$pagination 	= of_get_option( 'tokokoo_slide_camera_pagination', 1 );
	$navigation 	= of_get_option( 'tokokoo_slide_camera_navigation', 1 );
	$playpause 		= of_get_option( 'tokokoo_slide_camera_play_pause', 1 );
	$height 		= of_get_option( 'tokokoo_slide_camera_height', '50%' );
	$loader 		= of_get_option( 'tokokoo_slide_camera_loader', 'pie' );
	$loader_color 	= of_get_option( 'tokokoo_slide_camera_loader_color', '#eeeeee' );
	$loader_bgcolor = of_get_option( 'tokokoo_slide_camera_loader_bg_color', '#222222' );
	$pie_position 	= of_get_option( 'tokokoo_slide_camera_loader_pie_position', 'rightTop' );
	$bar_position 	= of_get_option( 'tokokoo_slide_camera_loader_bar_position', 'bottom' );
?>
<script type="text/javascript">

var $ = jQuery.noConflict();

$(window).load(function() {
	$("#camera_slider").camera({
		autoAdvance: <?php if ( 1 == $automatic ) { echo 'true'; } else { echo 'false'; } ?>,
		thumbnails: <?php if ( 1 == $thumbnail ) { echo 'true'; } else { echo 'false'; } ?>,
		fx: '<?php echo $fx; ?>',
		transPeriod: <?php echo $animate; ?>,
		time: <?php echo $slide; ?>,
		hover: <?php if ( 1 == $hover ) { echo 'true'; } else { echo 'false'; } ?>,
		imagePath: '<?php echo trailingslashit ( TOKOKOO_ASSETS ) . 'img/'; ?>',
		pauseOnClick: <?php if ( 1 == $click ) { echo 'true'; } else { echo 'false'; } ?>,
		pagination: <?php if ( 1 == $pagination ) { echo 'true'; } else { echo 'false'; } ?>,
		navigation: <?php if ( 1 == $navigation ) { echo 'true'; } else { echo 'false'; } ?>,
		playPause: <?php if ( 1 == $playpause ) { echo 'true'; } else { echo 'false'; } ?>,
		height: '<?php echo $height; ?>',
		loader: '<?php echo $loader; ?>',
		loaderColor: '<?php echo $loader_color; ?>',
		loaderBgColor: '<?php echo $loader_bgcolor; ?>',
		<?php if( 'pie' == $loader ) { echo "piePosition: '" . $pie_position . "'" . "\n"; } ?>
		<?php if( 'bar' == $loader ) { echo "barPosition: '" . $bar_position . "'" . "\n"; } ?>
	});
});

</script>

<?php }
}
?>