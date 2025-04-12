<?php
/* 
* Template Name: Jobs List
*/
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array( 
  'author' => get_current_user_id(),
  'posts_per_page' => 10, 
  'paged' => $paged,
  'post_type' => 'post' 
);
$postslist = new WP_Query( $args ); ?>
<!-- Job Listing Setion Start -->
    <div class="table-page-wrap">
        <div class="container-lg py-5">
            <div class="d-flex align-content-center justify-content-between mb-4">
                <h4 class="job-listing-title mb-0 text-dark">Our Requirement</h4>
                <button class="btn btn-dark">Post Job</button>
            </div>
            <div class="card dashboard-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Job ID</th>
                                    <th scope="col">Job Position</th>
                                    <th scope="col">Experience</th>                                    
                                    <th scope="col">Skill</th>
                                    <th scope="col">Job Date</th>
                                </tr>
                            </thead>
                            <?php if ( $postslist->have_posts() ) : ?>
                            <tbody>
                              <?php while ( $postslist->have_posts() ) : $postslist->the_post(); 
                                $experience = get_field('experience'); 
                                $skills = get_field('skills'); ?>
                                <tr>
                                    <th scope="row"><?php the_ID(); ?></th>
                                    <td><?php the_title(); ?></td>
                                    <td><?php echo $experience; ?></td>
                                    <td><?php echo $skills; ?></td>
                                    <td><?php echo get_the_date(); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Listing Setion End -->
<?php get_footer();