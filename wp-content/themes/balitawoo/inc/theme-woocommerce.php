<?php

// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;

/**
 * Any WooCommerce overrides and functions can be found here
 *
 * @package tokokoo
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */

if ( class_exists( 'woocommerce' ) ) {


	/* Disable WooCommerce styles */
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	 	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	 } else {
	 	define( 'WOOCOMMERCE_USE_CSS', false );
	 }
	
	
	add_theme_support( 'woocommerce' );

	// My account URL on header.php
	function tokokoo_my_account_url() {
		printf ( __( '<a class="top-account" href="%s">My Account</a>', 'balitawoo' ), get_permalink( wc_get_page_id( 'myaccount' ) ) );
	}

	function balitawoo_your_cart_url() {
		global $woocommerce;
		?>
			<div class="cartbox">
				<div class="cartbox-top">
					<span class="this-arrow">arrow</span>
					<h3><?php _e('Shopping Sac','balitawoo') ?></h3>
					<p class="stat">
						<?php echo sprintf(_n('%d Item', '%d Items', $woocommerce->cart->cart_contents_count, 'balitawoo'), $woocommerce->cart->cart_contents_count);?> <span>|</span> <?php echo $woocommerce->cart->get_cart_subtotal(); ?>
					</p>
				</div>
				<?php the_widget( 'WC_Widget_Cart' ); ?>
				<!-- cartdrop -->
			</div>
		<?php 	
	}
	
	/**
	 * Hook in default WooCommerce image setting
	 */
	global $pagenow;
	if ( is_admin() )
		add_action( 'init', 'tokokoo_woocommerce_image_dimensions', 1 );

	/**
	 * Define image sizes
	 */
	function tokokoo_woocommerce_image_dimensions() {
		$catalog = array(
			'width' => '250', // px
			'height' => '250', // px
			'crop' => 1 // true
		);

		$single = array(
			'width' => '320', // px
			'height' => '330',// px
			'crop' => 0 // true
		);

		$thumbnail = array(
			'width' => '70', // px
			'height' => '70', // px
			'crop' => 1 // true
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
		update_option( 'shop_single_image_size', $single ); // Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
	}
	/**
	 * Returns true if on WooCommerce pages
	 * Includes: Cart, Checkout, Pay, Thanks (Order Received), View Order, Order Tracking,
	 *   My Account, Edit Address, Change Password, and Term
	 * @return boolean 
	 */
	function tokokoo_is_woocommerce_pages() {
		if (is_cart() || is_checkout() || is_account_page() )
			return true;
		else
			return false;
	}
		
	
	/**
	 * Filter product price; return 'Free' if not set
	 */
	function tokokoo_product_price() {
		
		global $product;
		
		if ($price_html = $product->get_price_html()) 
			echo $price_html;
		else
			_e( 'Free!', 'balitawoo' );

	}	
	
	
	/** Template Hooks ********************************************************/

	if ( ! is_admin() || defined('DOING_AJAX') ) {
				
		/**
		 * Remove Breadcrumbs
		 */
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
				
		/**
		 * Product Summary Box
		 */
		//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		
		/** Put other necessary Hook Removal/Addition here */
		
	}

	add_filter('woocommerce_single_product_image_thumbnail_html', 'balitawoo_single_thumbnail', 10, 2);
	function balitawoo_single_thumbnail( $html, $loop ) {
		$div = '';
		if( 0 == $loop%4 )
			$div = '</div><div class="slide">';
		return $div.'<div class="item">'.$html.'</div>';
	}

	// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	add_filter('add_to_cart_fragments', 'tokokoo_header_add_to_cart_fragment');
	function tokokoo_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		
		?>

			<p class="stat">
				<?php echo sprintf(_n('%d Item', '%d Items', $woocommerce->cart->cart_contents_count, 'tokokoo'), $woocommerce->cart->cart_contents_count);?> <span>|</span> <?php echo $woocommerce->cart->get_cart_subtotal(); ?>
			</p>
		
		<?php
		
		$fragments['.cartbox-top p.stat'] = ob_get_clean();
		
		return $fragments;
		
	}
}