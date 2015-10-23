<?php
/**
 * Register the 'role' and 'portfolio_cat' for 'portfolio' post type
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register the 'role' taxonomy. */
add_action( 'init', 'tokokoo_register_portfolio_cat_taxonomy', 15 );

/* Register the 'role' taxonomy. */
add_action( 'init', 'tokokoo_register_role_taxonomy', 15 );

/**
 * Register the 'portfolio_cat' taxonomy.
 * 
 * @since 1.0
 */
function tokokoo_register_portfolio_cat_taxonomy() {

 	$cat_labels = array(
	 	'name'					=> _x( 'Project Category', 'taxonomy general name', 'tokokoo' ),
		'singular_name'			=> _x( 'Project Category', 'taxonomy singular name', 'tokokoo' ),
		'search_items'			=> __( 'Search Project Category', 'tokokoo' ),
		'all_items'				=> __( 'All Project Category', 'tokokoo' ),
		'parent_item'			=> __( 'Parent Project Category', 'tokokoo' ),
		'parent_item_colon'		=> __( 'Parent Project Category:', 'tokokoo' ),
		'edit_item'				=> __( 'Edit Project Category', 'tokokoo' ), 
		'update_item'			=> __( 'Update Category', 'tokokoo' ),
		'add_new_item'			=> __( 'Add New Project Category', 'tokokoo' ),
		'new_item_name'			=> __( 'New Project Category', 'tokokoo' ),
		'menu_name'				=> __( 'Category', 'tokokoo' ),
	);

	$cat_args = array(
		'labels'				=> apply_filters( 'tokokoo_portfolio_cat_labels', $cat_labels ),
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'hierarchical'			=> true,
		'query_var'				=> true,
		'rewrite'				=> apply_filters( 'tokokoo_portfolio_cat_slug', array( 'slug' => 'project-category' ) ),
	);

	register_taxonomy( 'portfolio_cat', array( 'portfolio' ), apply_filters( 'tokokoo_portfolio_cat_taxonomy_arguments', $cat_args ));

}

/**
 * Register the 'role' taxonomy.
 * 
 * @since 1.0
 */
function tokokoo_register_role_taxonomy() {

	$role_labels = array(
		'name'							=> _x( 'Roles', 'taxonomy general name', 'tokokoo' ),
		'singular_name'					=> _x( 'Role', 'taxonomy singular name', 'tokokoo' ),
		'search_items'					=> __( 'Search Roles', 'tokokoo' ),
		'all_items'						=> __( 'All Roles', 'tokokoo' ),
		'parent_item'					=> __( 'Parent Role', 'tokokoo' ),
		'parent_item_colon'				=> __( 'Parent Role:', 'tokokoo' ),
		'edit_item'						=> __( 'Edit Role', 'tokokoo' ), 
		'update_item'					=> __( 'Update Role', 'tokokoo' ),
		'add_new_item'					=> __( 'Add New Role', 'tokokoo' ),
		'new_item_name'					=> __( 'New Role', 'tokokoo' ),
		'menu_name'						=> __( 'Roles', 'tokokoo' ),
		'separate_items_with_commas'	=> __( 'Separate roles with commas', 'tokokoo' ),
		'choose_from_most_used'			=> __( 'Choose from the most used roles', 'tokokoo' ),
	);

	$role_args = array(
		'labels'				=> apply_filters( 'tokokoo_role_labels', $role_labels ),
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'hierarchical'			=> false,
		'query_var'				=> true,
		'rewrite'				=> apply_filters( 'tokokoo_role_slug', array( 'slug' => 'role' ) ),
	);

	register_taxonomy( 'role', array( 'portfolio' ), apply_filters( 'tokokoo_role_taxonomy_arguments', $role_args ));

}
?>