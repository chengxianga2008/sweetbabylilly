<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Landing Template
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

    include_once "landing_logic.php";
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

<?php include_once "landing_template.php"; ?>

<!-- foot -->
<?php wp_footer(); ?>

   <script type="text/javascript">
                jQuery(document).ready(function($){

                  $.material.init();
                });
   </script>
</body>
</html>