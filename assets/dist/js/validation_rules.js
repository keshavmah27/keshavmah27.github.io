$().ready(function() {
	jQuery.validator.addMethod("lettersonly", function(value, element) {
	  return this.optional(element) || /^[a-z]+$/i.test(value);
	}, "Letters only please"); 

	// space validation

	jQuery.validator.addMethod("noSpace", function(value, element) { 
	  return value.indexOf(" ") < 0 && value != ""; 
	}, "No space please and don't leave it empty");

	// password validation 

	$.validator.addMethod("validpass", function (value, element) {
	     if (/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}/.test(value)) {
	         return true;
	     } else {
	         return false; };
	 }, "Enter atleast one uppercase, lowercase, numeric value, special character & minimum 8 charaters.");

	// email exist check for driver


	// email exist check for Parent

	$.validator.addMethod("emailCheckParent", function (value, element)
	{
		$.ajax({
	 		url : "<?php echo base_url('admin/User/check_email') ?>",
	 		type : "post",
	 		data : {
	 			'email' : value 
	 		},
	 		success : (data)=>{
	 			if(data > 0)
	 			{
					return false;
				}
				else
				{
					return true;
				}
	 		}
	 	});
	}, "Email is already exist");

	// admin profile validation start

	
	
	
	// validate signup form on keyup and submit
	$("#registerForm").validate({
		rules: {
			fname: "required",
			lname: "required",
			password: {
				required: true,
				minlength: 5
			},
			cnf_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			fname: "Please enter your first name",
			lname: "Please enter your last name",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			cnf_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: {
				required: 'Email address is required',
				email: 'Please enter a valid email address'
			}
			
		}
	});

	$("#createSession").validate({
		rules: {
			password: {
				required: true
			},
			email: {
				required: true,
				email: true,
			}

		},
		messages: {
			password: {
				required: "Password is required"
			},
			email: {
				required: 'Email address is required',
				email: 'Please enter a valid email address'
			}
		}
	});

	$('#certification_form').validate({
		rules:{
			name: {
				required: true
			},	
			organization: {
				required: true
			},
			issue:{
				required: true
			},
			cred_id: {
				required: true
			},	
			cred_url: {
				required: true
			},
			image: {
				required: true
			}
		},
		messages: {
			name: {
				required: "Certification name is required."
			},	
			organization: {
				required: "Certification organization is required."
			},
			issue:{
				required: "Certification issue date is required."
			},
			cred_id: {
				required: "Certification credential id is required."
			},	
			cred_url: {
				required: "Certification credential URL is required."
			},
			image: {
				required: "Certification image is required."
			}
		}
	});

	$('#certification_edit_form').validate({
		rules:{
			name: {
				required: true
			},	
			organization: {
				required: true
			},
			issue:{
				required: true
			},
			cred_id: {
				required: true
			},	
			cred_url: {
				required: true
			}
		},
		messages: {
			name: {
				required: "Certification name is required."
			},	
			organization: {
				required: "Certification organization is required."
			},
			issue:{
				required: "Certification issue date is required."
			},
			cred_id: {
				required: "Certification credential id is required."
			},	
			cred_url: {
				required: "Certification credential URL is required."
			}
		}
	});

	$('#requestForm').validate({
		rules:{
			sheet: {
				required: true
			}
		},
		messages: {
			sheet: {
				required: "Spreed Sheet is required."
			}
		}
	});

	$("#userFormEdit").validate({
		rules: {
			username: {
	            required :true,
	            // lettersonly: true,
	          },
		     // profile_image: {
	      //   required: true
	      //   // extension: "jpg|jpeg|png"
	      // },
	          dob : {
	            required :true,
	            
     		 },
						
			email: {
				required: true,
				email: true
			}
			

		},
		messages: {
			username: {
	            required :'Please enter your username.',
	            // lettersonly: "Please type alphabet only.",
	          },
	       //    profile_image: {
		      //   required: "Please upload image.",
		      //   // extension: "Only .jpg and .jpeg,.png files allowed"
		      // },
	          dob : {
	            required :'Please enter Birthdate.',
	            // lettersonly: "Please type alphabet only.",
	          },
			
			email: {
				required: 'Email address is required',
				email: 'Please enter a valid email address'
				//remote: 'Email already used.'
			}
			
			
		}
	});

	function abnValidate(value, element){
  if (value.length != 11 || isNaN(parseInt(value)))
  return false;
  var weighting =[10,1,3,5,7,9,11,13,15,17,19];
  var tally = (parseInt(value[0]) - 1) * weighting[0];
  for (var i = 1; i < value.length; i++){
  tally += (parseInt(value[i]) * weighting[i]);
  }
  return (tally % 89) == 0;
}
jQuery.validator.addMethod(
  'abnValidate',
  abnValidate, 'This ABN is not valid'
);

	$("#venueFormEdit").validate({
	    // Specify validation rules
	    rules: {
	      venue_name: {
	            required :true,
	            // lettersonly: true,
	          },
	       //    venue_image: {
		      //   required: true
		      //   // extension: "jpg|jpeg|png"
		      // },
	          email: {
	       		required: true,
		        email: true
		       
     		 },  
     		 abn:{
			        required :true,
			        // number:true,
			        // max:11
			        abnValidate:true,
			      },
		     account_manager : {
	            required :true,
	            // lettersonly: true,
     		 },
     		  address : {
	            required :true
	            
     		 },
     		 'venue_type[]': {
		            required : true,
		      },
		      'menu_type[]': {
		            required : true,
		      },
     		 // membership_end_date : {
	       //      required :true,
	            
     		 // }
     		
     		 // phone:{
		      //   required :true,
		      //   number:true,
		      //   max:12
		      // },
		     
		      website_url: {
		        url: true
		        
		      },
		      facebook_url: {
		        url: true
		        
		      },
		      instagram_url: {
		        url: true
		        
		      }
		     
	      
	    },
	    errorPlacement: function (error, element) {
			// console.log('error = ' + error);
			// console.log('element1 = ' + element.closest("select").siblings("div").attr('class'));
			// console.log('element = ' + element.parent("div").find("select").siblings("div").attr('class'));
			// console.log('element = ' + element.closest("select").siblings("div").attr('class'));
			// console.log('element = ' + element.parents("ul").siblings("div").attr('class'));
			if (element.parent("div").find("select").siblings("div").attr('class') == "error venueTypeError") {
			// error.insertAfter($(element).siblings('span'));
			// console.log('venueTypeError = ' + element.attr("class"));
			error.insertAfter("#venueTypeError");
			}else if (element.parent("div").find("select").siblings("div").attr('class') == "error menusError") {
			// error.insertAfter($(element).siblings('span'));
			error.insertAfter("#menusError");
			}else{
			error.insertAfter($(element));
			}
		},
	    // Specify validation error messages
	    messages: {
	      venue_name: {
	            required :'Please enter venue name.',
	            // lettersonly: "Please type alphabet only.",
	          },
	          email: {
		        required :"Please enter email.",
		        email:"enter valid email"
		        
		      },
		      // venue_image: {
		      //   required: "Please upload image.",
		      //   // extension: "Only .jpg and .jpeg,.png files allowed"
		      // },
	          abn: {
        required :"Please enter your abn.",
        number:"Only number allowed",
        max:"Your number must be 11 characters long."
      },
		      account_manager : {
	            required :'Please enter your account manager .',
	            // lettersonly: "Please type alphabet only.",
	          },
	          address : {
	            required :'Please enter address.'
	            
	          },
	          'venue_type[]': {
            required :"Please select venue type. ",
		      },
		      'menu_type[]': {
		            required :"Please select menu type.",
		      },
	          // membership_end_date : {
	          //   required :'Please enter date.',
	          //   // lettersonly: "Please type alphabet only.",
	          // }
	    
	    //  	 phone: {
			  //       required :"Please enter your phone number.",
			  //       number:"Only number allowed",
			  //       max:"Your number must be 12 characters long."
			  //     },
			  // // // created_date : "Please enter a created_date",
			  // // membership_end_date : "Please enter a membership_end_date",
			  // // status : "Please select status",
				 // // venue_type: "Please enter your venue type.",
				 website_url:{
		        url : "Please enter valid url."
		        
		      },
		      facebook_url:{
		        url : "Please enter valid url."
		        
		      },
		      instagram_url:{
		        url : "Please enter valid url."
		        
		      }
	        
	    },
	    //   venue_type: "Please enter your venue type.",
	    //   account_manager : {
	    //         required :'Please enter your account manager name.',
	    //         lettersonly: "Please type alphabet only.",
	    //       },
	    //   address:"Please enter your address.",
	    //   abn: {
	    //     required :"Please enter your abn.",
	    //     number:"Only number allowed",
	    //     max:"Your number must be 11 characters long."
	    //   },
	    //   password: {
	    //     required: "Please provide a password",
	    //     minlength: "Your password must be at least 6 characters long"
	    //   },
	    //   email: "Please enter a valid email address"
	    // },
	    // Make sure the form is submitted to the destination defined
	    // in the "action" attribute of the form when valid
	    submitHandler: function(form) {
	      form.submit();
	    }
  	});

	$("#msgFormAdd").validate({
		rules: {
			access_key: {
	            required :true,
	            // lettersonly: true,
	          },						
			message: {
				required: true,
			}
			
		},
		messages: {
			access_key: {
	            required :'Please enter your access key.',
	            // lettersonly: "Please type alphabet only.",
	          },		
			message: {
				required: 'Please enter your message.',
			}
					
		},
		submitHandler: function(form) {
	      form.submit();
	    }
	});


	$("#formFilter").validate({
		rules: {						
			dateData: {
				required: true,
			}
			
		},
		messages: {		
			dateData: {
				required: 'Please select one.',
			}
					
		},
		submitHandler: function(form) {
	      form.submit();
	    }
	});

	$("form[name='passform']").validate({
   
    	rules: {
    
      current_password: {
        required: true,
        minlength: 5,
        noSpace : true
      },
      password: {
        required: true,
        minlength: 5,
        noSpace : true
      },
      conpassword: {
        required: true,
        minlength: 5,
        equalTo : "#password",
        noSpace : true
      },
    },
    		// Specify validation error messages
    	messages: {
      current_password: {
        required: "Please enter a current password.",
        minlength: "Your password must be at least 5 characters long."
      },
      password: {
        required: "Please enter a new password.",
        minlength: "Your password must be at least 5 characters long."
      },
      conpassword: {
        required: "Please enter confirm password.",
        minlength: "Your password must be at least 5 characters long.",
        equalTo : "Confirm password not matched with password.",
      },


    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });


	$("form[name='resetPasswordForm']").validate({
    // Specify validation rules
    rules: {
      
     email: {
				required: true,
				email: true,
				noSpace : true
			},
      password: {
        required: true,
        noSpace :true,
        validpass : true
      },
      confirm_password: {
        required: true,
        equalTo : "#password",
        noSpace : true
      },
    },
    // Specify validation error messages
    messages: {
      email: {
				required: 'Please enter your email.',
				email:"Please enter valid email"
			},
      password: {
        required: "Please enter a password"
      },
      confirm_password: {
        required: "Please enter confirm password",
        equalTo : "Confirm password not matched with password",
      },


    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

	$("form[name='resetPasswordFormUser']").validate({
    // Specify validation rules
    rules: {
      
     email: {
				required: true,
				email: true
			},
      password: {
        required: true,
        minlength: 5
      },
      conpassword: {
        required: true,
        minlength: 5,
        equalTo : "#password"
      },
    },
    // Specify validation error messages
    messages: {
      email: {
				required: 'Please enter your email.',
				email:"Please enter valid email"
			},
      password: {
        required: "Please enter a password",
        minlength: "Your password must be at least 5 characters long"
      },
      conpassword: {
        required: "Please enter confirm password",
        minlength: "Your password must be at least 5 characters long",
        equalTo : "Conmfirm password not matched with password",
      },


    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

	$("#forgetValidation").validate({
		rules: {						
			email: {
				required: true,
				email: true
			}
			
		},
		messages: {		
			email: {
				required: 'Please enter your email.',
				email:"Please enter valid email"
			}
					
		},
		submitHandler: function(form) {
	      form.submit();
	    }
	});

	

	
});