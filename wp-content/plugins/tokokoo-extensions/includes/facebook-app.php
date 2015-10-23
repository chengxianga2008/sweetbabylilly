<?php
/**
 * Facebook App Setting
 * 
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register setting. */
add_action( 'admin_init', 'tokokoo_register_facebook_apps_setting' );

/* Add the Facebook App menu. */
add_action( 'admin_menu', 'tokokoo_facebook_app_menu', 21 );

/**
 * Register the setting.
 *
 * @since 1.0
 */
function tokokoo_register_facebook_apps_setting() {
	register_setting( 'tokokoo_facebook_app', 'tokokoo_facebook_app', 'tokokoo_facebook_app_setting_validate' );
}

/**
 * Add the custom css menu to the admin menu.
 *
 * @since 1.0
 */
function tokokoo_facebook_app_menu() {

	$settings = add_theme_page( __( 'Facebook App', 'tokokoo' ), __( 'Facebook App', 'tokokoo' ), 'edit_theme_options', 'tokokoo-facebook-app', 'tokokoo_facebook_app_page' );

	if ( ! $settings )
		return;

}

/**
 * Render the Facebook App page
 *
 * @since  1.0
 */
function tokokoo_facebook_app_page() {
	$options = get_option( 'tokokoo_facebook_app' );
	$fb_app = isset( $options['fb_app'] ) ? $options['fb_app']: '';

	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );
	?>

	<div class="wrap">

		<div id="icon-tools" class="icon32"><br></div>
		<h2><?php printf( __( 'Facebook App for %s', 'tokokoo' ), $theme->Name ); ?></h2>
		<?php settings_errors(); ?>

		<form action="options.php" method="post">

			<?php settings_fields( 'tokokoo_facebook_app' ); ?>

			<div class="updated settings-error below-h2">
				<p>Based on <a href="https://developers.facebook.com/blog/post/497/" target="_blank">Facebook announced</a>, you need to use a secure SSL (Secure Socked Layer) connection to enable this feature.</p>
			</div>

			<p>This feature enables you to market your products through one of the biggest social networking in the world. Reach the highest sales potential with this Facebook integration feature.</p>
			<p><strong>How to activate Facebook Apps Integration widget.</strong></p>
			<ol>
			    <li><a href="https://developers.facebook.com/apps" target="_blank"><img src="<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/create-fb-apps.png'; ?>"></a></li>
			    <li>To start creating Facebook app you need to register as developer.</li>
			    <li>After that, click the Create New App button. Fill the App Name.</li>
			    <li>Copy and paste your <strong>App ID</strong> to the input box below.</li>
			    <li>Save this theme settings.</li>
			    <li>On Facebook apps. Choose <strong>Page Tab</strong>(at the bottom), then fill the <strong>Page Tab Name</strong> with 'My Store' or something else.</li>
			    <li>Fill the <strong>Page Tab URL</strong> with <strong><?php echo esc_url( home_url('/') ); ?></strong></li>
			    <li>And fill the <strong>Secure Page Tab URL</strong> with <strong><?php echo esc_url( home_url('/', 'https') ); ?></strong></li>
			    <li>Click Save Changes button.</li>
			    <li>Now you need to crete the Facebook Page.</li>
			    <li><a href="http://www.facebook.com/pages/create.php" target="_blank"><img src="<?php echo trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/create-fb-pages.png'; ?>"></a></li>
			    <li>Choose your page category and follow the steps.</li>
			    <li>Then, you need to activate the apps in your Facebook page by <a href="https://www.facebook.com/dialog/pagetab?app_id=<?php echo wp_kses_data( $fb_app ); ?>&next=<?php echo esc_url( home_url('/') ); ?>" target="_blank">clicking this link</a>.</li>
			    <li>You will be redirected to the <strong>Add Page Tab</strong> page, choose facebook pages that you already created before. Click the add page tab button.</li>
			    <li><strong>Voila!</strong> Your online store is now integrated with its Facebook fan page.</li>
			</ol>
			
			<br class="clear">

			<p><strong><?php _e( 'Enter your App ID here.', 'tokokoo' ); ?></strong></p>
			<input id="tokokoo-fb-app" class="regular-text" type="text" name="tokokoo_facebook_app[fb_app]" value="<?php echo wp_kses_data( $fb_app ); ?>" />
			
			<?php submit_button( esc_attr__( 'Save Settings', 'tokokoo' ) ); ?>

		</form>

	</div>
	<?php
}

/**
 * Sanitize and validate form input.
 *
 * @since 1.0
 */
function tokokoo_facebook_app_setting_validate( $input ) {
	$input['fb_app'] = wp_kses_data( $input['fb_app'] );
	return $input;
}
?>