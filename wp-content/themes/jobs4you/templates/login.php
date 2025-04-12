<?php
/* 
* Template Name: Login
*/
if(is_user_logged_in()){   
    $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
    wp_redirect( $dashboard ); 
    exit;
}
get_header();
?>
<section class="job_section login-tabs">
    <div class="container-fluid">
        <div class="auth-page-wrap">
            <div class="auth-left">
                <h2 class="page-title">Login</h2>
                
                <div class="tab-content" id="myTabContent">
                    <div class="auth-content"></div>
                    <div class="job_board tab-pane fade show active" id="jb-1" role="tabpanel"
                        aria-labelledby="jb-1-tab">
                        <form class="inner-form login-form" method="post" id="common_login">                            
                            <div class="mb-3">
                                <label for="txt_email">Email</label>
                                <input type="email" name="txt_email" id="txt_email" class="form-control" maxlength="50" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="pwd">Password</label>
                                <input type="password" id="pwd" name="pwd" class="form-control" maxlength="20" placeholder="Password" required>
                            </div>
                            <div class="w-100 text-right mb-3">
                                <a class="text-dark" href="<?php echo get_permalink( get_page_by_path( 'forgot-password' ) ); ?>">Forgot Password ?</a>
                            </div>
                            <div class="w-100 text-center">
                                <button class="btn btn-dark" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="auth-right">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/job-hunt.svg">
            </div>
        </div>
    </div>
</section>
<?php
get_footer();