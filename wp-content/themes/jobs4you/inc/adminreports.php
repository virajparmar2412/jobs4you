<?php
/**
 * Admin Reports menu page hook
 * @since 1.0
 * */
add_action('admin_menu', 'job4you_setting_menu');
function job4you_setting_menu() {
    add_menu_page( 
        'Reports',
        'Reports',
        'manage_options',
        'job4you_adminuser_reports_settings',
        'job4you_user_reports_menu_callback_function'
    );
	add_submenu_page( 
        'job4you_adminuser_reports_settings',
        'User Reports',
        'User Reports',
        'manage_options',
        'job4you_adminuser_reports_settings',
        'job4you_user_reports_menu_callback_function'
    );
    add_submenu_page( 
        'job4you_adminuser_reports_settings',
        'Jobs Reports',
        'Jobs Reports',
        'manage_options',
        'job4you_adminjob_reports_settings',
        'job4you_jobs_reports_menu_callback_function'
    );
    add_submenu_page( 
        'job4you_adminuser_reports_settings',
        'Jobseeker Reports',
        'Jobseeker Reports',
        'manage_options',
        'job4you_adminjobseeker_reports_settings',
        'job4you_jobseeker_reports_menu_callback_function'
    );
    add_submenu_page( 
        'job4you_adminuser_reports_settings',
        'Company Reports',
        'Company Reports',
        'manage_options',
        'job4you_admincompany_reports_settings',
        'job4you_company_reports_menu_callback_function'
    );
}

/**
 * Admin User Reports menu page callback function
 * */
function job4you_user_reports_menu_callback_function(){
?>
<div id="wpbody" role="main">
    <div id="wpbody-content">
    <div class="wrap">
        <h1 class="wp-heading-inline">
            Users List
        </h1>
        <hr class="wp-header-end">
        <pre>
            <?php global $wp_roles; ?>
        </pre>
        <input type="date" id="min" name="min" placeholder="Start date" placeholder="YYYY/MM/DD" class="alignleft">
        <input type="date" id="max" name="max" placeholder="End date" data-date-format="YYYY/MM/DD" class="alignleft">
        <select id="rolesfilters" class="alignleft">
        <option value="">Change role to…</option>
        <?php foreach ( $wp_roles->roles as $key=>$value ) { ?>
            <option value="<?php echo $value['name']?>"><?php echo $value['name']?></option>
        <?php } ?>
        </select>
        <select id="statusfilters" class="alignleft">
        <option value="">Change status to…</option>
        <option value="active">Active</option>
        <option value="deactive">Deactive</option>
        </select>
        <table class="wp-list-table widefat fixed striped posts" id="customuserlist">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Date</th>
            </thead>
            <tbody id="the-list">
                <?php 
                    global $wpdb; 
                    $table_name = $wpdb->prefix.'users';
                    $customuserlist = "SELECT * FROM $table_name ORDER BY ID DESC";
                    $customuserlist_result = $wpdb->get_results($customuserlist); 
                    $customuserlistarray = json_decode(json_encode($customuserlist_result), True); 
                    foreach ($customuserlistarray as $customuserlistarray) {  
                    $all_meta_for_user =  array_map( function( $a ){ return $a[0]; }, get_user_meta( $customuserlistarray['ID'] ) );
                    $user_meta = get_userdata($customuserlistarray['ID']);
                    $user_roles = $user_meta->roles;
                    $userRegisteredDate = $customuserlistarray['user_registered'];
                ?>
                    <tr>
                        <td><?php echo $customuserlistarray['user_login']; ?></td>
                        <td><?php echo $all_meta_for_user['first_name'].' '.$all_meta_for_user['last_name']; ?></td>
                        <td><?php echo $customuserlistarray['user_email']; ?></td>
                        <td><?php echo ucfirst(str_replace("_user","" ,$user_roles[0])); ?></td>
                        <td>
                            <?php
                            if($user_meta->user_flag){
                                echo $user_meta->user_flag;
                            } else if($user_roles[0] != 'administrator'){
                                echo 'deactive';
                            }else{
                                echo 'active';
                            } ?>
                        </td>
                        <td><?php echo date('Y-m-d',strtotime($userRegisteredDate)); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php
}

/**
 * Admin Jobs Reports menu page callback function
 * */
function job4you_jobs_reports_menu_callback_function(){
?>
<div id="wpbody" role="main">
    <div id="wpbody-content">
    <div class="wrap">
        <h1 class="wp-heading-inline">
            Jobs List
        </h1>
        <hr class="wp-header-end">
        <pre>
            <?php global $wp_roles; ?>
        </pre>
        <input type="date" id="min" name="min" placeholder="Start date" placeholder="YYYY/MM/DD" class="alignleft">
        <input type="date" id="max" name="max" placeholder="End date" data-date-format="YYYY/MM/DD" class="alignleft">
        <?php
        $parentcategories = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => true,
            'parent' => 0
        ) );
        $childcategories = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ) );
        $uniqueArry = array();
        ?>
        <select id="jobtimingfilters" class="alignleft">
            <option value="">Change job timing to…</option>
            <?php foreach($parentcategories as $category){ ?>
                <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
            <?php } ?>
        </select>
        <select id="categoryfilters" class="alignleft">
            <option value="">Change category to…</option>
            <?php foreach($childcategories as $category){ ?>
                <?php if($category->parent){ ?>
                    <?php if(!in_array($category->name, $uniqueArry)){ ?>
                        <?php $uniqueArry[] = $category->name; ?>
                        <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </select>
        <select id="experiencefilters" class="alignleft">
            <option value="">Change Experience to…</option>
            <option value="Fresher">Fresher </option>
            <option value="1 Year">1 Year</option>
            <option value="2 Years">2 Years</option>
            <option value="3 Years">3 Years</option>
            <option value="4 Years">4 Years</option>
            <option value="5 Years">5 Years</option>
            <option value="6 Years">6 Years</option>
            <option value="7 Years">7 Years</option>
            <option value="8 Years">8 Years</option>
            <option value="9 Years">9 Years</option>
            <option value="10+ Years">10+ Years</option>
        </select>
        <table class="wp-list-table widefat fixed striped posts" id="jobslist">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Experience</th>
                    <th>Skill</th>
                    <th>Location</th>
                    <th>Company</th>
                    <th>Date</th>
            </thead>
            <tbody id="the-list">
                <?php 
                global $wpdb; 
                $table_name = $wpdb->prefix.'posts';
                $postlist = "SELECT * FROM $table_name where post_type = 'post' AND post_status = 'publish' ORDER BY ID DESC";
                $postlist_result = $wpdb->get_results($postlist); 
                $postlistarray = json_decode(json_encode($postlist_result), True); 
                foreach ($postlistarray as $postlistarray) {
                    $user_experience = get_post_meta($postlistarray['ID'], 'experience', true);
                    $user_skills = get_post_meta($postlistarray['ID'], 'skills', true);
                    $user_location = get_post_meta($postlistarray['ID'], 'location', true);
                    $jobCategoriesData = get_the_category($postlistarray['ID']);
                    foreach($jobCategoriesData as $jobCategoryData){
                        if($jobCategoryData->parent == 0){
                            $parentCatId = $jobCategoryData->term_id;
                        }else{
                            $subCatId = $jobCategoryData->term_id;
                        }
                    }
                    ?>
                    <tr>
                        <td><?php echo $postlistarray['post_title']; ?></td>
                        <td><?php echo get_term($parentCatId)->name; ?></td>
                        <td><?php echo get_term($subCatId)->name; ?></td>
                        <td>
                            <?php
                                if($user_experience == 'Fresher'){
                                    echo $user_experience;
                                } else if($user_experience == 1){
                                    echo $user_experience.' Year';
                                } else if($user_experience < 10 && $user_experience > 1){
                                    echo $user_experience.' Years';
                                } else if($user_experience == 10){
                                    echo $user_experience.'+ Years';
                                }
                            ?>        
                        </td>
                        <td><?php echo $user_skills; ?></td>
                        <td><?php echo $user_location; ?></td>
                        <td>
                            <?php
                            $author = get_user_by('id', $postlistarray['post_author']);
                            echo get_user_meta($author->ID,'companyName',true);
                            ?>
                        </td>
                        <td><?php echo date('Y-m-d',strtotime($postlistarray['post_date'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php
}

/**
 * Admin Jobseeker Reports menu page callback function
 * */
function job4you_jobseeker_reports_menu_callback_function(){
?>
<div id="wpbody" role="main">
    <div id="wpbody-content">
    <div class="wrap">
        <h1 class="wp-heading-inline">
            Jobseeker List
        </h1>
        <hr class="wp-header-end">
        <pre>
            <?php global $wp_roles; ?>
        </pre>
        <input type="date" id="min" name="min" placeholder="Start date" placeholder="YYYY/MM/DD" class="alignleft">
        <input type="date" id="max" name="max" placeholder="End date" data-date-format="YYYY/MM/DD" class="alignleft">
        <table class="wp-list-table widefat fixed striped posts" id="jobseekerlist">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Location</th>
                    <th>Skills</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th>Date</th>
            </thead>
            <tbody id="the-list">
                <?php 
                global $wpdb; 
                $table_name = $wpdb->prefix.'users';
                $customuserlist = "SELECT * FROM $table_name ORDER BY ID DESC";
                $customuserlist_result = $wpdb->get_results($customuserlist); 
                $customuserlistarray = json_decode(json_encode($customuserlist_result), True); 
                foreach ($customuserlistarray as $customuserlistarray) {  
                    $all_meta_for_user =  array_map( function( $a ){ return $a[0]; }, get_user_meta( $customuserlistarray['ID'] ) );
                    $user_meta = get_userdata($customuserlistarray['ID']);
                    $user_roles = $user_meta->roles;
                    $userRegisteredDate = $customuserlistarray['user_registered'];
                    if($user_roles[0] == 'jobseeker_user'){
                        $mobile = get_user_meta($customuserlistarray['ID'], 'mobile', true);
                        $txt_interest = get_user_meta($customuserlistarray['ID'], 'txt_interest', true);
                        $skill = get_user_meta($customuserlistarray['ID'], 'skill', true);
                        $wordk_exp_arr = get_user_meta($customuserlistarray['ID'], 'wordk_exp_arr', true);
                        ?>
                        <tr>
                            <td><?php echo $customuserlistarray['user_login']; ?></td>
                            <td><?php echo $all_meta_for_user['first_name'].' '.$all_meta_for_user['last_name']; ?></td>
                            <td><?php echo $customuserlistarray['user_email']; ?></td>
                            <td><?php echo $mobile; ?></td>
                            <td><?php echo $txt_interest; ?></td>
                            <td><?php echo ($skill)?implode(',',$skill):''; ?></td>
                            <td><?php echo (!empty($wordk_exp_arr))?'Experienced':'Fresher'; ?></td>
                            <td>
                                <?php
                                if($user_meta->user_flag){
                                    echo $user_meta->user_flag;
                                } else if($user_roles[0] != 'administrator'){
                                    echo 'deactive';
                                }else{
                                    echo 'active';
                                } ?>
                            </td>
                            <td><?php echo date('Y-m-d',strtotime($userRegisteredDate)); ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php
}

/**
 * Admin Company Reports menu page callback function
 * */
function job4you_company_reports_menu_callback_function(){
?>
<div id="wpbody" role="main">
    <div id="wpbody-content">
    <div class="wrap">
        <h1 class="wp-heading-inline">
            Company List
        </h1>
        <hr class="wp-header-end">
        <pre>
            <?php global $wp_roles; ?>
        </pre>
        <input type="date" id="min" name="min" placeholder="Start date" placeholder="YYYY/MM/DD" class="alignleft">
        <input type="date" id="max" name="max" placeholder="End date" data-date-format="YYYY/MM/DD" class="alignleft">
        <table class="wp-list-table widefat fixed striped posts" id="companylist">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Web Address</th>
                    <th>Registration No</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date</th>
            </thead>
            <tbody id="the-list">
                <?php 
                global $wpdb; 
                $table_name = $wpdb->prefix.'users';
                $customuserlist = "SELECT * FROM $table_name ORDER BY ID DESC";
                $customuserlist_result = $wpdb->get_results($customuserlist); 
                $customuserlistarray = json_decode(json_encode($customuserlist_result), True); 
                foreach ($customuserlistarray as $customuserlistarray) {  
                    $all_meta_for_user =  array_map( function( $a ){ return $a[0]; }, get_user_meta( $customuserlistarray['ID'] ) );
                    $user_meta = get_userdata($customuserlistarray['ID']);
                    $user_roles = $user_meta->roles;
                    $userRegisteredDate = $customuserlistarray['user_registered'];
                    if($user_roles[0] == 'company_user'){
                        ?>
                        <tr>
                            <td><?php echo $all_meta_for_user['first_name'].' '.$all_meta_for_user['last_name']; ?></td>
                            <td><?php echo $customuserlistarray['user_email']; ?></td>
                            <td><?php echo get_user_meta($customuserlistarray['ID'], 'companyTYPE', true); ?></td>
                            <td><?php echo get_user_meta($customuserlistarray['ID'], 'CompanyWebsite', true); ?></td>
                            <td><?php echo get_user_meta($customuserlistarray['ID'], 'CompanyRegistrationNo', true); ?></td>
                            <td><?php echo get_user_meta($customuserlistarray['ID'], 'CompanyLocation', true); ?></td>
                            <td>
                                <?php
                                if($user_meta->user_flag){
                                    echo $user_meta->user_flag;
                                } else if($user_roles[0] != 'administrator'){
                                    echo 'deactive';
                                }else{
                                    echo 'active';
                                } ?>
                            </td>
                            <td><?php echo date('Y-m-d',strtotime($userRegisteredDate)); ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<?php
}

/**
 * Add CSS and JS to Admin side
 * */
function job4you_add_admin_jscss(){
    $screen = get_current_screen();
    $job4you_screen1 = 'toplevel_page_job4you_adminuser_reports_settings';
    $job4you_screen2 = 'reports_page_job4you_adminjob_reports_settings';
    $job4you_screen3 = 'reports_page_job4you_adminjobseeker_reports_settings';
    $job4you_screen4 = 'reports_page_job4you_admincompany_reports_settings';
    if( is_object( $screen ) && (($job4you_screen1 == $screen->base) || ($job4you_screen2 == $screen->base) || ($job4you_screen3 == $screen->base) || ($job4you_screen4 == $screen->base)) ) {
        wp_enqueue_script( 'dataTables', get_theme_file_uri( 'assets/js/jquery.dataTables.min.js' ), array( 'jquery' ),  false, true);
        wp_enqueue_script( 'dataTables2', 'https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'jszip_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'pdfmake_min_js', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'vfs_f_nts_js', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',array( 'jquery' ),  false, true);
        wp_enqueue_script( 'buttons_html5_min_js', 'https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js',array( 'jquery' ),  false, true);
         wp_enqueue_script( 'adminjsforreports', get_theme_file_uri( 'assets/js/adminreports.js' ), array( 'jquery' ),  false, true);
        wp_register_style('dataTables_style' , get_theme_file_uri( 'assets/css/jquery.dataTables.css' ));
        wp_enqueue_style('dataTables_style');
        wp_register_style('buttons_dataTables_style' , get_theme_file_uri( 'assets/css/buttons.dataTables.min.css' ));
        wp_enqueue_style('buttons_dataTables_style');
    }
}
add_action('admin_enqueue_scripts','job4you_add_admin_jscss');

/**
* get User roles
**/
function job4you_get_editable_roles() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) ){
        $wp_roles = new WP_Roles();
    }
    return $wp_roles;
}