<?php
/**
 * Theme developers may use the default custom post types provided by the framework within their own themes, 
 * decide not to use them, or register additional custom post type.
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register post types. */
add_action( 'init', 'tokokoo_register_post_types', 5 );

/**
 * Registers the framework's default custom post type.
 *
 * @since 1.0
 */
function tokokoo_register_post_types() {

	/* Get theme-supported post types. */
	$type = get_theme_support( 'tokokoo-post-types' );

	/* If there is no array of post type IDs, return. */
	if ( !is_array( $type[0] ) )
		return;

	/* Load the slides post type file if supported. */
	if ( in_array( 'slides', $type[0] ) )
		require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'slides-type/slides.php' );

	/* Load the portfolio post type file if supported. */
	if ( in_array( 'portfolio', $type[0] ) )
		require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'portfolio-type/portfolio.php' );

	/* Load the portfolio post type file if supported. */
	if ( in_array( 'video', $type[0] ) )
		require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'video-type/video.php' );

}
?>