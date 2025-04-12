<?php
/**
 * Template Name: Update Job
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
if(($role != 'company_user') || (!isset($_GET['jobId'])) || ($_GET['jobId'] == '')){
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo site_url(); ?>");
    </script>
    <?php
    exit;
}else{
    $jobId = $_GET['jobId'];
    $jobData = get_post( $jobId );
    if(!$jobData){
        ?>
        <script type="text/javascript">
            window.location.replace("<?php echo site_url(); ?>");
        </script>
        <?php
        exit;
    }
}
if(isset($_REQUEST['Update'])){
    $jtitle = $_REQUEST['jtitle'];
    $exp = $_REQUEST['exp'];
    $location = $_REQUEST['location'];
    $skills = $_REQUEST['skills'];
    $excerpt = $_REQUEST['excerpt'];
    $content = $_REQUEST['content'];
    $category = $_REQUEST['category'];
    $subcategory = $_REQUEST['subcategory'];

    $my_job = array(
        'ID' =>  $jobId,
        'post_title'    => $jtitle,
        'post_content'  => $content,
        'post_excerpt'  => $excerpt,
        'post_status'   => 'publish',
        'post_author'   => $user_id,
        'post_category' => array( $category,$subcategory )
    );
    wp_update_post( $my_job );
    update_post_meta( $jobId, 'experience', $exp );
    update_post_meta( $jobId, 'skills', $skills );
    update_post_meta( $jobId, 'location', $location );
     ?>
    <script type="text/javascript">
        window.location.replace("<?php echo get_permalink( get_page_by_path( 'company-jobs-list' ) ); ?>");
    </script>
    <?php
    exit;
}
?>    
    <div class="container-fluid">
        <div class="auth-page-wrap">
            <div class="auth-left">
                <h2 class="page-title">UPDATE THE JOB</h2>
                <form class="inner-form post-job" id="job_title" method="post" action="">
                    <div class="mb-3">
                        <label for="jtitle">Job Title</label>
                        <input type="text" class="form-control" id="jtitle" name="jtitle" minlength="3" maxlength="30" placeholder="Job Title" required value="<?php echo $jobData->post_title; ?>">
                    </div>
                    <div class="mb-3">
                        <?php $experience = get_post_meta($jobId, 'experience', true); ?>
                        <label for="exp">Experience Required</label>
                        <select id="exp" class="form-control" name="exp" required>
                            <option <?php echo ($experience == 'Fresher')?'selected':''; ?> value="Fresher">Fresher </option>
                            <option <?php echo ($experience == '1')?'selected':''; ?> value="1">1 Year</option>
                            <option <?php echo ($experience == '2')?'selected':''; ?> value="2">2 Years</option>
                            <option <?php echo ($experience == '3')?'selected':''; ?> value="3">3 Years</option>
                            <option <?php echo ($experience == '4')?'selected':''; ?> value="4">4 Years</option>
                            <option <?php echo ($experience == '5')?'selected':''; ?> value="5">5 Years</option>
                            <option <?php echo ($experience == '6')?'selected':''; ?> value="6">6 Years</option>
                            <option <?php echo ($experience == '7')?'selected':''; ?> value="7">7 Years</option>
                            <option <?php echo ($experience == '8')?'selected':''; ?> value="8">8 Years</option>
                            <option <?php echo ($experience == '9')?'selected':''; ?> value="9">9 Years</option>
                            <option <?php echo ($experience == '10')?'selected':''; ?> value="10">10+ Years</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" maxlength="30" placeholder="Location" required value="<?php echo get_post_meta($jobId, 'location', true); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="skills">Skills</label>
                        <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills" required value="<?php echo get_post_meta($jobId, 'skills', true); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="skills">Short Description</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" placeholder="Sort Description" required><?php echo $jobData->post_excerpt; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="skills">Description</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Description" required><?php echo $jobData->post_content; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category">Job Timing</label>
                        <?php
                        $jobCategoriesData = get_the_category($jobId);
                        foreach($jobCategoriesData as $jobCategoryData){
                            if($jobCategoryData->parent == 0){
                                $parentCatId = $jobCategoryData->term_id;
                            }else{
                                $subCatId = $jobCategoryData->term_id;
                            }
                        }
                        ?>
                        <select id="category" class="form-control" name="category" required>
                            <option selected="" disabled="" value="">Job Timing</option>
                            <?php
                            $categories = get_terms( array(
                                'taxonomy' => 'category',
                                'hide_empty' => false,
                                'parent' => 0
                            ) );
                            foreach($categories as $key=>$category){
                            ?>
                                <option <?php echo ($parentCatId == $category->term_id)?'selected':''; ?> value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategory">Category</label>
                        <select id="subcategory" class="form-control" name="subcategory" required>
                            <?php
                            echo "<option selected disabled>Category</option>";
                            $categories = get_terms( array(
                                'taxonomy' => 'category',
                                'hide_empty' => false,
                                'parent' => $parentCatId
                            ) );
                            if ( !empty($categories) ) {
                                foreach( $categories as $category ) {
                                    $term_id = $category->term_id; ?>
                                    <option <?php echo ($subCatId == $term_id)?'selected':''; ?> value="<?php echo $term_id; ?>"><?php echo $category->name; ?></option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w-100 text-center mb-3">
                        <button class="btn btn-dark" type="submit" name="Update">Update</button>
                    </div>
                </form>
            </div>
            <div class="auth-right">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/post.png">
            </div>
        </div>
    </div>

<?php
get_footer();
?>