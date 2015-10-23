<?php
/**
 * Plugin Name: Tokokoo Extensions
 * Plugin URI: http://tokokoo.com
 * Description: Extensions features for all Tokokoo themes.
 * Version: 1.0
 * Author: Tokokoo Team
 * Author URI: http://tokokoo.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @version   1.0
 * @since     1.0
 * @author    Tokokoo Team
 * @copyright Copyright (c) 2013, Tokokoo
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Tokokoo_Extensions' ) ) :

class Tokokoo_Extensions {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the metabox library. */
		add_action( 'plugins_loaded', array( &$this, 'metabox' ), 3 );

		/* Load the set of files for theme supported features. */
		add_action( 'init', array( &$this, 'includes' ), 1 );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 1.0
	 */
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'TOKOKOO_EXTENSIONS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set the constant path to the plugin directory URI. */
		define( 'TOKOKOO_EXTENSIONS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Sets the path to the includes directory. */
		define( 'TOKOKOO_EXTENSIONS_INCLUDES', trailingslashit( TOKOKOO_EXTENSIONS_DIR ) . 'includes' );

		/* Sets the path to the assets directory. */
		define( 'TOKOKOO_EXTENSIONS_ASSETS', trailingslashit( TOKOKOO_EXTENSIONS_URI ) . 'assets' );

		/* Sets the path to the shortcodes directory. */
		define( 'TOKOKOO_EXTENSIONS_SHORTCODES_DIR', trailingslashit( TOKOKOO_EXTENSIONS_DIR ) . 'shortcodes' );

		/* Sets the path to the shortcodes URI directory. */
		define( 'TOKOKOO_EXTENSIONS_SHORTCODES_URI', trailingslashit( TOKOKOO_EXTENSIONS_URI ) . 'shortcodes' );

		/* Sets the path to the core metabox directory. */
		define( 'TOKOKOO_EXTENSIONS_METABOX', trailingslashit( TOKOKOO_EXTENSIONS_DIR ) . 'metabox' );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since 1.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'tokokoo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		load_plugin_textdomain( 'acf', false, dirname( plugin_basename( __FILE__ ) ) . '/metabox/lang/' );
	}

	/**
	 * Load the metabox framework.
	 *
	 * @since 1.0
	 */
	public function metabox() {

		/* Load the metabox library. */
		define( 'ACF_LITE' , true );
		require_once( trailingslashit( TOKOKOO_EXTENSIONS_METABOX ) . 'acf.php' );

		/* Load the custom metabox functions. */
		require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'metabox.php' );

	}

	/**
	 * Loads the extensions functions if the theme supports them.
	 *
	 * @since 1.0
	 */
	public function includes() {

		/* Load the custom post types if theme support it. */
		require_if_theme_supports( 'tokokoo-post-types', trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'post-type.php' );

		/* Load the custom css if theme support it. */
		require_if_theme_supports( 'tokokoo-custom-css', trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'custom-css.php' );

		/* Load the custom Facebook App if theme support it. */
		require_if_theme_supports( 'tokokoo-facebook-app', trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'facebook-app.php' );

		/* Load the custom css if supported. */
		require_if_theme_supports( 'tokokoo-customizer', trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'customizer.php' );

		/* Load the shortcodes if theme support it. */
		if( ! class_exists( 'Koo_Shortcodes' ) )
			require_if_theme_supports( 'tokokoo-shortcodes', trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'shortcodes.php' );
	
		/* Load custom resizer script if theme support it. */
		require_if_theme_supports( 'tokokoo-image-resizer', trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'aq_resize.php' );

	}

}

new Tokokoo_Extensions();
endif; // End if class_exists check
?>