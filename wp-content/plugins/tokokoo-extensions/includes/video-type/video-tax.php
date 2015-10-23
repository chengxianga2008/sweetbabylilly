<?php
/**
 * Register the 'video_category' for 'video' post type
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register the 'video_category' taxonomy. */
add_action( 'init', 'tokokoo_register_video_cat_taxonomy', 15 );

/**
 * Register the 'video_cat' taxonomy.
 * 
 * @since 1.0
 */
function tokokoo_register_video_cat_taxonomy() {

 	$cat_labels = array(
	 	'name'					=> _x( 'Video Category', 'taxonomy general name', 'tokokoo' ),
		'singular_name'			=> _x( 'Video Category', 'taxonomy singular name', 'tokokoo' ),
		'search_items'			=> __( 'Search Video Category', 'tokokoo' ),
		'all_items'				=> __( 'All Video Category', 'tokokoo' ),
		'parent_item'			=> __( 'Parent Video Category', 'tokokoo' ),
		'parent_item_colon'		=> __( 'Parent Video Category:', 'tokokoo' ),
		'edit_item'				=> __( 'Edit Video Category', 'tokokoo' ), 
		'update_item'			=> __( 'Update Video Category', 'tokokoo' ),
		'add_new_item'			=> __( 'Add New Category', 'tokokoo' ),
		'new_item_name'			=> __( 'New Video Category', 'tokokoo' ),
		'menu_name'				=> __( 'Category', 'tokokoo' ),
	);

	$cat_args = array(
		'labels'				=> apply_filters( 'tokokoo_video_cat_labels', $cat_labels ),
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'hierarchical'			=> true,
		'query_var'				=> true,
		'rewrite'				=> apply_filters( 'tokokoo_video_cat_slug', array( 'slug' => 'video-categories' ) ),
	);

	register_taxonomy( 'video_category', array( 'video' ), apply_filters( 'tokokoo_video_category_taxonomy_arguments', $cat_args ));

}
?>