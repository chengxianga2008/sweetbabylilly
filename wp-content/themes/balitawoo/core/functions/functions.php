<?php
/**
 * Custom functions to help theme developer.
 *
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/**
 * Site title/logo.
 * 
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_site_title' ) ):
function tokokoo_site_title() {

	$logo = get_theme_mod( 'tokokoo_logo' );

	if ( $logo ) {
		
		$logotag  = ( is_home() || is_front_page() ) ? 'h1':'div';
			
			echo '<' . $logotag . ' id="logo">' . "\n";
				echo '<a href="' . esc_url( get_home_url() ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home">' . "\n";
					echo '<img class="logo" src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '" />' . "\n";
				echo '</a>' . "\n";
			echo '</' . $logotag . '>' . "\n";

	} else {
		hybrid_site_title(); // Site Title
	}

}
endif;

/**
 * Additional Menu.
 * 
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_additional_menu' ) ):
function tokokoo_additional_menu() {

	echo '<nav class="additional-menu" role="navigation">';
		if ( ! is_user_logged_in() ) {
			echo '<a class="nav-account" href="' . esc_url( wp_login_url( home_url() ) ) . '">' . __( 'Login', 'balitawoo' ) . '</a>';
			echo '<a class="nav-reg" href="' . esc_url( site_url( 'wp-login.php?action=register' ) ) . '">' . __( 'Register', 'balitawoo' ) . '</a>';
		} else {
			echo '<a class="nav-logs" href="' . esc_url( wp_logout_url( home_url() ) ) . '">' . __( 'Logout', 'balitawoo' ) . '</a>';
			if ( function_exists( 'tokokoo_my_account_url' ) ) tokokoo_my_account_url();
		}
	echo '</nav>';

}
endif;

/**
 * Retrieves embedded audio from the post content.  This script only searches for embeds used by 
 * the WordPress embed functionality.
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_get_audio' ) ):
function tokokoo_get_audio( $args = array() ) {
	global $wp_embed;

	/* If this is not a 'audio' post, return. */
	if ( !has_post_format( 'audio' ) )
		return false;

	/* Merge the input arguments and the defaults. */
	$args = wp_parse_args( $args, wp_embed_defaults() );

	/* Get the post content. */
	$content = get_the_content();

	/* Set the default $embed variable to false. */
	$embed = false;

	/* Use WP's built in WP_Embed class methods to handle the dirty work. */
	add_filter( 'post_format_tools_audio_shortcode_embed', array( $wp_embed, 'run_shortcode' ) );
	add_filter( 'post_format_tools_audio_auto_embed', array( $wp_embed, 'autoembed' ) );

	/* We don't want to return a link when an embed doesn't work.  Filter this to return false. */
	add_filter( 'embed_maybe_make_link', '__return_false' );

	/* Check for matches against the [embed] shortcode. */
	preg_match_all( '|\[embed.*?](.*?)\[/embed\]|i', $content, $matches, PREG_SET_ORDER );

	/* If matches were found, loop through them to see if we can hit the jackpot. */
	if ( is_array( $matches ) ) {
		foreach ( $matches  as $value ) {

			/* Apply filters (let WP handle this) to get an embedded audio. */
			$embed = apply_filters( 'post_format_tools_audio_shortcode_embed', '[embed width="' . absint( $args['width'] ) . '" height="' . absint( $args['height'] ) . '"]' . $value[1]. '[/embed]' );

			/* If no embed, continue looping through the array of matches. */
			if ( empty( $embed ) )
				continue;
		}
	}

	/* If no embed at this point and the user has 'auto embeds' turned on, let's check for URLs in the post. */
	if ( empty( $embed ) && get_option( 'embed_autourls' ) ) {
		preg_match_all( '|^\s*(https?://[^\s"]+)\s*$|im', $content, $matches, PREG_SET_ORDER );

		/* If URL matches are found, loop through them to see if we can get an embed. */
		if ( is_array( $matches ) ) {
			foreach ( $matches  as $value ) {

				/* Let WP work its magic with the 'autoembed' method. */
				$embed = apply_filters( 'post_format_tools_audio_auto_embed', $value[0] );

				/* If no embed, continue looping through the array of matches. */
				if ( empty( $embed ) )
					continue;
			}
		}
	}

	/* Remove the maybe make link filter. */
	remove_filter( 'embed_maybe_make_link', '__return_false' );

	/* Return the embed. */
	return $embed;
}
endif;

/**
 * Display post author data on single post.
 * 
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_post_author' ) ) :
function tokokoo_post_author() {

	if ( of_get_option( 'tokokoo_post_author' ) && get_the_author_meta( 'description' ) && is_singular( 'post' ) ) { ?>

		<aside class="post-author">
			<h4 class="title"><?php _e( 'About the author', 'balitawoo' ); ?></h4>
			<div class="author-box">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tokokoo_author_bio_avatar_size', 60 ) ); ?>
				<p class="author-desc author vcard">
					<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php echo wp_kses_data( get_the_author() ); ?>
					</a> 
					<?php echo wp_kses_data( get_the_author_meta( 'description' ) ); ?>
				</p>
			</div>
		</aside>

	<?php }

}
endif;

/**
 * Display facebook like & twitter share button.
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_share_buttons' ) ) :
function tokokoo_share_buttons() {

	if( of_get_option( 'tokokoo_social_share' ) && is_singular( get_post_type() ) ) { ?>

		<div class="share-this">
			<span class="twitter-share">
				<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</span>
			<span class="facebook-share">
				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink() ); ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>
			</span>

			<?php 
				/* Allow theme developer to add another social share button. */
				do_action( 'tokokoo_add_social_button' ); 
			?>

		</div>

	<?php 
	}

}
endif;

/**
 * Add has-sidebar or no-sidebar class to the content area.
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_dynamic_sidebar_class' ) ) :
function tokokoo_dynamic_sidebar_class() {

	if( current_theme_supports( 'theme-layouts' ) && ! is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() || 'layout-1c-full' == theme_layouts_get_layout() ) {
			echo 'no-sidebar';
		} else {
			echo 'has-sidebar';
		}

	}
}
endif;

/**
 * Dynamic footer text.
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_footer_text' ) ) :
function tokokoo_footer_text() {
	$footer_text = of_get_option( 'tokokoo_credits' );
?>
	<div class="footer-text">
		<p class="copyright">
			<span class="footer-content"><?php hybrid_footer_content(); ?></span>
			<?php if ( $footer_text == false ) { 
				printf( __( '- Theme by <a href="%1$s" title="%2$s" rel="designer">%3$s</a>', 'balitawoo' ),
					esc_url( 'http://tokokoo.com' ),
					esc_attr( 'Premium Ecommerce WordPress Themes' ),
					esc_attr( 'balitawoo' )
				);
			}
			?>
		</p>
	</div>
<?php
}
endif;


/**
 * IE Warning.
 * 
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_ie_warning_message' ) ) :
function tokokoo_ie_warning_message() {
	if ( of_get_option( 'tokokoo_ie_warning' ) == true ) {
?>	
<!--[if lte IE 8]>
	<style>
	.chromeframe {
		background: #FFF7D6;
		border: 1px solid #E9D477;
		color: #956433;
		padding: 10px 0;
		position: fixed;
		text-align: center;
		width: 100%;
		z-index: 99;
	}
	.chromeframe a {
		color: #FBA344;
	}
	</style>

    <p class="chromeframe">
    	You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.
    </p>
<![endif]-->
<?php 
	}	
}
endif;
?>