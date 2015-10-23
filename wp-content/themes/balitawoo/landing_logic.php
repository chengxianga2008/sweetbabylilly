<?php


$is_valid = True;

if(isset($_POST['landing_form_name']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {


	$name = esc_attr(strip_tags($_POST['landing_form_name']));

	// get email address from post data
	$email = esc_attr(strip_tags($_POST['landing_form_email']));

	// VALIDATION
	$is_valid = FALSE;  // Initialise is_valid as false


	// VALID EMAIL TEST
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		// Does domain name actually exist?
		if(checkdnsrr(array_pop(explode("@",$email)),"MX")){
			$is_valid = TRUE; // email is valid
			// could go even further and lookup ip address in spam lists, and do disposable email address checks here
		}
	}


	// PROCESS
	// test if form is valid.
	if ($is_valid == TRUE) {
		// Mailchimp Add Subscriber part
		include_once 'Drewm/MailChimp.php';

		$MailChimp = new \Drewm\MailChimp('7c02a28b43861385ac9ad68a4762bb37-us11');
		$result = $MailChimp->call('lists/subscribe', array(
				'id'                => 'd9124b31f5', //b341ab9d4e
				'email'             => array('email'=> $email ),
				'merge_vars'        => array(
						'FNAME'=> $name,
				),
				'double_optin'      => false,
				'update_existing'   => true,
				'replace_interests' => false,
				'send_welcome'      => false,
		));

		wp_redirect( get_home_url(null,"landing-thanks") );
		exit;

	}

}