<?php
	// Exit if accessed directly
	if ( !defined('ABSPATH') ) exit;
	/**
	* Theme Customizer
	* Display theme customization sections
	* @package Balitawoo
	* @author Tokokoo
	* @license license.txt
	* @since x.x.x
	*/

	// Register customizer
	

	// Print stylesheet in header to alter the display of site
	

	$font_slugs = array();
	$color_slugs = array();


/**
 * Register Custom Sections, Settings, And Controls
 *
 * @since x.x.x
 */

	function balitawoo_customizer_register($wp_customize) {
	/* =====================================================================================================*
	*  General Color 										 												*
	*  =====================================================================================================*/
		// Rename Colors Sections Into General Colors
		$wp_customize->get_section('colors')->title = __( 'General Colors', 'balitawoo' );
		$wp_customize->get_control('background_color')->priority = 0;

		global $default_setting;
		global $color_slugs;		
		$general_colors = array();
		$general_colors[] = array( 'slug' => 'balitawoo_menu_hover_color', 'default' => '#a8af3f', 'priority' => 3, 'label' => __('Menu hover color', 'balitawoo'));
		$general_colors[] = array( 'slug' => 'balitawoo_menu_color', 'default' => '#d6a293', 'priority' => 4, 'label' => __('Menu color', 'balitawoo'));
		$general_colors[] = array( 'slug' => 'balitawoo_menu_dropdown_color', 'default' => '#a8af3f', 'priority' => 5, 'label' => __('Menu dropdown background color', 'balitawoo'));
		$general_colors[] = array( 'slug' => 'balitawoo_site_title_color', 'default' => '#d6a293', 'priority' => 6, 'label' => __('Site title color', 'balitawoo'));
		$general_colors[] = array( 'slug' => 'balitawoo_heading_color', 'default' => '#663223', 'priority' => 7, 'label' => __('Heading color', 'balitawoo'));
		$general_colors[] = array( 'slug' => 'balitawoo_global_link_color', 'default' => '#049cdb', 'priority' => 8, 'label' => __('Global link color', 'balitawoo'));
		$general_colors[] = array( 'slug' => 'balitawoo_link_hover_color', 'default' => '#0378a9', 'priority' => 9, 'label' => __('Link hover color', 'balitawoo'));

		foreach( $general_colors as $general_color) {
			$wp_customize->add_setting($general_color['slug'], array('default' => $general_color['default'], 'transport' => 'postMessage', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'balitawoo_general_color_sanitize'));
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $general_color['slug'], array('label' => $general_color['label'], 'section' => 'colors', 'priority' => $general_color['priority'], 'settings' => $general_color['slug'])));
			$color_slugs[] = $general_color['slug'];
		}

		/* =====================================================================================================*
		*  ECOMMERCE COLOR 										 												*
		*  =====================================================================================================*/
		$wp_customize->add_section( 'balitawoo_ecommerce_color' , array(
			'title'      => __( 'Ecommerce Color', 'balitawoo' ),
			'priority'   => 50,
		) );

		// Ecommerce Color
		$ecommerce_colors = array();
		$ecommerce_colors[] = array( 'slug' => 'balitawoo_primary_color', 'default' => '#a8af3f', 'priority' => 1, 'label' => __('Primary color', 'balitawoo'));
		$ecommerce_colors[] = array( 'slug' => 'balitawoo_secondary_color', 'default' => '#663223', 'priority' => 2, 'label' => __('Secondary color', 'balitawoo'));
		$ecommerce_colors[] = array( 'slug' => 'balitawoo_tabs_background', 'default' => '#a8af3f', 'priority' => 3, 'label' => __('Tabs background color', 'balitawoo'));
		$ecommerce_colors[] = array( 'slug' => 'balitawoo_badge_color', 'default' => '#663223', 'priority' => 4, 'label' => __('Badge color', 'balitawoo'));
		$ecommerce_colors[] = array( 'slug' => 'balitawoo_button_background', 'default' => '#898F2A', 'priority' => 5, 'label' => __('Button color', 'balitawoo'));
		$ecommerce_colors[] = array( 'slug' => 'balitawoo_button_background_hover', 'default' => '#bcc351', 'priority' => 6, 'label' => __('Button hover color', 'balitawoo'));

		foreach( $ecommerce_colors as $ecommerce_color) {
			// SETTINGS & CONTROLS
			$wp_customize->add_setting($ecommerce_color['slug'], array('default' => $ecommerce_color['default'], 'transport' => 'postMessage', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'balitawoo_general_color_sanitize'));
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $ecommerce_color['slug'], array('label' => $ecommerce_color['label'], 'section' => 'balitawoo_ecommerce_color', 'priority' => $ecommerce_color['priority'], 'settings' => $ecommerce_color['slug'])));
			$color_slugs[] = $ecommerce_color['slug'];
		}

		$wp_customize->add_section( 'balitawoo_typography' , array(
			'title'      => __( 'Typography', 'balitawoo' ),
			'priority'   => 30,
		) );
		/* =====================================================================================================*
		*  TYPOGRAPHY 										 													*
		*  =====================================================================================================*/
		global $font_slugs;
		$fonts = array();
		$list_font = array(
			'Montserrat' 			=> 'Montserrat',
			'ActionManBold' 		=> 'ActionManBold',
			'Helvetica' 			=> 'Helvetica',
			'Arial' 				=> 'Arial',	
			'Arial Black'			=> 'Arial Black',
			'Trebuchet' 			=> 'Trebuchet',
			'Sans-Serif'			=> 'Sans-Serif',
			'Open Sans'				=> 'Open Sans',
			'Droid Sans'			=> 'Droid Sans',
			'Impact'				=> 'Impact',
			'Verdana' 				=> 'Verdana',
			'Palatino'				=> 'Palatino',
			'Tahoma'				=> 'Tahoma',
			'Times New Roman'		=> 'Times New Roman',
			'Lucida Sans Unicode' 	=> 'Lucida Sans Unicode',
			);

		$fonts[] = array('slug'=>'balitawoo_body_font', 'default' => 'Montserrat', 'priority'=>1,'label' => __('Body Font', 'balitawoo'));
		$fonts[] = array('slug'=>'balitawoo_site_title_font', 'default' => 'ActionManBold','priority'=>2, 'label' => __('Site Title', 'balitawoo'));
		$fonts[] = array('slug'=>'balitawoo_heading_font', 'default' => 'Arial', 'priority'=>3,'label' => __('Heading Font', 'balitawoo'));
		$fonts[] = array('slug'=>'balitawoo_content_font', 'default' => 'Montserrat', 'priority'=>4,'label' => __('Content Font', 'balitawoo'));
		$fonts[] = array('slug'=>'balitawoo_product_title_font', 'default' => 'ActionManBold', 'priority'=>6,'label' => __('Product Title Font', 'balitawoo'));

	
		foreach( $fonts as $font ) {

			// SETTINGS & CONTROLS
			$wp_customize->add_setting($font['slug'], array('default' => $font['default'], 'transport'   => 'postMessage','capability' => 'edit_theme_options','sanitize_callback' => 'balitawoo_font_family_sanitize'));
			$wp_customize->add_control(new WP_Customize_Control($wp_customize, $font['slug'], array('label' => $font['label'],'type'=>'select','choices'=>$list_font, 'section' => 'balitawoo_typography','priority'=>$font['priority'],
					'settings' => $font['slug'])));
			$font_slugs[] = $font['slug'];
		}
	}

	/**
	 * Used by hook: 'customize_preview_init'
	 * 
	 * @see add_action('customize_preview_init',$func)
	 */
	function balitawoo_customizer_live_preview() {
		wp_enqueue_script('balitawoo-themecustomizer', get_template_directory_uri().'/js/theme-customizer.js', array( 'jquery'),'',true);
	}
	add_action( 'customize_preview_init', 'balitawoo_customizer_live_preview' );
	
	/**
	 * Sanitize Font Family Settings
	 *
	 * @since x.x.x
	 */
	function balitawoo_general_color_sanitize($setting, $object) {
		global $color_slugs;
		if( in_array( $object->id, $color_slugs ) ) {
			$setting = wp_filter_nohtml_kses( $setting );
		}
		return $setting;
	}

	/**
	 * Sanitize General Color Settings
	 *
	 * @since x.x.x
	 */
	function balitawoo_font_family_sanitize( $setting, $object ) {
		global $font_slugs;
		if ( in_array( $object->id, $font_slugs ) ) {
			$setting = wp_filter_nohtml_kses( $setting );
		}
		return $setting;
	}

	/**
	 * Sanitize Print To Head
	 *
	 * @since x.x.x
	 */
	function balitawoo_customizer_css() { ?>
	<style type="text/css">
		/* General color settings section */
		<?php if ( get_theme_mod('balitawoo_menu_hover_color') ) { ?>
			.menu li a:hover { background-color: <?php echo get_theme_mod('balitawoo_menu_hover_color'); ?>; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_menu_color') ) { ?>
			.menu li a {color: <?php echo get_theme_mod('balitawoo_menu_color'); ?>; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_menu_dropdown_color') ) { ?>
			.menu .sub-menu, .menu .sub-menu li a, .menu .sub-menu li a:hover {background-color: <?php echo get_theme_mod('balitawoo_menu_dropdown_color'); ?>; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_site_title_color') ) { ?>
			#logo a{color: <?php echo get_theme_mod('balitawoo_site_title_color'); ?>; }
		<?php } ?>
		
		<?php if ( get_theme_mod('balitawoo_heading_color') ) { ?>
			h1, h2, h3, h4, h5, h6 {color: <?php echo get_theme_mod('balitawoo_heading_color'); ?>; }
		<?php } ?>
		
		<?php if ( get_theme_mod('balitawoo_global_link_color') ) { ?>
			a {color: <?php echo get_theme_mod('balitawoo_global_link_color'); ?>;}
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_link_hover_color') ) { ?>
			a:hover {color: <?php echo get_theme_mod('balitawoo_link_hover_color'); ?>; }
		<?php } ?>

		/* End of general color section */

		/* Ecommerce color settings section */
		<?php if ( get_theme_mod( 'balitawoo_primary_color' ) ) {  ?>
			.prolog, .woocommerce-ordering .chzn-drop .chzn-results, .woocommerce-ordering .chzn-single {background-color: <?php echo get_theme_mod('balitawoo_primary_color'); ?>;}
		<?php } ?>
	
		<?php if ( get_theme_mod('balitawoo_secondary_color') ) { ?>
			.cartbox-top {background: url("<?php echo get_template_directory_uri() ?>/img/ico_cart.png") no-repeat scroll 30px 16px <?php echo get_theme_mod('balitawoo_secondary_color'); ?>;}
			.cartbox .widget, .woocommerce-cart .cart th, .woocommerce-ordering .chzn-drop .chzn-results li:hover { background-color: <?php echo get_theme_mod('balitawoo_secondary_color'); ?>;}
		<?php } ?>

		<?php if ( get_theme_mod( 'balitawoo_tabs_background' ) ) {  ?>
			html ul.tabs li.active, html ul.tabs li.active a, html ul.tabs li.active a:hover { background-color:  <?php echo get_theme_mod( 'balitawoo_tabs_background' ); ?>; }
		<?php } ?>

		<?php if ( get_theme_mod( 'balitawoo_badge_color' ) ) {  ?>
			.produktxt .price { background-color: <?php echo get_theme_mod( 'balitawoo_badge_color' ); ?>;}
		<?php } ?>
		
		<?php if ( get_theme_mod( 'balitawoo_button_background' ) ) {  ?>
			.sidebar .buttons .button, .sidebar .buttons .checkout, .produktxt button, .produktxt input[type=button], .cart button, .cart input[type=button], .button a, .woocommerce-cart .cart .actions input[type="submit"], .form-submit input[type="submit"], .form-submit #submit, button.button, .woocommerce-checkout .lost_password, .woocommerce-checkout .button, .woocommerce-account .lost_password, .woocommerce-account .button, #searchsubmit, .cartbox .widget .buttons .button, .cartbox .widget .buttons .checkout{ background-color: <?php echo get_theme_mod( 'balitawoo_button_background' ); ?>;}
		<?php } ?>

		<?php if ( get_theme_mod( 'balitawoo_button_background_hover' ) ) {  ?>
			.sidebar .buttons .button:hover, .sidebar .buttons .checkout:hover, .produktxt button:hover, .produktxt input[type=button]:hover, .cart button:hover, .cart input[type=button]:hover, .button a:hover, .woocommerce-cart .cart .actions input[type="submit"]:hover, .form-submit input[type="submit"]:hover, .form-submit #submit:hover, button.button:hover, .woocommerce-checkout .lost_password:hover, .woocommerce-checkout .button:hover, .woocommerce-account .lost_password:hover, .woocommerce-account .button:hover, #searchsubmit:hover, .cartbox .widget .buttons .button:hover, .cartbox .widget .buttons .checkout:hover{ background-color: <?php echo get_theme_mod( 'balitawoo_button_background_hover' ); ?>;}
		<?php } ?>
		/* End of ecommerce color section */

		/* Typography settings section */
		<?php if ( get_theme_mod('balitawoo_body_font') ) { ?>
			body {font-family: <?php echo get_theme_mod('balitawoo_body_font'); ?>, Arial, Helvetica, sans-serif; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_heading_font') ) { ?>
			h1, h2, h3, h4, h5, h6 {font-family: <?php echo get_theme_mod('balitawoo_heading_font'); ?>, Arial, Helvetica, sans-serif; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_site_title_font') ) { ?>
			#logo a {font-family: <?php echo get_theme_mod('balitawoo_site_title_font'); ?>, Arial, Helvetica, sans-serif; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_content_font') ) { ?>
			.feat p, p {font-family: "<?php echo get_theme_mod('balitawoo_content_font'); ?>", Arial, Helvetica, sans-serif; }
		<?php } ?>

		<?php if ( get_theme_mod('balitawoo_product_title_font') ) { ?>
			.produktxt h2, .item h4 {font-family: "<?php echo get_theme_mod('balitawoo_product_title_font'); ?>", Arial, Helvetica, sans-serif; }
		<?php } ?>
		/* End of typography section */

	</style>
	<?php
	}


?>