<?php
/**
 * Custom CSS manager
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Enqueue some scripts for the custom css. */
add_action( 'admin_enqueue_scripts', 'tokokoo_custom_css_enqueue' );

/* Register setting. */
add_action( 'admin_init', 'tokokoo_register_custom_css_setting' );

/* Add the custom css menu. */
add_action( 'admin_menu', 'tokokoo_custom_css_menu', 20 );

/* Output the data to the wp_head. */
add_action( 'wp_head', 'tokokoo_custom_css_display', 10 );

/**
 * Enqueue script for Custom CSS related features.
 * 
 * @since 1.0
 */
function tokokoo_custom_css_enqueue( $hook_suffix ) {

	if ( 'appearance_page_tokokoo-custom-css' == $hook_suffix ) {
		wp_enqueue_script( 'codemirror', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'codemirror/lib/codemirror.min.js', array(), '2.3' );
		wp_enqueue_script( 'codemirror-mode-css', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'codemirror/mode/css/css.min.js', array(), '2.3' );

		wp_enqueue_style( 'codemirror', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'codemirror/lib/codemirror.css', array(), '2.3' );
		wp_enqueue_style( 'codemirror-theme-neat', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'codemirror/theme/monokai.css', array(), '2.3' );

		wp_enqueue_script( 'tokokoo-custom-css-js', trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'js/custom-css.js', array( 'jquery' ) );
	}

}

/**
 * Register the form setting.
 *
 * @since 1.0
 */
function tokokoo_register_custom_css_setting() {
	register_setting( 'tokokoo_custom_css', 'tokokoo_custom_css', 'tokokoo_custom_css_setting_validate' );
}

/**
 * Add the custom css menu to the admin menu.
 *
 * @since 1.0
 */
function tokokoo_custom_css_menu() {

	$settings = add_theme_page( __( 'Custom CSS', 'tokokoo' ), __( 'Custom CSS', 'tokokoo' ), 'edit_theme_options', 'tokokoo-custom-css', 'tokokoo_custom_css_page' );

	if ( ! $settings )
		return;

}

/**
 * Render the custom CSS page
 *
 * @since  1.0
 */
function tokokoo_custom_css_page() {
	$options = get_option( 'tokokoo_custom_css' );
	$custom_css = isset( $options['custom_css'] ) ? $options['custom_css']: '';

	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );
	?>

	<div class="wrap">

		<div id="icon-tools" class="icon32"><br></div>
		<h2><?php _e( 'Custom CSS', 'tokokoo' ) ?></h2>
		<?php settings_errors(); ?>
	
		<form action="options.php" method="post" style="margin-top:25px">
	
			<?php settings_fields( 'tokokoo_custom_css' ); ?>
			<div id="custom-css-container" style="border:1px solid #DFDFDF;">
				<textarea name="tokokoo_custom_css[custom_css]" id="custom-css-textarea"><?php echo wp_filter_nohtml_kses( $custom_css ) ?></textarea>
			</div>
			<p class="description">
				<?php printf( __( 'Easily add custom css rules to %s theme and its child themes', 'tokokoo' ), ucfirst( $theme->get( 'Name' ) ) ); ?>
			</p>
			<?php submit_button( esc_attr__( 'Save CSS', 'tokokoo' ) ); ?>
	
		</form>

	</div>
	<?php
}

/**
 * Sanitize and validate form input.
 *
 * @since 1.0
 */
function tokokoo_custom_css_setting_validate( $input ) {
	$input['custom_css'] = wp_filter_nohtml_kses( $input['custom_css'] );
	return $input;
}

/**
 * Hook the data to the wp_head.
 *
 * @since 1.0
 */
function tokokoo_custom_css_display() {
	$custom_css = get_option( 'tokokoo_custom_css' );
	
	if ( $custom_css != '' ) {
		echo "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . wp_filter_nohtml_kses( $custom_css['custom_css'] ) . "\n</style>\n";
	}
}
?>