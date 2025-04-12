<?php     
/*
* Ajax for login check action hook
*/
add_action('wp_ajax_user_login_check_login', 'job4you_user_login_check_login' );
add_action('wp_ajax_nopriv_user_login_check_login', 'job4you_user_login_check_login');

function job4you_user_login_check_login() {
	$email = $_REQUEST['user_email'];
	$password = $_REQUEST['user_pwd'];
	$user = get_user_by( 'email', $email );
	if ( $user && wp_check_password($password, $user->user_pass, $user->ID) ) {
		if(get_user_meta($user->ID, 'user_flag', true) == 'deactive') {
			echo "2";
		}elseif(get_user_meta($user->ID, 'user_flag', true) == 'active') {
			echo "1";	
		}else{
			echo "2";	
		}	    
	} else {
	    echo "0";
	}
	exit;
}

/*
* Ajax for login success action hook
*/
add_action('wp_ajax_common_success_login', 'jobs4you_common_success_login' );
add_action('wp_ajax_nopriv_common_success_login', 'jobs4you_common_success_login');
function jobs4you_common_success_login() {
	if($_POST) {		
		$email = $_REQUEST['user_email']; 
		$pwd = $_REQUEST['user_pwd'];		
		$remember = "true";
		$user_data = get_user_by( 'email', $email );
		$login_data = array();
		$login_data['user_email'] = $email;
		$login_data['user_login'] = $user_data->user_login;
		$login_data['user_password'] = $pwd;
		$login_data['remember'] = $remember;		
		$roles = ( array ) $user_data->roles;		
		$user = wp_signon( $login_data, false );
		if ( is_wp_error($user) ) {
        	echo $user->get_error_message();
        } else {    
            wp_clear_auth_cookie();
            do_action('wp_login', $user->ID);
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);
            echo "done";
            exit;
        }
			
		die();
	}
}


function subscribe_save() {
	global $wpdb;
	$tablename = $wpdb->prefix . "subscribers";
    $sub_email = $_REQUEST['sub_email'];
    $wpdb->insert($tablename, array(	
	'email' => $sub_email,	
	));
	echo 1;
    wp_die();
}

add_action( 'wp_ajax_nopriv_subscribe_save', 'subscribe_save' );
add_action( 'wp_ajax_subscribe_save', 'subscribe_save' );


function contact_save() {
	global $wpdb;
	$tablename = $wpdb->prefix . "contact";
    $txt_name = $_REQUEST['txt_name'];
    $txt_email = $_REQUEST['txt_email'];
    $txt_message = $_REQUEST['txt_message'];
    $wpdb->insert($tablename, array(	
		'c_name' => $txt_name,	
		'c_email' => $txt_email,
		'c_message' => $txt_message,
	));
	$to = 'khushi@indianic.com';
	$subject = 'Jobs4You : Request to Contact';
	$body = '<p>Below Details to contact you</p>';
	$body .= '<p>Name: <b>'.$txt_name.'</b></p>';
	$body .= '<p>Email: <b>'.$txt_email.'</b></p>';
	$body .= '<p>Message: <b>'.$txt_message.'</b></p>';
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	wp_mail( $to, $subject, $body, $headers );

	$message = '<p>Hello, '.$txt_name.'</p>';
	$message .= '<p>Thank you for contacting us, we will contact to you shortly</p>';
	$message .= '<p>Regards,</p>';
	$message .= '<p>Jobs4You</p>';

	$subject1 = 'Jobs4You : Thank you for Contact us';
	wp_mail( $txt_email, $subject1, $message, $headers );

	
	echo 1;
    wp_die();
}

add_action( 'wp_ajax_nopriv_contact_save', 'contact_save' );
add_action( 'wp_ajax_contact_save', 'contact_save' );


function user_success_registration_jobseeker() {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$email_r = $_POST['email_r'];
	$user_pwd = $_POST['user_pwd'];
	$txt_nationality = $_POST['txt_nationality'];
	$txt_language = $_POST['txt_language'];
	$txt_gender = $_POST['txt_gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$txt_address = $_POST['txt_address'];
	$high_qualification = $_POST['high_qualification'];
	$work_exp = $_POST['work_exp'];
	$txt_project = $_POST['txt_project'];
	$txt_skills = $_POST['txt_skills'];
	$txt_achievemnets = $_POST['txt_achievemnets'];
	$login_name = random_username($fname.' '.$lname);
	$data = array(
	    'user_login' => $login_name,
	    'user_pass'	 => $user_pwd,
	    'user_email' => $email_r,
	    'first_name' => $fname,
	    'last_name' => $lname,
	    'nickname' => $fname,
	    'display_name'=> $fname,
	    'role' => 'jobseeker_user',
	    'show_admin_bar_front' => false
	);	 
	$user_id = wp_insert_user( $data );	 
	if ( ! is_wp_error( $user_id ) ) {		
		update_user_meta($user_id, 'txt_email', $email_r );
	    update_user_meta($user_id, 'mobile', $mobile );
		update_user_meta($user_id, 'txt_nationality', $txt_nationality); 
		update_user_meta($user_id, 'txt_language', $txt_language); 
		update_user_meta($user_id, 'txt_gender', $txt_gender); 
		update_user_meta($user_id, 'date_of_birth', $date_of_birth); 
		update_user_meta($user_id, 'txt_address', $txt_address); 
		update_user_meta($user_id, 'high_qualification', $high_qualification); 
		update_user_meta($user_id, 'work_exp', $work_exp); 
		update_user_meta($user_id, 'txt_project', $txt_project); 
		update_user_meta($user_id, 'txt_skills', $txt_skills); 
		update_user_meta($user_id, 'txt_achievemnets', $txt_achievemnets); 
	    update_user_meta($user_id, 'user_flag', 'active' );
		
	}
    wp_die();
}

add_action( 'wp_ajax_nopriv_success_registration_jobseeker', 'user_success_registration_jobseeker' );
add_action( 'wp_ajax_success_registration_jobseeker', 'user_success_registration_jobseeker' );

function user_success_registration_company() {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$email_r = $_POST['email_r'];
	$user_pwd = $_POST['user_pwd'];
	$companyName = $_POST['companyName'];
	$companyTYPE = $_POST['companyTYPE'];
	$companyAddress = $_POST['companyAddress'];
	$CompanyWebsite = $_POST['CompanyWebsite'];
	$CompanyRegistrationNo = $_POST['CompanyRegistrationNo'];
	$CompanyLocation = $_POST['CompanyLocation'];
	$companyDetails = $_POST['companyDetails'];	
	$login_name = random_username($fname . ' ' . $lname);
	$data = array(
	    'user_login' => $login_name,
	    'user_pass'	 => $user_pwd,
	    'user_email' => $email_r,
	    'first_name' => $fname,
	    'last_name' => $lname,
	    'nickname' => $companyName,
	    'display_name'=> $companyName,
	    'role' => 'company_user',
	    'show_admin_bar_front' => false
	);	 
	$user_id = wp_insert_user( $data );	 
	if ( ! is_wp_error( $user_id ) ) {	
		update_user_meta($user_id, 'mobile', $mobile );
		update_user_meta($user_id, 'companyName', $companyName ); 
		update_user_meta($user_id, 'companyTYPE', $companyTYPE );         
		update_user_meta($user_id, 'companyAddress', $companyAddress ); 
		update_user_meta($user_id, 'CompanyWebsite', $CompanyWebsite ); 
		update_user_meta($user_id, 'CompanyRegistrationNo', $CompanyRegistrationNo ); 
		update_user_meta($user_id, 'CompanyLocation', $CompanyLocation ); 
		update_user_meta($user_id, 'companyDetails', $companyDetails );
	    update_user_meta($user_id, 'user_flag', 'deactive' );		
	}
    wp_die();
}

add_action( 'wp_ajax_nopriv_success_registration_company', 'user_success_registration_company' );
add_action( 'wp_ajax_success_registration_company', 'user_success_registration_company' );


/*
* Ajax for get 
*/
add_action('wp_ajax_getSubCat', 'job4you_getSubCat' );
add_action('wp_ajax_nopriv_getSubCat', 'job4you_getSubCat');
function job4you_getSubCat() {
	echo "<option selected disabled>Category</option>";
	$categories = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => $_REQUEST['term_id']
    ) );
    if ( !empty($categories) ) {
    	foreach( $categories as $category ) {
    		$term_id = $category->term_id; ?>
        	<option value="<?php echo $term_id; ?>"><?php echo $category->name; ?></option>
        <?php }
    }
	exit;
}