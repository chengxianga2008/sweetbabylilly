<?php
/**
 * Filter and action to help theme developer.
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Flush rewrite rules. */
add_action( 'after_switch_theme', 'tokokoo_flush_rewrite_rules' );

/* Custom character for excerpt. */
add_filter( 'excerpt_more', 'tokokoo_auto_excerpt_more' );

/* Add classes to the comments pagination. */
add_filter( 'previous_comments_link_attributes', 'tokokoo_previous_comments_link_attributes' );
add_filter( 'next_comments_link_attributes', 'tokokoo_next_comments_link_attributes' );

/* Remove theme-layouts meta box from some custom post type. */
add_action( 'init', 'tokokoo_remove_theme_layout_metabox', 11 );

/* Removes default styles set by WordPress recent comments widget. */
add_action( 'widgets_init', 'tokokoo_remove_recent_comments_style' );

/* Hybrid Core 1.6 changes. */
add_filter( "{$prefix}_sidebar_defaults", 'tokokoo_sidebar_defaults' );

/* Add Full-Width layout. */
add_filter( 'theme_layouts_strings', 'tokokoo_register_theme_layout' );

/* Remove the "Theme Settings" submenu. */
add_action( 'admin_menu', 'tokokoo_remove_theme_settings_submenu', 11 );
	    
/* Default footer settings */
add_filter( "{$prefix}_default_theme_settings", 'tokokoo_default_footer_settings' );

/**
 * Redirect user to the Dashboard page.
 * 
 * @since 1.0
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

	wp_redirect( admin_url( 'themes.php?page=tokokoo-dashboard' ) );
	exit;
	
}

/**
 * Flush rewrite rules.
 * 
 * @since 1.0
 */
function tokokoo_flush_rewrite_rules() {
	flush_rewrite_rules();
}

/**
 * Replaces "[...]" with just ...
 *
 * @since 1.0
 */
function tokokoo_auto_excerpt_more( $more ) {
	return ' &hellip;';
}

/**
 * Adds 'class="prev" to the previous comments link.
 *
 * @since 1.0
 */
function tokokoo_previous_comments_link_attributes( $attributes ) {
	return $attributes . ' class="prev"';
}

/**
 * Adds 'class="next" to the next comments link.
 *
 * @since 1.0
 */
function tokokoo_next_comments_link_attributes( $attributes ) {
	return $attributes . ' class="next"';
}

/**
 * Remove theme-layouts meta box
 * 
 * @since 1.0
 */
function tokokoo_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );
	remove_post_type_support( 'slides', 'theme-layouts' );
	remove_post_type_support( 'catalog', 'theme-layouts' );
	remove_post_type_support( 'portfolio', 'hybrid-core-template-hierarchy' );
}

/**
 * Removes default styles set by WordPress recent comments widget.
 *
 * @since 1.0
 */
function tokokoo_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

/**
 * Sidebar parameter defaults.
 *
 * @since 1.0
 */
function tokokoo_sidebar_defaults( $defaults ) {

	$defaults = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);

	return $defaults;
}

/**
 * Add Full-Width layout.
 *
 * @since 1.0
 */
function tokokoo_register_theme_layout( $strings ) {
	$strings['1c-full'] = __( 'Full Width', 'balitawoo' );
	return $strings;
}

/**
 * Remove the "Theme Settings" submenu.
 *
 * @since 1.0
 */
function tokokoo_remove_theme_settings_submenu() {
	remove_submenu_page( 'themes.php', 'theme-settings' );
}

/**
 * Default footer settings text.
 *
 * @since  1.0
 */
function tokokoo_default_footer_settings( $settings ) {
    $settings['footer_insert'] = 'Copyright &#169; [the-year] [site-link]';
    return $settings;
}
?>