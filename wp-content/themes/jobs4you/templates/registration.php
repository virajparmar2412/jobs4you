<?php
/* 
* Template Name: Registration
*/
if(is_user_logged_in()){   
    $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
    wp_redirect( $dashboard ); 
    exit;
}
get_header();
?>
<!-- Registraion Form -->
    <div class="container-fluid">
        <div class="auth-page-wrap">
            <div class="auth-left">
                <h2 class="page-title">Registration</h2>
                <form class="inner-form registraion-form" id="user_registration" method="post" action="">
                    <div class="mb-3">
                        <label for="fname">First name</label>
                        <input type="text" class="form-control text" id="fname" name="fname" minlength="3" maxlength="15" placeholder="First name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lname">Last name</label>
                        <input type="text" class="form-control text" id="lname" name="lname" minlength="3" maxlength="15" placeholder="Last name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <input type="number" class="form-control number" id="mobile" name="mobile" maxlength="12" placeholder="Mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_r">Email</label>
                        <input type="email" class="form-control" id="email_r" name="email_r" maxlength="30" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_pwd">Password</label>
                        <input type="password" class="form-control" id="user_pwd" name="user_pwd" minlength="8" maxlength="20" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpwd">Confirm Password</label>
                        <input type="password" class="form-control" id="cpwd" name="cpwd" minlength="8" maxlength="20" placeholder="Confirm Password" required>
                    </div>
                    <div class="mb-3">  
                        <label for="user_type_select">User type</label>                      
                        <select class="custom-select h-100" id="user_type_select" name="user_type_select" required> 
                          <option selected disabled>Select User type</option>
                          <option value="<?php echo get_permalink( get_page_by_path( 'jobseeker-registration' ) ); ?>">Jobseeker</option>
                          <option value="<?php echo get_permalink( get_page_by_path( 'company-registration' ) ); ?>">Company</option>                          
                        </select>                        
                    </div>

                    <div class="w-100 text-center mb-3">
                        <button class="btn btn-dark" type="submit">Next</button>
                    </div>

                </form>
            </div>
            <div class="auth-right">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/job-hunt.svg">
            </div>
        </div>
    </div>
    <!-- End Registraion Form -->
<?php get_footer();