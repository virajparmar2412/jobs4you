<?php
/* 
* Template Name: Jobseeker Registration
*/
if(!is_user_logged_in()){
    if((!isset($_POST['fname'])) && (!isset($_POST['lname'])) && (!isset($_POST['mobile'])) && (!isset($_POST['email_r'])) && (!isset($_POST['user_pwd'])) ){
        $registration = get_permalink( get_page_by_path( 'registration' ) );
        wp_redirect( $registration ); 
        exit;
    }
}else{
    $dashboard = get_permalink( get_page_by_path( 'dashboard' ) );
    wp_redirect( $dashboard ); 
    exit;
}


if(wp_verify_nonce($_REQUEST['jobseeker_r_submit'], 'jobseeker_r_submit')){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $email_r = $_POST['email_r'];
    $user_pwd = $_POST['user_pwd'];
    $txt_nationality = $_POST['txt_nationality'];
    $txt_language = $_POST['txt_language'];
    $txt_gender = $_POST['txt_gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $txt_address = $_POST['txt_address'];
    $education_table = $_POST['education_table'];
    $wordk_exp_arr = $_POST['wordk_exp_arr'];
    $txt_project = $_POST['txt_project'];
    $skill = $_POST['skill'];
    $certificates = $_POST['certificates'];
    $awards = $_POST['awards'];
    
    $login_name = random_username($fname.' '.$lname);
    $data = array(
        'user_login' => $login_name,
        'user_pass'  => $user_pwd,
        'user_email' => $email_r,
        'first_name' => $fname,
        'last_name' => $lname,
        'nickname' => $fname,
        'display_name'=> $fname,
        'role' => 'jobseeker_user',
        'show_admin_bar_front' => false
    );   
    $user_id = wp_insert_user( $data );  
    if ( ! is_wp_error( $user_id ) ) {
        update_user_meta($user_id, 'txt_email', $email_r );
        update_user_meta($user_id, 'mobile', $mobile );
        update_user_meta($user_id, 'txt_nationality', $txt_nationality); 
        update_user_meta($user_id, 'txt_language', $txt_language); 
        update_user_meta($user_id, 'txt_gender', $txt_gender); 
        update_user_meta($user_id, 'date_of_birth', $date_of_birth); 
        update_user_meta($user_id, 'txt_address', $txt_address); 
        update_user_meta($user_id, 'education_table', $education_table); 
        update_user_meta($user_id, 'wordk_exp_arr', $wordk_exp_arr); 
        update_user_meta($user_id, 'txt_project', $txt_project); 
        update_user_meta($user_id, 'skill', $skill); 
        update_user_meta($user_id, 'certificates', $certificates); 
        update_user_meta($user_id, 'awards', $awards); 
        update_user_meta($user_id, 'user_flag', 'active' );
    }

    $thankyou = get_permalink( get_page_by_path( 'thank-you' ) ).'?message=Thank you for Registration to Jobs4You';
    wp_redirect($thankyou);
}
get_header();

?>
<!-- Registraion Form -->
    <h2 class="page-title">Jobseeker Details</h2>
    <form class="inner-form jobseeker-form" method="post" id="jobseeker_reg_form" action="">
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="txt_nationality">Nationality</label>                
                <select class="form-control" id="txt_nationality" name="txt_nationality" required><option value="">-Nationality-</option><option value="Afghan">Afghan</option><option value="Albanian">Albanian</option><option value="Algerian">Algerian</option><option value="American">American</option><option value="Andorran">Andorran</option><option value="Angolan">Angolan</option><option value="Antiguans">Antiguans</option><option value="Argentinean">Argentinean</option><option value="Armenian">Armenian</option><option value="Australian">Australian</option><option value="Austrian">Austrian</option><option value="Azerbaijani">Azerbaijani</option><option value="Bahamian">Bahamian</option><option value="Bahraini">Bahraini</option><option value="Bangladeshi">Bangladeshi</option><option value="Barbadian">Barbadian</option><option value="Barbudans">Barbudans</option><option value="Batswana">Batswana</option><option value="Belarusian">Belarusian</option><option value="Belgian">Belgian</option><option value="Belizean">Belizean</option><option value="Beninese">Beninese</option><option value="Bhutanese">Bhutanese</option><option value="Bolivian">Bolivian</option><option value="Bosnian">Bosnian</option><option value="Brazilian">Brazilian</option><option value="British">British</option><option value="Bruneian">Bruneian</option><option value="Bulgarian">Bulgarian</option><option value="Burkinabe">Burkinabe</option><option value="Burmese">Burmese</option><option value="Burundian">Burundian</option><option value="Cambodian">Cambodian</option><option value="Cameroonian">Cameroonian</option><option value="Canadian">Canadian</option><option value="Cape Verdean">Cape Verdean</option><option value="Central African">Central African</option><option value="Chadian">Chadian</option><option value="Chilean">Chilean</option><option value="Chinese">Chinese</option><option value="Colombian">Colombian</option><option value="Comoran">Comoran</option><option value="Congolese">Congolese</option><option value="Costa Rican">Costa Rican</option><option value="Croatian">Croatian</option><option value="Cuban">Cuban</option><option value="Cypriot">Cypriot</option><option value="Czech">Czech</option><option value="Danish">Danish</option><option value="Djibouti">Djibouti</option><option value="Dominican">Dominican</option><option value="Dutch">Dutch</option><option value="East Timorese">East Timorese</option><option value="Ecuadorean">Ecuadorean</option><option value="Egyptian">Egyptian</option><option value="Emirian">Emirian</option><option value="Equatorial Guinean">Equatorial Guinean</option><option value="Eritrean">Eritrean</option><option value="Estonian">Estonian</option><option value="Ethiopian">Ethiopian</option><option value="Fijian">Fijian</option><option value="Filipino">Filipino</option><option value="Finnish">Finnish</option><option value="French">French</option><option value="Gabonese">Gabonese</option><option value="Gambian">Gambian</option><option value="Georgian">Georgian</option><option value="German">German</option><option value="Ghanaian">Ghanaian</option><option value="Greek">Greek</option><option value="Grenadian">Grenadian</option><option value="Guatemalan">Guatemalan</option><option value="Guinea-Bissauan">Guinea-Bissauan</option><option value="Guinean">Guinean</option><option value="Guyanese">Guyanese</option><option value="Haitian">Haitian</option><option value="Herzegovinian">Herzegovinian</option><option value="Honduran">Honduran</option><option value="Hungarian">Hungarian</option><option value="Icelander">Icelander</option><option value="Indian">Indian</option><option value="Indonesian">Indonesian</option><option value="Iranian">Iranian</option><option value="Iraqi">Iraqi</option><option value="Irish">Irish</option><option value="Israeli">Israeli</option><option value="Italian">Italian</option><option value="Ivorian">Ivorian</option><option value="Jamaican">Jamaican</option><option value="Japanese">Japanese</option><option value="Jordanian">Jordanian</option><option value="Kazakhstani">Kazakhstani</option><option value="Kenyan">Kenyan</option><option value="Kittian and Nevisian">Kittian and Nevisian</option><option value="Kuwaiti">Kuwaiti</option><option value="Kyrgyz">Kyrgyz</option><option value="Laotian">Laotian</option><option value="Latvian">Latvian</option><option value="Lebanese">Lebanese</option><option value="Liberian">Liberian</option><option value="Libyan">Libyan</option><option value="Liechtensteiner">Liechtensteiner</option><option value="Lithuanian">Lithuanian</option><option value="Luxembourger">Luxembourger</option><option value="Macedonian">Macedonian</option><option value="Malagasy">Malagasy</option><option value="Malawian">Malawian</option><option value="Malaysian">Malaysian</option><option value="Maldivan">Maldivan</option><option value="Malian">Malian</option><option value="Maltese">Maltese</option><option value="Marshallese">Marshallese</option><option value="Mauritanian">Mauritanian</option><option value="Mauritian">Mauritian</option><option value="Mexican">Mexican</option><option value="Micronesian">Micronesian</option><option value="Moldovan">Moldovan</option><option value="Monacan">Monacan</option><option value="Mongolian">Mongolian</option><option value="Moroccan">Moroccan</option><option value="Mosotho">Mosotho</option><option value="Motswana">Motswana</option><option value="Mozambican">Mozambican</option><option value="Namibian">Namibian</option><option value="Nauruan">Nauruan</option><option value="Nepalese">Nepalese</option><option value="New Zealander">New Zealander</option><option value="Ni-Vanuatu">Ni-Vanuatu</option><option value="Nicaraguan">Nicaraguan</option><option value="Nigerien">Nigerien</option><option value="North Korean">North Korean</option><option value="Northern Irish">Northern Irish</option><option value="Norwegian">Norwegian</option><option value="Omani">Omani</option><option value="Pakistani">Pakistani</option><option value="Palauan">Palauan</option><option value="Panamanian">Panamanian</option><option value="Papua New Guinean">Papua New Guinean</option><option value="Paraguayan">Paraguayan</option><option value="Peruvian">Peruvian</option><option value="Polish">Polish</option><option value="Portuguese">Portuguese</option><option value="Qatari">Qatari</option><option value="Romanian">Romanian</option><option value="Russian">Russian</option><option value="Rwandan">Rwandan</option><option value="Saint Lucian">Saint Lucian</option><option value="Salvadoran">Salvadoran</option><option value="Samoan">Samoan</option><option value="San Marinese">San Marinese</option><option value="Sao Tomean">Sao Tomean</option><option value="Saudi">Saudi</option><option value="Scottish">Scottish</option><option value="Senegalese">Senegalese</option><option value="Serbian">Serbian</option><option value="Seychellois">Seychellois</option><option value="Sierra Leonean">Sierra Leonean</option><option value="Singaporean">Singaporean</option><option value="Slovakian">Slovakian</option><option value="Slovenian">Slovenian</option><option value="Solomon Islander">Solomon Islander</option><option value="Somali">Somali</option><option value="South African">South African</option><option value="South Korean">South Korean</option><option value="Spanish">Spanish</option><option value="Sri Lankan">Sri Lankan</option><option value="Sudanese">Sudanese</option><option value="Surinamer">Surinamer</option><option value="Swazi">Swazi</option><option value="Swedish">Swedish</option><option value="Swiss">Swiss</option><option value="Syrian">Syrian</option><option value="Taiwanese">Taiwanese</option><option value="Tajik">Tajik</option><option value="Tanzanian">Tanzanian</option><option value="Thai">Thai</option><option value="Togolese">Togolese</option><option value="Tongan">Tongan</option><option value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option><option value="Tunisian">Tunisian</option><option value="Turkish">Turkish</option><option value="Tuvaluan">Tuvaluan</option><option value="Ugandan">Ugandan</option><option value="Ukrainian">Ukrainian</option><option value="Uruguayan">Uruguayan</option><option value="Uzbekistani">Uzbekistani</option><option value="Venezuelan">Venezuelan</option><option value="Vietnamese">Vietnamese</option><option value="Welsh">Welsh</option><option value="Yemenite">Yemenite</option><option value="Zambian">Zambian</option><option value="Zimbabwean">Zimbabwean</option></select>
            </div>
            <div class="col-md-12 mb-3">
                <label class="d-block" for="txt_language">Languages</label>                
                <select class="form-control" id="txt_language" name="txt_language" required><option value="">-Language-</option> <option value="AF">Afrikaans</option><option value="SQ">Albanian</option><option value="AR">Arabic</option><option value="HY">Armenian</option><option value="EU">Basque</option><option value="BN">Bengali</option><option value="BG">Bulgarian</option><option value="CA">Catalan</option><option value="KM">Cambodian</option><option value="ZH">Chinese (Mandarin)</option><option value="HR">Croatian</option><option value="CS">Czech</option><option value="DA">Danish</option><option value="NL">Dutch</option><option value="EN">English</option><option value="ET">Estonian</option><option value="FJ">Fiji</option><option value="FI">Finnish</option><option value="FR">French</option><option value="KA">Georgian</option><option value="DE">German</option><option value="EL">Greek</option><option value="GU">Gujarati</option><option value="HE">Hebrew</option><option value="HI">Hindi</option><option value="HU">Hungarian</option><option value="IS">Icelandic</option><option value="ID">Indonesian</option><option value="GA">Irish</option><option value="IT">Italian</option><option value="JA">Japanese</option><option value="JW">Javanese</option><option value="KO">Korean</option><option value="LA">Latin</option><option value="LV">Latvian</option><option value="LT">Lithuanian</option><option value="MK">Macedonian</option><option value="MS">Malay</option><option value="ML">Malayalam</option><option value="MT">Maltese</option><option value="MI">Maori</option><option value="MR">Marathi</option><option value="MN">Mongolian</option><option value="NE">Nepali</option><option value="NO">Norwegian</option><option value="FA">Persian</option><option value="PL">Polish</option><option value="PT">Portuguese</option><option value="PA">Punjabi</option><option value="QU">Quechua</option><option value="RO">Romanian</option><option value="RU">Russian</option><option value="SM">Samoan</option><option value="SR">Serbian</option><option value="SK">Slovak</option><option value="SL">Slovenian</option><option value="ES">Spanish</option><option value="SW">Swahili</option><option value="SV">Swedish</option><option value="TA">Tamil</option><option value="TT">Tatar</option><option value="TE">Telugu</option><option value="TH">Thai</option><option value="BO">Tibetan</option><option value="TO">Tonga</option><option value="TR">Turkish</option><option value="UK">Ukrainian</option><option value="UR">Urdu</option><option value="UZ">Uzbek</option><option value="VI">Vietnamese</option><option value="CY">Welsh</option><option value="XH">Xhosa</option></select>
            </div>
            <div class="col-6 mb-3">
                <label class="d-block" for="txt_gender">Gender</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="txt_gender_male" name="txt_gender" class="custom-control-input" value="male" checked>
                    <label class="custom-control-label" for="txt_gender_male">Male</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="txt_gender_female" name="txt_gender" class="custom-control-input" value="female">
                    <label class="custom-control-label" for="txt_gender_female">Female</label>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" required>
            </div>            
            <div class="col-md-12 mb-3">
                <label for="txt_address">Address</label>
                <textarea class="form-control" id="txt_address" name="txt_address" minlength="8" maxlength="100" rows="3" placeholder="Address"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label class="d-block" for="education_table">High Qualification</label>
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
                                                     <tr>
                                                         <td><input type="text" id="education_table[0][std]" name="education_table[0][std]" class="form-control" placeholder="STD"></td>
                                                         <td><input type="text" id="education_table[0][institute]" name="education_table[0][institute]" class="form-control" placeholder="Institute"></td>
                                                         <td><input type="text" id="education_table[0][university]" name="education_table[0][university]" class="form-control" placeholder="University / Board"></td>
                                                         <td><input type="text" id="education_table[0][year]" name="education_table[0][year]" class="form-control" placeholder="Year"></td>
                                                         <td><input type="text" id="education_table[0][percentage]" name="education_table[0][percentage]" class="form-control" placeholder="Percentage"></td>
                                                         <td class="mt-10"></td>
                                                     </tr>                                                         
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
            <div class="col-md-12 mb-3">
                <label class="d-block" for="work_exp">Work Experience</label>                
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
                                                <tr>
                                                     <td><input type="text" name="wordk_exp_arr[0][company_name]" id="wordk_exp_arr[0][company_name]" class="form-control" placeholder="Company Name"></td>
                                                     <td><input type="text" name="wordk_exp_arr[0][emp_number]" id="wordk_exp_arr[0][emp_number]" class="form-control" placeholder="Emp Number"></td>
                                                     <td><input type="text" name="wordk_exp_arr[0][joining_date]" id="wordk_exp_arr[0][joining_date]" class="form-control" placeholder="Joining Date"></td>
                                                     <td><input type="text" name="wordk_exp_arr[0][end_date]" id="wordk_exp_arr[0][end_date]" class="form-control" placeholder="End Date"></td>
                                                     <td><input type="text" name="wordk_exp_arr[0][designation]" id="wordk_exp_arr[0][designation]" class="form-control" placeholder="Designation"></td>
                                                     <td class="mt-10"></td>
                                                 </tr>
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
            <div class="col-md-12 mb-3">
                <label class="d-block" for="txt_project">Project</label>
                <textarea class="form-control" id="txt_project" name="txt_project" minlength="5" maxlength="255" rows="3" placeholder="Project"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label class="d-block" for="txt_skills">Skills</label>
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
                                                    <tr>
                                                        <td><input type="text" name="skill[0]" id="skill[0]" class="form-control" placeholder="Skill"></td>                                                                             
                                                        <td class="mt-10"></td>
                                                    </tr>                                                                        
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
            <div class="col-md-12 mb-3">
                <label class="d-block" for="certificates">Certificates</label>                
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
                                                <tr>
                                                    <td><input type="text" name="certificates[0][name]" id="certificates[0][name]" class="form-control" placeholder="Name"></td>
                                                    <td><input type="text" name="certificates[0][url]" id="certificates[0][url]" class="form-control" placeholder="URL"></td>
                                                    <td><input type="text" name="certificates[0][grade]" id="certificates[0][grade]" class="form-control" placeholder="Grade"></td>
                                                    <td class="mt-10"></td>
                                                </tr>
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
            <div class="col-md-12 mb-3">
                <label class="d-block" for="awards">Awards</label>                
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
                                                     <tr>
                                                         <td><input type="text" name="awards[0][name]" class="form-control" placeholder="Name"></td>
                                                         <td><input type="text" name="awards[0][detail]" class="form-control" placeholder="Detail"></td>
                                                         <td class="mt-10"></td>
                                                     </tr>
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
            
        </div>
        <div class="w-100 text-center">
            <input type="hidden" id="message" name="message" value="Welcome to Jobs4You! – Thank you for Registration to Jobs4You">
            <input type="hidden" id="fname" name="fname" minlength="3" maxlength="15" value="<?php echo $_POST['fname']; ?>">
            <input type="hidden" id="lname" name="lname" minlength="3" maxlength="15" value="<?php echo $_POST['lname']; ?>">
            <input type="hidden" id="mobile" name="mobile" maxlength="12" value="<?php echo $_POST['mobile']; ?>">
            <input type="hidden" id="email_r" name="email_r" maxlength="30" value="<?php echo $_POST['email_r']; ?>">
            <input type="hidden" id="user_pwd" name="user_pwd" minlength="8" maxlength="20" value="<?php echo $_POST['user_pwd']; ?>">
            <?php wp_nonce_field('jobseeker_r_submit', 'jobseeker_r_submit'); ?>

            <input class="btn btn-dark" type="submit" value="Submit" name="jobseeker_login_submit">
        </div>
    </form>
    <!-- End Registraion Form -->
<?php 
get_footer();