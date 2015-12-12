<?php
/**
 * Additional Information tab
 * 
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly
	exit;
}

global $product;

?>


<?php 

$comments_args = array(
		
		'title_reply' => 'Write A Review',
		'title_reply_to' => 'Write A Review',
);

add_filter( 'comment_form_default_fields', "custom_comment_form_field");

function custom_comment_form_field($fields){
	
	unset($fields["url"]);
	
	return $fields;
	
}

comment_form( $comments_args ); // Loads the comment form. ?>