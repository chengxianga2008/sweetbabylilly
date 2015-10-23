<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Landing Thanks Template
 *
 * Description: A Page Template for homepage
 *
 * @package balita
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */

	

	wp_enqueue_style ( 'bootstrap3-style', get_stylesheet_directory_uri () . '/css/bootstrap3.min.css', array (), '1.0.0' );

	wp_enqueue_style ( 'material-style', get_stylesheet_directory_uri () . '/css/material-custom.min.css', array (), '1.0.0' );
	
	
	wp_enqueue_style ( 'ripples-style', get_stylesheet_directory_uri () . '/css/ripples.min.css', array (), '1.0.0' );
	
	
	wp_enqueue_style ( 'theme-custom-style', get_stylesheet_directory_uri () . '/css/theme.css', array (
		'bootstrap3-style'
	), '1.0.0' );

// Loads JavaScript file with functionality specific to classiads.

	wp_enqueue_script ( 'bootstrap3-js', get_stylesheet_directory_uri () . '/js/bootstrap3.min.js', array (
	'jquery'
			), '2014-07-18', true );
	
	wp_enqueue_script ( 'material-js', get_stylesheet_directory_uri () . '/js/material.min.js', array (
		'bootstrap3-js'
	), '2014-07-18', true );
	
	wp_enqueue_script ( 'ripples-js', get_stylesheet_directory_uri () . '/js/ripples.min.js', array (
	'material-js'
			), '2014-07-18', true );

?>

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

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

<?php wp_head(); ?>

</head>
<body>
<div class="landing_thanks_page container main thankyou">
  <div class="row">
    <div class="col-lg-7 col-md-7">
      <div class="left-col">
       <a href="" class="logo"><img src="<?php echo get_stylesheet_directory_uri();?>/css/images/logo.png" width="191" height="80" alt=""></a>   
      <h1>Thank You</h1>
       <p>Thank you for signing up to <a href="<?php echo get_home_url();?>" class="link">sweetbabylilly.com.au.</a> We’ve sent you an email with all the details on report.</p>
      
      <p class="sign-up"><strong>
        <a href="<?php echo get_home_url();?>">Click here to check out our latest specials.</a>
        </strong>
        
      </p>
      </div> 
    </div>
    <div class="col-lg-5 col-md-5">
      
    </div>
  </div>

</div>

<!-- foot -->
<?php wp_footer(); ?>

   <script type="text/javascript">
                jQuery(document).ready(function($){

                  $.material.init();
                });
   </script>
</body>
</html>