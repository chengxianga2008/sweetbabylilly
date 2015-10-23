<?php

/* Add custom options to the theme settings. */
add_filter( 'tokokoo_options_setting', 'tokokoo_custom_options' );


/* Custom inline scripts. */
add_action( 'optionsframework_custom_scripts', 'balitawoo_custom_inline_script' );

add_filter( 'tokokoo_options_setting_general', 'tokokoo_general_settings_custom_option' );


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 *  
 * @since 1.0
 */
function tokokoo_custom_options($options) {

	$options[] = array( 
		'name'	=> __( 'Banner', 'balitawoo' ),
		'type'	=> 'heading'
	);


	$options[] = array( 
		'name'	=> __( 'Header Banner', 'balitawoo' ),
		'desc'	=> __( 'Banner text on header', 'balitawoo' ),
		'id'	=> 'balitawoo_header_banner',
		'type'	=> 'textarea'
	);

	$options[] = array( 
		'name'	=> __( 'Prolog Message', 'balitawoo' ),
		'desc'	=> __( 'Text to show under slider on shop page', 'balitawoo' ),
		'id'	=> 'balitawoo_prolog_message',
		'type'	=> 'textarea'
	);

	$options[] = array( 
		'name'	=> __( 'Prolog Button', 'balitawoo' ),
		'desc'	=> __( 'Text for prolog button', 'balitawoo' ),
		'id'	=> 'balitawoo_prolog_button',
		'type'	=> 'text'
	);

	$options[] = array( 
		'name'	=> __( 'Prolog Button Link', 'balitawoo' ),
		'desc'	=> __( 'Link to be embedded into button', 'balitawoo' ),
		'id'	=> 'balitawoo_prolog_link',
		'type'	=> 'text'
	);


	/* ============================== End Banner Settings ================================= */


	$options[] = array( 
		'name' => __( 'Social', 'balitawoo' ),
		'type' => 'heading'
	);

	$options[] = array(
		'desc' => __( 'The social icon will appear on footer of your site.', 'balitawoo' ),
		'type' => 'info'
	);

	$options[] = array( 
		"name" => __( 'Header', 'balitawoo' ),
	    "desc" => __( 'Insert header for social section', 'balitawoo' ),
		"id" => 'tokokoo_social_header',
		"type" => 'text'
	);

	$options[] = array( 
		"name" => __( 'Flickr', 'balitawoo' ),
	    "desc" => __( 'Insert your flickr username', 'balitawoo' ),
		"id" => 'tokokoo_flickr',
		"type" => 'text'
	);

	$options[] = array( 
		"name" => __( 'Facebook', 'balitawoo' ),
	    "desc" => __( 'Insert your facebook username', 'balitawoo' ),
		"id" => 'tokokoo_fb',
		"type" => 'text'
	);

	$options[] = array( 
		"name" => __( 'Twitter', 'balitawoo' ),
	    "desc" => __( 'Insert your twitter username', 'balitawoo' ),
		"id" => 'tokokoo_tw',
		"type" => 'text'
	);
	
	/* ============================== End Social Settings ================================= */

	$options[] = array( 
		'name'	=> __( 'Contact', 'balitawoo' ),
		'type'	=> 'heading'
	);

	$options[] = array(
		'desc' => __( 'Info for your contact page, you can get Latitude and Longitude at location service such as <a href="http://www.latlong.net" target="_blank">here</a>', 'balitawoo' ),
		'type' => 'info'
	);

	$options[] = array(
		"name" => __( 'Latitude', 'balitawoo' ),
		"desc" => __( 'Your location latitude', 'balitawoo' ),
		"id" => 'balitawoo_lat',
		"type" => 'text'
	);

	$options[] = array(
		"name" => __( 'Longitude', 'balitawoo' ),
		"desc" => __( 'Your location longitude', 'balitawoo' ),
		"id" => 'balitawoo_lon',
		"type" => 'text'
	);

	$options[] = array(
		"name" => __( 'Street', 'balitawoo' ),
		"desc" => __( 'Street location', 'balitawoo' ),
		"id" => 'balitawoo_street',
		"type" => 'textarea'
	);

	$options[] = array(
		"name" => __( 'Description', 'balitawoo' ),
		"desc" => __( 'Description', 'balitawoo' ),
		"id" => 'balitawoo_desc',
		"type" => 'textarea'
	);

	/* ============================== End Contact Settings ================================= */

	$options[] = array(
		"name" => "Homepage",
		"type" => "heading"
	);

	$options[] = array( 
		'name'	=> __( 'Slider Shortcode', 'balitawoo' ),
		'desc'	=> __( 'Paste your slider shortcode here, this is will be shown on the home page.', 'balitawoo' ),
		'id'	=> 'balitawoo_slider_shortcode',
		'type'	=> 'textarea'
	);

	$options[] = array(
		'name'		=> __( 'Homepage banner', 'balitawoo' ),
		'desc'		=> __( 'Settings for banner that will show up at homepage', 'balitawoo' ),
		'id'		=> 'balitawoo_banner_number',
		'std'		=> 'none',
		'type'		=> 'select',
		'class'		=> 'mini',
		'options'	=> array(
			'none'			=> __( 'Choose Banner', 'balitawoo' ),
			'banner1'		=> __( 'Banner 1', 'balitawoo' ),
			'banner2'		=> __( 'Banner 2', 'balitawoo' ),
			'banner3'		=> __( 'Banner 3', 'balitawoo' ),
			'banner4'		=> __( 'Banner 4', 'balitawoo' )
		)
	);

	$options[] = array(
		'name'		=> __( 'Banner 1 image', 'balitawoo' ),
		'desc'		=> __( 'Select image for your Banner 1', 'balitawoo' ),
		'id'		=> 'balitawoo_banner1_image',
		'type'		=> 'upload',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 1 title', 'balitawoo' ),
		'desc'		=> __( 'Title for your Banner 1', 'balitawoo' ),
		'id'		=> 'balitawoo_banner1_title',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 1 text', 'balitawoo' ),
		'desc'		=> __( 'Text for your Banner 1', 'balitawoo' ),
		'id'		=> 'balitawoo_banner1_text',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 1 link', 'balitawoo' ),
		'desc'		=> __( 'Link for Banner 1', 'balitawoo' ),
		'id'		=> 'balitawoo_banner1_link',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	/* ============================== End banner1 Settings ================================= */

	$options[] = array(
		'name'		=> __( 'Banner 2 image', 'balitawoo' ),
		'desc'		=> __( 'Select image for your Banner 2', 'balitawoo' ),
		'id'		=> 'balitawoo_banner2_image',
		'type'		=> 'upload',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 2 title', 'balitawoo' ),
		'desc'		=> __( 'Title for your Banner 2', 'balitawoo' ),
		'id'		=> 'balitawoo_banner2_title',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 2 text', 'balitawoo' ),
		'desc'		=> __( 'Text for your Banner 2', 'balitawoo' ),
		'id'		=> 'balitawoo_banner2_text',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 2 link', 'balitawoo' ),
		'desc'		=> __( 'Link for Banner 2', 'balitawoo' ),
		'id'		=> 'balitawoo_banner2_link',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	/* ============================== End banner2 Settings ================================= */

	$options[] = array(
		'name'		=> __( 'Banner 3 image', 'balitawoo' ),
		'desc'		=> __( 'Select image for your Banner 3', 'balitawoo' ),
		'id'		=> 'balitawoo_banner3_image',
		'type'		=> 'upload',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 3 title', 'balitawoo' ),
		'desc'		=> __( 'Title for your Banner 3', 'balitawoo' ),
		'id'		=> 'balitawoo_banner3_title',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 3 text', 'balitawoo' ),
		'desc'		=> __( 'Text for your Banner 3', 'balitawoo' ),
		'id'		=> 'balitawoo_banner3_text',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 3 link', 'balitawoo' ),
		'desc'		=> __( 'Link for Banner 3', 'balitawoo' ),
		'id'		=> 'balitawoo_banner3_link',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	/* ============================== End banner3 Settings ================================= */

	$options[] = array(
		'name'		=> __( 'Banner 4 image', 'balitawoo' ),
		'desc'		=> __( 'Select image for your Banner 4', 'balitawoo' ),
		'id'		=> 'balitawoo_banner4_image',
		'type'		=> 'upload',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 4 title', 'balitawoo' ),
		'desc'		=> __( 'Title for your Banner 4', 'balitawoo' ),
		'id'		=> 'balitawoo_banner4_title',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 4 text', 'balitawoo' ),
		'desc'		=> __( 'Text for your Banner 4', 'balitawoo' ),
		'id'		=> 'balitawoo_banner4_text',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	$options[] = array(
		'name'		=> __( 'Banner 4 link', 'balitawoo' ),
		'desc'		=> __( 'Link for Banner 4', 'balitawoo' ),
		'id'		=> 'balitawoo_banner4_link',
		'type'		=> 'text',
		'class'		=> 'hidden'
	);

	/* ============================== End banner4 Settings ================================= */

	return $options;

}

function tokokoo_general_settings_custom_option( $options ) {

	$options[] = array( 
		'name'	=> __( 'Custom logo', 'balitawoo' ),
		'desc'	=> 'Logo for your site',
		'id'	=> 'balitawoo_custom_logo',
		'type'	=> 'upload' 
	);

	return $options;

}

function balitawoo_custom_inline_script() { ?>

	<script type='text/javascript'>

	var $ = jQuery.noConflict();

	jQuery(document).ready(function($) {

		var banner1 = $( '#section-balitawoo_banner1_image, #section-balitawoo_banner1_text, #section-balitawoo_banner1_title, #section-balitawoo_banner1_link' );
		var banner2 = $( '#section-balitawoo_banner2_image, #section-balitawoo_banner2_text, #section-balitawoo_banner2_title, #section-balitawoo_banner2_link' );
		var banner3 = $( '#section-balitawoo_banner3_image, #section-balitawoo_banner3_text, #section-balitawoo_banner3_title, #section-balitawoo_banner3_link' );
		var banner4 = $( '#section-balitawoo_banner4_image, #section-balitawoo_banner4_text, #section-balitawoo_banner4_title, #section-balitawoo_banner4_link' );

		$( '#balitawoo_banner_number' ).on( 'change', function() {
	       banner1.toggle( $(this).val() == 'banner1' );
	       banner2.toggle( $(this).val() == 'banner2' );
	       banner3.toggle( $(this).val() == 'banner3' );
	       banner4.toggle( $(this).val() == 'banner4' );
		});

		if ( $('#balitawoo_banner_number option:selected').val() === 'banner1' ) {
			banner1.show();
		}

		if ( $('#balitawoo_banner_number option:selected').val() === 'banner2' ) {
			banner2.show();
		}
		if ( $('#balitawoo_banner_number option:selected').val() === 'banner3' ) {
			banner3.show();
		}

		if ( $('#balitawoo_banner_number option:selected').val() === 'banner4' ) {
			banner4.show();
		}

	});
	</script>
<?php
}

?>