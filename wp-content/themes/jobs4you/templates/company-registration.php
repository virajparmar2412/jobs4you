<?php
/* 
* Template Name: Company Registration
*/
if(!is_user_logged_in()){
    if((!isset($_POST['fname'])) && (!isset($_POST['lname'])) && (!isset($_POST['mobile'])) && (!isset($_POST['email_r'])) && (!isset($_POST['user_pwd'])) ){
        $registration = get_permalink( get_page_by_path( 'registration' ) );
        wp_redirect( $registration ); 
        exit;
    }
}else{
    $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
    wp_redirect( $dashboard ); 
    exit;
}
get_header();
?>
<!-- Registraion Form -->
    <!-- Registraion Form -->
    <h2 class="page-title">Company Details</h2>
    <form class="inner-form company-form" id="company_reg_form" action="<?php echo get_permalink( get_page_by_path( 'thank-you' ) ); ?>" method="post">
        <div class="form-row">            
            <div class="col-md-6 mb-3">
                <label for="companyName">Company name</label>
                <input type="text" class="form-control" id="companyName" name="companyName" maxlength="20" placeholder="Company name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="companyTYPE">Company Type</label>
                <input type="text" class="form-control" id="companyTYPE" name="companyTYPE" maxlength="20" placeholder="Company Type" required>
            </div>
            <div class="col-md-12 mb-3">
                <label class="d-block" for="companyAddress">Company Address</label>
                <textarea class="form-control" id="companyAddress" name="companyAddress" maxlength="50" rows="3" placeholder="Company Address"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="CompanyWebsite">Company Web Address</label>
                <input type="text" class="form-control" id="CompanyWebsite" name="CompanyWebsite" maxlength="30" placeholder="Company Web Address" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="CompanyRegistrationNo">Registration No</label>
                <input type="text" class="form-control" id="CompanyRegistrationNo" name="CompanyRegistrationNo" minlength="12" maxlength="12" placeholder="Company Web Address" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="CompanyLocation">Location</label>
                <input type="text" class="form-control" id="CompanyLocation" name="CompanyLocation" maxlength="200" placeholder="Company Web Address" required>
            </div>
            <div class="col-md-12 mb-3">
                <label class="d-block" for="companyDetails">Company Description</label>
                <textarea class="form-control" id="companyDetails" name="companyDetails" maxlength="255" rows="3" placeholder="Company Description"></textarea>
            </div>
        </div>
        <div class="w-100 text-center">
            <input type="hidden" id="message" name="message" value="Welcome to Jobs4You! – Thank you for Registration to Jobs4You">
            <input type="hidden" id="fname" name="fname" minlength="3" maxlength="15" value="<?php echo $_POST['fname']; ?>">
            <input type="hidden" id="lname" name="lname" minlength="3" maxlength="15" value="<?php echo $_POST['lname']; ?>">
            <input type="hidden" id="mobile" name="mobile" maxlength="12" value="<?php echo $_POST['mobile']; ?>">
            <input type="hidden" id="email_r" name="email_r" maxlength="30" value="<?php echo $_POST['email_r']; ?>">
            <input type="hidden" id="user_pwd" name="user_pwd" minlength="8" maxlength="20" value="<?php echo $_POST['user_pwd']; ?>">
            <button class="btn btn-dark" type="submit">Submit</button>
        </div>
    </form>
    <!-- End Registraion Form -->
<?php 
get_footer();