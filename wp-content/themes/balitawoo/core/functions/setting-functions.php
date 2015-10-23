<?php
/**
 * Theme settings functions
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Load the custom dashboard. */
add_action( 'admin_init', 'tokokoo_load_dashboard' );

/* Register dashboard to the admin_menu hook. */
add_action( 'admin_menu', 'tokokoo_theme_setting_dashboard' );

/* Filter theme settings location. */
add_filter( 'options_framework_location', 'tokokoo_theme_settings_location' );

/* Load the custom css for theme settings. */
add_action( 'admin_enqueue_scripts', 'tokokoo_theme_settings_scripts' );

/* Textarea sanitization. */
add_action( 'admin_init', 'tokokoo_change_santiziation', 100 );

/* Custom inline scripts. */
add_action( 'optionsframework_custom_scripts', 'tokokoo_custom_inline_script' );

/**
 * Load the Dashboard file.
 * 
 * @since 1.0
 */
function tokokoo_load_dashboard() {
	/* Load the theme settings functions. */
	require_once( trailingslashit( TOKOKOO_ADMIN ) . 'options-dashboard.php' );
}

/**
 * Dashboard.
 * 
 * @since 1.0
 */
function tokokoo_theme_setting_dashboard() {

	add_theme_page( __( 'Tokokoo Dashboard', 'balitawoo' ), __( 'Tokokoo Dashboard', 'balitawoo' ), 'edit_theme_options', 'tokokoo-dashboard', 'tokokoo_dashboard' );
}

/**
 * Filter theme settings location.
 * 
 * @since 1.0
 */
function tokokoo_theme_settings_location() {
	return array( 'core/functions/settings.php' );
}

/**
 * Loads the options-custom.css stylesheet for theme settings related features.
 *
 * @since 1.0
 */
function tokokoo_theme_settings_scripts( $hook_suffix ) {

	$menu = optionsframework_menu_settings(); // load the theme settings menu options
 
	if ( 'appearance_page_' . $menu['menu_slug'] == $hook_suffix ) {
		wp_register_style( 'tokokoo-optionsframework-custom-css', trailingslashit ( TOKOKOO_ASSETS ) . 'css/options-custom.css' );
		wp_enqueue_style( 'tokokoo-optionsframework-custom-css' );
	}

}

/**
 * Theme settings Textarea sanitization.
 *
 * @since 1.0
 */
function tokokoo_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'tokokoo_sanitize_textarea' );
}

function tokokoo_sanitize_textarea( $input ) {

    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
		"src" => array(),
		"type" => array(),
		"allowfullscreen" => array(),
		"allowscriptaccess" => array(),
		"height" => array(),
		"width" => array()
		);
	$custom_allowedtags["script"] = array(
		"src" => array(), 
		"type" => array()
		);
	$custom_allowedtags["meta"] = array(
		"name" => array(), 
		"content" => array()
		);
	$custom_allowedtags = array_merge( $custom_allowedtags, $allowedposttags );
	$output = wp_kses( $input, $custom_allowedtags);
    return $output;

}

/** 
 * Custom script for theme settings.
 *
 * @since 1.0
 */
function tokokoo_custom_inline_script() { ?>

	<script type='text/javascript'>

	var $ = jQuery.noConflict();

	jQuery(document).ready(function($) {

		var flex = $( '#section-tokokoo_slide_flex_auto_play, #section-tokokoo_slide_flex_effect, #section-tokokoo_slide_flex_easing, #section-tokokoo_slide_flex_animation_speed, #section-tokokoo_slide_flex_speed, #section-tokokoo_slide_flex_pause_action, #section-tokokoo_slide_flex_pause_hover, #section-tokokoo_slide_flex_video, #section-tokokoo_slide_flex_control_nav, #section-tokokoo_slide_flex_direction_nav, #section-tokokoo_slide_flex_direction' );

		var camera = $( '#section-tokokoo_slide_camera_auto_play, #section-tokokoo_slide_camera_effect, #section-tokokoo_slide_camera_animation_speed, #section-tokokoo_slide_camera_speed, #section-tokokoo_slide_camera_pause_hover, #section-tokokoo_slide_camera_height, #section-tokokoo_slide_camera_loader, #section-tokokoo_slide_camera_loader_color, #section-tokokoo_slide_camera_loader_bg_color, #section-tokokoo_slide_camera_pause_click, #section-tokokoo_slide_camera_pagination, #section-tokokoo_slide_camera_navigation, #section-tokokoo_slide_camera_play_pause, #section-tokokoo_slide_camera_thumbnail, #section-tokokoo_slide_camera_loader_pie_position, #section-tokokoo_slide_camera_loader_bar_position' );

		$( '#tokokoo_slides_type' ).on( 'change', function() {
	       flex.toggle( $(this).val() == 'flexslider' );
	       camera.toggle( $(this).val() == 'camera' );
		});

		if ( $('#tokokoo_slides_type option:selected').val() === 'flexslider' ) {
			flex.show();
		}

		if ( $('#tokokoo_slides_type option:selected').val() === 'camera' ) {
			camera.show();
		}

	});
	</script>

<?php
}
?>