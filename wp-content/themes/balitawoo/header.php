<!DOCTYPE html>
<!--[if IE 8]>    <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no ">

<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<title><?php hybrid_document_title(); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

<?php 

	
	wp_enqueue_style ( 'bootstrap3-style', get_stylesheet_directory_uri () . '/css/bootstrap3.min.css', array (), '1.0.0' );
	
	wp_enqueue_style ( 'fa-style', get_stylesheet_directory_uri () . '/css/font-awesome.min.css', array (), '1.0.0' );

	wp_enqueue_style ( 'animate-style', get_stylesheet_directory_uri () . '/css/animate.min.css', array (), '1.0.0' );
	
	wp_enqueue_style ( 'buttons-style', get_stylesheet_directory_uri () . '/css/buttons.css', array (), '1.0.0' );
	
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css', 'style', ''  );
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/theme_style.css', 'style', ''  );
 
	wp_enqueue_script ( 'bootstrap3-js', get_stylesheet_directory_uri () . '/js/bootstrap3.min.js', array (
	'jquery'
			), '2014-07-18', true );
	
	wp_enqueue_script ( 'waypoints-js', get_stylesheet_directory_uri () . '/js/jquery.waypoints.min.js', array (
			'jquery'
	), '2014-07-18', true );
	
	wp_enqueue_script ( 'parallax-js', get_stylesheet_directory_uri () . '/js/jquery.parallax.min.js', array (
			'jquery'
	), '2014-07-18', true );
	
	wp_enqueue_script ( 'skrollr-js', get_stylesheet_directory_uri () . '/js/skrollr.min.js', array (
			'jquery'
	), '2014-07-18', true );
	
	
	wp_enqueue_script ( 'masonry-js', get_stylesheet_directory_uri () . '/js/masonry.pkgd.min.js', array (
	'jquery'
			), '2014-07-18', true );
	
	

	wp_head(); ?>

</head>

<?php

//$geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );

// echo $geoPlugin_array['geoplugin_countryCode'] ;
 
//if ( $geoPlugin_array['geoplugin_countryCode'] == 'US' ) { 
 
	//header('Location: http://sweetbabylilly.com/');
 
//} 




?>

<body class="<?php hybrid_body_class(); ?>">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
	
	<div class="hfeed site" id="page">
		<?php if ( '' != of_get_option( 'balitawoo_header_banner' ) ) : ?>
		<div id="headbanner">
			<p>
				<strong><?php echo of_get_option( 'balitawoo_header_banner' ); ?></strong>
			</p>
		</div>
		<?php endif; ?>
		
		<div id="root_container">
			<header id="masthead" class="site-header" role="banner">
			<div class="container">
			    <div class="visible-lg logo-animation">
				<div id="logo" class="animated">
					<div id="logo-wrapper">
						<a rel="home" title="Sweet Baby Lilly" href="<?php echo get_home_url(); ?>">
							<img class="logo" alt="Sweet Baby Lilly" src="<?php echo get_stylesheet_directory_uri () . '/images/logo.png'; ?>">
							
						</a>
					</div>
				</div>
				</div>
				<div class="hidden-lg">
				<div id="logo-static">
					<a rel="home" title="Sweet Baby Lilly" href="<?php echo get_home_url(); ?>">
						<img class="logo" alt="Sweet Baby Lilly" src="<?php echo get_stylesheet_directory_uri () . '/images/logo.png'; ?>">
					
					</a>
				</div>
				</div>
				<div class="hidden-lg hidden-md clearfix"></div>
				<!-- logo -->
				<div class="header-wrapper">
					<div id="loginsearch">
						<p class="loginmenu">
		
							<a class="" title="USD" href="http://sweetbabylilly.com/">
							
							    <img alt="USD" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/08/eng.png"></img>
							
							</a>
							<a class=" " title="AUD"  href="http://sweetbabylilly.com.au/">
							
							    <img alt="AUD" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/08/aus.jpg"></img>
							
							</a>
		
		
			                <span style="color: #555; font-size: 1.3em;"><i class="fa fa-phone"></i> 1300 661 072</span><span>|</span>
								<?php if ( ! is_user_logged_in() ) { ?>
			
									<a href="<?php echo wp_login_url( home_url() ); ?>"><?php _e( 'Login', 'balitawoo' ); ?></a><span>|</span>
									<a href="<?php echo site_url( 'wp-login.php?action=register' ); ?>"><?php _e( 'Register', 'balitawoo' ); ?></a>
			
								<?php } else { ?>
			
									<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><?php _e( 'My Account', 'balitawoo' ); ?></a><span>|</span>
									<a href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e( 'Logout', 'balitawoo' ); ?></a>
			
								<?php } ?> 
						</p>
						<?php get_template_part( 'searchform' ); ?>
		            </div>
		            <div class="hidden-lg hidden-md clearfix"></div>
		            <div class="banner-wrapper" style="width: <?php echo get_option( 'banner_setting_text_width' );?>px;">
		            	<div class="banner">
		            		<div class="bk l">
    							<div class="arrow top"></div> 
    							<div class="arrow bottom"></div>
  							</div>

 							<div class="skew l"></div>

  							<div class="main">
    							<div><?php echo get_option( 'banner_setting_text' );?></div>   
  							</div>

  							<div class="skew r"></div>
  
  							<div class="bk r">
    							<div class="arrow top"></div> 
    							<div class="arrow bottom"></div>
  							</div>
			            	
         				</div>
         			</div>
      				<div class="hidden-lg hidden-md clearfix"></div>	
	                <div class="header-highlight"> Free Shipping on orders over $98!</div>
	            </div>
				<div class="clear">
				</div>
				<?php
			 		get_template_part( 'menu', 'primary' );
			 	?>
			 	<?php if ( function_exists( 'balitawoo_your_cart_url' ) ) balitawoo_your_cart_url(); ?>
		 	</div>
			</header>
			<div class="clearfix"></div>
		<div id="main" class="site-main cl">
	<?php //echo do_shortcode( '[koo-slides id="14"]' ); ?>
