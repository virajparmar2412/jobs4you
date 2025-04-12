<?php
/* 
* Template Name: Reset Password
*/
if(is_user_logged_in()){   
    $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
    wp_redirect( $dashboard ); 
    exit;
}
get_header();
?>
<!-- Registraion Form -->
    <section class="job_section login-tabs">
        <div class="container-fluid">
            <div class="auth-page-wrap">
                <?php 
                    if(isset($_GET['key']) && $_GET['action'] == "rp") { 
                        $reset_key = $_GET['key'];
                        $user_login = $_GET['login'];
                        $user_data = check_password_reset_key($reset_key,$user_login);
                        if(!empty($reset_key) && !is_wp_error( $user_data )) {
                ?>
                    <div class="auth-left rest_wrap">
                        <h2 class="page-title">Reset Password</h2>
                        <form class="inner-form login-form" method="post" id="reset_password">
                            <div class="mb-3">
                                <label for="jobseeker_pwd">Password</label>
                                <input type="password" id="rest_pwd" name="rest_pwd" class="form-control" placeholder="Enter Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpwd">Confirm New Password</label>
                                <input type="password" class="form-control" id="cpwd" name="cpwd" placeholder="Enter New Password" required>
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
                <?php } else{?>
                    <div class="auth-left">
                        <h2 class="page-title">Invalid key</h2>
                    </div>
                <?php } }?>
                <div class="auth-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/job-hunt.svg">
                </div>
            </div>
        </div>
    </section>
<?php get_footer();