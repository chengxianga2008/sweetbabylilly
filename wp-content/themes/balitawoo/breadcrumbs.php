<?php
	$args = array(
		'separator' => '/',
		'before' =>'',
		'after' => false,
		'front_page' => true,
		'show_home' => __( 'Home', 'breadcrumb-trail' ),
		"singular_{$post_type}_taxonomy" => false,
		'echo' => true
	);
	if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( $args );
?>