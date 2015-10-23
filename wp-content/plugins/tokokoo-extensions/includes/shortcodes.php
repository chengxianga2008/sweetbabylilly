<?php
/**
 * Custom shortcodes
 * based off zillashortcode by ThemeZilla
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Enqueue some scripts for the shortcodes. */
add_action( 'wp_enqueue_scripts', 'tokokoo_shortcodes_enqueue' );

/* Register custom TinyMCE button. */
add_action( 'init', 'tokokoo_shortcodes_tinymce' );

/* Enqueue scripts and styles for the admin page. */
add_action( 'admin_init', 'tokokoo_shortcodes_tinymce_script', 11 );

/* Register custom TinyMCE button. */
add_action( 'init', 'tokokoo_shortcodes_lists' );

/**
 * Enqueue scripts for the shortcodes.
 *
 * @since 1.0
 */
function tokokoo_shortcodes_enqueue() {

	if( ! is_admin() ) {
		wp_enqueue_style( 'tokokoo-shortcodes', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'css/shortcodes.css' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'tokokoo-shortcodes-js', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'js/shortcodes.js', array( 'jquery', 'jquery-ui-accordion', 'jquery-ui-tabs' ), '1.0', true );
	}

}

/**
 * Register custom TinyMCE button.
 *
 * @since 1.0
 */
function tokokoo_shortcodes_tinymce() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
		return;
	
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'tokokoo_add_rich_plugins' );
		add_filter( 'mce_buttons', 'tokokoo_register_rich_buttons' );
	}
}

/**
 * Defins TinyMCE rich editor js plugin.
 *
 * @since 1.0
 */
function tokokoo_add_rich_plugins( $plugin_array ) {
	$plugin_array['kooShortcodes'] = trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'tinymce/plugin.js';
	return $plugin_array;
}

/**
 * Adds TinyMCE rich editor buttons.
 *
 * @since 1.0
 */
function tokokoo_register_rich_buttons( $buttons ) {
	array_push( $buttons, "|", 'koo_button' );
	return $buttons;
}

/**
 * Enqueue scripts for the TinyMCE.
 *
 * @since 1.0
 */
function tokokoo_shortcodes_tinymce_script() {
	wp_enqueue_style( 'tokokoo-popup', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'tinymce/css/popup.css', false, '1.0', 'all' );
	
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'tokokoo-jquery-livequery', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'tinymce/js/jquery.livequery.js', false, '1.1.1', false );
	wp_enqueue_script( 'tokokoo-jquery-appendo', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'tinymce/js/jquery.appendo.js', false, '1.0', false );
	wp_enqueue_script( 'tokokoo-base64', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'tinymce/js/base64.js', false, '1.0', false );
	wp_enqueue_script( 'tokokoo-popup-js', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'tinymce/js/popup.js', false, '1.0', false );

	wp_localize_script( 'jquery', 'KooShortcodes', array( 'theme_folder' => trailingslashit( TOKOKOO_EXTENSIONS_URI ) . 'assets' ) );
}

/**
 * Shortcode Lists.
 *
 * @since 1.0
 */
function tokokoo_shortcodes_lists() {

	/* Accordion shortcode. */
	add_shortcode( 'koo-accordion-content', 'tokokoo_accordion_content_shortcode' );
	add_shortcode( 'koo-accordion', 'tokokoo_accordion_shortcode' );

	/* Alert shortcode. */
	add_shortcode( 'koo-alert', 'tokokoo_alert_shortcode' );

	/* Button shortcode. */
	add_shortcode( 'koo-button', 'tokokoo_button_shortcode' );

	/* Boxes shortcode. */
	add_shortcode( 'koo-box', 'tokokoo_box_shortcode' );

	/* Column shortcodes. */
	add_shortcode( 'koo-one-half', 'tokokoo_one_half' );
	add_shortcode( 'koo-one-half-last', 'tokokoo_one_half_last' );
	add_shortcode( 'koo-one-third', 'tokokoo_one_third' );
	add_shortcode( 'koo-one-third-last', 'tokokoo_one_third_last' );
	add_shortcode( 'koo-one-fourth', 'tokokoo_one_fourth' );
	add_shortcode( 'koo-one-fourth-last', 'tokokoo_one_fourth_last' );
	add_shortcode( 'koo-one-fifth', 'tokokoo_one_fifth' );
	add_shortcode( 'koo-one-fifth-last', 'tokokoo_one_fifth_last' );
	add_shortcode( 'koo-one-sixth', 'tokokoo_one_sixth' );
	add_shortcode( 'koo-one-sixth-last', 'tokokoo_one_sixth_last' );

	add_shortcode( 'koo-two-third', 'tokokoo_two_third' );
	add_shortcode( 'koo-two-third-last', 'tokokoo_two_third_last' );
	add_shortcode( 'koo-two-fifth', 'tokokoo_two_fifth' );
	add_shortcode( 'koo-two-fifth-last', 'tokokoo_two_fifth_last' );

	add_shortcode( 'koo-three-fourth', 'tokokoo_three_fourth' );
	add_shortcode( 'koo-three-fourth-last', 'tokokoo_three_fourth_last' );
	add_shortcode( 'koo-three-fifth', 'tokokoo_three_fifth' );
	add_shortcode( 'koo-three-fifth-last', 'tokokoo_three_fifth_last' );

	add_shortcode( 'koo-four-fifth', 'tokokoo_four_fifth' );
	add_shortcode( 'koo-four-fifth-last', 'tokokoo_four_fifth_last' );

	add_shortcode( 'koo-five-sixth', 'tokokoo_five_sixth' );
	add_shortcode( 'koo-five-sixth-last', 'tokokoo_five_sixth_last' );

	/* Google maps shortcode. */
	add_shortcode( 'koo-gmaps', 'tokokoo_gmaps_shortcode' );

	/* Highlight shortcode. */
	add_shortcode( 'koo-highlight', 'tokokoo_highlight_shortcode' );

	/* Tabs shortcode. */
	add_shortcode( 'koo-tabs', 'tokokoo_tabs_shortcode' );
	add_shortcode( 'koo-tab', 'tokokoo_tab_shortcode' );

	/* Toggle shortcode. */
	add_shortcode( 'koo-toggle', 'tokokoo_toggle_shortcode' );

	/* Tooltip shortcode. */
	add_shortcode( 'koo-tooltip', 'tokokoo_tooltip_shortcode' );

}

/**
 * Accordion shortcode.
 *
 * @since 1.0
 */
function tokokoo_accordion_shortcode( $atts, $content = null ) {
	return '<div class="koo-accordion">' . do_shortcode( $content ) . '</div>';
}

function tokokoo_accordion_content_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
	  'title' => __( 'Title', 'tokokoo' ),
	), $atts ) );
	  
   return '<div class="koo-accordion-title">' . esc_attr( $title ) . '</div><div class="koo-accordion-inner">' . do_shortcode( wpautop( wp_kses_data( $content ) ) ) . '</div>';
}

/**
 * Alert shortcode.
 *
 * @since 1.0
 */
function tokokoo_alert_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style'   => 'white'
    ), $atts));
	
	return '<div class="koo-alert ' . sanitize_html_class( $style ) . '">' . do_shortcode( wpautop( wp_kses_data( $content ) ) ) . '</div>';
}

/**
 * Button shortcode.
 *
 * @since 1.0
 */
function tokokoo_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url' => '#',
		'target' => '_self',
		'style' => 'white',
		'size' => 'small',
		'type' => 'square'
    ), $atts ) );
	
   return '<a class="koo-button ' . sanitize_html_class( $size ) . ' ' . sanitize_html_class( $style ) . ' ' . sanitize_html_class( $type ) . '" href="' . esc_url( $url ) . '" target="' . $target . '">' . do_shortcode( wp_kses_data( $content ) ) . '</a>';
}

/**
 * Boxes shortcode.
 *
 * @since 1.0
 */
function tokokoo_box_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'style' => 'white',
		'title' => __( 'This is box title', 'tokokoo' )
	), $atts ) );

	return '<div class="koo-box ' . sanitize_html_class( $style ) . '"><div class="koo-box-title">' . esc_attr( $title ) . '</div><div class="koo-box-content">' . do_shortcode( wpautop( wp_kses_data( $content ) ) ) . '</div></div>';

}

/**
 * Columns shortcode
 *
 * @since 1.0
 */

/* Column One. */
function tokokoo_one_half( $atts, $content = null ) {
   return '<div class="koo-one-half">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_one_half_last( $atts, $content = null ) {
   return '<div class="koo-one-half koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

function tokokoo_one_third( $atts, $content = null ) {
   return '<div class="koo-one-third">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_one_third_last( $atts, $content = null ) {
   return '<div class="koo-one-third koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

function tokokoo_one_fourth( $atts, $content = null ) {
   return '<div class="koo-one-fourth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_one_fourth_last( $atts, $content = null ) {
   return '<div class="koo-one-fourth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

function tokokoo_one_fifth( $atts, $content = null ) {
   return '<div class="koo-one-fifth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_one_fifth_last( $atts, $content = null ) {
   return '<div class="koo-one-fifth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

function tokokoo_one_sixth( $atts, $content = null ) {
   return '<div class="koo-one-sixth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_one_sixth_last( $atts, $content = null ) {
   return '<div class="koo-one-sixth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

/* Column Two. */
function tokokoo_two_third( $atts, $content = null ) {
   return '<div class="koo-two-third">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_two_third_last( $atts, $content = null ) {
   return '<div class="koo-two-third koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

function tokokoo_two_fifth( $atts, $content = null ) {
   return '<div class="koo-two-fifth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_two_fifth_last( $atts, $content = null ) {
   return '<div class="koo-two-fifth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

/* Column Three. */
function tokokoo_three_fourth( $atts, $content = null ) {
   return '<div class="koo-three-fourth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_three_fourth_last( $atts, $content = null ) {
   return '<div class="koo-three-fourth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

function tokokoo_three_fifth( $atts, $content = null ) {
   return '<div class="koo-three-fifth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_three_fifth_last( $atts, $content = null ) {
   return '<div class="koo-three-fifth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

/* Column Four. */
function tokokoo_four_fifth( $atts, $content = null ) {
   return '<div class="koo-four-fifth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_four_fifth_last( $atts, $content = null ) {
   return '<div class="koo-four-fifth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

/* Column Five. */
function tokokoo_five_sixth( $atts, $content = null ) {
   return '<div class="koo-five-sixth">' . do_shortcode( wpautop( $content ) ) . '</div>';
}

function tokokoo_five_sixth_last( $atts, $content = null ) {
   return '<div class="koo-five-sixth koo-column-last">' . do_shortcode( wpautop( $content ) ) . '</div><div class="koo-clear"></div>';
}

/**
 * Google Maps shortcode
 *
 * @since 1.0
 */
function tokokoo_gmaps_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'country'	=> '',
		'state'		=> '',
		'city'		=> '',
		'street'	=> '',
		'zip'		=> '',
		'type'		=> 'dynamic',
		'width'		=> 300,
		'height'	=> 250,
		'zoom'		=> 15
  	), $atts ) );

  	$address = $country . ' ' . $state . ' ' . $city . ' ' . $street;

  	if( $country ) :

	  	if ( $type == 'dynamic' ) {
	  		wp_enqueue_style('tokokoo-google-style', 'http://code.google.com/apis/maps/documentation/javascript/examples/default.css'); 

	  		wp_register_script( 'tokokoo-googleapis', 'https://maps.googleapis.com/maps/api/js?sensor=false', true, '1.0' );
	  		wp_enqueue_script( 'tokokoo-googleapis' );

	  		wp_register_script( 'tokokoo-googlemap', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'js/google-maps.js', true, '1.0' );
	  		wp_enqueue_script( 'tokokoo-googlemap' );
	  	} else {
	  		$address = str_replace( ' ', '+', $address );
	  	}

  		ob_start(); ?>

		<div class="koo-gmaps">
			<?php if ( $type == 'dynamic' ) { ?>
				<script>
					var sci_google_zoom 	= "<?php echo $zoom; ?>";
					var sci_google_address 	= "<?php echo $address; ?>";
				</script>
				<div id="tokokoo-google-map" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
					<!-- map here -->
				</div>
			<?php } elseif( $type == 'static' ) { ?>
				<img src="http://maps.googleapis.com/maps/api/staticmap?
				center=<?php echo $address; ?>&
				zoom=<?php echo $zoom; ?>&
				size=<?php echo $width; ?>x<?php echo $height; ?>&
				maptype=roadmap&
				markers=color:red%7Clabel:S%7C<?php echo $address; ?>&
				sensor=false">
			<?php } ?>
		</div>

	<?php 
	endif; return ob_get_clean();

}

/**
 * Hightlight shortcode
 *
 * @since 1.0
 */
function tokokoo_highlight_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => 'yellow',
  	), $atts ) );

	return '<span class="koo-highlight ' . sanitize_html_class( $style ) . '">' . do_shortcode( wp_kses_data( $content ) ) . '</span>';

}

/**
 * Tabs shortcode
 *
 * @since 1.0
 */
function tokokoo_tabs_shortcode( $atts, $content = null ) {
	$defaults = array();
	extract( shortcode_atts( $defaults, $atts ) );
	
	// Extract the tab titles for use in the tab widget.
	preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	
	$tab_titles = array();
	if( isset( $matches[1]) ){ $tab_titles = $matches[1]; }
	
	$output = '';
	
	if( count( $tab_titles ) ){
	    $output .= '<div id="koo-tabs-'. rand(1, 100) .'" class="koo-tabs"><div class="koo-tab-inner">';
		$output .= '<ul class="koo-nav koo-clearfix">';
		
		foreach( $tab_titles as $tab ){
			$output .= '<li><a href="#koo-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
		}
	    
	    $output .= '</ul>';
	    $output .= do_shortcode( wp_kses_data( $content ) );
	    $output .= '</div></div>';
	} else {
		$output .= do_shortcode( wp_kses_data( $content ) );
	}
	
	return $output;
}

function tokokoo_tab_shortcode( $atts, $content = null ) {
	$defaults = array( 'title' => __( 'Tab', 'tokokoo' ) );
	extract( shortcode_atts( $defaults, $atts ) );
	
	return '<div id="koo-tab-'. sanitize_title( $title ) .'" class="koo-tab">'. do_shortcode( wpautop( wp_kses_data( $content ) ) ) .'</div>';
}

/**
 * Toggle shortcode
 *
 * @since 1.0
 */
function tokokoo_toggle_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		'title'    	 => __( 'Title goes here', 'tokokoo' ),
		'state'		 => 'open'
    ), $atts));

	return "<div data-id='" . esc_attr( $state ) . "' class=\"koo-toggle\"><span class=\"koo-toggle-title\">" . esc_attr( $title ) . "</span><div class=\"koo-toggle-inner\">". do_shortcode( wpautop( wp_kses_data( $content ) ) ) ."</div></div>";
}

/**
 * Tooltip shortcode
 *
 * @since 1.0
 */
function tokokoo_tooltip_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => __( 'Title', 'tokokoo' ),
	  	'placement' => 'top',
	  	'url' => ''
	), $atts ) );

	if( empty( $url ) )
		return '<span data-toggle="tooltip" data-placement="' . esc_attr( $placement ) . '" title="' . esc_attr( $title ) . '" rel="tooltip">' . do_shortcode( wp_kses_data( $content ) ) . '</span>';
	else
   		return '<a href="' . esc_url( $url ) . '" data-toggle="tooltip" data-placement="' . esc_attr( $placement ) . '" title="' . esc_attr( $title ) . '" rel="tooltip">' . do_shortcode( wp_kses_data( $content ) ) . '</a>';
}
?>