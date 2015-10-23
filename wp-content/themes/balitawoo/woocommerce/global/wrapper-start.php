<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php 

if(is_product()){
			echo '';
		}elseif(is_cart()){
			echo '';

		}elseif(is_checkout()){
			echo '';
		}else{
			echo '<h3>Products</h3>';
	}

?>