jQuery(document).ready(function($){

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
      }
    });

  /*********************************
  * Company Login validation
  **********************************/

  $("#company_login").validate({
      rules: {                            
          'company_email': {
              required: true,
              email: true,                        
          },                    
          'company_password': {
              required: true,
              minlength: 8,
              maxlength: 255,
          },
          
      },
      messages: {          
          'company_email': {
              required: "The email field is mandatory!",
              email: "Please enter a valid email address!", 
              
          },
          'company_password': {
              required: "The Password is required!",
              minlength: "Enter the Password of at least 8 characters!",
              maxlength: "Enter the Password is too much lenght.",
          }
      }
    });

  /*********************************
  * JobSeeker Login validation
  **********************************/

  $("#jobseeker_login").validate({
      rules: {                            
          'jobseeker_email': {
              required: true,
              email: true,                        
          },                    
          'jobseeker_pwd': {
              required: true,
              minlength: 8,
              maxlength: 255,
          },
          
      },
      messages: {          
          'jobseeker_email': {
              required: "The email field is mandatory!",
              email: "Please enter a valid email address!", 
              
          },
          'jobseeker_pwd': {
              required: "The Password is required!",
              minlength: "Enter the Password of at least 8 characters!",
              maxlength: "Enter the Password is too much lenght.",
          }
      }
    });

  /*********************************
  * Admin Login validation
  **********************************/

  $("#admin_login").validate({
      rules: {                            
          'admin_email': {
              required: true,
              email: true,                        
          },                    
          'admin_password': {
              required: true,
              minlength: 8,
              maxlength: 255,
          },
          
      },
      messages: {          
          'admin_email': {
              required: "The email field is mandatory!",
              email: "Please enter a valid email address!", 
              
          },
          'admin_password': {
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
      rules: {
          'txt_nationality': {
              required: true,
              minlength: 3,
              maxlength: 20,
          }, 
          'txt_language': {
              required: true,
              minlength: 3,
              maxlength: 15,
          },
          'date_of_birth': {
              required: true,
          }, 
          'txt_address': {
              required: true,
              minlength: 8,
              maxlength: 100,
          },
          'high_qualification': {
              required:true,
              minlength: 8,
              maxlength:255,
          },
          'work_exp': {
              required:true,
              minlength: 8,
              maxlength:255,
          },
          'txt_project': {
              required:true,
              minlength: 5,
              maxlength:255,
          },
          'txt_skills': {
              required:true,
              minlength: 5,
              maxlength:100,
          },
      },
      messages: {
          'txt_nationality': {
              required: "The Nationality field is mandatory!",
              minlength: "Enter the Nationality of at least 3 letters!",
              maxlength: "Enter the Nationality of too much lenght.",
          }, 
          'txt_language': {
              required: "The Language field is mandatory!",
              minlength: "Enter the language of at least 3 letters!",
              maxlength: "Enter the language of too much lenght.",
          },
          'date_of_birth': {
              required: "The DOB field is mandatory!",
          }, 
          'txt_address': {
              required: "The Address field is mandatory!",
              minlength: "Enter the Address of at least 8 letters!",
              maxlength: "Enter the Address of too much lenght.",
          },
          'high_qualification': {
              required: "The High qualification field is mandatory!",
              minlength: "Enter the High qualification of at least 8 letters!",
              maxlength: "Enter the High qualification of too much lenght.",
          },
          'work_exp': {
              required: "The Work Experience field is mandatory!",
              minlength: "Enter the Work Experience of at least 8 letters!",
              maxlength: "Enter the Work Experience of too much lenght.",
          },
          'txt_project': {
              required: "The Project field is mandatory!",
              minlength: "Enter the Project of at least 5 letters!",
              maxlength: "Enter the Project of too much lenght.",
          },
          'txt_skills': {
              required:"The Skills field is mandatory!",
              minlength: "Enter the skills of at least 5 letters!",
              maxlength: "Enter the skills of too much lenght.",
          },
        }
    });

});