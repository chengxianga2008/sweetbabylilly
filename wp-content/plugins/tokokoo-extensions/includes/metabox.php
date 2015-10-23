<?php
/**
 * Custom metabox functions
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/**
 * Register Field Groups
 *
 * @since 1.0
 */

if( function_exists( 'register_field_group' ) ) {

	register_field_group( array(
		'id'		=> 'acf_group-settings',
		'title'		=> __( 'Group Settings', 'tokokoo' ),
		'fields'	=> array(
			array(
				'key'			=> 'field_51d3ec915577a',
				'label'			=> __( 'Width', 'tokokoo' ),
				'name'			=> 'tokokoo_slide_width',
				'type'			=> 'text',
				'instructions'	=> __( 'Set the image width in this group(px). eg: 960', 'tokokoo' ),
				'default_value'	=> '',
				'formatting'	=> 'html',
			),
			array(
				'key'			=> 'field_51d3ebf84a637',
				'label'			=> __( 'Height', 'tokokoo' ),
				'name'			=> 'tokokoo_slide_height',
				'type'			=> 'text',
				'instructions'	=> __( 'Set the image height in this group(px). eg: 400', 'tokokoo' ),
				'default_value'	=> '',
				'formatting'	=> 'html',
			),
			array(
				'key'			=> 'field_51ed553d76bce',
				'label'			=> __( 'Crop', 'tokokoo' ),
				'name'			=> 'tokokoo_slide_crop',
				'type'			=> 'true_false',
				'message'		=> __( 'Hard crop?', 'tokokoo' ),
				'default_value'	=> 1,
			),
		),
		'location' => array(
			array(
				array(
					'param'		=> 'ef_taxonomy',
					'operator'	=> '==',
					'value'		=> 'slide-group',
					'order_no'	=> 0,
					'group_no'	=> 0,
				),
			),
		),
		'options' => array(
			'position'			=> 'normal',
			'layout'			=> 'no_box',
			'hide_on_screen'	=> array(
			),
		),
		'menu_order' => 0,
	));

	register_field_group( array(
		'id'		=> 'acf_slide-options',
		'title'		=> __( 'Slide Options', 'tokokoo' ),
		'fields'	=> array(
			array(
				'key'			=> 'field_51d3c89af9053',
				'label'			=> __( 'Slide URL', 'tokokoo' ),
				'name'			=> 'tokokoo_slide_url',
				'type'			=> 'text',
				'instructions'	=> __( 'Where you\'d like the slide to link to. If you leave this field blank the slide will not link anywhere.', 'tokokoo' ),
				'default_value' => '',
				'formatting'	=> 'none',
			),
			array(
				'key'			=> 'field_51d3c8f2f9055',
				'label'			=> __( 'Video', 'tokokoo' ),
				'name'			=> 'tokokoo_slide_video',
				'type'			=> 'text',
				'instructions'	=> __( 'Paste any video URL here, support video such as from youtube, vimeo and etc (<a href="http://codex.wordpress.org/Embeds">oEmbed</a> support).', 'tokokoo' ),
				'default_value'	=> '',
				'formatting'	=> 'html',
			),
		),
		'location' => array(
			array(
				array(
					'param'		=> 'post_type',
					'operator'	=> '==',
					'value'		=> 'slides',
					'order_no'	=> 0,
					'group_no'	=> 0,
				),
			),
		),
		'options' => array(
			'position'			=> 'normal',
			'layout'			=> 'default',
			'hide_on_screen'	=> array (
			),
		),
		'menu_order' => 1,
	));

	register_field_group(array (
		'id'		=> 'acf_project-galleries',
		'title'		=> __( 'Project Galleries', 'tokokoo' ),
		'fields'	=> array(
			array(
				'key'			=> 'field_51e4ed5d84050',
				'label'			=> __( 'Project Galleries', 'tokokoo' ),
				'name'			=> 'tokokoo_project_galleries',
				'type'			=> 'repeater',
				'instructions'	=> __( 'Upload the project images as many as you want!', 'tokokoo' ),
				'sub_fields'	=> array(
					array(
						'key'			=> 'field_51e4f16596653',
						'label'			=> __( 'Image', 'tokokoo' ),
						'name'			=> 'tokokoo_project_image',
						'type'			=> 'image',
						'column_width'	=> '',
						'save_format'	=> 'url',
						'preview_size'	=> 'thumbnail',
						'library'		=> 'all',
					),
				),
				'row_min'		=> 0,
				'row_limit'		=> '',
				'layout'		=> 'table',
				'button_label'	=> __( 'Add Image', 'tokokoo' ),
			),
		),
		'location' => array(
			array(
				array(
					'param'		=> 'post_type',
					'operator'	=> '==',
					'value'		=> 'portfolio',
					'order_no'	=> 0,
					'group_no'	=> 0,
				),
			),
		),
		'options' => array(
			'position'			=> 'normal',
			'layout'			=> 'default',
			'hide_on_screen'	=> array(
			),
		),
		'menu_order' => 2,
	));

	register_field_group( array(
		'id'		=> 'acf_project-url',
		'title'		=> __( 'Project URL', 'tokokoo' ),
		'fields'	=> array(
			array(
				'key'			=> 'field_51e4e3ae6243b',
				'label'			=> __( 'URL of your project', 'tokokoo' ),
				'name'			=> 'tokokoo_project_url',
				'type'			=> 'text',
				'instructions'	=> __( '(eg: http://example.com/) Leave it blank if your project does not have url.', 'tokokoo' ),
				'default_value'	=> '',
				'formatting'	=> 'none',
			),
		),
		'location' => array(
			array(
				array(
					'param'		=> 'post_type',
					'operator'	=> '==',
					'value'		=> 'portfolio',
					'order_no'	=> 0,
					'group_no'	=> 0,
				),
			),
		),
		'options' => array(
			'position'			=> 'side',
			'layout'			=> 'default',
			'hide_on_screen'	=> array (
			),
		),
		'menu_order' => 5,
	));

	register_field_group( array(
		'id'		=> 'acf_video-options',
		'title'		=> __( 'Video Options', 'tokokoo' ),
		'fields'	=> array(
			array(
				'key'			=> 'field_51f0c3613ec49',
				'label'			=> __( 'Video Embed Code', 'tokokoo' ),
				'name'			=> 'tokokoo_video_embed_code',
				'type'			=> 'textarea',
				'instructions'	=> __( 'Enter the video embed code for your video (YouTube, Vimeo or similar).', 'tokokoo' ),
				'default_value'	=> '',
				'formatting'	=> 'html',
			),
		),
		'location' => array(
			array(
				array(
					'param'		=> 'post_type',
					'operator'	=> '==',
					'value'		=> 'video',
					'order_no'	=> 0,
					'group_no'	=> 0,
				),
			),
		),
		'options' => array(
			'position'			=> 'normal',
			'layout'			=> 'default',
			'hide_on_screen'	=> array(
			),
		),
		'menu_order' => 1,
	));
}
?>