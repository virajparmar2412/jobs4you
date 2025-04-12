<?php
/* 
* Template Name: Dashboard
*/
if(!is_user_logged_in()){   
    $login = get_permalink( get_page_by_path( 'login' ) );
    wp_redirect( $login ); 
    exit;
}
$user_id = get_current_user_id();
$role = get_role_by_id($user_id);

if($role == 'company_user'){
    global $wpdb;
    $tablename = $wpdb->prefix . 'payment';
    $sql = "SELECT *  FROM ".$tablename." WHERE `user_id` = ".$user_id."  AND `end_date` > '".date('Y-m-d')."'";
    $results = $wpdb->get_results($sql);    
    if(empty($results)){

        $packages = get_permalink( get_page_by_path( 'packages' ) );
        ?>
        <script type="text/javascript">
          window.location.replace("<?php echo $packages; ?>");
        </script>
        <?php
        exit;
    }
}
get_header();

?>
<!-- Dashboard Cards Start -->
<h2 class="page-title">Dashboard</h2>
<section class="dashboard-cards my-5">
    <div class="container">
        <div class="row">
            <?php if($role == 'jobseeker_user'){
                get_template_part( 'template-parts/content', 'jobseeker' );
            }elseif($role == 'company_user'){
                get_template_part( 'template-parts/content', 'company' );
            }elseif($role == 'administrator'){    
                get_template_part( 'template-parts/content', 'administrator' );
            } ?>
        </div>
    </div>
</section>
<!-- Dashboard Cards End -->
<?php get_footer();