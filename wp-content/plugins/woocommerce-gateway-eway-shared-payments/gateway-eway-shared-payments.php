<?php
/*
	Plugin Name: WooCommerce eWAY Shared Payments Gateway
	Plugin URI: http://www.woothemes.com/
	Description: A payment gateway for eWAY Australia, New Zealand and United Kingdom using their Shared Payments method.
	Version: 1.0.5
	Author: WooThemes
	Author URI: http://www.woothemes.com/
	Requires at least: 3.5
	Tested up to: 3.5

	Copyright: 2013 Gerhard Potgieter.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '292fac5aba58f6276542821fe23a4099', '184998' );

add_action( 'plugins_loaded', 'woocommerce_eway_shared_init', 0 );

function woocommerce_eway_shared_init () {
	if ( ! class_exists( 'WC_Payment_Gateway' ) )
		return;

	require_once( plugin_basename( 'classes/class-wc-eway-shared.php' ) );

	add_filter('woocommerce_payment_gateways', 'woocommerce_eway_shared_add_gateway' );
}

// Add the payment gateway to the WooCommerce methods
function woocommerce_eway_shared_add_gateway( $methods ) {
	$methods[] = 'WC_EWAY_Shared'; return $methods;
}
?>