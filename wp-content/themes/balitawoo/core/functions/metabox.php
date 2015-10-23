<?php
/**
 * Custom metabox addons
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register the repeater addons. */
add_action( 'acf/register_fields', 'tokokoo_register_repeater_field' );

/* Register the gallery addons. */
add_action( 'acf/register_fields', 'tokokoo_register_gallery_field' );

/**
 * Repeater field for the metabox.
 *
 * @since 1.0
 */
function tokokoo_register_repeater_field() {
	require_once( trailingslashit( TOKOKOO_METABOX ) . 'addons/acf-repeater/repeater.php' );
}

/**
 * Gallery field for the metabox.
 *
 * @since 1.0
 */
function tokokoo_register_gallery_field() {
	require_once( trailingslashit( TOKOKOO_METABOX ) . 'addons/acf-gallery/gallery.php' );
}
?>