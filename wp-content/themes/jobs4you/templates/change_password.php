<?php
/* 
* Template Name: Change Password
*/
if(!is_user_logged_in()){   
    $dashboard = site_url();
    wp_redirect( $dashboard ); 
    exit;
}
get_header();
$user_id = get_current_user_id();
$user_data = get_user_by('id', $user_id);
?>
<!-- Registraion Form -->
    <section class="job_section login-tabs">
        <div class="container-fluid">
            <div class="auth-page-wrap">
                    <div class="auth-left rest_wrap">
                        <h2 class="page-title">Change Password</h2>
                        <form class="inner-form login-form" method="post" id="change_password">
                            <div class="mb-3">
                                <label for="jobseeker_pwd">Old Password</label>
                                <input type="password" id="old_pwd" name="old_pwd" class="form-control" placeholder="Enter Old Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="jobseeker_pwd">New Password</label>
                                <input type="password" id="new_pwd" name="new_pwd" class="form-control" placeholder="Enter New Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpwd">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_cpwd" name="new_cpwd" placeholder="Enter Confirm New Password" required>
                            </div>
                            <div class="w-100 text-center">
                                 <input type="hidden" class="form-control" id="usereemail" name="usereemail" value="<?php echo $user_data->user_email; ?>">
                                 <input type="hidden" class="form-control" id="userlogin" name="userlogin" value="<?php echo $user_data->user_login; ?>">
                                 <input type="hidden" class="form-control" id="userID" name="userID" value="<?php echo $user_data->ID; ?>">
                                 <input type="hidden" class="form-control" id="redirecttologin" name="redirecttologin" value="<?php echo esc_url(get_permalink( 2 )); ?>">
                                <button class="btn btn-dark" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                <div class="auth-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/job-hunt.svg">
                </div>
            </div>
        </div>
    </section>
<?php get_footer();