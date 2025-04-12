<?php
/**
 * Template Name: Post Job
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
if(isset($_REQUEST['Post'])){
    $jtitle = $_REQUEST['jtitle'];
    $exp = $_REQUEST['exp'];
    $location = $_REQUEST['location'];
    $skills = $_REQUEST['skills'];
    $excerpt = $_REQUEST['excerpt'];
    $content = $_REQUEST['content'];
    $category = $_REQUEST['category'];
    $subcategory = $_REQUEST['subcategory'];

    $my_job = array(
        'post_title'    => $jtitle,
        'post_content'  => $content,
        'post_excerpt'  => $excerpt,
        'post_status'   => 'publish',
        'post_author'   => $user_id,
        'post_category' => array( $category,$subcategory )
    );
    $postId = wp_insert_post( $my_job );
    add_post_meta( $postId, 'experience', $exp );
    add_post_meta( $postId, 'skills', $skills );
    add_post_meta( $postId, 'location', $location );
     ?>
    <script type="text/javascript">
        window.location.replace("<?php echo get_permalink(211); ?>");
    </script>
    <?php
    exit;
}
?>    
    <div class="container-fluid">
        <div class="auth-page-wrap">
            <div class="auth-left">
                <h2 class="page-title">POST THE JOB</h2>
                <form class="inner-form post-job" id="job_title" method="post" action="">
                    <div class="mb-3">
                        <label for="jtitle">Job Title</label>
                        <input type="text" class="form-control" id="jtitle" name="jtitle" minlength="3" maxlength="30" placeholder="Job Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="exp">Experience Required</label>
                        <select id="exp" class="form-control" name="exp" required>
                            <option value="Fresher">Fresher </option>
                            <option value="1">1 Year</option>
                            <option value="2">2 Years</option>
                            <option value="3">3 Years</option>
                            <option value="4">4 Years</option>
                            <option value="5">5 Years</option>
                            <option value="6">6 Years</option>
                            <option value="7">7 Years</option>
                            <option value="8">8 Years</option>
                            <option value="9">9 Years</option>
                            <option value="10">10+ Years</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" maxlength="30" placeholder="Location" required>
                    </div>
                    <div class="mb-3">
                        <label for="skills">Skills</label>
                        <input type="text" class="form-control" id="skills" name="skills" placeholder="Skills" required>
                    </div>
                    <div class="mb-3">
                        <label for="skills">Short Description</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" placeholder="Sort Description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="skills">Description</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category">Job Timing</label>
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
                                <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subcategory">Category</label>
                        <select id="subcategory" class="form-control" name="subcategory" required>
                        </select>
                    </div>
                    <div class="w-100 text-center mb-3">
                        <button class="btn btn-dark" type="submit" name="Post">Post</button>
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