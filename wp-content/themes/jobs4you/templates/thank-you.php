<?php
/* 
* Template Name: Thank you
*/
get_header();
if(isset($_REQUEST['message']) && ($_REQUEST['message']!='')){
    $message = $_REQUEST['message'];
    $cl = 'green';
/*}elseif(isset($_REQUEST['message']) && ($_REQUEST['message']=='contacting')){
    $message = 'Thank you for contacting to us. Our team will be contact you soon.';
    $cl = 'green';
}elseif(isset($_REQUEST['message']) && ($_REQUEST['message']=='applyjob')){    
    $message = 'Thank you for Applying a job. Our team will be contact you soon.';
    $cl = 'green';*/
}else{
    $message = 'Oops! Something Went Wrong';
    $cl = 'red';
}
?>
<section class="job_section login-tabs">
    <div class="container-fluid">
        <div class="auth-page-wrap">
            <div class="auth-left">
                <h2 class="page-title <?php echo $cl; ?>"><?php echo $message; ?></h2>
            </div>
            <div class="auth-right">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/job-hunt.svg">
            </div>
        </div>
    </div>
</section>
<?php 
get_footer();