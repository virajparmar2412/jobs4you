<?php
/* 
* Template Name: Company Jobs List
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
if($role != 'company_user'){
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo site_url(); ?>");
    </script>
    <?php
    exit;
}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array( 
  'author' => get_current_user_id(),
  'posts_per_page' => -1, 
  'post_type' => 'post' 
);
$postslist = new WP_Query( $args ); ?>
<!-- Job Listing Setion Start -->
    <div class="table-page-wrap">
        <div class="container-lg py-5">
            <div class="d-flex align-content-center justify-content-between mb-4">
                <h4 class="job-listing-title mb-0 text-dark">Company Jobs List</h4>
            </div>
            <div class="card dashboard-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="" id="jobslist">
                            <thead>
                                <tr>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Experience</th>                                    
                                    <th scope="col">Skill</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Job Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <?php if ( $postslist->have_posts() ) : ?>
                            <tbody>
                              <?php while ( $postslist->have_posts() ) : $postslist->the_post(); 
                                $experience = get_field('experience'); 
                                $location = get_field('location'); 
                                $skills = get_field('skills'); ?>
                                <tr>
                                    <td><?php the_title(); ?></td>
                                    <td><?php echo $experience; ?></td>
                                    <td><?php echo $skills; ?></td>
                                    <th><?php echo $location; ?></th>
                                    <td><?php echo get_the_date(); ?></td>
                                    <td>
                                        <a href="<?php echo get_permalink( get_page_by_path( 'update-job' ) ); ?>?jobId=<?php echo get_the_ID(); ?>">Edit</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Listing Setion End -->
<?php get_footer();