<?php

// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;

/**
 * Template tags
 *
 * @package tokokoo
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */

/**
 * Add custom content to the header
 *
 * @since 1.0
 */
function tokokoo_header_content() {
	?>
	
	<div class="header-right">
		
		<?php if ( ! is_user_logged_in() ) { ?>

			<a class="top-login" href="<?php echo wp_login_url( home_url() ); ?>"><?php _e( 'Login', 'balitawoo' ); ?></a>
			<a href="<?php echo site_url( 'wp-login.php?action=register' ); ?>"><?php _e( 'Register', 'balitawoo' ); ?></a>

		<?php } else { ?>

			<a class="top-login" href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e( 'Logout', 'balitawoo' ); ?></a>
			<?php if ( function_exists( 'tokokoo_my_account_url' ) ) tokokoo_my_account_url(); ?>

		<?php } ?> 
		
	</div>

	<?php
}
add_action( 'tokokoo_header', 'tokokoo_header_content', 1 );

/**
 * Load the menu-primary.php
 *
 * @since 1.0
 */
function tokokoo_load_menu_primary() {

	if ( ! is_page_template( 'page-templates/landing.php' ) )
		get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template.

}
add_action( 'tokokoo_header_after', 'tokokoo_load_menu_primary', 1 );

/**
 * Container class
 * 
 * @since 1.0
 */
function tokokoo_add_container() {
	echo '<div class="container">';
}
add_action( 'tokokoo_main_open', 'tokokoo_add_container', 1 );

/**
 * Closing container class
 * 
 * @since 1.0
 */
function tokokoo_closing_container() {
	echo '</div><!-- .container -->';
}
add_action( 'tokokoo_main_close', 'tokokoo_closing_container', 1 );

/**
 * Load the breadcrumb-trail
 *
 * @since 1.0
 */
function tokokoo_breadcrumbs() {
	
	if ( ! is_page_template( 'page-templates/landing.php' ) ) { ?>

		<div class="breadcrumb" id="breadcrumb">
			<?php 
			if ( current_theme_supports( 'breadcrumb-trail' ) )
				breadcrumb_trail( array(
					'before' => '',
					'separator' => '&raquo;',
					'show_home' => false
				) );
			?>
		</div>

		<?php get_template_part( 'loop', 'meta' ); ?>

	<?php }
}
add_action( 'tokokoo_main_open', 'tokokoo_breadcrumbs', 5 );

/**
 * Add social share to the single post.
 *
 * @since 1.0
 */
function tokokoo_social_share() {

	if( is_singular( 'post' ) ) { ?>
		<div class="share-this">
			<span class="twitter">
				<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</span>
			<span class="facebook">
				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink() ); ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
			</span>
		</div>
	<?php 
	}

}
add_action( 'tokokoo_entry_close', 'tokokoo_social_share', 1 );

/**
 * Author Box on single post.
 * 
 * @since 1.0
 */
function tokokoo_author_box() {

	if ( get_the_author_meta( 'description' ) && is_singular( 'post' ) ) { ?>

		<aside class="post-author">
			<h4 class="title"><?php _e( 'About the author', 'balitawoo' ); ?></h4>
			<div class="author-box">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tokokoo_author_bio_avatar_size', 60 ) ); ?>
				<p class="author-desc">
					<a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo esc_attr( get_the_author() ); ?></a> 
					<?php echo stripslashes( get_the_author_meta( 'description' ) ); ?>
				</p>
			</div>
		</aside>

	<?php }

}
add_action( 'tokokoo_entry_after', 'tokokoo_author_box', 1 );

/**
 * Loads sidebar-primary.php
 * 
 * @since 1.0
 */
function tokokoo_load_sidebar_primary() {
	get_sidebar( 'primary' ); // Loads the sidebar-primary.php template.
}
add_action( 'tokokoo_main_close', 'tokokoo_load_sidebar_primary', 1 );
