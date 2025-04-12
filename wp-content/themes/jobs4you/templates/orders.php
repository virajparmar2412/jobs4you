<?php
/* 
* Template Name: Orders
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
    $sql = "SELECT *  FROM ".$tablename." WHERE `user_id` = ".$user_id."  AND `end_date` > ".date('Y-m-d');
    $results = $wpdb->get_results($sql);    
    if(empty($results)){
        $packages = get_permalink( get_page_by_path( 'packages' ) );
        ?>
        <script type="text/javascript">
          location.replace(<?php echo $packages; ?>);
        </script>
        <?php
        
    }
}else{
  $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
  wp_redirect( $dashboard ); 
  exit;
}
get_header();
global $wpdb;
$tablename = $wpdb->prefix . 'payment';
$sql = "SELECT *  FROM ".$tablename." WHERE `user_id` = ".$user_id;
$results = $wpdb->get_results($sql);
?>
<div class="table-page-wrap">
        <div class="container-lg py-5">
            <div class="d-flex align-content-center justify-content-between mb-4">
                <h4 class="job-listing-title mb-0 text-dark">Subscription Details</h4>                
            </div>
            <div class="card dashboard-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Transaction id</th>
                                    <th scope="col">subscribe</th>
                                    <th scope="col">during</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">payment method</th>
                                    <th scope="col">purchased date</th>
                                    <th scope="col">end date</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if($results){ ?>
                                <?php foreach ($results as $result) { ?>
                                  <tr>
                                      <th scope="row"><?php echo  $result->transaction_id; ?></th>
                                      <td><?php echo  $result->subscribe; ?></td>
                                      <td><?php echo  $result->during; ?></td>
                                      <td>INR <?php echo  $result->amount; ?></td>
                                      <td><?php echo  $result->payment_method; ?></td>
                                      <td><?php echo  $result->purchased_date; ?></td>
                                      <td><?php echo  $result->end_date; ?></td>
                                  </tr>
                                <?php } ?>
                              <?php } ?>
                                
                                
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();