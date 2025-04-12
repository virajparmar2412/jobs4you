jQuery(document).ready(function($){
  var urlRedirect = my_ajax_object.dashboard;
  var ajaxurl = my_ajax_object.ajax_url;
  var education_table = my_ajax_object.education_table;


  $("#inputGroupSelect01").change(function(){
    var formData = {
      'action' : 'getSubCat',
      'term_id' : $(this).val()
    };
    $.ajax({
        type: "post",
        url: ajaxurl,
        data: formData,
        success: function(msg){
          $("#inputGroupSelect02").html(msg);
        }
    });
  });

   $('#category').change(function () {
    var formData = {
      'action' : 'getSubCat',
      'term_id' : $('#category').val()
    };
    $.ajax({
        type: "post",
        url: ajaxurl,
        data: formData,
        success: function(msg){
          $("#subcategory").html(msg);
        }
    });
  });
  /*$('#category').trigger('change');*/

  if($("#solution_profile_form").length > 0){

    var solutionform = jQuery("#solution_profile_form");
    solutionform.validate({
      errorPlacement: function errorPlacement(error, element) { element.before(error); },      
      rules: {
          confirm: {
              equalTo: "#password"
          }
      },
   });
  solutionform.children("div").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      stepsOrientation: "vertical",      
      labels: {
        cancel: "Cancel",        
        pagination: "Pagination",      
        next: "NEXT PAGE",
        previous: "PREVIOUS PAGE",
        loading: "Loading ..."
      },
       onCanceled: function (event)
        {
            validator.resetForm();
        },
      onStepChanging: function (event, currentIndex, newIndex)
      {
          solutionform.validate().settings.ignore = ":disabled,:hidden";
          return solutionform.valid();
      },
      onFinishing: function (event, currentIndex)
      {
          solutionform.validate().settings.ignore = ":disabled";
          return solutionform.valid();
      },
      onFinished: function (event, currentIndex)
      {        
          jQuery('#solution_profile_form').submit();
      }
  });


   
  }

  /*********************************
  * Search validation
  **********************************/

  $("#search-form").validate({
      rules: {
          'search_txt': {
              required: true,
          },
      },
      messages: {          
          'search_txt': {
            required: "The email field is mandatory!",            
          },          
      },
      highlight: function(element) {
        $(element).parent().addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).parent().removeClass('has-error');
      },
      errorPlacement: function(){
            return false;  // suppresses error message text
        },
      errorElement: 'span',        
      
    });

  /*********************************
  * subscribe validation
  **********************************/

  $("#subscribeMail_page").validate({      
      rules: {                            
          'subscribeMail': {
              required: true,
              email: true,                        
          },
      },
      messages: {          
          'subscribeMail': {
            required: "The email field is mandatory!",
            email: "Please enter a valid email address!",               
          },          
      },
      highlight: function(element) {
        $(element).parent().addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).parent().removeClass('has-error');
      },
      submitHandler: function(form) {
        var emailID = $('#subscribeMail').val();
        var formData = {
          'action' : 'subscribe_save',
          'sub_email' : emailID
        };
        $.ajax({
            type: "post",
            dataType: "json",
            url: my_ajax_object.ajax_url,
            data: formData,
            success: function(msg){
              if(msg == 1){
                form.submit();
              }
            }
        });
        
      },
      errorPlacement: function(){
            return false;  // suppresses error message text
        },
      errorElement: 'span',
      
    });

  /*********************************
  * Contact us validation
  **********************************/

  $("#contact-us").validate({
      rules: {
          'txt_name': {
              required: true,
              minlength: 3,
              maxlength: 25,
          },                    
          'txt_email': {
              required: true,
              email: true,                        
          },                    
          'txt_message': {
              required: true,
              minlength: 8,
              maxlength: 500,
          },
          
      },
      messages: {
          'txt_name': {
              required: "The name field is mandatory!",
              minlength: "Enter the name of at least 3 letters!",
              maxlength: "Enter the name of too much lenght.",
          },
          'txt_email': {
              required: "The email field is mandatory!",
              email: "Please enter a valid email address!", 
              
          },
          'txt_message': {
              required: "The message is required!",
              minlength: "Enter the message of at least 8 letters!",
              maxlength: "Enter the message is too much lenght.",
          }
      },
      submitHandler: function(form) {
        var txt_name = $('#txt_name').val();
        var txt_email = $('#txt_email').val();
        var txt_message = $('#txt_message').val();

        var formData = {
          'action' : 'contact_save',
          'txt_name' : txt_name,
          'txt_email' : txt_email,
          'txt_message' : txt_message,
        };
        $.ajax({
            type: "post",
            dataType: "json",
            url: my_ajax_object.ajax_url,
            data: formData,
            success: function(msg){
              if(msg == 1){
                form.submit();
              }
            }
        });
        
      },
    });

  /*********************************
  * Common Login validation
  **********************************/

  $("#common_login").validate({    
    submitHandler : function(form) {
       var txt_email = $('#txt_email').val();
        var pwd = $('#pwd').val();
        var formData = {
          'action' : 'user_login_check_login',
          'user_email' : txt_email,
          'user_pwd' : pwd,
        };
        var ajaxurl = my_ajax_object.ajax_url;        
        jQuery.post(ajaxurl, formData, function(response) {            
            if(response == '0'){
                $(".auth-content").html("");
                $(".auth-content").html("<label class='error'>Your email address or password are wrong, please try again.</label>");
                return false;
            }else if(response == '2'){  
              $(".auth-content").html("");  
              $(".auth-content").html("<label class='error'>Your account is not active</label>");
                return false;
            }else if(response == '1'){
                var data = {
                    'action': 'common_success_login',
                    'user_email': txt_email,
                    'user_pwd': pwd,
                    
                };
                var ajaxurl = my_ajax_object.ajax_url;        
                jQuery.post(ajaxurl, data, function(responseCool) {                

                  if(responseCool == 'error'){
                    $(".auth-content").html("");
                    $(".auth-content").html("<label class='error'>Someing wants to wrong.</label>");
                  }else if(responseCool == 'done'){
                    window.location.href = urlRedirect;
                  }else{
                    $(".auth-content").html("");
                    $(".auth-content").html("<label class='error'>"+responseCool+"</label>");
                  }


                });                        
                return true;
            }
        });
    },    
      rules: {                            
          'txt_email': {
              required: true,
              email: true,                        
          },                    
          'pwd': {
              required: true,
              minlength: 8,
              maxlength: 255,
          },
          
      },
      messages: {          
          'txt_email': {
              required: "The email field is mandatory!",
              email: "Please enter a valid email address!", 
              
          },
          'pwd': {
              required: "The Password is required!",
              minlength: "Enter the Password of at least 8 characters!",
              maxlength: "Enter the Password is too much lenght.",
          }
      }
    });

  

  /*********************************
  * Registration us validation
  **********************************/
  $('#user_type_select').on('change', function() {
    var selectUsertype = this.value;
    $("#user_registration").attr('action', selectUsertype);
  }); 

  $("#user_registration").validate({
      submitHandler: function(form) {        
        form.submit();
      },
      rules: {
          'fname': {
              required: true,
              minlength: 3,
              maxlength: 15,
          }, 
          'lname': {
              required: true,
              minlength: 3,
              maxlength: 15,
          },
          'mobile': {
              required: true,
              minlength: 10,
              maxlength: 12,
          }, 
          'email_r': {
              required: true,
              maxlength: 30,
              email: true,
          },
          'user_pwd': {
              required:true,
              minlength:8,
              maxlength:30,              
          },                               
          'cpwd': {              
              required:true,
              minlength:8,
              maxlength:30,
              equalTo :'#user_pwd'
          },
          'user_type_select': {
              required: true              
          },
          
      },
      messages: {
          'fname': {
              required: "The First name field is mandatory!",
              minlength: "Enter the First name of at least 3 letters!",
              maxlength: "Enter the First name of too much lenght.",
          },
          'lname': {
              required: "The Last name field is mandatory!",
              minlength: "Enter the Last name of at least 3 letters!",
              maxlength: "Enter the Last name of too much lenght.",
          },
          'mobile': {
              required: "The Mobile field is mandatory!",
              minlength: "Enter the Mobile of at least 10 characters!",
              maxlength: "Enter the mobile of maximum 12 characters!",
          },
          'email_r': {
              required: "The Email field is mandatory!",
              email: "Please enter a valid email address!",               
          },
          'user_pwd': {
              required:"The Password field is mandatory!",
              minlength: "Enter the Password of at least 8 letters!",
              maxlength: "Enter the Password of too much lenght.",              
          },                               
          'cpwd': {              
              required:"The Confirm Password field is mandatory!",
              minlength: "Enter the Confirm Password of at least 8 letters!",
              maxlength: "Enter the Confirm Password of too much lenght.",
              equalTo :'Password is not matched',
          },
          'user_type_select': {
              required: "The user type field is mandatory!"              
          },
      }
    });

  /*********************************
  * Company Registration us validation
  **********************************/

  $("#company_reg_form").validate({
      submitHandler: function(form) { 
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var mobile = $("#mobile").val();
        var email_r = $("#email_r").val();
        var user_pwd = $("#user_pwd").val();
        var companyName = $("#companyName").val();
        var companyTYPE = $("#companyTYPE").val();        
        var companyAddress = $("#companyAddress").val();
        var CompanyWebsite = $("#CompanyWebsite").val();
        var CompanyRegistrationNo = $("#CompanyRegistrationNo").val();
        var CompanyLocation = $("#CompanyLocation").val();
        var companyDetails = $("#companyDetails").val();
        
        var data = {
          'action': 'success_registration_company',
          'fname': fname,
          'lname': lname,
          'mobile': mobile,
          'email_r': email_r,
          'user_pwd': user_pwd,
          'companyName': companyName,
          'companyTYPE': companyTYPE,          
          'companyAddress': companyAddress,
          'CompanyWebsite': CompanyWebsite,
          'CompanyRegistrationNo': CompanyRegistrationNo,
          'CompanyLocation': CompanyLocation,
          'companyDetails': companyDetails,          
        };
        var ajaxurl = my_ajax_object.ajax_url;        
        jQuery.post(ajaxurl, data, function(responseCool) {
          form.submit();
        });  
        
      },
      rules: {
          'companyName': {
              required: true,              
              maxlength: 20,
          }, 
          'companyTYPE': {
              required: true,              
              maxlength: 20,
          },
          'companyAddress': {
              required: true,              
              maxlength: 50,
          }, 
          'CompanyWebsite': {
              required: true,
              maxlength: 30,              
          },
          'CompanyRegistrationNo': {
              required: true,
              maxlength: 12,              
              minlength: 12,              
          },
          'CompanyLocation': {
              required: true,
              maxlength: 200,              
          },
          'companyDetails': {
              required:true,              
              maxlength:255              
          },
      },
      messages: {
          'companyName': {
              required: "The Company Name field is mandatory!",
              maxlength: "Enter the Company Name of too much lenght.",
          },
          'companyTYPE': {
              required: "The Company Type field is mandatory!",
              maxlength: "Enter the Company Type of too much lenght.",
          },
          'companyAddress': {
              required: "The Company Address field is mandatory!",
              maxlength: "Enter the Company Address of too much lenght.",
          },
          'CompanyWebsite': {
              required: "The Website field is mandatory!",
              maxlength: "Enter the Website of too much lenght.",
          },
          'CompanyRegistrationNo': {
              required: "The Registration No field is mandatory!",
              maxlength: "Enter 12 characters Registration No.",
              minlength: "Enter 12 characters Registration No.",
          },
          'CompanyLocation': {
              required: "The Company Location field is mandatory!",
              maxlength: "Enter the Company Location of too much lenght.",
          },
          'companyDetails': {
              required: "The Description field is mandatory!",
              maxlength: "Enter the Company Description of too much lenght.",
          },
        }
    });

  /*********************************
  * Jobseeker Registration us validation
  **********************************/

  $("#jobseeker_reg_form").validate({
      //submitHandler: function(form) { 
        /*var fname = $("#fname").val();
        var lname = $("#lname").val();
        var mobile = $("#mobile").val();
        var email_r = $("#email_r").val();
        var user_pwd = $("#user_pwd").val();
        var txt_nationality = $("#txt_nationality").val();
        var txt_language = $("#txt_language").val();
        var txt_gender = $('input[name="txt_gender"]:checked').val();
        var date_of_birth = $("#date_of_birth").val();
        var txt_address = $("#txt_address").val();
        var education_table = $("#education_table").val();
        var work_exp = $("#work_exp").val();
        var txt_project = $("#txt_project").val();
        var txt_skills = $("#txt_skills").val();
        var txt_achievemnets = $("#txt_achievemnets").val();
        var data = {
          'action': 'success_registration_jobseeker',
          'fname': fname,
          'lname': lname,
          'mobile': mobile,
          'email_r': email_r,
          'user_pwd': user_pwd,
          'txt_nationality': txt_nationality,
          'txt_language': txt_language,
          'txt_gender': txt_gender,
          'date_of_birth': date_of_birth,
          'txt_address': txt_address,
          'high_qualification': high_qualification,
          'work_exp': work_exp,
          'txt_project': txt_project,
          'txt_skills': txt_skills,
          'txt_achievemnets': txt_achievemnets,
        };
        var ajaxurl = my_ajax_object.ajax_url;        
        jQuery.post(ajaxurl, data, function(responseCool) {
          form.submit();
        }); */
        
      //},
      rules: {
          'txt_nationality': {
              required: true,              
          }, 
          'txt_language': {
              required: true,              
          },
          'date_of_birth': {
              required: true,
          }, 
          'txt_address': {
              required: true,
              minlength: 8,
              maxlength: 100,
          },
          'education_table[0][std]': {
              required:true,
          },
          'education_table[0][institute]': {
              required:true,
          },
          'education_table[0][university]': {
              required:true,
          },
          'education_table[0][year]': {
              required:true,
          },
          'education_table[0][percentage]': {
              required:true,
          },          
          'txt_project': {
              required:true,
              minlength: 5,
              maxlength:255,
          },
          'skill[0]': {
              required:true,
          },
                  

      },
      messages: {
          'txt_nationality': {
              required: "The Nationality field is mandatory!",              
          }, 
          'txt_language': {
              required: "The Language field is mandatory!",              
          },
          'date_of_birth': {
              required: "The DOB field is mandatory!",
          }, 
          'txt_address': {
              required: "The Address field is mandatory!",
              minlength: "Enter the Address of at least 8 letters!",
              maxlength: "Enter the Address of too much lenght.",
          },          
          'education_table[0][std]': {
              required: "Mandatory",
          },
          'education_table[0][institute]': {
              required: "Mandatory",
          },
          'education_table[0][university]': {
              required: "Mandatory",
          },
          'education_table[0][year]': {
              required: "Mandatory",
          },
          'education_table[0][percentage]': {
              required: "Mandatory",
          },
          'txt_project': {
              required: "The Project field is mandatory!",
              minlength: "Enter the Project of at least 5 letters!",
              maxlength: "Enter the Project of too much lenght.",
          },
          'skill[0]': {
              required:"The Skills field is mandatory!",
          },
          
        }
    });

    $('.text').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });

    $('.number').on('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });

});
  var education_table = my_ajax_object.education_table;
  var faqs_row = education_table;
  function addfaqs() {
  html = '<tr id="faqs-row' + faqs_row + '">';
      html += '<td><input type="text" name="education_table['+faqs_row+'][std]" class="form-control" placeholder="STD"></td>';
      html += '<td><input type="text" name="education_table['+faqs_row+'][institute]" class="form-control" placeholder="Institute"></td>';
      html += '<td><input type="text" name="education_table['+faqs_row+'][university]" class="form-control" placeholder="University / Board"></td>';
      html += '<td><input type="text" name="education_table['+faqs_row+'][year]" class="form-control" placeholder="Year"></td>';
      html += '<td><input type="text" name="education_table['+faqs_row+'][percentage]" class="form-control" placeholder="Percentage"></td>';
      html += '<td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery(\'#faqs-row' + faqs_row + '\').remove();"><i class="fa fa-trash"></i> Delete</a></td>';

      html += '</tr>';

  jQuery('#faqs tbody').append(html);

  faqs_row++;
  }

  var skill_obj_val = my_ajax_object.skill;
  var skill_row = skill_obj_val;
  function addskill() {
    html = '<tr id="skill-row' + skill_row + '">';
    html += '<td><input type="text" name="skill['+skill_row+']" class="form-control" placeholder="Skill"></td>';      
    html += '<td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery(\'#skill-row' + skill_row + '\').remove();"><i class="fa fa-trash"></i> Delete</a></td>';
    html += '</tr>';
    jQuery('#skills tbody').append(html);
    skill_row++;
  }

  var wordk_exp_arr_obj_val = my_ajax_object.wordk_exp_arr;
  var work_exp_table_row = wordk_exp_arr_obj_val;
  function add_work_exp_table() {
    html = '<tr id="work_exp_table-row' + work_exp_table_row + '">';
    html += '<td><input type="text" name="wordk_exp_arr[' + work_exp_table_row + '][company_name]" class="form-control" placeholder="Company Name"></td>';
    html += '<td><input type="text" name="wordk_exp_arr[' + work_exp_table_row + '][emp_number]" class="form-control" placeholder="Emp Number"></td>';
    html += '<td><input type="text" name="wordk_exp_arr[' + work_exp_table_row + '][joining_date]" class="form-control" placeholder="Joining Date"></td>';
    html += '<td><input type="text" name="wordk_exp_arr[' + work_exp_table_row + '][end_date]" class="form-control" placeholder="End Date"></td>';
    html += '<td><input type="text" name="wordk_exp_arr[' + work_exp_table_row + '][designation]" class="form-control" placeholder="Designation"></td>';
    html += '<td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery(\'#work_exp_table-row' + work_exp_table_row + '\').remove();"><i class="fa fa-trash"></i> Delete</a></td>';
    html += '</tr>';
    jQuery('#work_exp_table tbody').append(html);
    work_exp_table_row++;
  }

  var certificates_obj_val = my_ajax_object.certificates;
  var certificates_row = certificates_obj_val;
  function add_certificates() {
    html = '<tr id="certificates-row' + certificates_row + '">';
    html += '<td><input type="text" name="certificates[' + certificates_row + '][name]" class="form-control" placeholder="Name"></td>';
    html += '<td><input type="text" name="certificates[' + certificates_row + '][url]" class="form-control" placeholder="URL"></td>';
    html += '<td><input type="text" name="certificates[' + certificates_row + '][grade]" class="form-control" placeholder="Grade"></td>';
    html += '<td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery(\'#certificates-row' + certificates_row + '\').remove();"><i class="fa fa-trash"></i> Delete</a></td>';
    html += '</tr>';
    jQuery('#certificates tbody').append(html);
    certificates_row++;
  }

  var awards_obj_val = my_ajax_object.awards;
  var awards_row = awards_obj_val;
  function add_awards() {
    html = '<tr id="awards-row' + awards_row + '">';
    html += '<td><input type="text" name="awards[' + awards_row + '][name]" class="form-control" placeholder="Name"></td>';
    html += '<td><input type="text" name="awards[' + awards_row + '][detail]" class="form-control" placeholder="Detail"></td>';  
    html += '<td class="mt-10"><a href="javascript:void(0);" class="badge badge-danger" onclick="jQuery(\'#awards-row' + awards_row + '\').remove();"><i class="fa fa-trash"></i> Delete</a></td>';
    html += '</tr>';
    jQuery('#awards tbody').append(html);
    awards_row++;
  }

jQuery("document").ready(function () {
  jQuery("#jobslist").dataTable({
    "searching": true,
    mark: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend:'pdf',
            text: 'Download In PDF',
            className: 'red',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4 ]
            }
        },
        /*{
            extend: 'csv',
            text: 'Copy all data',
            exportOptions: {
                modifier: {
                search: 'none'
                }
            }
        }*/
    ]
  });
});