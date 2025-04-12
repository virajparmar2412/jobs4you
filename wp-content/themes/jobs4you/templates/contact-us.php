<?php
/* 
* Template Name: Contact us
*/
get_header();
?>
<!-- Registraion Form -->
    <h2 class="page-title">Contact Us</h2>
    <form class="inner-form jobseeker-form" id="contact-us" method="post" action="<?php echo get_permalink( get_page_by_path( 'thank-you' ) ); ?>">
        <div class="form-row">            
            <div class="col-md-12 mb-3">
                <label class="d-block" for="validationDefault02">Name</label>
                <input type="text" name="txt_name" id="txt_name" class="form-control notValidSpecial" maxlength="25" placeholder="Name" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="validationDefault02">Email</label>
                <input type="email" name="txt_email" id="txt_email" class="form-control" maxlength="50" placeholder="Email" required>
            </div>
            <div class="col-md-12 mb-3">
                <label class="d-block" for="validationDefault02">Message</label>
                <textarea class="form-control" name="txt_message" id="txt_message" maxlength="500" rows="3" placeholder="Message"></textarea>
                <input type="hidden" id="message" name="message" value="Thank you for contacting to us. Our team will be contact you soon."/>
            </div>
        </div>
        <div class="w-100 text-center">
            <button class="btn btn-dark" type="submit">Submit</button>
        </div>
    </form>
    <!-- End Registraion Form -->
<?php 
get_footer();
?>