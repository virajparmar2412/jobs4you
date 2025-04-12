<?php
/* 
* Template Name: Apply Now
*/

if(isset($_REQUEST['submit'])){
    $title = $_REQUEST['title'];
    $jobApplyfirstname = $_REQUEST['job-applyfirstname'];
    $jobApplylastname = $_REQUEST['job-applylastname'];
    $jobApplyemail = $_REQUEST['job-applyemail'];
    $jobApplyphone = $_REQUEST['job-applyphone'];
    $additionInformation = $_REQUEST['additionInformation'];
    $jobpostid = $_REQUEST['jobpostid'];

    $uploadDirArray = wp_upload_dir();
    $uploadPath = $uploadDirArray['basedir'];

    $newfilename = "/resume/" . pathinfo($_FILES['file']['name'], PATHINFO_FILENAME) . '-' . uniqid() . "-" . time() . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath . $newfilename);

    global $wpdb;
    $table = $wpdb->prefix.'apply';

    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    $wpdb->insert(
        $table,
        array(
            'userId' => $user_id,
            'jobID' => $jobpostid,
            'firstName' => $jobApplyfirstname,
            'LastName' => $jobApplylastname,
            'email' => $jobApplyemail,
            'contact' => $jobApplyphone,
            'resume' => $newfilename,
            'comment' => $additionInformation
        )
    );
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo get_permalink(191); ?>");
    </script>
    <?php
    exit;
}
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
if($role != 'jobseeker_user'){
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo site_url(); ?>");
    </script>
    <?php
    exit;
}
if(!isset($_REQUEST['jobid'])){
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo site_url(); ?>");
    </script>
    <?php
    exit;
}
$post_id = $_REQUEST['jobid'];
$categories = get_the_terms($post_id, 'category');
$catArray = array();
foreach($categories as $category){
    $catArray[] = $category->name;
}
?>
<!-- Job Listing Setion Start -->
<div class="container  my-5">
    <div class="job-desc pb-30">
        <div class="card">
            <div class="card-body">
                <ul class="information">
                    <li><span>Job Title  :  </span><?php echo get_the_title($post_id); ?></li>
                    <li><span>Job Type  :  </span><?php echo implode(', ', $catArray); ?></li>
                </ul>
            </div>
        </div>
        <div class="contentblock">
            <p><?php echo get_the_excerpt($post_id); ?></p>
        </div>
    </div>
     <div class="applyjob-form pb-30">
        <p class="success"></p>
        <form name="job-apply" class="job-apply" id='job' method="post" enctype="multipart/form-data">
            <div class="section-alert p-30">
                <div class="block-title mb-3">
                    <h3>Account Information</h3>
                </div>
                <div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="inputFirstname">First Name*</label>
                            <input type="text" class="form-control" id="inputFirstname" name="job-applyfirstname" value="<?php echo get_user_meta($user_id,'first_name',true); ?>" required maxlength="20">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="inputLastname">Last Name*</label>
                            <input type="text" class="form-control" id="inputLastname" name="job-applylastname" value="<?php echo get_user_meta($user_id,'last_name',true); ?>" required maxlength="20">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="inputEmail">Email*</label>
                            <input type="email" class="form-control" id="inputEmail" name="job-applyemail" value="<?php echo get_user_meta($user_id,'txt_email',true); ?>" required maxlength="50" required>
                        </div>
                      <!--   <div class="form-group col-sm-6">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="job-applypassword">
                            <span class="note">(max 20 characters)</span>
                        </div> -->
                        <div class="form-group col-sm-6">
                            <label for="inputNumber">Contact Number*</label>
                            <input type="tel" class="form-control" id="inputNumber" name="job-applyphone" value="<?php echo get_user_meta($user_id,'mobile',true); ?>" maxlength="10" required>
                        </div>
                        <!-- <div class="form-group col-sm-6">
                            <label for="inputalterNumber">Alternate Number</label>
                            <input type="tel" class="form-control" id="inputalterNumber" name="job-applyalterphone" maxlength="10">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="inputabout">Where did you hear about us?*</label>
                            <select id="inputabout" class="form-control" name="job-applyhereabout" required>
                                    <option value="CareerHub">CareerHub </option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="FriendsOfMouth">Friends/Word of Mouth</option>
                                    <option value="GoogleSearchEngine">Google/Search Engine</option>
                                    <option value="JobBoard">Job Board</option>
                                    <option value="JobCentrePlus">Job Centre Plus</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="OtherSource">Other Source</option>
                                    <option value="Twitter">Twitter</option>
                                </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="jobposition">Job Position*</label>
                            <input type="tel" class="form-control" id="jobposition" name="job-jobposition" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="workexp">Work Exp.*</label>
                            <select id="workexp" class="form-control" name="job-workexp" required>
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
                        </div> -->

                    </div>
                </div>
            </div>

            <div class="section-alert p-30">
                <div class="block-title mb-3">
                    <h3>Upload Documents*</h3>
                </div>
                <div >
                    <div  class="form-group">
                        <span class="label">File</span>
                         <div class="upload-filewrap">
                        <input  type="file"  id="file"  name="file" required/>
                        <label for="file" class="btn btn-upload">Upload</label>
                        </div>
                    </div>                               
                </div>
            </div>

            <div class="section-alert p-30">
                <div class="block-title mb-3">
                    <h3>Additional Information</h3>
                </div>
                <div >
                    <div class="form-group">
                        <label for="additionInformation">Additional Information</label>
                        <textarea name="additionInformation" id="additionInformation"></textarea>
                    </div> 
                </div>
            </div>
            <p class="form-note">By submitting this form you agree to our <a href="javascript:void(0)" title="terms of use">terms of use</a></p>

        <div class="job-applybuttons">
            <input type="hidden" name="action" value="applyjob">
            <input type="hidden" name="jobtitle" value="<?php echo get_the_title($post_id);?>">
            <input type="hidden" name="jobpostid" value="<?php echo $post_id;?>">
            <input type="submit" class="btn btn-primary" title="Submit" name="submit" value="Submit">
            <button type="button" class="btn btn-outline-primary" title="Cancel" onclick='window.location.reload();'>Cancel</button>
        </div>
        
        </form>
    </div>
</div>
<!-- Job Listing Setion End -->
<?php get_footer(); ?>