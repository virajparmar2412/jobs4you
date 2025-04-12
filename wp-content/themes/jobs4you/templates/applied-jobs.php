<?php
/**
 * Template Name: Applied Jobs
 */
get_header();
if(!is_user_logged_in()){   
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo get_permalink(2); ?>");
    </script>
    <?php
    exit;
}
$user_id = get_current_user_id();
$role = get_role_by_id($user_id);
if($role != 'company_user' && $role != 'jobseeker_user'){
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo site_url(); ?>");
    </script>
    <?php
    exit;
}
?>
    <!-- Job Listing Setion Start -->
    <div class="table-page-wrap">
        <div class="container-lg py-5">
            <div class="d-flex align-content-center justify-content-between mb-4">
                <?php if($role == 'company_user'){ ?>
                    <h4 class="job-listing-title mb-0 text-dark">Jobseeker Listing</h4>
                <?php } ?>
                <?php if($role == 'jobseeker_user'){ ?>
                    <h4 class="job-listing-title mb-0 text-dark">Applied Jobs</h4>
                <?php } ?>
            </div>
            <div class="card dashboard-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Jobseeker Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Jobseeker Email</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                global $wpdb;
                                $p = ((isset($_REQUEST['pageNo'])) && ($_REQUEST['pageNo'] > 1))?$_REQUEST['pageNo']:1;
                                $limit = 10;
                                $limitStart = ($p - 1) * $limit;
                                $table1 = $wpdb->prefix.'apply';
                                $table2 = $wpdb->prefix.'posts';
                                if($role == 'company_user'){
                                    $results = $wpdb->get_results("select ".$table1.".*,".$table2.".post_title from ".$table1." left join ".$table2." on ".$table1.".jobID = ".$table2.".ID where ".$table2.".post_author = ".$user_id." limit ".$limitStart.",".$limit);
                                }
                                if($role == 'jobseeker_user'){
                                    $results = $wpdb->get_results("select ".$table1.".*,".$table2.".post_title from ".$table1." left join ".$table2." on ".$table1.".jobID = ".$table2.".ID where ".$table1.".userId = ".$user_id." limit ".$limitStart.",".$limit);
                                }
                                if(!empty($results)){
                                    $uploadDirArray = wp_upload_dir();
                                    $uploadPath = $uploadDirArray['baseurl'];
                                    foreach($results as $row){
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $row->post_title; ?></th>
                                            <td><?php echo $row->firstName.' '.$row->LastName; ?> </td>
                                            <td><?php echo $row->contact; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><a href="<?php echo $uploadPath.$row->resume; ?>" target="_blank" class="text-primary">RESUME</a></td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <tr align="center">
                                        <th colspan="7" scope="row">No record found</th>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php $totalPage = ceil(count($wpdb->get_results("select ".$table1.".*,".$table2.".post_title from ".$table1." left join ".$table2." on ".$table1.".jobID = ".$table2.".ID where ".$table2.".post_author = ".$user_id))); ?>
                        <?php if($totalPage > $limit){ ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <?php if($p != 1){ ?>
                                        <li class="page-item"><a class="page-link" href="<?php echo get_permalink( get_page_by_path( 'hiring' ) ); ?>?pageNo=<?php echo $p-1; ?>">Previous</a></li>
                                    <?php } ?>
                                    <?php for ($i=1; $i <= $totalPage; $i++) { ?>
                                        <?php if($p==$i){ ?>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0)"><?php echo $i; ?></a></li>
                                        <?php }else{ ?>
                                            <li class="page-item"><a class="page-link" href="<?php echo get_permalink( get_page_by_path( 'hiring' ) ); ?>?pageNo=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($p != $totalPage){ ?>
                                        <li class="page-item"><a class="page-link" href="<?php echo get_permalink( get_page_by_path( 'hiring' ) ); ?>?pageNo=<?php echo $p+1; ?>">Next</a></li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Listing Setion End -->

<?php
get_footer();
?>