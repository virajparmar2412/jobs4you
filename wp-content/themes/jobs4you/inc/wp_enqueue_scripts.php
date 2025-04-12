<?php  
/**
 * Enqueue scripts and styles.
 */
function jobs4you_style() {
	wp_enqueue_style( 'jobs4you-default-style', get_stylesheet_uri(), array(), _JOB_VERSION );		
	wp_enqueue_style( 'jobs4you-ui', get_template_directory_uri(). '/assets/css/jquery-ui.css', array(), _JOB_VERSION );	
	wp_enqueue_style( 'jobs4you-bootstrap', get_template_directory_uri(). '/assets/css/bootstrap.css', array(), _JOB_VERSION );	
	wp_enqueue_style( 'jobs4you-steps', get_template_directory_uri(). '/assets/css/jquery.steps.css', array(), _JOB_VERSION );	
	if ( is_page_template( 'templates/jobseekerreports.php' ) || is_page_template( 'templates/company-jobs-list.php' ) ) {
        wp_enqueue_script( 'dataTables', get_theme_file_uri( 'assets/js/jquery.dataTables.min.js' ), array( 'jquery' ),  false, true);
        wp_enqueue_script( 'dataTables2', 'https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'jszip_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'pdfmake_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'vfs_f_nts_js', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'buttons_html5_min_js', 'https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js',array( 'jquery' ),  false, true);
         wp_enqueue_script( 'jobseekerreports', get_theme_file_uri( 'assets/js/jobseekerreports.js' ), array( 'jquery' ),  false, true);
        wp_register_style('dataTables_style' , get_theme_file_uri( 'assets/css/jquery.dataTables.css' ));
        wp_enqueue_style('dataTables_style');
        wp_register_style('buttons_dataTables_style' , get_theme_file_uri( 'assets/css/buttons.dataTables.min.css' ));
        wp_enqueue_style('buttons_dataTables_style');
    }
	wp_enqueue_style( 'jobs4you-style', get_template_directory_uri(). '/assets/css/style.css', array(), _JOB_VERSION );	
	
}
add_action( 'wp_enqueue_scripts', 'jobs4you_style' );

function jobs4you_scripts() {
	$user_id = get_current_user_id();
	$education_table = get_user_meta($user_id, 'education_table', true);
	$skill = get_user_meta($user_id, 'skill', true);
	$wordk_exp_arr = get_user_meta($user_id, 'wordk_exp_arr', true);
	$certificates = get_user_meta($user_id, 'certificates', true);
	$awards = get_user_meta($user_id, 'awards', true);
	if($education_table){
		$education_table_count = @count($education_table);	
	}else{
		$education_table_count = 1;
	}
	if($skill){
		$skill_count = @count($skill);	
	}else{
		$skill_count = 1;
	}
	if($wordk_exp_arr){
		$wordk_exp_arr_count = @count($wordk_exp_arr);	
	}else{
		$wordk_exp_arr_count = 1;
	}
	if($certificates){
		$certificates_count = @count($certificates);	
	}else{
		$certificates_count = 1;
	}
	if($awards){
		$awards_count = @count($awards);	
	}else{
		$awards_count = 1;
	}

	wp_enqueue_script( 'jquery' );	
	wp_enqueue_script( 'jobs4you-ui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array(), _JOB_VERSION, true );
	wp_enqueue_script( 'jobs4you-popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), _JOB_VERSION, true );
	wp_enqueue_script( 'jobs4you-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), _JOB_VERSION, true );
	wp_enqueue_script( 'validator-js', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array(), _JOB_VERSION, true  );
	wp_enqueue_script( 'steps-js', get_template_directory_uri() . '/assets/js/jquery.steps.min.js', array(), _JOB_VERSION, true  );
	
	wp_enqueue_script( 'jobs4you-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), _JOB_VERSION, true );	
	wp_localize_script( 'jobs4you-custom', 'my_ajax_object', array( 
		'ajax_url' => admin_url( 'admin-ajax.php' ), 
		'dashboard' => get_permalink( get_page_by_path( 'dashboard' ) ), 
		'admin_url' => admin_url(), 
		'education_table' => $education_table_count,
		'skill' => $skill_count,
		'wordk_exp_arr' => $wordk_exp_arr_count,
		'certificates' => $certificates_count,
		'awards' => $awards_count,
	));
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_page_template( 'templates/forgot-password.php' ) || is_page_template( 'templates/reset-password.php' )|| is_page_template( 'templates/change_password.php' )) {
		wp_localize_script( 'forgotpassword', 'my_ajax_object', array( 
		'ajax_url' => admin_url( 'admin-ajax.php' )));
		wp_enqueue_script( 'forgotpassword', get_theme_file_uri( 'assets/js/forgotpassword.js' ), array( 'jquery' ),  false, true);
    }
}
add_action( 'wp_enqueue_scripts', 'jobs4you_scripts' );
