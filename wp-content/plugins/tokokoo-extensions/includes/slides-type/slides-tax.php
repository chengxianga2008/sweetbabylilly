<?php
/**
 * Register the 'slide-group' for 'slides' post type
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register the 'slide group' taxonomy. */
add_action( 'init', 'tokokoo_register_slide_group_taxonomy', 15 );

/* Add custom columns to the 'slide-group' taxonomy screen. */
add_filter( 'manage_edit-slide-group_columns', 'tokokoo_slide_group_custom_columns' ) ;
add_action( 'manage_slide-group_custom_column', 'tokokoo_slide_group_custom_columns_content', 10, 3 );

/**
 * Register the taxonomy.
 * 
 * @since 1.0
 */
function tokokoo_register_slide_group_taxonomy() {

	$taxonomy_labels = array(
	    'name'					=> _x( 'Slide Groups', 'taxonomy general name', 'tokokoo' ),
	    'singular_name'			=> _x( 'Slide Group', 'taxonomy singular name', 'tokokoo' ),
	    'search_items'			=> __( 'Search Group', 'tokokoo' ),
	    'all_items'				=> __( 'All Slide Groups', 'tokokoo' ),
	    'parent_item'			=> __( 'Parent Group', 'tokokoo' ),
	    'parent_item_colon'		=> __( 'Parent Group:', 'tokokoo' ),
	    'edit_item'				=> __( 'Edit Group', 'tokokoo' ), 
	    'update_item'			=> __( 'Update Group', 'tokokoo' ),
	    'add_new_item'			=> __( 'Add New Group', 'tokokoo' ),
	    'new_item_name'			=> __( 'New Group', 'tokokoo' ),
    	'menu_name'				=> __( 'Slide Groups', 'tokokoo' ),
  	);

  	$taxonomy_args = array(
	    'labels'				=> apply_filters( 'tokokoo_slide_groups_labels', $taxonomy_labels ),
	    'show_ui'				=> true,
	    'show_admin_column'		=> true,
	    'hierarchical'			=> true,
	    'query_var'				=> true,
	    'rewrite'				=> false
  	);

  	register_taxonomy( 'slide-group', array( 'slides' ), apply_filters( 'tokokoo_slides_taxonomy_arguments', $taxonomy_args ) );

}

/**
 * Add custom columns to the manage taxonomy screen.
 * 
 * @since 1.0
 */
function tokokoo_slide_group_custom_columns( $columns ) {

	$columns = array(
		'cb'						=> '<input type="checkbox" />',
        'name'						=> __( 'Group', 'tokokoo' ),
        'posts'						=> __( 'Slides', 'tokokoo' ),
        'tokokoo_slide_width_num'	=> __( 'Width', 'tokokoo' ),
        'tokokoo_slide_height_num'	=> __( 'Height', 'tokokoo' ),
        'tokokoo_slide_crop'		=> __( 'Crop', 'tokokoo' ),
        'tokokoo_slide_shortcode'	=> __( 'Shortcode', 'tokokoo' ),
    );

	return $columns;
	
}

/**
 * Display the data to the columns.
 * 
 * @since 1.0
 */
function tokokoo_slide_group_custom_columns_content( $value, $column_name, $term_id ) {

	switch( $column_name ) {

		case 'tokokoo_slide_width_num' :

			$width = get_field( 'tokokoo_slide_width', 'slide-group_' . $term_id );
			if( $width )
				echo (int) $width;
			else
				echo '0';

			break;

		case 'tokokoo_slide_height_num' :

			$height = get_field( 'tokokoo_slide_height', 'slide-group_' . $term_id );
			if( $height )
				echo (int) $height;
			else
				echo '0';

			break;

		case 'tokokoo_slide_crop' :

			$crop = get_field( 'tokokoo_slide_crop', 'slide-group_' . $term_id );
			if( $crop )
				echo 'true';
			else
				echo 'false';

			break;

		case 'tokokoo_slide_shortcode' :

			echo '[koo-slides id="' . $term_id . '"]'; 

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;

	}

}
?>