<?php
/**
 * Forgot Password Call Back Function
 * */
function jobs4you_forgot_email_fn() {
	global $wpdb;
    $forgot_email = $_REQUEST['forgot_email'];
    $response = array();
    if (empty($forgot_email)) {
		$response['code'] = 200;
		$response['message'] = __("The field 'user_login' is required.", "jobs4you");
    } else {
        $user_id = username_exists($forgot_email);
        if ($user_id == false) {
            $user_id = email_exists($forgot_email);
            if ($user_id == false) {
				$response['code'] = 401;
				$response['message'] = __("User '" . $forgot_email . "' Not Found", "jobs4you");
            }
        }
    }
    $user = get_user_by('email', $forgot_email);
    if($user){
	    $key = get_password_reset_key($user);
	    $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
	    $rp_link = '<a href="' . jobs4you_validate_url() . "action=rp&key=$key&login=" . rawurlencode($user->user_login) . '">' . jobs4you_validate_url() . "action=rp&key=$key&login=" . rawurlencode($user->user_login) . '';
		$message = __('Someone requested For the password reset for the following account:') . "<br><br><br>";
		$message .= get_option('siteurl') . "<br><br>";
		$message .= sprintf(__('Username: %s'), $user->user_login) . "<br><br><br>";
		$message .= __('If this was a error, just ignore this email as no action will be taken.') . "<br><br>";
		$message .= __('To reset your password, visit the following address:') . "<br><br>";
		$message .= '<a href="'.jobs4you_validate_url() . "action=rp&key=$key&login=" . rawurlencode($user->user_login) . '" > '.jobs4you_validate_url() . "action=rp&key=$key&login=" . rawurlencode($user->user_login) ."</a><br><br>";	

		$headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: help@jobs4you.com' . "\r\n";

		$email_successful = wp_mail($forgot_email, 'Reset password', $message, $headers);

		if ($email_successful) {
	        $response['code'] = 200;
	        $response['message'] = __("Reset Password link has been sent to your email.", "wp-rest-user");
	    } else {
	        $response['code'] = 402;
			$response['message'] = __("Failed to send Reset Password email.", "jobs4you");
	    }
	}else{
		$response['code'] = 402;
		$response['message'] = __("User '" . $forgot_email . "' Not Found", "jobs4you");
	}

	
	wp_send_json($response);
    wp_die();
}

add_action( 'wp_ajax_nopriv_forgot_email_fn', 'jobs4you_forgot_email_fn' );
add_action( 'wp_ajax_forgot_email_fn', 'jobs4you_forgot_email_fn' );
/**
 * Url For reset Password
 * */
function jobs4you_validate_url() {
	global $post;
	$page_url = esc_url(get_permalink( get_page_by_path( 'reset-password' )));
	$urlget = strpos($page_url, "?");
	if ($urlget === false) {
		$concate = "?";
	} else {
		$concate = "&";
	}
	return $page_url.$concate;
}

/**
 * Rest Password Call Back Function
 * */
function jobs4you_reset_pass_fn() {
	global $wpdb;
    $rest_pwd = $_REQUEST['rest_pwd'];
    $useremail = $_REQUEST['useremail'];
    $userlogin = $_REQUEST['userlogin'];
    $userID = $_REQUEST['userID'];
    $response = array();
    $passreset = wp_set_password($rest_pwd,$userID);
    echo 1;
    wp_die();
}

add_action( 'wp_ajax_nopriv_reset_pass_fn', 'jobs4you_reset_pass_fn' );
add_action( 'wp_ajax_reset_pass_fn', 'jobs4you_reset_pass_fn' );/**
 
 * Rest Password Call Back Function
 * */
function jobs4you_change_pass_fn() {
	global $wpdb;
    $old_pwd = trim($_REQUEST['old_pwd']);
    $new_pwd = trim($_REQUEST['new_pwd']);
    $userlogin = $_REQUEST['userlogin'];
    $userID = $_REQUEST['userID'];
    $user = wp_get_current_user();
    $response = array();
	if ( !wp_check_password( $old_pwd, $user->data->user_pass, $user->ID ) ) {
		$response['code'] = 402;
		$response['message'] = __("Old Password wrong..", "jobs4you");
	}else{
		wp_set_password( $new_pwd, $user->ID );
		do_action( 'wp_login', $user->user_login, $user );
		wp_set_current_user( $user->ID );
		wp_set_auth_cookie( $user->ID );
   		$response['code'] = 200;
		$response['message'] = __("Password Changed.", "jobs4you");
	}
	wp_send_json($response);
    wp_die();
}

add_action( 'wp_ajax_nopriv_change_pass_fn', 'jobs4you_change_pass_fn' );
add_action( 'wp_ajax_change_pass_fn', 'jobs4you_change_pass_fn' );