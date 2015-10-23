<?php
/**
 * Register the 'Video' post type
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register the 'video' post type. */
add_action( 'init', 'tokokoo_video_type' );

/* Loads the functions & taxonomy file. */
add_action( 'init', 'tokokoo_loads_video_library', 10 );

/* Custom post type icon. */
add_action( 'admin_head', 'tokokoo_video_icon' );

/* Filter text message. */
add_filter( 'post_updated_messages', 'tokokoo_video_updated_messages' );

/* Filter the 'enter title here' placeholder. */
add_filter( 'enter_title_here', 'tokokoo_video_enter_title_here', 10 );

/* Add and remove meta box. */
add_action( 'do_meta_boxes', 'tokokoo_video_remove_post_template' );

/* Change the some text using gettext filter. */
add_filter( 'gettext', 'tokokoo_change_video_post_type_text', 10, 2 );

/* Add custom columns to the manage screen. */
add_filter( 'manage_edit-video_columns', 'tokokoo_video_custom_columns' );
add_action( 'manage_video_posts_custom_column', 'tokokoo_video_custom_columns_content', 10, 3 );
add_filter( 'manage_edit-video_sortable_columns', 'tokokoo_video_column_sortable' );

/* Add video menu item to Admin Bar. */
add_action( 'wp_before_admin_bar_render', 'video_adminbar' );

/**
 * Register post type
 * 
 * @since 1.0
 */
function tokokoo_video_type() {

	$labels = array(
		'name'					=> _x( 'Video', 'post type general name', 'tokokoo' ),
	    'singular_name'			=> _x( 'Video', 'post type singular name', 'tokokoo' ),
	    'add_new'				=> _x( 'Add New Video', 'video', 'tokokoo' ),
		'add_new_item'			=> __( 'Add New Video', 'tokokoo' ),
		'edit_item'				=> __( 'Edit Video', 'tokokoo' ),
		'new_item'				=> __( 'New Video', 'tokokoo' ),
		'all_items'				=> __( 'All Videos', 'tokokoo' ),
		'view_item'				=> __( 'View Video', 'tokokoo' ),
		'search_items'			=> __( 'Search Videos', 'tokokoo' ),
		'not_found'				=> __( 'No Videos Found', 'tokokoo' ),
    	'menu_name'				=> __( 'Videos', 'tokokoo' ),
		'parent_item_colon'		=> '',
	);

	$args = array(	
		'labels'				=> apply_filters( 'tokokoo_video_labels', $labels ),
		'public'				=> true,
		'exclude_from_search'	=> false,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'capability_type'		=> 'post',
		'rewrite'				=> apply_filters( 'tokokoo_video_slug', array( 'slug' => 'videos', 'with_front' => false ) ),
		'query_var'				=> true,
		'menu_position'			=> 52,
		'supports'				=> array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	);

	register_post_type( 'video', apply_filters( 'tokokoo_video_arguments', $args ) );

}

/**
 * Loads the functions & taxonomy file.
 * 
 * @since 1.0
 */
function tokokoo_loads_video_library() {

	/* Load the video taxonomy file. */
	require_once( trailingslashit( TOKOKOO_EXTENSIONS_INCLUDES ) . 'video-type/video-tax.php' );

}

/**
 * Displays the custom post type icon in the dashboard
 *
 * @since 1.0
 */
function tokokoo_video_icon() { 
	?>
    
	<style type="text/css" media="screen">

    	/* Admin Menu - 16px */
        #menu-posts-video .wp-menu-image {
            background: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/video.png'; ?>') no-repeat 7px 7px !important;
        }
		/* Post Screen - 32px */
        .icon32-posts-video {
        	background: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/video32.png'; ?>') no-repeat left 3px !important;
        }

        @media
        only screen and (-webkit-min-device-pixel-ratio: 1.5),
        only screen and (   min--moz-device-pixel-ratio: 1.5),
        only screen and (     -o-min-device-pixel-ratio: 3/2),
        only screen and (        min-device-pixel-ratio: 1.5),
        only screen and (        		 min-resolution: 1.5dppx) {
        	
        	/* Admin Menu - 16px @2x */
        	#menu-posts-video .wp-menu-image {
        		background-image: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/video_2x.png'; ?>') !important;
        		-webkit-background-size: 16px 48px;
        		-moz-background-size: 16px 48px;
        		background-size: 16px 48px;
        	}
        	/* Post Screen - 32px @2x */
        	.icon32-posts-video {
        		background-image: url('<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/video32_2x.png'; ?>') !important;
        		-webkit-background-size: 32px 32px;
        		-moz-background-size: 32px 32px;
        		background-size: 32px 32px;
        	}

        }

    </style>

<?php }

/**
 * Add filter to ensure the text video is displayed when user updates a video.
 * 
 * @since 1.0
 */
function tokokoo_video_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages['video'] = array(
		0 => '',
		1 => sprintf( __( 'Video updated. <a href="%s">View Video</a>', 'tokokoo' ), esc_url( get_permalink($post_ID) ) ),
		2 => __( 'Custom field updated.', 'tokokoo' ),
		3 => __( 'Custom field deleted.', 'tokokoo' ),
		4 => __( 'Video updated.', 'tokokoo' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Video restored to revision from %s', 'tokokoo' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Video published. <a href="%s">View Video</a>', 'tokokoo' ), esc_url( get_permalink($post_ID) ) ),
		7 => __( 'Video saved.', 'tokokoo' ),
		8 => sprintf( __( 'Video submitted. <a target="_blank" href="%s">Preview Video</a>', 'tokokoo' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __( 'Video scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Video</a>', 'tokokoo' ),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i', 'tokokoo' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __( 'Video draft updated. <a target="_blank" href="%s">Preview Video</a>', 'tokokoo' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

/**
 * Filter the 'enter title here' placeholder.
 *
 * @since 1.0
 */
function tokokoo_video_enter_title_here( $title ) {
	if ( get_post_type() == 'video' ) {
		$title = __( 'Enter video title here', 'tokokoo' );
	}
	
	return $title;
}

/**
 * Remove post template meta box.
 *
 * @since 1.0
 */
function tokokoo_video_remove_post_template() {
	if ( current_theme_supports( 'hybrid-core-template-hierarchy' ) )
		remove_meta_box( 'hybrid-core-post-template', 'video', 'side' );
}

/**
 * Change the some text using gettext filter.
 *
 * @since 1.0
 */
function tokokoo_change_video_post_type_text( $translation, $text ) {

	if ( get_post_type() == 'video' ) {

		if ( $text == 'Publish' )
		    return __( 'Publish Video', 'tokokoo' );

		if ( $text == 'Attributes' )
		    return __( 'Video Order', 'tokokoo' );

		if ( $text == 'Featured Image' )
		    return __( 'Video Cover', 'tokokoo' );

		if ( $text == 'Set featured image' )
		    return __( 'Click here to set the video cover', 'tokokoo' );

		if ( $text == 'Remove featured image' )
		    return __( 'Click here to remove the video cover', 'tokokoo' );

	}

	return $translation;
}

/**
 * Add custom columns to the manage taxonomy screen.
 * 
 * @since 1.0
 */
function tokokoo_video_custom_columns( $columns ) {

	$columns = array(
		'cb'						=> '<input type="checkbox" />',
        'title'						=> __( 'Video Title', 'tokokoo' ),
        'video_cover'				=> __( 'Cover', 'tokokoo' ),
        'taxonomy-video_category'	=> __( 'Category', 'tokokoo' ),
        'video_order'				=> __( 'Order', 'tokokoo' ),
        'date'						=> __( 'Date', 'tokokoo' ),
    );

	return $columns;
	
}

/**
 * Display the data to the columns.
 * 
 * @since 1.0
 */
function tokokoo_video_custom_columns_content( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'video_cover' :

			$img = tokokoo_video_column_image( $post_id );

			if ( $img ) 
				echo '<img src="' . esc_url( $img ) . '" />';
			else 
				echo __( 'No Cover', 'tokokoo' );

			break;

		case 'video_order':

		    $order = $post->menu_order;
		    echo $order;

		    break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;

	}

}

/**
 * Make column sortable.
 * 
 * @since 1.0
 */
function tokokoo_video_column_sortable( $columns ) {

	$columns['taxonomy-video_category'] = 'taxonomy-video_cat';
	$columns['video_order'] = 'video_order';
	return $columns;

}

/**
 * Get the featured image.
 * 
 * @since 1.0
 */
function tokokoo_video_column_image( $post_id ) {

	$post_thumbnail_id = get_post_thumbnail_id( $post_id );

	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'small' );
		return $post_thumbnail_img[0];
	}

}

/**
 * Add video menu item to Admin Bar.
 *
 * @since 1.0
 */
function video_adminbar() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id' => 'video_post_type',
		'title' => __( 'video', 'tokokoo' ),
		'href' => admin_url( 'edit.php?post_type=video' )
	));
	
}
?>