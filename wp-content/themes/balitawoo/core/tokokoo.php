<?php
/**
 * Tokokoo Core - A WordPress theme core development framework.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Core constants. */
add_action( 'after_setup_theme', 'tokokoo_constants', 5 );

/* Core setup. */
add_action( 'after_setup_theme', 'tokokoo_core_setup', 6 );

/* Custom functions. */
add_action( 'after_setup_theme', 'tokokoo_theme_functions', 16 );

/* Theme supported features. */
add_action( 'after_setup_theme', 'tokokoo_theme_support', 17 );

/* Load admin files for the framework. */
add_action( 'after_setup_theme', 'tokokoo_admin_functions', 18 );

/**
 * Defines the constant paths for use within the core framework, parent theme, and child theme.
 *
 * @since 1.0
 */
function tokokoo_constants() {

	/* Sets the path to the core directory. */
	define( 'TOKOKOO_DIR', trailingslashit( THEME_DIR ) . basename( dirname( __FILE__ ) ) );

	/* Sets the path to the core directory URI. */
	define( 'TOKOKOO_URI', trailingslashit( THEME_URI ) . basename( dirname( __FILE__ ) ) );

	/* Sets the path to the core admin directory. */
	define( 'TOKOKOO_ADMIN', trailingslashit( TOKOKOO_DIR ) . 'admin' );

	/* Sets the path to the core functions directory. */
	define( 'TOKOKOO_FUNCTIONS', trailingslashit( TOKOKOO_DIR ) . 'functions' );

	/* Sets the path to the core class directory. */
	define( 'TOKOKOO_CLASS', trailingslashit( TOKOKOO_DIR ) . 'class' );

	/* Sets the path to the core metabox directory. */
	define( 'TOKOKOO_METABOX', trailingslashit( TOKOKOO_DIR ) . 'metabox' );

	/* Sets the path to the core widgets directory. */
	define( 'TOKOKOO_WIDGETS', trailingslashit( TOKOKOO_DIR ) . 'widgets' );

	/* Sets the path to the core assets directory. */
	define( 'TOKOKOO_ASSETS', trailingslashit( TOKOKOO_URI ) . 'assets' );

	/* Constant for the theme settings. */
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', trailingslashit( TOKOKOO_URI ) . 'admin/' );

}

/**
 * Core setup.
 *
 * @since 1.0
 */
function tokokoo_core_setup() {

	/* Get action/filter hook prefix from hybrid. */
	$prefix = hybrid_get_prefix();

	/* hybrid core framework features. */
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-styles', array( 'gallery', 'parent', 'style' ) );
	add_theme_support( 'hybrid-core-scripts', array( 'comment-reply' ) );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer' ) );

	/* hybrid core framework extensions. */
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'cleaner-caption' );
	add_theme_support( 'post-stylesheets' );

	/* Tokokoo core features. */
	add_theme_support( 'tokokoo-widgets' );
	add_theme_support( 'tokokoo-extra-sidebar' );
	add_theme_support( 'tokokoo-theme-settings' );

	/* WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) );

	/* Basic image sizes. */
	add_image_size( 'small', 45, 45, true );

	/* Disqus plugin issue. */
	if( function_exists( 'dsq_comments_template' ) ) :
		remove_filter( 'comments_template', 'dsq_comments_template' );
		add_filter( 'comments_template', 'dsq_comments_template', 11 );
	endif;	

}

/**
 * Custom functions.
 *
 * @since 1.0
 */
function tokokoo_theme_functions() {

	/* Get action/filter hook prefix from hybrid. */
	$prefix = hybrid_get_prefix();

	/* Load the core custom functions. */
	require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'custom.php' );

	/* Load the basic enqueue scripts. */
	require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'scripts.php' );

	/* Load the custom theme functions. */
	require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'functions.php' );

	/* Load the metabox addons. */
	// require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'metabox.php' );

}

/**
 * Functions are only loaded if the theme supports them.
 *
 * @since 1.0
 */
function tokokoo_theme_support() {

	/* Load the custom widgets if supported. */
	require_if_theme_supports( 'tokokoo-widgets', trailingslashit( TOKOKOO_FUNCTIONS ) . 'widgets.php' );

	/* Load the custom sidebar for the woocommerce plugin if supported. */
	require_if_theme_supports( 'tokokoo-extra-sidebar', trailingslashit( TOKOKOO_FUNCTIONS ) . 'sidebar.php' );

}

/**
 * Load admin files for the framework.
 *
 * @since 1.0
 */
function tokokoo_admin_functions() {

	/* Load the theme settings framework if supported. */
	require_if_theme_supports( 'tokokoo-theme-settings', trailingslashit( TOKOKOO_ADMIN ) . 'options-framework.php' );

	/* Load the options backup setting. */
	if( current_theme_supports( 'tokokoo-theme-settings' ) )
		require_once( trailingslashit( TOKOKOO_ADMIN ) . 'options-backup.php' );

	/* Load the options setting. */
	if( current_theme_supports( 'tokokoo-theme-settings' ) )
		require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'settings.php' );

	/* Load the theme settings functions. */
	if( current_theme_supports( 'tokokoo-theme-settings' ) )
		require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'setting-functions.php' );

	/* Load the theme settings functions. */
	if( current_theme_supports( 'tokokoo-theme-settings' ) )
		require_once( trailingslashit( TOKOKOO_FUNCTIONS ) . 'setting-output.php' );

}
?>