<?php
/* 
* Template Name: Payment Thank you
*/
get_header();
$dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
?>
<!-- Registraion Form -->
<section class="job_section login-tabs">
    <div class="container-fluid">
        <div class="auth-page-wrap">
            <div class="auth-left">                
                <h1 class="page-title green">PAYMENT SUCCESSFULL</h1><br>
                <h2 class="page-title" >Thank you for purchesed</h2><br>
                <div class="w-100 text-center mb-3">
                    <a class="btn btn-dark" href="<?php echo $dashboard; ?>">Go to Dashboard</a>                    
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