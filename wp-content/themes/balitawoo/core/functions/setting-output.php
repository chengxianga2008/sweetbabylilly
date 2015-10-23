<?php
/**
 * Default options setting output
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Theme settings functions. */
add_action( 'init', 'tokokoo_theme_settings_output', 20 );

/**
 * Theme settings functions.
 *
 * @since 1.0
 */
function tokokoo_theme_settings_output() {

	if( ! is_admin() ) {

		/* Custom head code. */
		add_action( 'wp_head', 'tokokoo_header_code', 15 );

		/* Custom footer code. */
		add_action( 'wp_footer', 'tokokoo_footer_code', 20 );

	}

}

/**
 * Custom code in HEAD section.
 *
 * @since 1.0
 */
function tokokoo_header_code() {
	$hcode = of_get_option( 'tokokoo_header_code' );
	if ( $hcode ) 
		echo "\n" . wp_kses_data( $hcode ) . "\n";
}

/**
 * Custom code before closing BODY.
 *
 * @since 1.0
 */
function tokokoo_footer_code() {
	$fcode = of_get_option( 'tokokoo_footer_code' );
	if ( $fcode ) 
		echo "\n" . wp_kses_data( $fcode ) . "\n";
}
?>