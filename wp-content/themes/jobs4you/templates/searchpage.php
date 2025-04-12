<?php
/* 
* Template Name: Search Page
*/
get_header();
?>
<!-- Job Listing Setion Start -->
<div class="container my-5">
    <h4 class="job-listing-title">Search Results:</h4>
    <?php
    /*keywords=wordpress&jobType=1&jobCategory=2*/
    $args = array(
        'post_type' => 'post',
        'post_status '      => 'publish',
        's'      => $_GET['keywords'],
        'posts_per_page' => -1 ,
        'tax_query' => array(),
        'meta_query' => array(),
    );
    if(!empty($_GET['jobType'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $_GET['jobType']
        );
    }
    if(!empty($_GET['jobCategory'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $_GET['jobCategory']
        );
    }
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            ?>
            <div class="job-card">
                <div class="job-info-left">
                    <h5 class="job-title"><?php echo get_the_title(); ?></h5>
                    <h6 class="company-name"><?php the_author(); ?></h6>
                    <span class="job-subtext"><span class="job-subtitle">Exp:</span> <?php echo get_field("experience"); ?></span>
                    <span class="job-subtext"><span class="job-subtitle">Skills:</span> <?php echo get_field("skills"); ?></span>
                    <span class="job-subtext"><span class="job-subtitle">Location:</span> <?php echo get_field("location"); ?></span>
                    <p class="job-desc"><?php echo get_the_excerpt(); ?></p>
                </div>
                <?php
                if(is_user_logged_in()){   
                    $user_id = get_current_user_id();
                    $role = get_role_by_id($user_id);
                    if($role == 'jobseeker_user'){
                        ?>
                        <a class="btn btn-dark" href="<?php echo get_permalink(188); ?>/?jobid=<?php echo get_the_ID(); ?>" >Apply Now</a>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
</div>
<!-- Job Listing Setion End -->
<?php get_footer(); ?>