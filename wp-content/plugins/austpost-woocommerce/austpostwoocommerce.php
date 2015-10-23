<?php
/*
	Plugin Name: WooCommerce - Australia Post Shipping Calculator
	Plugin URI: http://dtbaker.com.au/
	Description: Allow shipping calculation from Australia Post API in WooCommerce
	Version: 1.88
    1.6 - support for  smallletters.
    1.8 - support for large letters
    1.81 - fix for grams/kg error
    1.82 - fix for combined weight, we check each individual product for weight/size issues first then combine.
    1.83 - NT post code fix
    1.84 - 2013-04-13 - updated austpost api
    1.85 - 2013-04-14 - better letter size checking
    1.86 - 2013-04-14 - fix for international extra cover
    1.87 - 2013-05-06 - fix for international extra cover
    1.88 - 2013-10-08 - api key in options
	Author:  David Baker
	Author URI: http://dtbaker.net
    Support: For all support please use http://codecanyon.net/user/dtbaker
	License: Please purchase a license for this item at CodeCanyon.net
    Date: Oct 8th 2013
    Text Domain: austpostwoocommerce
*/


function australia_post_woocommerce_shipping_init(){
    include_once('australia_post.php');
}
add_action('woocommerce_shipping_init', 'australia_post_woocommerce_shipping_init');


include_once('plugin_update.php');

