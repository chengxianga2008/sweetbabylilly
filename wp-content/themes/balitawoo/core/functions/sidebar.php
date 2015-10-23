<?php
/**
 * Extra Sidebar
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register custom sidebar for woocommerce plugin. */
add_action( 'widgets_init', 'tokokoo_register_extra_sidebars', 15 );

/**
 * Registers custom sidebars.
 * 
 * @since 1.0
 */
function tokokoo_register_extra_sidebars() {
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		
		register_sidebar(
			array(
				'id' => 'shop',
				'name' => __( 'Shop', 'balitawoo' ),
				'description' => __( 'The widget area loaded on the shop page.', 'balitawoo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-wrap widget-inside">',
				'after_widget'  => '</div></section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);

	}

}
?>