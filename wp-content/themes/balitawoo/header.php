<!DOCTYPE html>
<!--[if IE 8]>    <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<title><?php hybrid_document_title(); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

<?php wp_head(); ?>

</head>

<?php

//$geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );

// echo $geoPlugin_array['geoplugin_countryCode'] ;
 
//if ( $geoPlugin_array['geoplugin_countryCode'] == 'US' ) { 
 
	//header('Location: http://sweetbabylilly.com/');
 
//} 




?>

<body class="<?php hybrid_body_class(); ?>">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-46731335-1', 'auto');
  ga('send', 'pageview');
 
</script>	
	<div class="hfeed site" id="page">
		<?php if ( '' != of_get_option( 'balitawoo_header_banner' ) ) : ?>
		<div id="headbanner">
			<p>
				<strong><?php echo of_get_option( 'balitawoo_header_banner' ); ?></strong>
			</p>
		</div>
		<?php endif; ?>
		
		<div id="container">
			<header id="masthead" class="site-header" role="banner">
			
			<?php tokokoo_site_title(); ?>
			<!-- logo -->
			<div style="float:right; max-width:780px;">
			<div id="loginsearch">
				<p class="loginmenu">

<a class="" title="USD" href="http://sweetbabylilly.com/">

    <img alt="USD" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/08/eng.png"></img>

</a>
<a class=" " title="AUD"  href="http://sweetbabylilly.com.au/">

    <img alt="AUD" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/08/aus.jpg"></img>

</a>


               <span style="color: #FFFFFF; font-size: 1.3em;"><img src="http://sweetbabylilly.com.au/wp-content/themes/balitawoo/core/assets/img/phone16.png" alt=""/> 1300 661 072</span><span>|</span>
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
                <div style="float:right; color: #FFFFFF; font-size: 1.5em; text-align:right; margin: 15px 20px 0 0;"> Free Shipping on orders over $98!</div>
                </div>
			<div class="clear">
			</div>
			<?php
		 		get_template_part( 'menu', 'primary' );
		 	?>
		 	<?php if ( function_exists( 'balitawoo_your_cart_url' ) ) balitawoo_your_cart_url(); ?>
			</header>
		<div id="main" class="site-main cl">
	<?php //echo do_shortcode( '[koo-slides id="14"]' ); ?>
