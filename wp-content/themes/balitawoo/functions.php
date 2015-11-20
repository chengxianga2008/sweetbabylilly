<?php

/* banner settings */

function banner_settings_api_init() {
	// Add the section to reading settings so we can add our
	// fields to it
	add_settings_section(
			'banner_setting_section',
			'Sweet Lilly Banner Settings',
			'banner_setting_section_callback_function',
			'general'
	);

	// Add the field with the names and function to use for our new
	// settings, put it in our new section
	add_settings_field(
			'banner_setting_text',
			'Banner Text',
			'banner_setting_callback_function',
			'general',
			'banner_setting_section'
	);
	
	add_settings_field(
			'banner_setting_text_width',
			'Banner Text Width',
			'banner_setting_text_width_callback_function',
			'general',
			'banner_setting_section'
	);

	// Register our setting so that $_POST handling is done for us and
	// our callback function just has to echo the <input>
	register_setting( 'general', 'banner_setting_text' );
	register_setting( 'general', 'banner_setting_text_width' );
} // eg_settings_api_init()

add_action( 'admin_init', 'banner_settings_api_init' );


// ------------------------------------------------------------------
// Settings section callback function
// ------------------------------------------------------------------
//
// This function is needed if we added a new section. This function
// will be run at the start of our section
//

function banner_setting_section_callback_function() {
	echo '<p>Enter banner settings below</p>';
}

// ------------------------------------------------------------------
// Callback function for our example setting
// ------------------------------------------------------------------
//
// creates a checkbox true/false option. Other types are surely possible
//

function banner_setting_callback_function() {
	echo '<textarea name="banner_setting_text" cols="50" rows="5" class="banner_setting_text" />'.get_option( 'banner_setting_text' ).'</textarea>';
}

function banner_setting_text_width_callback_function() {
	echo '<input name="banner_setting_text_width" value="'.get_option( 'banner_setting_text_width' ).'" type="text" class="banner_setting_text_width" />';
}


/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Load the tokokoo core framework. */
require_once( trailingslashit( get_template_directory() ) . 'core/tokokoo.php' );

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'balitawoo_theme_setup_' );

/* Load additional libraries. */
add_action( 'after_setup_theme', 'tokokoo_load_libraries', 15 );

/**
 * Theme setup function. This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 1.0
 */


	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	// remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30 );

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
 
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'AUD': $currency_symbol = 'AUD&nbsp;$'; break;
     }
     return $currency_symbol;
}


function balitawoo_theme_setup_() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Set content width. */
	hybrid_set_content_width( 670 );

	/* Tokokoo features. */
	// add_theme_support( 'tokokoo-post-types', array( 'slides' ) );

	/* Add theme support for core framework features. */
	add_theme_support( 
		'hybrid-core-menus', 
		array( 'primary' ) 
	);
	
	add_theme_support( 
		'hybrid-core-sidebars', 
		array( 'primary', 'subsidiary' , ) 
	);

	/* Add theme support for framework extensions. */
	add_theme_support( 
		'theme-layouts', 
		array( '1c', '1c-full', '2c-l', '2c-r' ), array( 'default' => '2c-l' ) 
	);

	add_theme_support(
		'post-formats',
		array('quote', 'audio', 'image', 'video'
	));

	/* Add theme support for WordPress features. */
	add_editor_style();
	add_theme_support( 
		'custom-background',
		array( 'default-color' => 'ffffff' )
	);

	/* Tokokoo features. */
	if ( class_exists( 'Tokokoo_Extensions' ) ) {
		add_theme_support( 'tokokoo-post-types', array( 'slides' ) );
		add_theme_support( 'tokokoo-shortcodes' );
		add_theme_support( 'tokokoo-custom-css' );
		add_theme_support( 'tokokoo-customizer' );
		add_theme_support( 'tokokoo-facebook-app' );
		add_theme_support( 'tokokoo-image-resizer' );
	}



	/* Embed width defaults. */
	add_filter( 'embed_defaults', 'tokokoo_embed_defaults' );

	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'tokokoo_disable_sidebars' );
	add_action( 'template_redirect', 'tokokoo_one_column' );
	add_action( 'template_redirect', 'tokokoo_one_column_full' );
	add_filter( "{$prefix}_sidebar_defaults", 'balitawoo_sidebar_defaults_args', 10, 2 );

	/* Register custom sidebar. */
	add_action( 'widgets_init', 'balitawoo_register_custom_sidebars', 15 );

	/* Add custom image sizes. */
	add_action( 'init', 'tokokoo_add_image_sizes' );
	/* Add custom image sizes. */
	add_action( 'init', 'balita_load_scripts' );
	/* Add custom image sizes custom name. */
	add_filter( 'image_size_names_choose', 'tokokoo_custom_name_image_sizes', 11, 1 );

	/* Load the theme styles & scripts. */
	add_action( 'wp_enqueue_scripts', 'tokokoo_scripts' );

	/* Add no widgets layout. */
	add_filter( 'theme_layouts_strings', 'tokokoo_register_theme_layout' );

	/* Filter size of the gravatar on comments. */
	add_filter( "{$prefix}_list_comments_args", 'tokokoo_comments_args' );

	/* Ignore some selectors for the Color Palette extension in the theme customizer. */
	add_filter( 'color_palette_preview_js_ignore', 'tokokoo_cp_preview_js_ignore', 10, 3 );

	/* Load the media grabber. */
	add_theme_support( 'hybrid-core-media-grabber' );

}

/**
 * Loads some additional PHP scripts into the theme for usage.
 *
 * @since 1.0
 */
function tokokoo_load_libraries() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
	
	/* Load WooCommerce custom functions if the plugin exist. */
	if ( class_exists( 'woocommerce' ) ) {
		require_once( trailingslashit ( THEME_DIR ) . 'inc/theme-woocommerce.php' );
	}

	/* Load custom options setting. */
	require_once( trailingslashit ( THEME_DIR ) . 'inc/theme-settings.php' );

	/* Load customizer */
	require_once(  trailingslashit ( THEME_DIR ) . 'inc/theme-customizer.php' );

	/* Needed plugins. */
 	require_once( trailingslashit ( THEME_DIR ) . 'inc/plugins.php' );


}

/**
 * Overwrites the default widths for embeds. This is especially useful for making sure videos properly
 * expand the full width on video pages. This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 1.0
 */
function tokokoo_embed_defaults( $args ) {

	$args['width'] = 670;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-1c-full' == $layout )
			$args['width'] = 970;

	}

	return $args;
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 1.0
 */
function tokokoo_one_column() {
	if ( is_attachment() && 'layout-default' == theme_layouts_get_layout() )
		add_filter( 'get_theme_layout', 'tokokoo_theme_layout_one_column' );
}

/**
 * Function for deciding which pages should have a one-column Full layout.
 *
 * @since 1.0
 */
function tokokoo_one_column_full() {

	if ( is_post_type_archive( 'portfolio' ) || is_page_template( 'page-templates/shop-fullwidth.php' ) ){
		add_filter( 'get_theme_layout', 'tokokoo_theme_layout_one_column_full' );
	}
	
	if ( class_exists( 'woocommerce' ) && ( tokokoo_is_woocommerce_pages() ) ) {
		add_filter( 'get_theme_layout', 'tokokoo_theme_layout_one_column_full' );
	}

}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 1.0
 */
function tokokoo_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c-full'.
 *
 * @since 1.0
 */
function tokokoo_theme_layout_one_column_full( $layout ) {
	return 'layout-1c-full';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 1.0
 */
function tokokoo_disable_sidebars( $sidebars_widgets ) {

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() || 'layout-1c-full' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
		}

	}

	return $sidebars_widgets;

}

/**
 * Adds custom image sizes.
 *
 * @since 1.0
 */
function tokokoo_add_image_sizes() {

	add_image_size( 'tokokoo-widget', 45, 45, true );
	add_image_size( 'tokokoo-featured', 670, 377, true );
	add_image_size( 'blog', 770, 320 , true);
	add_image_size( 'slider', 1170, 440 , true);
	add_image_size( 'featured', 255, 170 , true);
	add_image_size( 'secondary-slider', 125, 125, true);
	add_image_size( 'related-image', 95, 115 );
	add_image_size( 'list-thumbnail', 100, 100 );
	set_post_thumbnail_size( 70, 70 );

}


function balita_load_scripts() {
	if (!is_admin()) {
        //Register Script
        wp_enqueue_script( 'nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'), '' );
        wp_enqueue_script( 'nivo-slider-pack', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array('jquery'), '' );
        wp_enqueue_script( 'method', get_template_directory_uri() . '/js/methods.js', array('jquery'), '', true );
        wp_enqueue_script( 'plugin', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '' );
        //wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/slides.min.jquery.js', array('jquery'), '' );
        // Load Default stylesheet 
        wp_enqueue_style( 'nivo-slider', get_template_directory_uri() . '/css/nivo-slider.css', '', ''  );
        wp_enqueue_style( 'nivo-slider-default', get_template_directory_uri() . '/css/default/default.css', '', ''  );
        wp_enqueue_style( 'font-montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', '', ''  );
        wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', '', ''  );
    
	}
}

/**
 * Adds custom image sizes custom name.
 *
 * @since 1.0
 */
function tokokoo_custom_name_image_sizes( $sizes ) {

    $sizes['tokokoo-widget'] = __( 'Widget', 'balitawoo' );
    $sizes['tokokoo-featured'] = __( 'Featured', 'balitawoo' );
 
    return $sizes;
    
}

/**
 * Load the theme styles & scripts.
 *
 * @since 1.0
 */
function tokokoo_scripts() {
	//wp_enqueue_style( 'tokokoo-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800', false, '1.0', 'all' );

	wp_enqueue_style( 'flexslider-css' );

	wp_enqueue_script( 'flexslider-js' );
	wp_enqueue_script( 'fitvids-js' );

}


/**
 * Filter size of the gravatar on comments.
 * 
 * @since 1.0
 */
function tokokoo_comments_args( $args ) {
	$args['avatar_size'] = 60;
	return $args;
}

function list_thumbnail_sizes(){
 	global $_wp_additional_image_sizes;
 	$sizes = array();
	foreach( get_intermediate_image_sizes() as $s ){
		$sizes[ $s ] = array( 0, 0 );
		if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
			$sizes[ $s ][0] = get_option( $s . '_size_w' );
			$sizes[ $s ][1] = get_option( $s . '_size_h' );
		}else{
			if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
				$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
		}
	}

	foreach( $sizes as $size => $atts ){
		echo $size . ' ' . implode( 'x', $atts ) . "\n";
	}
}

function balitawoo_sidebar_defaults_args( $defaults, $sidebar ) {
	if ( 'primary' == $sidebar ) {
		$defaults = array(
			'before_widget' => '<section id="%1$s" class="%1$s ">',
			'after_widget' => '</section>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		);
	}

	return $defaults;
}

add_filter( 'balitawoo_comment_form_default_fields', 'balitawoo_wrap_comment_fields', 10 );
function balitawoo_wrap_comment_fields( $fields ) {
	$limit = sizeof($fields);
	$count = 0;
	foreach( $fields as $key => $value ) {
		if( $count == 0 ){
			$fields[$key] = '<div class="input-area">'.$value;
		}
		elseif( $count == $limit-1 ) {
			$fields[$key] .= '</div>';
			break;
		}
		$fields[$key] .= '</br>';

		$count++;
	}
	return $fields;
}

add_filter( 'balitawoo_list_comments_args', 'balitawoo_comments_args' );
function balitawoo_comments_args( $args ) {

	$args['avatar_size'] = 50;
	return $args;
}

function balitawoo_register_custom_sidebars() {
	if ( class_exists( 'woocommerce' ) ) {	
		
		register_sidebar(
			array(
				'id' => 'shop',
				'name' => __( 'Shop', 'balitawoo' ),
				'description' => __( 'The widget area appears on the shop page.', 'balita' ),
				'before_widget' => '<section id="%1$s" class="%1$s kucing">',
				'after_widget' => '</section>',
				'before_title' => '<h3>',


				'after_title' => '</h3>'
			)
		);
				
	}
}


/* Code below this line is used to handle load post using ajax */
add_action('wp_enqueue_scripts','balita_enqueue_ajax_script');
function balita_enqueue_ajax_script(){
	/* Due to some unknown reason, is_page_template can't detect the template */
    // if ( is_page_template( 'blog_ii.php' ) ) {
    	wp_register_script( "ajaxify_script", get_template_directory_uri().'/js/ajaxify.js', array('jquery') );
		wp_localize_script( 'ajaxify_script', 'ajaxify', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

		wp_enqueue_script( 'ajaxify_script' );
		// echo "Ini masuk";
		// die();
    // }
}

add_action("wp_ajax_ajaxify_load_post", "ajaxify_load_post");
add_action("wp_ajax_nopriv_ajaxify_load_post", "ajaxify_load_post");

function ajaxify_load_post() {
	if ( !wp_verify_nonce( $_POST['nonce'], "ajaxify_load_post_nonce")) {
    	exit("No naughty business please");
	}

	$query = new WP_Query( array( 'post_type' => 'post', 'offset' => $_POST['page']*get_option( 'posts_per_page' ) ) );

	if ( $query->have_posts() ){
		$result = array();
		$result['data'] = array();
		$counter = 0;
		while ( $query->have_posts() ):
			$query->the_post(); 
			ob_start(); 
			get_template_part( 'contents', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
	 		$result['data'][$counter] = ob_get_clean();
	 		$counter++;
		endwhile;
		$result['type'] = 'success';
	}
	else {
		$result['type'] = 'failed';
	}

	header('Content-type: application/json');
	echo json_encode($result);
	die();
}
/* End of ajax handler */

function tokokoo_flexslider_markup( $slides, $get_width, $get_height, $crop_img ) {
	global $post, $wp_embed;

		echo '<div class="slider-wrapper theme-default">';

      		if ( is_array( $slides ) ) :

				$slider['init'] = '<div id="slider" class="nivoSlider">';
				$slider['data'] = array();

				foreach( $slides as $post ) : setup_postdata( $post );

					$get_url	= esc_url( get_field( 'tokokoo_slide_url', get_the_ID() ) ); // get the url 
					$get_video	= esc_url( get_field( 'tokokoo_slide_video', get_the_ID() ) ); // get the video url

					$img 		= wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
					$new_img 	= aq_resize( $img, $get_width, $get_height, $crop_img ); //resize & crop the image
					ob_start();

					if( $img )
						echo '<img src="'. esc_url( $img ) .'" alt="' . esc_attr( get_the_title() ) . '" title="#'. get_the_ID() .'" />';
					else
						echo $wp_embed->shortcode( array( 'width' => $get_width ), $get_video );

					$slider['init'] .= ob_get_clean( );

					ob_start();

					echo '<div id="'. get_the_ID() .'" class="nivo-html-caption">';
						echo '<h2>'. get_the_title( ) .'</h2>';
						echo '<p>'. the_content( ) .'</p>';
						echo '<div class="browse"><a href="'. $get_url .'">browse  collections</a></div>';
					echo '</div>';

					$slider['data'][] = ob_get_clean();

				endforeach;

				$slider['init'] .= '</div>';

			endif;

			echo $slider['init'];
			foreach ($slider['data'] as $data ) {
				echo $data;
			}

		echo '</div><!-- .slider-wrapper -->';
	

}

function balitawoo_get_thumbnail_src( $size ) {
	global $_product;
	if ( function_exists( 'get_product' ) ) {
		$_product = get_product( get_the_ID() );
	} else {
		$_product = new WC_Product( get_the_ID() );
	}
	$src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false, '');
	if ( !is_array($size) )
		$size_arr = balitawoo_get_image_size($size);
	else
		$size_arr = $size;
	echo $src[0] != '' ? $src[0] : 'http://placehold.it/'.$size_arr['width'].'x'.$size_arr['height'].'/eeeeee/ffffff&amp;text=Item';
}

function balitawoo_get_image_size( $name ) {
	global $_wp_additional_image_sizes;

	if ( isset( $_wp_additional_image_sizes[$name] ) )
		return $_wp_additional_image_sizes[$name];

	return false;
}

function tokokoo_post_meta() { ?>
	<div class="meta">
		<?php echo apply_atomic_shortcode( 'entry_byline', __( 'Published under [entry-terms taxonomy="category"] at [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'balitawoo' ) ); ?>
		<?php _e( 'By ', 'balitawoo' ); ?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
	</div>
<?php }


