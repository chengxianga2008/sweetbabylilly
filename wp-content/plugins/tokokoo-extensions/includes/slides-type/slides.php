<?php
/**
 * Register the 'Slides' post type
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register the 'slides' post type. */
add_action( 'init', 'tokokoo_register_slides_type' );

/* Loads the functions & taxonomy file. */
add_action( 'init', 'tokokoo_loads_slides_library', 10 );

/* Custom post type icon. */
add_action( 'admin_head', 'tokokoo_slides_icon' );

/* Filter text message. */
add_filter( 'post_updated_messages', 'tokokoo_slides_updated_messages' );

/* Filter the 'enter title here' placeholder. */
add_filter( 'enter_title_here', 'tokokoo_slides_enter_title_here', 10 );;

/* Change the some text using gettext filter. */
add_filter( 'gettext', 'tokokoo_change_slides_post_type_text', 10, 2 );

/* Add custom columns to the manage screen. */
add_filter( 'manage_edit-slides_columns', 'tokokoo_slides_custom_columns' ) ;
add_action( 'manage_slides_posts_custom_column', 'tokokoo_slides_custom_columns_content', 10, 3 );
add_filter( 'manage_edit-slides_sortable_columns', 'tokokoo_slides_column_sortable' );

/* Add Slides menu item to Admin Bar. */
add_action( 'wp_before_admin_bar_render', 'tokokoo_slides_adminbar' );

/**
 * Register the post type.
 * 
 * @since 1.0
 */
function tokokoo_register_slides_type() {

	$labels = array(
		'name'					=> _x( 'Slides', 'post type general name', 'tokokoo' ),
	    'singular_name'			=> _x( 'Slide', 'post type singular name', 'tokokoo' ),
	    'add_new'				=> _x( 'Add New', 'slides', 'tokokoo' ),
		'add_new_item'			=> __( 'Add New Slide', 'tokokoo' ),
		'edit_item'				=> __( 'Edit Slide', 'tokokoo' ),
		'new_item'				=> __( 'New Slide', 'tokokoo' ),
		'all_items'				=> __( 'All Slides', 'tokokoo' ),
		'view_item'				=> __( 'View Slide', 'tokokoo' ),
		'search_items'			=> __( 'Search Slides', 'tokokoo' ),
		'not_found'				=> __( 'No Slides Found', 'tokokoo' ),
    	'menu_name'				=> __( 'Slides', 'tokokoo' ),
		'parent_item_colon'		=> ''
	);

	$args = array(	
		'labels'				=> apply_filters( 'tokokoo_slides_labels', $labels ),
		'public'				=> false,
		'publicly_queryable'	=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'hierarchical'			=> false,
		'rewrite'				=> false,
		'query_var'				=> false,
		'exclude_from_search'	=> true,
		'menu_position'			=> 50,
		'supports'				=> array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	);

	register_post_type( 'slides', apply_filters( 'tokokoo_slides_arguments', $args ) );

}

/**
 * Loads the functions & taxonomy file.
 * 
 * @since 1.0
 */
function tokokoo_loads_slides_library() {

	/* Load the 'slide-group' taxonomy file. */
	require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'slides-type/slides-tax.php' );

	if( current_theme_supports( 'tokokoo-image-resizer' ) )
		/* Load the custom function for the Slides post type. */
		require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'slides-type/slides-functions.php' );

	/* Display shortcode button. */
	require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'slides-type/slides-button.php' );

}

/**
 * Displays the custom post type icon in the dashboard.
 * Retina ready.
 *
 * @since 1.0
 */
function tokokoo_slides_icon() {
	?>

    <style type="text/css" media="screen">

    	/* Admin Menu - 16px */
        #menu-posts-slides .wp-menu-image {
            background: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/slides.png'; ?>') no-repeat 7px 7px !important;
        }
		/* Post Screen - 32px */
        .icon32-posts-slides {
        	background: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/slides32.png'; ?>') no-repeat left 3px !important;
        }

        @media only screen and (-webkit-min-device-pixel-ratio: 1.5),
		       only screen and (   min--moz-device-pixel-ratio: 1.5),
		       only screen and (     -o-min-device-pixel-ratio: 3/2),
		       only screen and (        min-device-pixel-ratio: 1.5),
		       only screen and (        		 min-resolution: 1.5dppx) {
        	
        	/* Admin Menu - 16px @2x */
        	#menu-posts-slides .wp-menu-image {
        		background-image: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/slides_2x.png'; ?>') !important;
        		-webkit-background-size: 16px 48px;
        		-moz-background-size: 16px 48px;
        		background-size: 16px 48px;
        	}
        	/* Post Screen - 32px @2x */
        	.icon32-posts-slides {
        		background-image: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/slides32_2x.png'; ?>') !important;
        		-webkit-background-size: 32px 32px;
        		-moz-background-size: 32px 32px;
        		background-size: 32px 32px;
        	}

        }

    </style>

<?php }

/**
 * Add filter to ensure the text Slide is displayed when user updates a slide.
 * 
 * @since 1.0
 */
function tokokoo_slides_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages['slides'] = array(
		0 => '',
		1 => __( 'Slide updated.', 'tokokoo' ),
		2 => __( 'Custom field updated.', 'tokokoo' ),
		3 => __( 'Custom field deleted.', 'tokokoo' ),
		4 => __( 'Slide updated.', 'tokokoo' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Slide restored to revision from %s', 'tokokoo' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => __( 'Slide published.', 'tokokoo' ),
		7 => __( 'Slide saved.', 'tokokoo' ),
		8 => __( 'Slide submitted.', 'tokokoo' ),
		9 => sprintf( __( 'Slide scheduled for: <strong>%1$s</strong>.', 'tokokoo' ),
		  date_i18n( __( 'M j, Y @ G:i', 'tokokoo' ), strtotime( $post->post_date ) ) ),
		10 => __( 'Slide draft updated.', 'tokokoo' ),
	);

	return $messages;

}

/**
 * Filter the 'enter title here' placeholder.
 *
 * @since 1.0
 */
function tokokoo_slides_enter_title_here( $title ) {
	if ( get_post_type() == 'slides' ) {
		$title = __( 'Enter slide title here', 'tokokoo' );
	}
	
	return $title;
}

/**
 * Change the some text using gettext filter.
 *
 * @since 1.0
 */
function tokokoo_change_slides_post_type_text( $translation, $text ) {

	if ( get_post_type() == 'slides' ) {

		if ( $text == 'Publish' )
		    return __( 'Publish Slide', 'tokokoo' );

		if ( $text == 'Attributes' )
		    return __( 'Slide Order', 'tokokoo' );

		if ( $text == 'Featured Image' )
		    return __( 'Slide Image', 'tokokoo' );

		if ( $text == 'Set featured image' )
		    return __( 'Click here to set the image or video cover', 'tokokoo' );

		if ( $text == 'Remove featured image' )
		    return __( 'Click here to remove the image', 'tokokoo' );

	}

	return $translation;
}

/**
 * Add custom columns to the manage taxonomy screen.
 * 
 * @since 1.0
 */
function tokokoo_slides_custom_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
        'title' => __( 'Title', 'tokokoo' ),
        'slide_type' => __( 'Type', 'tokokoo' ),
        'taxonomy-slide-group' => __( 'Group', 'tokokoo' ),
        'slide_order' => __( 'Order', 'tokokoo' ),
        'date' => __( 'Date', 'tokokoo' ),
    );

	return $columns;
	
}

/**
 * Display the data to the columns.
 * 
 * @since 1.0
 */
function tokokoo_slides_custom_columns_content( $column, $post_id ) {
	global $post;

	if ( class_exists( 'Acf' ) ) {

		switch( $column ) {

			case 'slide_type' :

				$slide_img 	= tokokoo_column_image( $post_id );
				$video		= get_field( 'tokokoo_slide_video' );

				if ( $video ) 
					echo __( 'Video', 'tokokoo' );
				elseif( $slide_img )
					echo __( 'Image', 'tokokoo' );
				else
					echo __( 'Unknown', 'tokokoo' );

				break;

			case 'slide_order':

			    $order = $post->menu_order;
			    echo $order;

			    break;

			/* Just break out of the switch statement for everything else. */
			default :
				break;

		}

	}

}

/**
 * Make column Group and Order sortable.
 * 
 * @since 1.0
 */
function tokokoo_slides_column_sortable( $columns ) {

	$columns['slide_type'] = 'slide_type';
	$columns['taxonomy-slide-group'] = 'taxonomy-slide-group';
	$columns['slide_order'] = 'slide_order';
	return $columns;

}

/**
 * Get the featured image.
 * 
 * @since 1.0
 */
function tokokoo_column_image( $post_id ) {

	$post_thumbnail_id = get_post_thumbnail_id( $post_id );

	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'small' );
		return $post_thumbnail_img[0];
	}

}

/**
 * Add Slides menu item to Admin Bar.
 *
 * @since 1.0
 */
function tokokoo_slides_adminbar() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id' => 'slides_post_type',
		'title' => __( 'Slides', 'tokokoo' ),
		'href' => admin_url( 'edit.php?post_type=slides' )
	));
	
}
?>