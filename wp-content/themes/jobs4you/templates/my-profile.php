<?php
/* 
* Template Name: My Profile
*/
if(!is_user_logged_in()){   
    $login = get_permalink( get_page_by_path( 'login' ) );
    wp_redirect( $login ); 
    exit;
}
get_header();
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$user_email = $current_user->user_email;
$user_firstname = $current_user->user_firstname;
$mname = get_user_meta($user_id, 'mname', true);
$user_lastname = $current_user->user_lastname;
$mobile = get_user_meta($user_id, 'mobile', true);
$txt_nationality = get_user_meta($user_id, 'txt_nationality', true);
$txt_language = get_user_meta($user_id, 'txt_language', true);
$date_of_birth = get_user_meta($user_id, 'date_of_birth', true);
$txt_gender = get_user_meta($user_id, 'txt_gender', true);
$txt_address = get_user_meta($user_id, 'txt_address', true);
$txt_permanent_address = get_user_meta($user_id, 'txt_permanent_address', true);
$txt_marital_status = get_user_meta($user_id, 'txt_marital_status', true);
$txt_interest = get_user_meta($user_id, 'txt_interest', true);
$education_table = get_user_meta($user_id, 'education_table', true);
$skill = get_user_meta($user_id, 'skill', true);
$wordk_exp_arr = get_user_meta($user_id, 'wordk_exp_arr', true);
$certificates = get_user_meta($user_id, 'certificates', true);
$awards = get_user_meta($user_id, 'awards', true);


if ( isset( $_POST['submit_form_solution_profile'] ) ||  wp_verify_nonce( $_POST['submit_form_solution_profile'], 'submit_form_solution_profile' ) ) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $txt_email = $_POST['txt_email'];
    $txt_permanent_address = $_POST['txt_permanent_address'];
    $txt_address = $_POST['txt_address'];
    $txt_contact = $_POST['txt_contact'];
    $txt_dob = $_POST['txt_dob'];
    $txt_gender = $_POST['txt_gender'];
    $txt_marital_status = $_POST['txt_marital_status'];
    $txt_nationality = $_POST['txt_nationality'];
    $txt_languages = $_POST['txt_languages'];
    $txt_interest = $_POST['txt_interest'];
    $education_table = $_POST['education_table'];
    $skill = $_POST['skill'];
    $wordk_exp_arr = $_POST['wordk_exp_arr'];
    $certificates = $_POST['certificates'];
    $awards = $_POST['awards'];
    $user_data = wp_update_user( 
        array( 
            'ID' => $user_id,             
            'first_name' => $fname,
            'last_name' => $lname,
            'nickname' => $fname,
            'display_name'=> $fname            
        ) 
    );
    update_user_meta($user_id, 'txt_email', $txt_email );
    update_user_meta($user_id, 'mname', $mname );
    update_user_meta($user_id, 'mobile', $txt_contact );
    update_user_meta($user_id, 'txt_nationality', $txt_nationality); 
    update_user_meta($user_id, 'txt_language', $txt_languages); 
    update_user_meta($user_id, 'txt_gender', $txt_gender); 
    update_user_meta($user_id, 'date_of_birth', $txt_dob); 
    update_user_meta($user_id, 'txt_address', $txt_address); 
    update_user_meta($user_id, 'txt_permanent_address', $txt_permanent_address); 
    update_user_meta($user_id, 'txt_marital_status', $txt_marital_status); 
    update_user_meta($user_id, 'txt_interest', $txt_interest); 
    update_user_meta($user_id, 'education_table', $education_table); 
    update_user_meta($user_id, 'skill', $skill);
    update_user_meta($user_id, 'wordk_exp_arr', $wordk_exp_arr); 
    update_user_meta($user_id, 'certificates', $certificates); 
    update_user_meta($user_id, 'awards', $awards);
}
?>
<!-- Dashboard Cards Start -->
<h2 class="page-title">My Profile</h2>
<section class="dashboard-cards my-5">
    <div class="container">
        <div class="row">
            <div class="wizard">
               <div class="wizard-inner">
                    <form id="solution_profile_form" action="" method="post" enctype="multipart/form-data">
                        <div>
                            <h3>Candidate Info</h3>
                            <section>
                                <div class="col-md-12 mb-3">
                                    <label for="fname">First name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" minlength="3" maxlength="15" placeholder="First name" value="<?php echo $user_firstname; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="mname">Middle name</label>
                                    <input type="text" class="form-control" id="mname" name="mname" minlength="3" maxlength="15" placeholder="Middle name" value="<?php echo $mname; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="lname">Last name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" minlength="3" maxlength="15" placeholder="Last name" value="<?php echo $user_lastname; ?>" required>
                                </div>                                 
                                <div class="col-md-12 mb-3">
                                    <label for="txt_email">Email</label>
                                    <input type="email" name="txt_email" id="txt_email" class="form-control" maxlength="50" placeholder="Email" value="<?php echo $user_email; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_permanent_address">Permanent Address</label>
                                    <textarea class="form-control" name="txt_permanent_address" id="txt_permanent_address" maxlength="500" rows="3" placeholder="Permanent Address" required><?php echo $txt_permanent_address; ?></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_address">Address</label>
                                    <textarea class="form-control" name="txt_address" id="txt_address" maxlength="500" rows="3" placeholder="Address" required><?php echo $txt_address; ?></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_contact">Contact No</label>
                                    <input type="tel" name="txt_contact" id="txt_contact" class="form-control" maxlength="15" placeholder="Contact No" value="<?php echo $mobile; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_dob">Date Of Birth</label>
                                    <input type="date" name="txt_dob" id="txt_dob" class="form-control" maxlength="15" placeholder="Date Of Birth" value="<?php echo $date_of_birth; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_male">Gender</label>                                    
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input class="form-check-input radio-inline" type="radio" name="txt_gender" id="txt_male" value="male" <?php echo ($txt_gender == 'male') ? 'checked' : ''; ?>>
                                        Male</label>
                                        <label class="form-check-label">
                                        <input class="form-check-input radio-inline" type="radio" name="txt_gender" id="txt_female" value="female" <?php echo ($txt_gender == 'female') ? 'checked' : ''; ?>>
                                        Female</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_marital_status">Marital Status</label>                                    
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input class="form-check-input radio-inline" type="radio" name="txt_marital_status" id="txt_unmarried" value="unmarried" <?php echo ($txt_marital_status == 'unmarried') ? 'checked' : ''; ?>>
                                        Unmarried</label>
                                        <label class="form-check-label">
                                        <input class="form-check-input radio-inline" type="radio" name="txt_marital_status" id="txt_married" value="married" <?php echo ($txt_marital_status == 'married') ? 'checked' : ''; ?>>
                                        Married</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_nationality">Nationality</label>
                                    <input type="text" name="txt_nationality" id="txt_nationality" class="form-control" maxlength="25" placeholder="Nationality" value="<?php echo $txt_nationality; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="txt_languages">Languages Known</label>
                                    <input type="text" name="txt_languages" id="txt_languages" class="form-control" maxlength="100" placeholder="Languages" value="<?php echo $txt_language; ?>" required>
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <label for="txt_interest">Area of Interest</label>
                                    <input type="text" name="txt_interest" id="txt_interest" class="form-control" maxlength="300" placeholder="Area of Interest" value="<?php echo $txt_interest; ?>" required>
                                </div> 
                            </section>
                            <h3>Education Details</h3>
                            <section>
                                <div class="col-md-12 mb-3">
                                     <div class="page-content page-container" id="page-content">
                                         <div class="padding1">
                                             <div class="justify-content-center">
                                                 <div class="stretch-card">
                                                     <div class="card">
                                                         <div class="card-body">
                                                             <div class="table-responsive">
                                                                 <table id="faqs" class="table table-hover">
                                                                     <thead>
                                                                         <tr>
                                                                             <th>STD</th>
                                                                             <th>Institute</th>
                                                                             <th>University / Board</th>
                                                                             <th>Year</th>
                                                                             <th>Percentage</th>
                                                                             <th>&nbsp;</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                        <?php if($education_table){ ?> 
                                                                            <?php $i = 0; foreach ($education_table as $education) { ?>
                                                                                <tr id="faqs-row<?php echo $i; ?>">
                                                                                    <td><input type="text" name="education_table[<?php echo $i; ?>][std]" class="form-control" placeholder="STD" value="<?php echo $education['std'] ?>"></td>
                                                                                    <td><input type="text" name="education_table[<?php echo $i; ?>][institute]" class="form-control" placeholder="Institute" value="<?php echo $education['institute'] ?>"></td>
                                                                                    <td><input type="text" name="education_table[<?php echo $i; ?>][university]" class="form-control" placeholder="University / Board" value="<?php echo $education['university'] ?>"></td>
                                                                                    <td><input type="text" name="education_table[<?php echo $i; ?>][year]" class="form-control" placeholder="Year" value="<?php echo $education['year'] ?>"></td>
                                                                                    <td><input type="text" name="education_table[<?php echo $i; ?>][percentage]" class="form-control" placeholder="Percentage" value="<?php echo $education['percentage'] ?>"></td>
                                                                                    <?php if($i != 0){ ?>
                                                                                        <td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery('#faqs-row<?php echo $i; ?>').remove();"><i class="fa fa-trash"></i> Delete</a></td>
                                                                                    <?php }else{ ?> 
                                                                                        <td class="mt-10"></td>
                                                                                     <?php } ?>
                                                                                 </tr>
                                                                            <?php $i++; } ?>
                                                                        <?php }else{ ?> 
                                                                             <tr>
                                                                                 <td><input type="text" name="education_table[0][std]" class="form-control" placeholder="STD"></td>
                                                                                 <td><input type="text" name="education_table[0][institute]" class="form-control" placeholder="Institute"></td>
                                                                                 <td><input type="text" name="education_table[0][university]" class="form-control" placeholder="University / Board"></td>
                                                                                 <td><input type="text" name="education_table[0][year]" class="form-control" placeholder="Year"></td>
                                                                                 <td><input type="text" name="education_table[0][percentage]" class="form-control" placeholder="Percentage"></td>
                                                                                 <td class="mt-10"></td>
                                                                             </tr>
                                                                         <?php } ?>
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                             <div class="text-center"><a href="javascript:void(0);" onclick="addfaqs();" class="badge badge-success"><i class="fa fa-plus"></i> ADD NEW</a></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                            </section>
                            <h3>Skill</h3>
                            <section>
                                <div class="col-md-12 mb-3">
                                     <div class="page-content page-container">
                                         <div class="padding1">
                                             <div class="justify-content-center">
                                                 <div class="stretch-card">
                                                     <div class="card">
                                                         <div class="card-body">
                                                             <div class="table-responsive">
                                                                 <table id="skills" class="table table-hover">
                                                                     <thead>
                                                                         <tr>
                                                                             <th>Skills</th>                                                                             
                                                                             <th>&nbsp;</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                        <?php if($skill){ ?> 
                                                                            <?php $j = 0; foreach ($skill as $skills) { ?>
                                                                                <tr id="skill-row<?php echo $j; ?>">
                                                                                     <td><input type="text" name="skill[<?php echo $j; ?>]" class="form-control" placeholder="Skill" value="<?php echo $skills; ?>"></td>                                                                             
                                                                                     <?php if($j != 0){ ?>
                                                                                        <td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery('#skill-row<?php echo $j; ?>').remove();"><i class="fa fa-trash"></i> Delete</a></td>
                                                                                     <?php }else{ ?> 
                                                                                        <td class="mt-10"></td>
                                                                                     <?php } ?>
                                                                                 </tr>
                                                                            <?php $j++; } ?>
                                                                        <?php }else{ ?> 
                                                                         <tr>
                                                                             <td><input type="text" name="skill[0]" class="form-control" placeholder="Skill"></td>                                                                             
                                                                             <td class="mt-10"></td>
                                                                         </tr>
                                                                         <?php } ?>
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                             <div class="text-center"><a href="javascript:void(0);" onclick="addskill();" class="badge badge-success"><i class="fa fa-plus"></i> ADD NEW</a></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                            </section>

                            <h3>Work Experience</h3>
                            <section>
                                <div class="col-md-12 mb-3">
                                     <div class="page-content page-container">
                                         <div class="padding1">
                                             <div class="justify-content-center">
                                                 <div class="stretch-card">
                                                     <div class="card">
                                                         <div class="card-body">
                                                             <div class="table-responsive">
                                                                 <table id="work_exp_table" class="table table-hover">
                                                                     <thead>
                                                                         <tr>
                                                                             <th>Company Name</th>
                                                                             <th>Emp Number</th>
                                                                             <th>Joining Date</th>
                                                                             <th>End Date</th>
                                                                             <th>Designation</th>                                                                             
                                                                             <th>&nbsp;</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                        <?php if($wordk_exp_arr){ ?> 
                                                                            <?php $k = 0; foreach ($wordk_exp_arr as $wordk_exp) { ?>
                                                                                <tr id="work_exp_table-row<?php echo $k; ?>">
                                                                                     <td><input type="text" name="wordk_exp_arr[<?php echo $k; ?>][company_name]" class="form-control" placeholder="Company Name" value="<?php echo $wordk_exp['company_name']; ?>"></td>
                                                                                     <td><input type="text" name="wordk_exp_arr[<?php echo $k; ?>][emp_number]" class="form-control" placeholder="Emp Number" value="<?php echo $wordk_exp['emp_number']; ?>"></td>
                                                                                     <td><input type="text" name="wordk_exp_arr[<?php echo $k; ?>][joining_date]" class="form-control" placeholder="Joining Date" value="<?php echo $wordk_exp['joining_date']; ?>"></td>
                                                                                     <td><input type="text" name="wordk_exp_arr[<?php echo $k; ?>][end_date]" class="form-control" placeholder="End Date" value="<?php echo $wordk_exp['end_date']; ?>"></td>
                                                                                     <td><input type="text" name="wordk_exp_arr[<?php echo $k; ?>][designation]" class="form-control" placeholder="Designation" value="<?php echo $wordk_exp['designation']; ?>"></td>
                                                                                     <?php if($k != 0){ ?>
                                                                                        <td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery('#work_exp_table-row<?php echo $k; ?>').remove();"><i class="fa fa-trash"></i> Delete</a></td>
                                                                                     <?php }else{ ?> 
                                                                                        <td class="mt-10"></td>
                                                                                     <?php } ?>
                                                                                 </tr>
                                                                            <?php $k++; } ?>
                                                                        <?php }else{ ?> 
                                                                            <tr>
                                                                                 <td><input type="text" name="wordk_exp_arr[0][company_name]" class="form-control" placeholder="Company Name"></td>
                                                                                 <td><input type="text" name="wordk_exp_arr[0][emp_number]" class="form-control" placeholder="Emp Number"></td>
                                                                                 <td><input type="text" name="wordk_exp_arr[0][joining_date]" class="form-control" placeholder="Joining Date"></td>
                                                                                 <td><input type="text" name="wordk_exp_arr[0][end_date]" class="form-control" placeholder="End Date"></td>
                                                                                 <td><input type="text" name="wordk_exp_arr[0][designation]" class="form-control" placeholder="Designation"></td>
                                                                                 <td class="mt-10"></td>
                                                                             </tr>
                                                                         <?php } ?>
                                                                         
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                             <div class="text-center"><a href="javascript:void(0);" onclick="add_work_exp_table();" class="badge badge-success"><i class="fa fa-plus"></i> ADD NEW</a></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                            </section>

                            <h3>Certificates</h3>
                            <section>
                                <div class="col-md-12 mb-3">
                                     <div class="page-content page-container">
                                         <div class="padding1">
                                             <div class="justify-content-center">
                                                 <div class="stretch-card">
                                                     <div class="card">
                                                         <div class="card-body">
                                                             <div class="table-responsive">
                                                                 <table id="certificates" class="table table-hover">
                                                                     <thead>
                                                                         <tr>
                                                                            <th>Certificates Name</th>
                                                                            <th>Certificates URL</th>
                                                                            <th>Grade</th>
                                                                            <th>&nbsp;</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                        <?php if($certificates){ ?> 
                                                                            <?php $l=0; foreach ($certificates as $certificate) { ?>
                                                                                <tr id="certificates-row<?php echo $l; ?>">
                                                                                    <td><input type="text" name="certificates[<?php echo $l; ?>][name]" class="form-control" placeholder="Name" value="<?php echo $certificate['name'];  ?>"></td>
                                                                                    <td><input type="text" name="certificates[<?php echo $l; ?>][url]" class="form-control" placeholder="URL" value="<?php echo $certificate['url'];  ?>"></td>
                                                                                    <td><input type="text" name="certificates[<?php echo $l; ?>][grade]" class="form-control" placeholder="Grade" value="<?php echo $certificate['grade'];  ?>"></td>
                                                                                    <?php if($l != 0){ ?>
                                                                                        <td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery('#certificates-row<?php echo $l; ?>').remove();"><i class="fa fa-trash"></i> Delete</a></td>
                                                                                     <?php }else{ ?> 
                                                                                        <td class="mt-10"></td>
                                                                                     <?php } ?>
                                                                                </tr>
                                                                            <?php $l++; } ?>
                                                                        <?php }else{ ?> 
                                                                            <tr>
                                                                             <td><input type="text" name="certificates[0][name]" class="form-control" placeholder="Name"></td>
                                                                             <td><input type="text" name="certificates[0][url]" class="form-control" placeholder="URL"></td>
                                                                             <td><input type="text" name="certificates[0][grade]" class="form-control" placeholder="Grade"></td>
                                                                             <td class="mt-10"></td>
                                                                         </tr>
                                                                         <?php } ?>    
                                                                         
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                             <div class="text-center"><a href="javascript:void(0);" onclick="add_certificates();" class="badge badge-success"><i class="fa fa-plus"></i> ADD NEW</a></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                            </section>

                            <h3>Awards</h3>
                            <section>
                                <div class="col-md-12 mb-3">
                                     <div class="page-content page-container">
                                         <div class="padding1">
                                             <div class="justify-content-center">
                                                 <div class="stretch-card">
                                                     <div class="card">
                                                         <div class="card-body">
                                                             <div class="table-responsive">
                                                                 <table id="awards" class="table table-hover">
                                                                     <thead>
                                                                         <tr>
                                                                            <th>Awards Name</th>
                                                                            <th>Awards Short Details</th>                                                                            
                                                                            <th>&nbsp;</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                        <?php if($awards){ ?> 
                                                                            <?php $m=0; foreach ($awards as $award) { ?>
                                                                                 <tr id="awards-row<?php echo $m; ?>">
                                                                                     <td><input type="text" name="awards[<?php echo $m; ?>][name]" class="form-control" placeholder="Name" value="<?php echo $award['name']; ?>"></td>
                                                                                     <td><input type="text" name="awards[<?php echo $m; ?>][detail]" class="form-control" placeholder="Detail" value="<?php echo $award['detail']; ?>"></td>                                                                                     
                                                                                     <?php if($m != 0){ ?>
                                                                                        <td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery('#awards-row<?php echo $m; ?>').remove();"><i class="fa fa-trash"></i> Delete</a></td>
                                                                                     <?php }else{ ?> 
                                                                                        <td class="mt-10"></td>
                                                                                     <?php } ?>
                                                                                 </tr>
                                                                            <?php $m++; } ?>
                                                                        <?php }else{ ?> 
                                                                             <tr>
                                                                                 <td><input type="text" name="awards[0][name]" class="form-control" placeholder="Name"></td>
                                                                                 <td><input type="text" name="awards[0][detail]" class="form-control" placeholder="Detail"></td>
                                                                                 <td class="mt-10"></td>
                                                                             </tr>
                                                                         <?php } ?> 
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                             <div class="text-center"><a href="javascript:void(0);" onclick="add_awards();" class="badge badge-success"><i class="fa fa-plus"></i> ADD NEW</a></div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                            </section>
                            <h3>Resume Templates</h3>
                            <section>
                                <a href="<?php echo esc_url( home_url( '/mpdf/example01_own.php' ) ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/resume_1.png" alt="" width="200px" height="250px"></a>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <a href="<?php echo esc_url( home_url( '/mpdf/example02_own.php' ) ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/resume_2.png" alt="" width="200px" height="250px"></a>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <a href="<?php echo esc_url( home_url( '/mpdf/example03_own.php' ) ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/assets/images/resume_3.png" alt="" width="200px" height="250px"></a>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                            </section>
                        </div>
                        <?php                                       
                            wp_nonce_field( 'submit_form_solution_profile', 'submit_form_solution_profile' ); 
                        ?>
                    </form>
               </div>
            </div>
                 
        </div>
    </div>
</section>
<?php
get_footer();
