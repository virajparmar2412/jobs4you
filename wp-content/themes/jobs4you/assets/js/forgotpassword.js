jQuery(document).ready(function($){
	/*********************************
	* Forgot Password submit
	**********************************/
	$("#forgot_password").validate({
		rules: {                          
			'forgot_email': {
				required: true,
				email: true,                        
			},
		},
		messages: {         
			'forgot_email': {
				required: "The email field is mandatory!",
				email: "Please enter a valid email address!",               
			},          
		},
		submitHandler: function(form) {
			$("#forgot_password h2").remove();
			var emailID = $('#forgot_email').val();
			var formData = {
				'action' : 'forgot_email_fn',
				'forgot_email' : emailID
			};
			$.ajax({
				type: "post",
				dataType: "json",
				url: my_ajax_object.ajax_url,
				data: formData,
				success: function(msg){
					if(msg.code == 200){
						$("#forgot_password").append('<h2 class="h5 alert-success">'+msg.message+'</h2>');
					}
					if(msg.code != 200){
						$("#forgot_password").append('<h2 class="h5 alert alert-warning">'+msg.message+'</h2>');
					}
				}
			});
		},		
	});
	/*********************************
	* Reset Password submit
	**********************************/
	$("#reset_password").validate({
		rules: {                          
			'rest_pwd': {
				required: true, 
				minlength: 8,                    
			},
			'cpwd': {
				required: true,
				equalTo: '#rest_pwd',                        
			},
		},
		messages: {         
			'rest_pwd': {
				required: "The field is mandatory!",
				minlength: "Enter the Password of at least 8 characters!",
			},          
			'cpwd': {
				required: "The field is mandatory!",
				equalTo:"The password is not match"
			}
		},
		submitHandler: function(form) {
			var rest_pwd = $('#rest_pwd').val();
			var usereemail = $('#usereemail').val();
			var userlogin = $('#userlogin').val();
			var userID = $('#userID').val();
			var redirecttologin = $('#redirecttologin').val();
			var formData = {
				'action' : 'reset_pass_fn',
				'rest_pwd' : rest_pwd,
				'useremail' : usereemail,
				'userlogin' : userlogin,
				'userID' : userID
			};
			$.ajax({
				type: "post",
				dataType: "json",
				url: my_ajax_object.ajax_url,
				data: formData,
				success: function(msg){
					if(msg == 1){
						setInterval(function() {
							$(".rest_wrap").html('<h2>Password Is reset try to login</h2>');
							window.location.href = redirecttologin;
						}, 5000); 
					}
				}
			});
		},		
	});
	/*********************************
	* Change Password submit
	**********************************/
	$("#change_password").validate({
		rules: {   
			'old_pwd': {
				required: true, 
				minlength: 8,                    
			},                       
			'new_pwd': {
				required: true, 
				minlength: 8,                    
			},
			'new_cpwd': {
				required: true,
				equalTo: '#new_pwd',                        
			},
		},
		messages: { 
			'old_pwd': {
				required: "The field is mandatory!",
				minlength: "Enter the Password of at least 8 characters!",
			},        
			'new_pwd': {
				required: "The field is mandatory!",
				minlength: "Enter the Password of at least 8 characters!",
			},          
			'new_cpwd': {
				required: "The field is mandatory!",
				equalTo:"The password is not match"
			}
		},
		submitHandler: function(form) {
			$("#change_password h2").remove();
			var old_pwd = $('#old_pwd').val();
			var new_pwd = $('#new_pwd').val();
			var userlogin = $('#userlogin').val();
			var userID = $('#userID').val();
			var redirecttologin = $('#redirecttologin').val();
			var formData = {
				'action' : 'change_pass_fn',
				'old_pwd' : old_pwd,
				'new_pwd' : new_pwd,
				'userlogin' : userlogin,
				'userID' : userID
			};
			$.ajax({
				type: "post",
				dataType: "json",
				url: my_ajax_object.ajax_url,
				data: formData,
				success: function(msg){
					if(msg.code == 200){
						$("#change_password").append('<h2 class="h5 alert-success">Password Is changed</h2>');
					}
					if(msg.code != 200){
						$("#change_password").append('<h2 class="h5 alert alert-warning">'+msg.message+'</h2>');
					}
				}
			});
		},		
	});
});