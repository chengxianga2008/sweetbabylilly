<?php
/**
 * Customizer functions
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Load textarea function for customizer. */
add_action( 'customize_register', 'tokokoo_load_textarea_customize_controls', 1 );

/* Register custom sections, settings, and controls. */
add_action( 'customize_register', 'tokokoo_customizer_register' );

/* Output favicon into the head. */
add_action( 'wp_head', 'tokokoo_favicon_output', 10 );

/**
 * Load textarea function for customizer.
 *
 * @since 1.0 
 */
function tokokoo_load_textarea_customize_controls() {
	require_once( trailingslashit( HYBRID_CLASSES ) . 'customize-control-textarea.php' );
}

/**
 * Register custom sections, settings, and controls.
 *
 * @since 1.0 
 */
function tokokoo_customizer_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/* Javascript for live preview purpose. */
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'tokokoo_customize_preview_js', 21 );

	/* Rename Colors Sections into General Colors. */
	$wp_customize->get_section( 'colors' )->title = __( 'General Colors', 'tokokoo' );

	/* Rename Layout Sections into Global Layouts and change priority to 95. */
	$wp_customize->get_section( 'layout' )->title = __( 'Global Layouts', 'tokokoo' );
	$wp_customize->get_section( 'layout' )->priority = 95;

	/* Rename Footer Sections into Footer Text. */
	$wp_customize->get_section( 'hybrid-core-footer' )->title = __( 'Footer Text', 'tokokoo' );

	/* Set the priority of background color function. */
	$wp_customize->get_control( 'background_color' )->priority = 0;

	/**
	 * General Settings.
	 *
	 * @since 1.0 
	 */
	$wp_customize->add_section( 'tokokoo_general_settings' , array(
		'title'      => __( 'General Settings', 'tokokoo' ),
		'priority'   => 90,
	) );

	/* Custom Logo */
	$wp_customize->add_setting( 'tokokoo_logo', array(
		'sanitize_callback'	=> 'esc_url_raw',
		'type'				=> 'theme_mod',
		'capability' 		=> 'edit_theme_options' 
	) );
	
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tokokoo_logo', array(
			'label'			=> __( 'Custom Logo', 'tokokoo' ),
			'section'		=> 'tokokoo_general_settings',
			'priority'		=> 1,
			'settings'		=> 'tokokoo_logo'
		) ) );

	/* Custom Favicon */
	$wp_customize->add_setting( 'tokokoo_favicon', array(
		'sanitize_callback'	=> 'esc_url_raw',
		'type'				=> 'theme_mod',
		'capability' 		=> 'edit_theme_options' 
	) );
	
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tokokoo_favicon', array(
			'label'			=> __( 'Custom Favicon', 'tokokoo' ),
			'section'		=> 'tokokoo_general_settings',
			'priority'		=> 2,
			'settings'		=> 'tokokoo_favicon'
		) ) );

	/* Allow theme developer to add another settings to the Customizer. */
	do_action( 'tokokoo_customizer_setting' );

}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 * Used with blogname and blogdescription.
 *
 * @since 1.0
 */
function tokokoo_customize_preview_js() {
	?>
	<script type="text/javascript">
		( function( $ ){
			wp.customize( 'blogname', function( value ) {
				value.bind( function( to ) {
					$( '#site-title a' ).html( to );
				} );
			} );
			wp.customize( 'blogdescription', function( value ) {
				value.bind( function( to ) {
					$( '#site-description' ).html( to );
				} );
			} );
		} )( jQuery );
	</script>
	<?php
}

/**
 * Output favicon into the head.
 *
 * @since  1.0
 */
function tokokoo_favicon_output() {

	$favicon = get_theme_mod( 'tokokoo_favicon' );
	if ( $favicon )
		echo '<link rel="shortcut icon" href="'. esc_url( $favicon ) .'">'."\n";

}
?>