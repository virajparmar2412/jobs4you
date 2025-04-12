<?php
/* 
* Template Name: Forgot Password
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
                <div class="auth-left">
                    <h2 class="page-title">Forgot Password</h2>
                    <form class="inner-form login-form" method="post" id="forgot_password">
                        <div class="mb-3">
                            <label for="forgot_email">Email</label>
                            <input type="email" name="forgot_email" id="forgot_email" class="form-control" maxlength="50" placeholder="Enter Email" required>
                        </div>                        
                        <div class="w-100 text-center">
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